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


//one chord
class ACCORD {
	//fields
	ahMain;			// chord base, one of ahXXXX
	bMainES;		// lowered chord
	bMainIS;		// raised chord
	ahBass;			// bass note,    -"-
	bBassES;		// lowered bass
	bBassIS;		// raised bass
	bMoll;			// true = moll
	nModIdx;		// modifier index
	
	//clears fields
	clear() {
		this.ahMain=ahNONE; this.bMainES=false; this.bMainIS=false;
		this.ahBass=ahNONE; this.bBassES=false; this.bBassIS=false;
		this.bMoll=false;
	};
	
	//string input -> fields; returns false if not a valid chord
	decode(str) {
		let ret = doDecode(str);
		if (!ret) clear();			//on error clean up the structure
		return ret;
	}
	
	doDecode(str) {
		clear();
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
};

export default ACCORD;
