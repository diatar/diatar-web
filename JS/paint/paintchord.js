import ENVIRONMENT from "./environment.js";

//note
const ahNONE	= 0;
const ahC		= 1;
const ahD		= 2;
const ahE		= 3;
const ahF		= 4;
const ahG		= 5;
const ahA		= 6;
const ahH		= 7;

const AkkordModArray = [
    '',     '#',    'o',    '7',    '7+',   'o7',   'o7-',   'o7+',   '#7',
    '#7+',  '6',    '79',   '79-',  '79+',  '#79',  '#79+',  '7+9',   '7+9+',
    '#7+9', '#7+9+','o79',  'o79-', '9',    '9-',   '9+',    '#9',    '#9+',
    'o9',   'o9-',  '4',    '2',    '47',   '49',   '49-',   '49+'
  ];

const AkkordCanBeMinor = [
    true,   false,  false,  true,   true,   false,   false,  false,   false,
    false,  true,   true,   true,   false,  false,   false,  true,    false,
    false,  false,  false,  false,  true,   true,    false,  false,   false,
    false,  false,  false,  false,  false,  false,   false,  false
  ];

//chord modifiers on screen
const AkkordOutputArray = [
    '',     '+',    'o',    '7',    '7+',   'o/7',  'o/7-',  'o/7+',  '+/7',
    '+/7+', '6',    '7/9',  '7/9-', '7/9+', '+/7/9','+/7/9+','7+/9',  '7+/9+',
    '+/7+/9','+/7+/9+','o/7/9','o/7/9-','9','9-',  '9+',    '+/9',   '+/9+',
    'o/9',  'o/9-', '4',    '2',    '4/7',   '4/9', '4/9-',  '4/9+'
  ];


//one chord
class ACCORD {
	//fields
	ahMain;			// chord base, one of ahXXXX
	bMainES;		// lowered chord
	bMainIS;		// raised chord
	ahBass;			// bass note,    -"-
	bBassES;		// lowered bass
	bBassIS;		// raised bass
	bMoll;			// true = moll (minor chord)
	nModIdx;		// modifier index (in AkkordModArray)
	nWidth;			// draw width (px)
	nW1=0; nW2; nWmod; nWbass;   //internal widths

	constructor() {
		this.clear();
	}
	
	//clears fields
	clear() {
		this.ahMain=ahNONE; this.bMainES=false; this.bMainIS=false;
		this.ahBass=ahNONE; this.bBassES=false; this.bBassIS=false;
		this.bMoll=false; this.nModIdx=0;
	};
	
	//string input -> fields; returns false if not a valid chord
	decode(str) {
		let ret = this.doDecode(str);
		if (!ret) this.clear();			//on error clean up the structure
		return ret;
	}
	
	doDecode(str) {
		this.clear();
		if (!str) return false;
		
		//decoding main chord note
		this.ahMain=this.decodeNote(str.substr(0,1));
		if (this.ahMain==ahNONE) return false;			//bad chord note?
		if (str.length<2) return true;					//finished?
		
		//checking for altered note
		let p=1;
		if (str.substr(1,1)=="+") {
			this.bMainIS=true;
			p++;
		} else if (str.substr(1,1)=='-') {
			this.bMainES=true;
			p++;
		}
		if (p>=str.length) return true;					//finished?
		
		//checking for minor chord
		if (str.substr(p,1)=="m") {
			this.bMoll=true;
			p++;
		}
		if (p>=str.length) return true;					//finished?
		
		let p0 = p;
		while (p<str.length && str.substr(p,1)!='/') p++;
		if (p>p0) {
			this.nModIdx=this.decodeMod(str.substr(p0,p-p0));
			if (this.nModIdx==0) return false;			//unknown modifier
			if (this.bMoll && !AkkordCanBeMinor[this.nModIdx]) return false;  //can't be applied on minor chord
		}
		if (p>=str.length) return true;					//finished?
		if (str.substr(p,1)!='/') return false;
		
		//bass note
		p++;
		if (p>=str.length) return false;				//invalid end on slash
		this.ahBass=this.decodeNote(str.substr(p,1));
		if (this.ahMain==ahNONE) return false;			//bad chord note?
		p++;
		if (p>=str.length) return true;					//finished?

		//checking for altered bass
		if (str.substr(p,1)=="+") {
			this.bBassIS=true;
			p++;
		} else if (str.substr(p,1)=='-') {
			this.bBassES=true;
			p++;
		}
		if (p>=str.length) return true;					//finished?
		
		//garbage on end of str
		return false;
	};
	
	//which note
	decodeNote(ch) {
		if (ch=='c' || ch=='C') return ahC;
		if (ch=='d' || ch=='D') return ahD;
		if (ch=='e' || ch=='E') return ahE;
		if (ch=='f' || ch=='F') return ahF;
		if (ch=='g' || ch=='G') return ahG;
		if (ch=='a' || ch=='A') return ahA;
		if (ch=='b' || ch=='B' || ch=='h' || ch=='H') return ahH;
		return ahNONE;
	};
	
	//chord modifiers
	decodeMod(str) {
		let idx = AkkordModArray.length;
		while (idx-->0) {
			if (str==AkkordModArray[idx]) return idx;
		}
		return 0;
	}

	//synthesize chord note string from parts
	NoteStr(ah,bis,bes,bmoll) {
		let str="";
		switch (ah) {
			case ahC : str+=(bmoll ? 'c' : 'C'); break;
			case ahD : str+=(bmoll ? 'd' : 'D'); break;
			case ahE : str+=(bmoll ? 'e' : 'E'); break;
			case ahF : str+=(bmoll ? 'f' : 'F'); break;
			case ahG : str+=(bmoll ? 'g' : 'G'); break;
			case ahA : str+=(bmoll ? 'a' : 'A'); break;
			case ahH :
				if (bes) str+=(bmoll ? 'b' : 'B'); else str+=(bmoll ? 'h' : 'H');
				break;
		}
		if (bis) str+='is'; else if (bes && ah!=ahH) str+=(ah==ahE || ah==ahA ? 's' : 'es');
		if (bmoll) str+='m';
		return str;
	}
	
	//setup nWidth (full), nW1 (note start), nW2 (note rest), nWbass (bass part), nWmod (modifier)
	calcWidth(env) {
		if (this.ahMain==ahNONE) {
			this.nWidth=0;
			return;
		}
		let str = this.NoteStr(this.ahMain,this.bMainIS,this.bMainES,this.bMoll);
		env.setFont(true,false);
		this.nW1 = env.oCtx.measureText(str.substr(0,1)).width;
		env.setFont(false,false);
		this.nW2 = env.oCtx.measureText(str.substr(1)).width;
		this.nWbass = ( this.ahBass==ahNONE ? 0 : env.oCtx.measureText('/'+this.NoteStr(this.ahBass,this.bBassIS,this.bBassES,false)) );
		this.nWmod=0;
		if (this.nModIdx>0) {
			env.setFontPercent(70,false,false);
			this.nWmod = env.oCtx.measureText(AkkordOutputArray[this.nModIdx]).width;
		}
		this.nWidth=this.nW1+this.nW2+this.nWmod+this.nWbass;
	}

	//draw chord
	paint(x,y,env) {
		if (this.ahMain==ahNONE) return;
		let str = this.NoteStr(this.ahMain,this.bMainIS,this.bMainES,this.bMoll);
		env.setFont(true,false);
		env.oCtx.fillText(str.substr(0,1),x,y);
		x+=this.nW1;
		env.oCtx.fillText(str.substr(1),x,y);
		x+=this.nW2;
		if (this.nModIdx>0) {
			env.setFontPercent(70,false,false);
			env.oCtx.fillText(AkkordOutputArray[this.nModIdx],x,y);
			env.setFont(false,false);
			x+=this.nWmod;
		}
		if (this.ahBass!=ahNONE) env.oCtx.fillText('/'+this.NoteStr(this.ahBass,this.bBassIS,this.bBassES,false));
	}
};

export default ACCORD;
