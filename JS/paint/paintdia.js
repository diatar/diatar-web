import ACCORD from "./paintchord.js";
import ENVIRONMENT from "./environment.js";

//end of atomic text
const endCONT	= 0;	//continued (no separator)
const endSPACE	= 1;	//space
const endHYPH	= 2;	//hyphen
const endEOL	= 3;	//end of line
const endBREAK	= 4;	//break proposal

//atomic block - this should be paint at once
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
	
	clone() {				//create an empty copy of myself
		let a = new ATOM();
		a.bBold=this.bBold;
		a.bItalic=this.bItalic;
		a.bUnderline=this.bUnderline;
		a.bStrike=this.bStrike;
		return a;
	}
	
	getTxtWithEnd() {
		if (this.eEndtype==endBREAK) return this.sTxt+" ";
		if (this.eEndtype==endSPACE) return this.sTxt+" ";
		if (this.eEndtype==endHYPH) return this.sTxt+"-";
		return this.sTxt;
	}
	
	calcWidth(env) {
		env.setFont(this.bBold, this.bItalic);
		const metrics1 = env.oCtx.measureText(this.getTxtWithEnd());
		this.nWidth=metrics1.width;
		const metrics2 = env.oCtx.measureText(this.sTxt);
		this.nTxtWidth=metrics2.width;
		if (this.oAccord!=null) this.oAccord.calcWidth(env);
	}
	
	getCurrWidth(env) {
		let w = this.nWidth;
		//if not at the end of row and this has conditional ending, the width is just the text
		if (!this.bBreak && (this.eEndtype==endBREAK || this.eEndtype==endHYPH)) w=this.nTxtWidth;
		if (this.oAccord!=null && env.bDrawAccord && this.oAccord.nWidth > w) w=this.oAccord.nWidth;
		return w;
	}

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
	}
}

//one line of input text
class LINE {
	//fields:
	aAtoms = [];				//array of ATOMs
	bHasAccord = false;		//true if any ACCORD
	
	//push oldatom into atoms[] and create a new one
	//  or keep the oldatom, if nothing to paint
	pushAtom(oldatom) {
		if (oldatom.sTxt.length>0			//if anything to paint
			|| oldatom.eEndtype==endHYPH
			|| oldatom.eEndtype==endSPACE
			|| oldatom.eEndtype==endBREAK
			|| oldatom.oAccord!=null)
		{
			this.aAtoms.push(oldatom);
			oldatom=oldatom.clone();
		}
		return oldatom;
	}
	
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
				if (ch=='-') {
					atom.eEndtype=endHYPH;
					atom=this.pushAtom(atom);
					continue;
				}
				if (ch=='.') {
					atom.eEndtype=endBREAK;
					atom=this.pushAtom(atom);
					continue;
				}
				if (ch=='K' || ch=='G' || ch=='?') {
					i++;
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
					}
					continue;
				}
			} else {
				if (ch=='\\') {
					esc=true;
					continue;
				}
				if (ch==' ') {
					atom.eEndtype=endSPACE;
					atom=this.pushAtom(atom);
					continue;
				}
				atom.sTxt+=ch;
			}
		}
		atom.eEndtype=endEOL;
		this.pushAtom(atom);
	}
	
	calcContinuationX(env) {
		return 2*env.nSpaceWidth;
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
				if (lastbreakable==null) {
					//maybe here we should split the atom...
					atom.bBreak=true;
					x=this.calcContinuationX(env);
					nrows++;
					continue;
				}
				lastbreakable.bBreak=true;
				lastbreakable=null;
				x=this.calcContinuationX(env)+(x-breakx);
				nrows++;
				continue;
			}
			if (atom.eEndtype==endSPACE || atom.eEndtype==endBREAK || atom.eEndtype==endHYPH) {
				lastbreakable=atom;
				breakx=x;
			}
		}
		return nrows;
	}
	
	paint(env, y) {
		let x=0;
		for (let atom of this.aAtoms) {
			atom.paint(x, y, env);
			if (atom.bBreak) {
				y+=env.nFontHeight;
				if (env.bDrawAccord && env.bHasAccord) y+=env.nFontHeight;
				x=this.calcContinuationX(env);
			} else {
				x+=atom.getCurrWidth(env);
			}
		}
		return y;
	}
}

class PAINTDIA {
	//fields:
	oEnv;						//ENVIRONMENT
	aLines = [];				//lines of source
	
	constructor(ctx) {
		this.oEnv = new ENVIRONMENT();
		this.oEnv.oCtx = ctx;
		this.oEnv.nWidth = ctx.canvas.clientWidth;
		this.oEnv.nHeight = ctx.canvas.clientHeight;
	}

	getHasAccord() {
		return this.oEnv.bHasAccord;
	}
	
	getDrawAccord() {
		return this.oEnv.bDrawAccord;
	}
	
	setDrawAccord(newval) {
		if (!this.oEnv.bHasAccord) return;
		this.oEnv.bDrawAccord=newval;
		this.oEnv.oCtx.clearRect(0,0,this.oEnv.nWidth,this.oEnv.nHeight);
		this.paint();
	}
	
	addLine(txt) {
		let line = new LINE();
		line.parse(txt);
		this.aLines.push(line);
		if (line.bHasAccord) this.oEnv.bHasAccord=true;
	}
	
	paint() {
		this.oEnv.nWidth = this.oEnv.oCtx.canvas.clientWidth;
		this.oEnv.nHeight = this.oEnv.oCtx.canvas.clientHeight;
		this.oEnv.sFontfamily = "Arial";

		let fsize = 60;
		let nrows = 0;
		let descent = 0;
		do {
			this.oEnv.nFontsize = fsize;
			this.oEnv.setFont(false,false);
			let metrics = this.oEnv.oCtx.measureText("ÁyXXXXXXXX");
			this.oEnv.nSpaceWidth = metrics.width/10;
			descent = metrics.fontBoundingBoxDescent;
			this.oEnv.nFontHeight = metrics.fontBoundingBoxAscent + descent;
			this.oEnv.nFontascent2 = metrics.fontBoundingBoxAscent/2;
			this.oEnv.nFontdescent2 = metrics.fontBoundingBoxDescent/2;
		
			nrows=0;
			for (let ln of this.aLines) {
				nrows+=ln.calcWidth(this.oEnv);
			}
			if (this.oEnv.bDrawAccord && this.oEnv.bHasAccord) nrows*=2;
			if (fsize>20) fsize-=2; else fsize--;
		} while (fsize>5 && nrows*this.oEnv.nFontHeight+descent >= this.oEnv.nHeight);
		
		let y=0;
		for (let ln of this.aLines) {
			y+=this.oEnv.nFontHeight;
			if (this.oEnv.bDrawAccord && this.oEnv.bHasAccord) y+=this.oEnv.nFontHeight;
			y=ln.paint(this.oEnv, y);
		}
		
	}
}

export default PAINTDIA;
