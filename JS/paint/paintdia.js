import ACCORD from "./paintchord.js";
import ENVIRONMENT from "./environment.js";
import KOTTA from "./kotta.js";

//end of atomic text
const endCONT	= 0;	//continued (no separator)
const endSPACE	= 1;	//space
const endHYPH	= 2;	//hyphen
const endEOL	= 3;	//end of line
const endBREAK	= 4;	//break proposal

//atomic block - this should be paint as one block
class ATOM {
	//fields:
	sTxt = "";				//text to output
	bBold = false;			//is bold?
	bItalic = false;		//is italic?
	bUnderline = false;		//is underlined?
	bStrike = false;		//is strikeout?
	eEndtype = endCONT;		//closing: empty, space, hyphen, ...
	nWidth = 0;				//object width
	nTxtWidth = 0;			//text width - w/o ending
	bBreak = false;			//line break after this?
	oAccord = null;			//chord
	sKotta = "";			//kotta text-encoded
	nKottaWidth = 0;		//kotta szelesseg
	
	//create an empty copy of myself (same formats)
	clone() {
		let a = new ATOM();
		a.bBold=this.bBold;
		a.bItalic=this.bItalic;
		a.bUnderline=this.bUnderline;
		a.bStrike=this.bStrike;
		return a;
	}

	//return sTxt with current ending
	getTxtWithEnd() {
		if (this.eEndtype==endBREAK) return this.sTxt+" ";
		if (this.eEndtype==endSPACE) return this.sTxt+" ";
		if (this.eEndtype==endHYPH) return this.sTxt+"-";
		return this.sTxt;
	}
	
	//calculate nWidth, nTxtWidth and oAccord widths
	calcWidth(env) {
		env.setFont(this.bBold, this.bItalic);
		const metrics1 = env.oCtx.measureText(this.getTxtWithEnd());
		this.nWidth=metrics1.width;
		const metrics2 = env.oCtx.measureText(this.sTxt);
		this.nTxtWidth=metrics2.width;
		if (this.oAccord!=null) this.oAccord.calcWidth(env);
		if (env.bDrawKotta) this.nKottaWidth=env.oKotta.getWidth(this.sKotta);
	}
	
	//return actual width (with or without ending)
	getCurrWidth(env) {
		let w = this.nWidth;
		//if not at the end of row and this has conditional ending, the width is just the text
		if (!this.bBreak && (this.eEndtype==endBREAK || this.eEndtype==endHYPH)) w=this.nTxtWidth;
		if (this.oAccord!=null && env.bDrawAccord && this.oAccord.nWidth > w) w=this.oAccord.nWidth;
		if (env.bDrawKotta && this.nKottaWidth > w) w=this.nKottaWidth;
		return w;
	}

	//draw the atomic text with formattings
	paint(x,y, env) {
		env.setFont(this.bBold, this.bItalic);
		env.oCtx.fillText(this.getTxtWithEnd(), x, y);
		if (this.bUnderline) {
			let yul = y + env.nFontdescent2;
			env.oCtx.beginPath();
			env.oCtx.moveTo(x, yul);
			env.oCtx.lineTo(x+this.nWidth, yul);
			env.oCtx.stroke();
		}
		if (this.bStrike) {
			let yst = y - env.nFontascent2;
			env.oCtx.beginPath();
			env.oCtx.moveTo(x, yst);
			env.oCtx.lineTo(x+this.nWidth, yst);
			env.oCtx.stroke();
		}
		if (this.oAccord!=null && env.bDrawAccord) {
			this.oAccord.paint(x,y-env.nFontHeight,env);
		}
		if (env.bHasKotta && env.bDrawKotta) {
			env.oKotta.draw(x, this.sKotta);
		}
	}
}

//one line of input text
class LINE {
	//fields:
	aAtoms = [];				//array of ATOMs
	bHasAccord = false;		//true if any ACCORD
	bHasKotta = false;		//true if any KOTTA
	
	//push oldatom into atoms[] and create a new one
	//  or keep the oldatom, if nothing to paint
	pushAtom(oldatom) {
		if (oldatom.sTxt.length>0			//if anything to paint
			|| oldatom.eEndtype==endHYPH
			|| oldatom.eEndtype==endSPACE
			|| oldatom.eEndtype==endBREAK
			|| oldatom.oAccord!=null
			|| !oldatom.sKotta.empty()
		)
		{
			this.aAtoms.push(oldatom);
			oldatom=oldatom.clone();
		}
		return oldatom;
	}
	
	//decode a line of text
	parse(txt) {
		let esc=false;
		let atom = new ATOM();
		for (let i=0; i<txt.length; i++)
		{
			let ch=txt.substr(i,1);
			if (esc) {
				esc=false;
				//double backslash, nonbreaking space or n.b. hyphen
				if (ch=='\\' || ch==' ' || ch=='_') {
					if (ch=='_') ch='-';
					atom.sTxt+=ch;
					continue;
				}
				//change bold/italic/underline/strike
				if (ch=='B' || ch=='b') {
					atom = this.pushAtom(atom);
					atom.bBold=(ch=='B');
					continue;
				}
				if (ch=='I' || ch=='i') {
					atom = this.pushAtom(atom);
					atom.bItalic=(ch=='I');
					continue;
				}
				if (ch=='U' || ch=='u') {
					atom = this.pushAtom(atom);
					atom.bUnderline=(ch=='U');
					continue;
				}
				if (ch=='S' || ch=='s') {
					atom = this.pushAtom(atom);
					atom.bStrike=(ch=='S');
					continue;
				}
				//conditional hyphen
				if (ch=='-') {
					atom.eEndtype=endHYPH;
					atom=this.pushAtom(atom);
					continue;
				}
				//break proposal
				if (ch=='.') {
					atom.eEndtype=endBREAK;
					atom=this.pushAtom(atom);
					continue;
				}
				//kotta, accord or other long-escape sequence
				if (ch=='K' || ch=='G' || ch=='?') {
					i++;
					//moderner form: start all sequences with '?'
					if (ch=='?' && i<txt.length) ch=txt.substr(i++,1);
					let p0=i;
					while (i<txt.length && txt.substr(i,1)!=';') i++;
					if (ch=='G') {
						let newacc = new ACCORD();
						newacc.clear();
						if (newacc.decode(txt.substr(p0,i-p0))) {
							atom=this.pushAtom(atom);
							atom.oAccord=newacc;
							this.bHasAccord=true;
						}
					} else if (ch=='K') {
						atom=this.pushAtom(atom);
						atom.sKotta=txt.substr(p0,i-p0);
						this.bHasKotta=true;
					}
					continue;
				}
			} else {
				if (ch=='\\') {
					esc=true;
					continue;
				}
				//end of a word with space
				if (ch==' ') {
					atom.eEndtype=endSPACE;
					atom=this.pushAtom(atom);
					continue;
				}
				atom.sTxt+=ch;
			}
		}
		//end of line
		atom.eEndtype=endEOL;
		this.pushAtom(atom);
	}
	
	//continuation line starts (default: 2 spaces indentation)
	calcContinuationX(env) {
		let x=2*env.nSpaceWidth;
		//if (env.bHasKotta && env.bDrawKotta && env.oKotta.fPostX > x) {
		//	x=env.oKotta.fPostX;
		//}
		return x;
	}

	//returns the number of rows it uses
	calcWidth(env) {
		let nrows=1;
		let x=0;
		let lastbreakable=null;
		let breakx=0;
		for (let atom of this.aAtoms) {
			atom.bBreak=false;
			atom.calcWidth(env);
			x+=atom.getCurrWidth(env);
			if (x > env.nWidth) {
				if (lastbreakable==null) { //this atom is alone too fat
					//maybe here we should split the atom...
					atom.bBreak=true;
					x=this.calcContinuationX(env);
					nrows++;
					continue;
				}
				//split line at last breakable position
				lastbreakable.bBreak=true;
				lastbreakable=null;
				x=this.calcContinuationX(env)+(x-breakx);
				nrows++;
				continue;
			}
			//is line breakable at this point?
			if (atom.eEndtype==endSPACE || atom.eEndtype==endBREAK || atom.eEndtype==endHYPH) {
				lastbreakable=atom;
				breakx=x;
			}
		}
		return nrows;
	}
	
	//draw the whole line
	paint(env, y) {
		let x=0;
		let drawkotta=(env.bDrawKotta && env.bHasKotta);
		let startrow=true;
		for (let atom of this.aAtoms) {
			if (startrow) {
				startrow=false;
				if (drawkotta) {
					env.oKotta.startDraw(x,y-2*env.nFontHeight,0);
					let xk=env.oKotta.startLine();
					if (xk>x) x=xk;
				}
			}
			atom.paint(x, y, env);
			x+=atom.getCurrWidth(env);
			if (atom.bBreak) {
				startrow=true;
				if (drawkotta) {
					env.oKotta.endDraw(x);
				}
				y+=env.nFontHeight;
				if (env.bDrawAccord && env.bHasAccord) y+=env.nFontHeight;
				if (drawkotta) y+=env.nFontHeight;
				x=this.calcContinuationX(env);
			}
		}
		if (drawkotta && !startrow) {
			env.oKotta.endDraw(x);
		}
		return y;
	}
}

//the main object, a whole screen of output
class PAINTDIA {
	//fields:
	oEnv = null;				//ENVIRONMENT
	aLines = [];				//lines of source
	
	constructor(ctx) {
		this.oEnv = new ENVIRONMENT();
		this.oEnv.oCtx = ctx;
		this.oEnv.nWidth = ctx.canvas.clientWidth;
		this.oEnv.nHeight = ctx.canvas.clientHeight;
		this.oEnv.oKotta = new KOTTA(this.oEnv);
	}

	//export internal values
	getHasAccord() {
		return this.oEnv.bHasAccord;
	}
	
	getDrawAccord() {
		return this.oEnv.bDrawAccord;
	}
	
	//set draw/hide chords; and repaint screen
	setDrawAccord(newval) {
		if (!this.oEnv.bHasAccord) return;
		this.oEnv.bDrawAccord=newval;
		this.oEnv.oCtx.clearRect(0,0,this.oEnv.nWidth,this.oEnv.nHeight);
		this.paint();
	}
	
	getHasKotta() {
		return this.oEnv.bHasKotta;
	}
	
	getDrawKotta() {
		return this.oEnv.bDrawKotta;
	}

	//set draw/hide music sheet; and repaint screen
	setDrawKotta(newval) {
		if (!this.oEnv.bHasKotta) return;
		this.oEnv.bDrawKotta=newval;
		this.oEnv.oCtx.clearRect(0,0,this.oEnv.nWidth,this.oEnv.nHeight);
		this.paint();
	}
	
	//fill aLines with decoded texts
	addLine(txt) {
		let line = new LINE();
		line.parse(txt);
		this.aLines.push(line);
		if (line.bHasAccord) this.oEnv.bHasAccord=true;
		if (line.bHasKotta) this.oEnv.bHasKotta=true;
	}

	//draw full screen
	paint() {
		this.oEnv.nWidth = this.oEnv.oCtx.canvas.clientWidth;
		this.oEnv.nHeight = this.oEnv.oCtx.canvas.clientHeight;
		this.oEnv.sFontfamily = "Arial";

		//reduce size until the whole text fits in canvas
		let fsize = 60;
		let nrows = 0;
		let descent = 0;
		let drawaccord = (this.oEnv.bHasAccord && this.oEnv.bDrawAccord);
		let drawkotta = (this.oEnv.bHasKotta && this.oEnv.bDrawKotta);
		let rowmul=1;
		if (drawaccord) rowmul++;
		if (drawkotta) rowmul++;
		do {
			//set font sizes
			this.oEnv.nFontsize = fsize;
			this.oEnv.setFont(false,false);
			let metrics = this.oEnv.oCtx.measureText("ÁyXXXXXXXX");
			this.oEnv.nSpaceWidth = metrics.width/10;
			descent = metrics.fontBoundingBoxDescent;
			this.oEnv.nFontHeight = metrics.fontBoundingBoxAscent + descent;
			this.oEnv.nFontascent2 = metrics.fontBoundingBoxAscent/2;
			this.oEnv.nFontdescent2 = metrics.fontBoundingBoxDescent/2;
			if (drawkotta) {
				this.oEnv.oKotta.reset(false);
				this.oEnv.oKotta.setHeight(this.oEnv.nFontHeight);
			}
		
			//calculate needed rows
			nrows=0;
			for (let ln of this.aLines) {
				if (drawkotta) this.oEnv.oKotta.reset(true);
				nrows+=ln.calcWidth(this.oEnv);
			}
			nrows*=rowmul;
			if (fsize>20) fsize-=2; else fsize--;
		} while (fsize>5 && nrows*this.oEnv.nFontHeight+descent >= this.oEnv.nHeight);

		//draw
		if (drawkotta) {
			this.oEnv.oKotta.reset(false);
			this.oEnv.oKotta.setHeight(this.oEnv.nFontHeight);
		}
		let y=0;
		for (let ln of this.aLines) {
			if (drawkotta) this.oEnv.oKotta.reset(true);
			y+=this.oEnv.nFontHeight;
			if (drawaccord) y+=this.oEnv.nFontHeight;
			if (drawkotta) y+=this.oEnv.nFontHeight;
			y=ln.paint(this.oEnv, y);
		}
	}
}

export default PAINTDIA;
