class ENVIRONMENT {
	//fields:
	ctx;				//canvas context
	width;				//screen width
	height;				//screen height
	fontsize;			//font size
	fontfamily;			//font family
	
	getFontName(bd,it) {
		return (bd ? "bold " : "")+(it ? "italic " : "") + this.fontsize + "pt " + this.fontfamily;
	};
	setFont(bd,it) {
		this.ctx.font = this.getFontName(bd,it);
	};
	outTxt(txt,x,y, bd,it,ul) {
		this.setFont(bd,it);
		this.ctx.fillText(txt, x, y);
		const metrics = this.ctx.measureText(txt);
		if (ul) {
			let yul = y + metrics.fontBoundingBoxDescent/2;
			this.ctx.beginPath();
			this.ctx.moveTo(x, yul);
			this.ctx.lineTo(x+metrics.width, yul);
			this.ctx.stroke();
		}
		return metrics.width;
	}
	
};

class ATOM {
	//fields:
	txt = "";				//text
	bold = false;			//is bold?
	italic = false;			//is italic?
	underline = false;		//is underlined?
	endchar = "";			//closing: empty, space, hyphen, ...
	
	clone() {
		let a = new ATOM();
		a.bold=this.bold;
		a.italic=this.italic;
		a.underline=this.underline;
		return a;
	}
}

class LINE {
	//fields:
	atoms = [];				//array of ATOMs
	
	parse(txt) {
		let esc=false;
		let atom = new ATOM();
		for (let i=0; i<txt.length; i++)
		{
			let ch=txt.substr(i,1);
			if (esc) {
				esc=false;
				if (ch=='\\' || ch==' ' || ch=='-') {
					atom.txt+=ch;
					continue;
				}
				if (ch=='B' || ch=='b') {
					this.atoms.push(atom);
					atom = atom.clone();
					atom.bold=(ch=='B');
					continue;
				}
				if (ch=='I' || ch=='i') {
					this.atoms.push(atom);
					atom = atom.clone();
					atom.italic=(ch=='I');
					continue;
				}
				if (ch=='U' || ch=='u') {
					this.atoms.push(atom);
					atom = atom.clone();
					atom.underline=(ch=='U');
					continue;
				}
			} else {
				if (ch=='\\') {
					esc=true;
					continue;
				}
				atom.txt+=ch;
			}
		}
		if (atom.txt.length>0) this.atoms.push(atom);
	}
	
	paint(env, y) {
		let x=0;
		for (let atom of this.atoms) {
			let w = env.outTxt(atom.txt, x, y, atom.bold, atom.italic, atom.underline);
			x+=w;
		}
	}
}

class PAINTDIA {
	//fields:
	env;					//ENVIRONMENT
	lines = [];				//lines of source
	
	constructor(ctx) {
		this.env = new ENVIRONMENT();
		this.env.ctx = ctx;
		this.env.width = ctx.canvas.clientWidth;
		this.env.height = ctx.canvas.clientHeight;
	}
	
	addLine(txt) {
		let line = new LINE();
		line.parse(txt);
		this.lines.push(line);
	}
	
	paint() {
		this.env.fontsize = 30;
		this.env.fontfamily = "Arial";
		this.env.setFont(false,false);
		let metrics = this.env.ctx.measureText("Áy");
		let fontHeight = metrics.fontBoundingBoxAscent + metrics.fontBoundingBoxDescent;
		let y=0;
		for (let ln of this.lines) {
			y+=fontHeight;
			ln.paint(this.env, y);
		}
	}
}

export default PAINTDIA;
