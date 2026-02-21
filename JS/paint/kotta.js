import * as KottaConsts from "./kottaconsts.js";

//kotta pillanatnyi statusa
class KOTTASTATE {
	nVonalszam = 5;				//kottavonalak szama 0..5
	cKulcs = ' ';				//lasd kG, kF stb.
	nElojegy = 0;				//-7..+7
	cModosito = ' ';			//lasd m0,mk stb.
	cRitmus = '4';				//lasd r1,r2 stb.
	bPontozott = false;			//  ez true ha R1,R2 stb.
	bTomor = false;				//egymas melle irt kottafejek (gregorian neuamak)
	bGerenda = false;			//nyolcad v tizenhatod osszekoto
	bSzaaratlan = false;		//van-e szaara a hangjegyeknek?
	cAgogika = ' ';				//lasd a-,a. stb

	fNeumaX =0.0;				//neuma pozicioja (fuggoleges vonalhoz)
	fNeumaY = 0.0;

	fIvStartX = 0.0;			//ivek adatai
	fIvStartY = 0.0;
	fIvEndX = 0.0;
	fIvEndY = 0.0;
	fIvBalX = -1.0;
	fIvMaxY = -1.0;
	cIvTipus = ' ';				// semmi vagy ( vagy )
	cIvTipusLesz = ' ';			// kovetkezo iv tipusa lesz

	bTriLe = false;				// triola adatok
	bTriTipus = ' ';
	aTriPos = [];
};

//floating rect
class FRECT {
	fX = 0.0;
	fY = 0.0;
	fW = 0.0;
	fH = 0.0;

	constructor(x,y,w,h) {
		this.fX=x;
		this.fY=y;
		this.fW=w;
		this.fH=h;
	}
	
	assign(otherrect) {
		this.fX=otherrect.fX;
		this.fY=otherrect.fY;
		this.fW=otherrect.fW;
		this.fH=otherrect.fH;
	}
	
	left() { return this.fX; }
	right() { return this.fX+this.fW; }
	top() { return this.fY; }
	bottom() { return this.fY+this.fH; }
	width() { return this.fW; }
	height() { return this.fH; }
	centerX() { return this.fX+this.fW/2.0; }
	centerY() { return this.fY+this.fH/2.0; }
};

//max. 4 hangot kotunk ossze gerendaval, az osztaly az adatokat tarolja
const MAXGERENDA = 4;
class GERENDA {
	rFej = new FRECT();
	bLe = false;					//szaar iranya
	cRitmus = ' ';					// 8 vagy 6 
};

//ez egy komplett kottareszlet
class KOTTA {
	oEnv = null;					//teljes kornyezet, canvas stb.
	fX0 = 0.0;						//sor eleje
	fY0 = 0.0;
	fX = 0.0;						//jelenlegi poz.
	fPostX = 0.0;					//elojegyzes, kulcs, metrum utan
	iColor = 0;						//rajzolas szine
	
	fMinWidth = 0.0;				//kottaelem minimalis szelessege
	fRatio = 0.0;					//eredeti PNGkhez kepesti arany
	iVonalSzel = 0;					//vonalak szelessege 1..
	oState = new KOTTASTATE();
	
	aGer = [];						//MAXGERENDA darab GERENDA objektum
	iGerIdx = 0;
	
	//0 felso hatar, 1-2 felso pot, 3-7 vonal
	// 8-9 also pot, 10 also hatar
	aLineY = [];  					//kottavonalak pozicioja

	constructor(env) {
		this.oEnv=env;
		for (let i=0; i<MAXGERENDA; i++) this.aGer[i] = new GERENDA();
		for (let i=0; i<11; i++) this.aLineY[i] = 0.0;
	}
	
	/////////////////////////////////////////////////////////
	// publikus rutinok
	/////////////////////////////////////////////////////////

	//magassagok beallitasa (height a teljes magassag)
	setHeight(height) {
		for (let i=0; i<11; i++)
			this.aLineY[i]=i*height/10.0;
		this.fMinWidth=KottaConsts.Hang4fejWIDTH*this.aLineY[1]/(KottaConsts.Hang4Vonal2aY-KottaConsts.Hang4Vonal2fY);
		this.fRatio=this.aLineY[1]/(KottaConsts.Hang4Vonal2aY-KottaConsts.Hang4Vonal2fY);
		this.iVonalSzel=Math.floor(1.0+this.fRatio*KottaConsts.ZaszloSzelesseg);
	}
	
	//oState alaphelyzetbe - keep: kulcs, elojegyzes, vonalszam megmarad
	reset(keep) {
		let oldstate = this.oState;
		this.oState = new KOTTASTATE();
		if (keep) {
			this.oState.cKulcs=oldstate.cKulcs;
			this.oState.nElojegy=oldstate.nElojegy;
			this.oState.nVonalszam=oldstate.nVonalszam;
		}
	}
	
	//s-ben kodolt kotta szelessege; fPostX-et is beallitja
	getWidth(s) {
		let len = s.length;
		let res=0.0;
		this.fPostX=0.0;
		for (let i=1; i<len; i+=2) {
			let c1=s.charAt(i-1), c2=s.charAt(i);
			res+=this.widthOf(c1,c2);
			if (c1=='k'||c1=='e'||c1=='E'||c1=='u'||c1=='U')
				this.fPostX=res;
		}
		return res;
	}
	
	//rajzolas kezdete
	startDraw(x0, y0, color) {
		this.fX0=x0; this.fY0=y0;
		this.fX=x0; this.iColor=color;
		//mPaint = new Paint(Paint.ANTI_ALIAS_FLAG);
		//mPaint.setColor(color);
	}
	
	//kulcs es elojegyzes kirajzolasa; return a szelesseg
	startLine() {
		let s =
			(this.oState.cKulcs!=' ' ? "k"+this.oState.cKulcs : "")+
			(this.oState.nElojegy<0 ? "e"+String.fromCharCode(48+-this.oState.nElojegy) : "")+
			(this.oState.nElojegy>0 ? "E"+String.fromCharCode(48+this.oState.nElojegy) : "");
		if (s === "") return 0.0;
		//if (!this.bDraw) return this.getWidth(s);
		let x0=this.fX;
		this.draw(x0, s);
		return this.fX-x0;
	}
	
	//rajzolas lezarasa; xend a minimum sorhossz
	endDraw(xend) {
		if (this.fX<xend) this.fX=xend;
		this.endGer();
		this.endTri();
		this.endIv('?');
		//kottavonalak
		for (let i=0; i<this.oState.nVonalszam; i++) {
			let y = this.fY0 + this.aLineY[7-i];
			this.rajzVastagViz(this.fX0,this.fX,y,this.iVonalSzel);
		}
	}

	/////////////////////////////////////////////////////////
	// belso rutinok
	/////////////////////////////////////////////////////////
	
	//egyetlen kottaelem szelessege
	widthOf(c1, c2) {
		switch(c1) {
			case 'k': //kulcs
				this.oState.cKulcs=c2;
				switch(c2) {
					case 'G': return this.fMinWidth+KottaConsts.GkulcsWIDTH*
								(this.aLineY[7]-this.aLineY[3])/(KottaConsts.GkulcsVonal1Y-KottaConsts.GkulcsVonal5Y);
					case 'F': return this.fMinWidth+KottaConsts.FkulcsWIDTH*
								(this.aLineY[7]-this.aLineY[3])/(KottaConsts.FkulcsVonal1Y-KottaConsts.FkulcsVonal5Y);
					case '1':
					case '2':
					case '3':
					case '4':
					case '5':
						return this.fMinWidth+KottaConsts.CkulcsWIDTH*
								(this.aLineY[7]-this.aLineY[3])/(KottaConsts.CkulcsVonal1Y-KottaConsts.CkulcsVonal5Y);
					case 'a': case 'b': case 'c':
					case 'd': case 'e': case 'f':
					case 'g': case 'h': case 'i':
						return this.fMinWidth+KottaConsts.DkulcsWIDTH*
								(this.aLineY[7]-this.aLineY[6])/(KottaConsts.DkulcsVonal1Y-KottaConsts.DkulcsVonal2Y);
				}
				return 0.0;
			case 'e': //bes elojegyzes
				this.oState.nElojegy=('0'-c2);
				return (1+c2-'0')*KottaConsts.BeWIDTH*this.aLineY[1]/(KottaConsts.BeVonal2aY-KottaConsts.BeVonal2fY)/1.5;
			case 'E': //keresztes
				this.oState.nElojegy=(c2-'0');
				return (1+c2-'0')*KottaConsts.KeresztWIDTH*this.aLineY[1]/(KottaConsts.KeresztVonal2aY-KottaConsts.KeresztVonal2fY)/1.5;
			case 'u': //utemjel
			case 'U': //spec.utemjel
				return this.fMinWidth+KottaConsts.U22WIDTH*(this.aLineY[7]-this.aLineY[3])/KottaConsts.U22HEIGHT;
			case '|': //utemvonal
				switch(c2) {
					case ':': return 3*this.fMinWidth;
					case '<':
					case '>':
						return 2*this.fMinWidth;
				}
				return this.fMinWidth;
			case 'm': //modositojel
				this.oState.cModosito=c2;
				return 0.0;
			case 's': //szunet
				this.oState.cModosito=' ';
				switch(c2) {
					case '1': return this.fMinWidth+KottaConsts.Szunet1WIDTH*
								this.aLineY[1]/KottaConsts.Szunet1VonalTav;
					case '2': return this.fMinWidth+KottaConsts.Szunet2WIDTH*
								this.aLineY[1]/KottaConsts.Szunet2VonalTav;
					case '4': return this.fMinWidth+KottaConsts.Szunet4WIDTH*
								this.aLineY[2]/(KottaConsts.Szunet4Vonal2Y-KottaConsts.Szunet4Vonal4Y);
					case '8': return this.fMinWidth+KottaConsts.Szunet8WIDTH*
								this.aLineY[2]/(KottaConsts.Szunet8Vonal2Y-KottaConsts.Szunet8Vonal4Y);
					case '6': return this.fMinWidth+KottaConsts.Szunet16WIDTH*
								this.aLineY[2]/(KottaConsts.Szunet16Vonal2Y-KottaConsts.Szunet16Vonal4Y);
				}
				return 0.0;
			case 'S': //pontozott szunet
				this.oState.cModosito=' ';
				switch(c2) {
					case '1': return 1.5*this.fMinWidth+KottaConsts.Szunet1WIDTH*
								this.aLineY[1]/KottaConsts.Szunet1VonalTav;
					case '2': return 1.5*this.fMinWidth+KottaConsts.Szunet2WIDTH*
								this.aLineY[1]/KottaConsts.Szunet2VonalTav;
					case '4': return 1.5*this.fMinWidth+KottaConsts.Szunet4WIDTH*
								this.aLineY[2]/(KottaConsts.Szunet4Vonal2Y-KottaConsts.Szunet4Vonal4Y);
					case '8': return 1.5*this.fMinWidth+KottaConsts.Szunet8WIDTH*
								this.aLineY[2]/(KottaConsts.Szunet8Vonal2Y-KottaConsts.Szunet8Vonal4Y);
					case '6': return 1.5*this.fMinWidth+KottaConsts.Szunet16WIDTH*
								this.aLineY[2]/(KottaConsts.Szunet16Vonal2Y-KottaConsts.Szunet16Vonal4Y);
				}
				return 0.0;
			case 'r': //ritmus
				if (c2=='t') {
					this.oState.bTomor=false;
					return 0.0;
				}
				this.oState.cRitmus=c2;
				this.oState.bPontozott=false;
				return 0.0;
			case 'R': //pontozott ritmus
				if (c2=='t') {
					this.oState.bTomor=true;
					return 0.0;
				}
				this.oState.cRitmus=c2;
				this.oState.bPontozott=true;
				return 0.0;
			case '1': //hamgok
			case '2':
			case '3':
			{
				let res=(this.oState.bTomor ? 0.0 : this.fMinWidth);
				switch(this.oState.cModosito) {
					case '0':
						res+=1.25*KottaConsts.FeloldoWIDTH*
							this.aLineY[1]/(KottaConsts.FeloldoVonal2aY-KottaConsts.FeloldoVonal2fY);
						break;
					case 'k':
						res+=1.25*KottaConsts.KeresztWIDTH*
							this.aLineY[1]/(KottaConsts.KeresztVonal2aY-KottaConsts.KeresztVonal2fY);
						break;
					case 'K':
						res+=1.25*KottaConsts.KettosKeresztWIDTH*
							this.aLineY[1]/(KottaConsts.KettosKeresztVonal2aY-KottaConsts.KettosKeresztVonal2fY);
						break;
					case 'b':
						res+=1.25*KottaConsts.BeWIDTH*
							this.aLineY[1]/(KottaConsts.BeVonal2aY-KottaConsts.BeVonal2fY);
						break;
					case 'B':
						res+=1.25*KottaConsts.BeBeWIDTH*
							this.aLineY[1]/(KottaConsts.BeBeVonal2aY-KottaConsts.BeBeVonal2fY);
						break;
				}
				this.oState.cModosito=' ';
				switch(this.oState.cRitmus) {
					case 'l':
						res+=KottaConsts.Hang0WIDTH*this.aLineY[1]/(KottaConsts.Hang0Vonal2aY-KottaConsts.Hang0Vonal2fY);
						break;
					case 'b':
						res+=KottaConsts.HangBrevis1WIDTH*this.aLineY[1]/(KottaConsts.HangBrevis1Vonal2aY-KottaConsts.HangBrevis1Vonal2fY);
						break;
					case 's':
						res+=KottaConsts.HangBrevis2WIDTH*this.aLineY[1]/(KottaConsts.HangBrevis2Vonal2aY-KottaConsts.HangBrevis2Vonal2fY);
						break;
					case '1':
						res+=KottaConsts.Hang1WIDTH*this.aLineY[1]/(KottaConsts.Hang1Vonal2aY-KottaConsts.Hang1Vonal2fY);
						break;
					case '2':
						res+=KottaConsts.Hang2fejWIDTH*this.aLineY[1]/(KottaConsts.Hang2Vonal2aY-KottaConsts.Hang2Vonal2fY);
						break;
					default:
						res+=KottaConsts.Hang4fejWIDTH*this.aLineY[1]/(KottaConsts.Hang4Vonal2aY-KottaConsts.Hang4Vonal2fY);
						break;
				}
				if (this.oState.bPontozott) {
					res+=(this.oState.bTomor ? 0.0 : this.fMinWidth/8.0);
					res+=KottaConsts.PontWIDTH*this.aLineY[1]/KottaConsts.PontVonalTav;
				}
				return res;
			}
			case '[': //gerenda
				return 0.0;
			case ']':
				return 0.0;
			case 'a': //agogika
				return 0.0;
			case '(': //iv
			case ')':
				return 0.0;
			case '-': //kottavonalak
				return 0.0;
		}
		return 0.0;
	}
	
	/////////////////////////////
	
	// kotta string kirajzolasa
	draw(x,kotta) {
		this.fX=x;
		let len=kotta.length;
		this.fPostX=this.fX;
		if (this.oState.IvBalX<0.0) this.oState.fIvBalX=this.fX;
		for (let i=1; i<len; i+=2) {
			let c1=kotta.charAt(i-1);
			let c2=kotta.charAt(i);
			this.drawOne(c1,c2);
			this.fX+=this.widthOf(c1,c2);
			if (c1=='k'||c1=='e'||c1=='E'||c1=='u'||c1=='U')
				this.fPostX=this.fX;
		}
	}

	//kep rajzolasa
	rajzPng(fname,x1,y1,x2,y2) {
		let img = new Image();
		img.onload = () => {
			this.oEnv.oCtx.drawImage(img,x1,y1,x2-x1,y2-y1);
		}
		img.src=fname;
	}

	//egyetlen fuggoleges vonal rajzolasa
	rajzVekonyFuggo(x, y1, y2) {
		this.oEnv.oCtx.lineWidth = 1;
		this.oEnv.oCtx.beginPath();
		this.oEnv.oCtx.moveTo(x,y1);
		this.oEnv.oCtx.lineTo(x,y2);
		this.oEnv.oCtx.stroke();
	}

	//egyetlen vizszintes vonal rajzolasa
	rajzVekonyViz(x1, x2, y) {
		this.oEnv.oCtx.lineWidth = 1;
		this.oEnv.oCtx.beginPath();
		this.oEnv.oCtx.moveTo(x1,y);
		this.oEnv.oCtx.lineTo(x2,y);
		this.oEnv.oCtx.stroke();
	}
	
	//vastag fuggoleges vonal rajzolasa
	rajzVastagFuggo(x, y1, y2, w) {
		let xmid = x + w/2;
		this.oEnv.oCtx.lineWidth = w;
		this.oEnv.oCtx.beginPath();
		this.oEnv.oCtx.moveTo(xmid,y1);
		this.oEnv.oCtx.lineTo(xmid,y2);
		this.oEnv.oCtx.stroke();
		this.oEnv.oCtx.lineWidth = 1;
	}

	//vastag fuggoleges vonal rajzolasa
	rajzVastagViz(x1, x2, y, w) {
		let ymid = y + w/2;
		this.oEnv.oCtx.lineWidth = w;
		this.oEnv.oCtx.beginPath();
		this.oEnv.oCtx.moveTo(x1,ymid);
		this.oEnv.oCtx.lineTo(x2,ymid);
		this.oEnv.oCtx.stroke();
		this.oEnv.oCtx.lineWidth = 1;
	}
	
	//iVonalSzel vastagsagu fuggoleges vonal
	rajzVekonyabbFuggo(x, y1, y2) {
		this.rajzVastagFuggo(x,y1,y2,this.iVonalSzel);
	}
	
	//ket pont ket vonalkozbe, ismetlojelhez (y egy vonalra esik)
	rajzKetPont(x, y) {
		let rat = (this.aLineY[7]-this.aLineY[3])/(4.0*KottaConsts.PontVonalTav);
		let w=KottaConsts.PontWIDTH*rat;
		let h=KottaConsts.PontHEIGHT*rat;
		let x1=x-w/2.0;
		y-=(this.aLineY[1]+h)/2.0;
		rajzPng(KottaConsts.Pont,x1,y,x1+w,y+h);
		y+=this.aLineY[1];
		rajzPng(KottaConsts.Pont,x1,y,x1+w,y+h);
	}

	/////////////////////////////
	
	//egy elem rajzolasa
	drawOne(c1, c2) {
		switch(c1) {
			case 'k': //kulcs
				this.oState.cKulcs=c2;
				this.drawKulcs(c2);
				return;
			case 'e': //bes elojegyzes
			case 'E': //keresztes
				this.drawElojegy(c2,c1=='e');
				return;
			case 'u': //utemjel
			case 'U': //spec.utemjel
				this.drawUtemjel(c2,c1=='U');
				return;
			case '|': //utemvonal
				this.drawUtemvonal(c2);
				return;
			case 'm': //modositojel
				this.oState.cModosito=c2;
				return;
			case 's': //szunet
			case 'S': //pontozott szunet
				this.drawSzunet(c2,c1=='S');
				return;
			case 'r': //ritmus
			case 'R': //pontozott ritmus
				if (c2=='t') {
					this.oState.bTomor=(c1=='R');
					return;
				}
				this.oState.cRitmus=c2;
				this.oState.bPontozott=(c1=='R');
				return;
			case '1': //hangok
			case '2':
			case '3':
				this.drawHang(c2,c1);
				return;
			case '[': //gerenda
				if (c2=='0') this.oState.bSzaaratlan=true;
				else if (c2=='1') this.oState.bSzaaratlan=false;
				else if (c2=='3' || c2=='5') this.startTri(c2);
				else this.oState.bGerenda=true;
				return;
			case ']':
				this.endGer();
				this.oState.bGerenda=false;
				if (c2=='3' || c2=='5') {
					this.endTri();
					return;
				}
				return;
			case 'a': //agogika
				this.oState.cAgogika=c2;
				return;
			case '(': //iv
			case ')':
				this.drawIv(c2,c1=='(');
				return;
			case '-': //kottavonalak
				this.oState.Vonalszam=(c2-'0');
				return;
		}
		return;
	}

	//kulcs rajzolasa
	drawKulcs(c2) {
		this.endGer();
		let id="";
		let w = 0.0; let h = 0.0; let v1 = 0.0; let v5 = 0.0;
		let y0=this.aLineY[3];  //kezdo vonal
		if (c2=='G') {
			id=KottaConsts.pngGkulcs;
			w=KottaConsts.GkulcsWIDTH;
			h=KottaConsts.GkulcsHEIGHT;
			v1=KottaConsts.GkulcsVonal1Y;
			v5=KottaConsts.GkulcsVonal5Y;
		} else if (c2=='F') {
			id=KottaConsts.pngFkulcs;
			w=KottaConsts.FkulcsWIDTH;
			h=KottaConsts.FkulcsHEIGHT;
			v1=KottaConsts.FkulcsVonal1Y;
			v5=KottaConsts.FkulcsVonal5Y;
		} else if (c2>='1' && c2 <='5') {
			id=KottaConsts.pngCkulcs;
			w=KottaConsts.CkulcsWIDTH;
			h=KottaConsts.CkulcsHEIGHT;
			v1=KottaConsts.CkulcsVonal1Y;
			v5=KottaConsts.CkulcsVonal5Y;
			y0=this.aLineY[6-(c2-'0')];
		} else if (c2>='a' && c2<='i') {
			id=KottaConsts.pngDkulcs;
			w=KottaConsts.DkulcsWIDTH;
			h=KottaConsts.DkulcsHEIGHT;
			v5=KottaConsts.DkulcsVonal2Y;
			v1=v5+(KottaConsts.DkulcsVonal1Y-v5)*4;
			y0=this.aLineY[7]-this.aLineY[1]*0.5*(1+c2-'a');
		} else
			return;
			
		let rat=(this.aLineY[7]-this.aLineY[3])/(v1-v5);
		let y1=this.fY0+y0-v5*rat;
		let y2=y1+h*rat;
		let x2=this.fX+w*rat;
		this.rajzPng(id,this.fX,y1,x2,y2);
		return;
	}
	
	//elojegyzes rajzolasa
	drawElojegy(c2, bes) {
		this.endGer();
		let id="";
		let w=0.0; let h=0.0; let v1=0.0; let v2a=0.0; let v2f=0.0;
		let t="";
		if (bes) {
			id=KottaConsts.pngBe;
			w=KottaConsts.BeWIDTH; h=KottaConsts.BeHEIGHT;
			v1=KottaConsts.BeVonal1Y;
			v2a=KottaConsts.BeVonal2aY;
			v2f=KottaConsts.BeVonal2fY;
			switch(this.oState.cKulcs) {
				case 'G': t="3-4=2=4-2-3=1="; break;
				case 'F': t="2-3=1=3-1-2=0="; break;
				case '1': t="4-2-3=1=3-1-2="; break;
				case '2': t="5-3-4=2=4-2-3="; break;
				case '4': t="3=5-3-4=2=4-2-"; break;
				case '5': t="4=2=4-2-3=1=3-"; break;
				default : t="2=4-2-3=1=3-1-"; break;
			}
		} else {
			id=KottaConsts.pngKereszt;
			w=KottaConsts.KeresztWIDTH; h=KottaConsts.KeresztHEIGHT;
			v1=KottaConsts.KeresztVonal1Y;
			v2a=KottaConsts.KeresztVonal2aY;
			v2f=KottaConsts.KeresztVonal2fY;
			switch(this.oState.cKulcs) {
				case 'G': t="5-3=5=4-2=4=3-"; break;
				case 'F': t="4-2=4=3-5-3=5="; break;
				case '1': t="2=1-3-1=3=2-4-"; break;
				case '2': t="3=2-4-2=4=3-5-"; break;
				case '4': t="5=4-2=4=3-5-3="; break;
				case '5': t="3-5-3=5=4-2=4="; break;
				default : t="4=3-5-3=5=4-2="; break;
			}
		}
		let mul=c2-'0';
		if (mul > 7) mul = 7;
		let rat = this.aLineY[1]/(v2a-v2f);
		let p=0;
		let x1=this.fX;
		while(mul --> 0) {
			let x2=x1+w*rat;
			let t1=t.charAt(p); let t2=t.charAt(p+1);
			let y1=this.fY0+this.aLineY[7-(t1-'1')];
			if (t2=='-') y1-=v1*rat; else y1-=v2a*rat;
			let y2=y1+h*rat;
			this.rajzPng(id,x1,y1,x2,y2);
			p+=2;
			x1+=w*rat/1.5;
		}
	}

	//utemjel rajzolasa
	drawUtemjel(c2,spec) {
		//this.endGer();
		let id="";
		switch(c2) {
			case '2': id=(spec ? KottaConsts.U22 : KottaConsts.U24); break;
			case '3': id=(spec ? KottaConsts.U32 : KottaConsts.U34); break;
			case '4': id=KottaConsts.U44; break;
			case '5': id=KottaConsts.U54; break;
			case '6': id=(spec ? KottaConsts.U68 : KottaConsts.U64); break;
			case '8': id=KottaConsts.U38; break;
			default: return;
		}
		
		//jelenleg mind egyforma szeles es magas
		let rat=(this.aLineY[7]-this.aLineY[3])/KottaConsts.U22HEIGHT;
		let x2=this.fX+KottaConsts.U22WIDTH*rat;
		this.rajzPng(id,this.fX,(this.fY0+this.aLineY[3]),x2,this.fY0+this.aLineY[7]);
	}

	//utemvonal rajzolasa
	drawUtemvonal(c2) {
		this.endGer();
		let w = this.fMinWidth/4.0;
		if (w<2.0) w=2.0;
		let x = this.fX+w+w;
		let y1 = this.fY0+this.aLineY[8-this.oState.nVonalszam];
		let y2 = this.fY0+this.aLineY[7];
		if (this.oState.nVonalszam<=1) {
			y2+=this.aLineY[1]/2.0;
			y1=y2-this.aLineY[1];
		}
		switch(c2) {
			case '1': this.rajzVekonyFuggo(x,y1,y2); break;
			case '|':
				x-=w/2.0;
				this.rajzVekonyabbFuggo(x,y1,y2);
				this.rajzVekonyabbFuggo(x+w,y1,y2);
				break;
			case '.':
				x-=w/2.0;
				this.rajzVekonyabbFuggo(x,y1,y2);
				this.rajzVastagFuggo(x+w,y1,y2,w);
				break;
			case '\'':
				y1-=this.aLineY[1]/2.0; y2=y1+this.aLineY[1];
				this.rajzVekonyabbFuggo(x,y1,y2);
				break;
			case '!':
				y1-=this.aLineY[1]/2.0; if (this.oState.nVonalszam<=2) y1-=this.aLineY[1];
				y2=y1+this.aLineY[2];
				this.rajzVekonyabbFuggo(x,y1,y2);
				break;
			case '>':
				this.rajzVekonyabbFuggo(x,y1,y2);
				this.rajzVastagFuggo(x-w-w,y1,y2,w);
				this.rajzKetPont(x+w+w,(y1+y2)/2.0);
				break;
			case '<':
				this.rajzVekonyabbFuggo(x,y1,y2);
				this.rajzVastagFuggo(x+w,y1,y2,w);
				this.rajzKetPont(x-w-w,(y1+y2)/2.0);
				break;
			case ':':
				x-=w/2.0;
				this.rajzVastagFuggo(x,y1,y2,w);
				this.rajzVekonyabbFuggo(x-w,y1,y2);
				this.rajzVekonyabbFuggo(x+w+w,y1,y2);
				y1=(y1+y2)/2.0;
				this.rajzKetPont(x-w-w-w,y1);
				this.rajzKetPont(x+w+w+w+w,y1);
				break;
			default: return;
		}
	}

	//szunetjel rajzolasa
	drawSzunet(c2, pontozott) {
		this.endGer();
		let id="";
		let w=0.0; let h=0.0; let v2=0.0; let v4=0.0;
		switch(c2) {
			case '1':
				id=KottaConsts.pngSzunet1;
				w=KottaConsts.Szunet1WIDTH; h=KottaConsts.Szunet1HEIGHT;
				v4=0.0; v2=2.0*KottaConsts.Szunet1VonalTav;
				break;
			case '2':
				id=KottaConsts.pngSzunet2;
				w=KottaConsts.Szunet2WIDTH; h=KottaConsts.Szunet2HEIGHT;
				v4=-KottaConsts.Szunet2VonalTav/2.0; v2=v4+2.0*KottaConsts.Szunet2VonalTav;
				break;
			case '4':
				id=KottaConsts.pngSzunet4;
				w=KottaConsts.Szunet4WIDTH; h=KottaConsts.Szunet4HEIGHT;
				v2=KottaConsts.Szunet4Vonal2Y; v4=KottaConsts.Szunet4Vonal4Y;
				break;
			case '8':
				id=KottaConsts.pngSzunet8;
				w=KottaConsts.Szunet8WIDTH; h=KottaConsts.Szunet8HEIGHT;
				v2=KottaConsts.Szunet8Vonal2Y; v4=KottaConsts.Szunet8Vonal4Y;
				break;
			case '6':
				id=KottaConsts.pngSzunet16;
				w=KottaConsts.Szunet16WIDTH; h=KottaConsts.Szunet16HEIGHT;
				v2=KottaConsts.Szunet16Vonal2Y; v4=KottaConsts.Szunet16Vonal4Y;
				break;
			default: return;
		}
		let rat = (this.aLineY[6]-this.aLineY[4])/(v2-v4);
		let x1=mX+0.5*w*rat;
		if (pontozott) x1-=this.fMinWidth/4.0;
		let x2=x1+w*rat;
		let y1=this.fY0+this.aLineY[4]-v4*rat;
		let y2=y1+h*rat;
		this.rajzPng(id,x1,y1,x2,y2);
		if (pontozott) {
			rat=this.aLineY[1]/KottaConsts.PontVonalTav;
			x1=x2+this.fMinWidth/2.0;
			x2=x1+KottaConsts.PontWIDTH*rat;
			h=KottaConsts.PontHEIGHT*rat;
			y1=this.fY0+(this.aLineY[4]+this.aLineY[5])/2.0-h/2.0;
			y2=y1+h;
			this.rajzPng(KottaConsts.pngPont,x1,y1,x2,y2);
		}
	}

	//hangjegy rajzolasa
	drawHang(c2, oktav) {
		let id="";
		let w=0.0; let h=0.0; let va=0.0; let vf=0.0; let vv=0.0;
		let rat=0.0; let mw=0.0; let x1=0.0; let x2=0.0; let y1=0.0; let y2=0.0;
		
		mw=(this.oState.bTomor ? 0.0 : this.fMinWidth);
		x1=this.fX+mw/2.0;
		
		let l1=0; let l2=0;
		switch(c2) {
			case 'g': case 'G': l1=10; l2=9; break;
			case 'a': case 'A': l1=9; l2=9; break;
			case 'h': case 'H': l1=9; l2=8; break;
			case 'c': case 'C': l1=8; l2=8; break;
			case 'd': case 'D': l1=8; l2=7; break;
			case 'e': case 'E': l1=7; l2=7; break;
			case 'f': case 'F': l1=7; l2=6; break;
			default: return;
		}
		if (oktav=='2') {
			if (l1==l2) { l1-=3; l2-=4; } else { l1-=4; l2-=3; }
		} else if (oktav=='3') {
			l1-=7; l2-=7;
			if (l1<=0) return;
		}
		
		if (this.oState.cModosito!=' ') {
			switch(this.oState.cModosito) {
				case '0':
					id=KottaConsts.pngFeloldo;
					w=KottaConsts.FeloldoWIDTH; h=KottaConsts.FeloldoHEIGHT;
					vv=KottaConsts.FeloldoVonal1Y;
					va=KottaConsts.FeloldoVonal2aY; vf=KottaConsts.FeloldoVonal2fY;
					break;
				case 'k':
					id=KottaConsts.pngKereszt;
					w=KottaConsts.KeresztWIDTH; h=KottaConsts.KeresztHEIGHT;
					vv=KottaConsts.KeresztVonal1Y;
					va=KottaConsts.KeresztVonal2aY; vf=KottaConsts.KeresztVonal2fY;
					break;
				case 'K':
					id=KottaConsts.png.KettosKereszt;
					w=KottaConsts.KettosKeresztWIDTH; h=KottaConsts.KettosKeresztHEIGHT;
					vv=KottaConsts.KettosKeresztVonal1Y;
					va=KottaConsts.KettosKeresztVonal2aY; vf=KottaConsts.KettosKeresztVonal2fY;
					break;
				case 'b':
					id=KottaConsts.pngBe;
					w=KottaConsts.BeWIDTH; h=KottaConsts.BeHEIGHT;
					vv=KottaConsts.BeVonal1Y;
					va=KottaConsts.BeVonal2aY; vf=KottaConsts.BeVonal2fY;
					break;
				case 'B':
					id=KottaConsts.pngBeBe;
					w=KottaConsts.BeBeWIDTH; h=KottaConsts.BeBeHEIGHT;
					vv=KottaConsts.BeBeVonal1Y;
					va=KottaConsts.BeBeVonal2aY; vf=KottaConsts.BeBeVonal2fY;
					break;
				default: return;
			}
			rat=this.aLineY[1]/(va-vf);
			x2=x1+w*rat;
			y1=this.fY0+this.aLineY[l1]-(l1==l2 ? vv : va)*rat;
			y2=y1+h*rat;
			this.rajzPng(id,x1,y1,x2,y2);
			x1=x2+w*rat*0.25;
		}
		
		switch (this.oState.cRitmus) {
			case 'l':
				id=KottaConsts.pngHang0;
				w=KottaConsts.Hang0WIDTH; h=KottaConsts.Hang0HEIGHT;
				vv=KottaConsts.Hang0Vonal1Y;
				va=KottaConsts.Hang0Vonal2aY; vf=KottaConsts.Hang0Vonal2fY;
				break;
			case 'b':
				id=KottaConsts.pngHangBrevis1;
				w=KottaConsts.HangBrevis1WIDTH; h=KottaConsts.HangBrevis1HEIGHT;
				vv=KottaConsts.HangBrevis1Vonal1Y;
				va=KottaConsts.HangBrevis1Vonal2aY; vf=KottaConsts.HangBrevis1Vonal2fY;
				break;
			case 's':
				id=KottaConsts.pngHangBrevis2;
				w=KottaConsts.HangBrevis2WIDTH; h=KottaConsts.HangBrevis2HEIGHT;
				vv=KottaConsts.HangBrevis2Vonal1Y;
				va=KottaConsts.HangBrevis2Vonal2aY; vf=KottaConsts.HangBrevis2Vonal2fY;
				break;
			case '1':
				id=KottaConsts.pngHang1;
				w=KottaConsts.Hang1WIDTH; h=KottaConsts.Hang1HEIGHT;
				vv=KottaConsts.Hang1Vonal1Y;
				va=KottaConsts.Hang1Vonal2aY; vf=KottaConsts.Hang1Vonal2fY;
				break;
			case '2':
				id=KottaConsts.pngHang2Fej;
				w=KottaConsts.Hang2fejWIDTH; h=KottaConsts.Hang2fejHEIGHT;
				vv=KottaConsts.Hang2Vonal1Y;
				va=KottaConsts.Hang2Vonal2aY; vf=KottaConsts.Hang2Vonal2fY;
				break;
			case '4':
			case '8':
			case '6':
				id=KottaConsts.pngHang4Fej;
				w=KottaConsts.Hang4fejWIDTH; h=KottaConsts.Hang4fejHEIGHT;
				vv=KottaConsts.Hang4Vonal1Y;
				va=KottaConsts.Hang4Vonal2aY; vf=KottaConsts.Hang4Vonal2fY;
				break;
			default: return;
		}
		rat=this.aLineY[1]/(va-vf);
		x2=x1+w*rat;
		y1=this.fY0+this.aLineY[l1]-(l1==l2 ? vv : va)*rat;
		y2=y1+h*rat;
		this.rajzPng(id,x1,y1,x2,y2);
		let r = new FRECT(x1,y1,x2-x1,y2-y1);
		this.addSzaar(r,c2<'a');
		this.addIv(r,c2<'a'); this.oState.IvTipus=this.oState.IvTipusLesz;
		this.addTri(r,c2<'a');
			
		//neuma vonal: ha a hang szorosan az elozonel
		let ym = (y1+y2)/2.0;
		if (x1==this.oState.fNeumaX) this.rajzVekonyFuggo(x1,this.oState.fNeumaY,ym);
		this.oState.fNeumaX=x2; this.oState.fNeumaY=ym;

		//potvonalak
		let w4 = w*rat*0.25;
		if (l2>=8) {
			this.rajzVekonyViz(x1-w4,x2+w4,this.fY0+this.aLineY[8]);
			if (l2>=9)
				this.rajzVekonyViz(x1-w4,x2+w4,this.fY0+this.aLineY[9]);
		}
		for (let i=l1; i<=7-this.oState.Vonalszam; i++)
			this.rajzVekonyViz(x1-w4,x2+w4,this.fY0+this.aLineY[i]);
			
		//agogika
		if (this.oState.cAgogika!=' ') {
			vv=0.0; vf=0.0;
			switch(this.oState.cAgogika) {
				case '-':
					id=KottaConsts.pngTenuto;
					w=KottaConsts.TenutoWIDTH; h=KottaConsts.TenutoHEIGHT;
					va=KottaConsts.TenutoVonalTav;
					break;
				case '.':
					id=KottaConsts.pngPont;
					w=KottaConsts.PontWIDTH; h=KottaConsts.PontHEIGHT;
					va=KottaConsts.PontVonalTav;
					break;
				case '>':
					id=KottaConsts.pngMarcato1;
					w=KottaConsts.Marcato1WIDTH; h=KottaConsts.Marcato1HEIGHT;
					//vv=KottaConsts.Marcato1Vonal1Y;
					va=KottaConsts.Marcato1Vonal2aY; vf=KottaConsts.Marcato1Vonal2fY;
					break;
				case '^':
					id=KottaConsts.pngMarcato2;
					w=KottaConsts.Marcato2WIDTH; h=KottaConsts.Marcato2HEIGHT;
					//vv=KottaConsts.Marcato2Vonal1Y;
					va=KottaConsts.Marcato2Vonal2aY; vf=KottaConsts.Marcato2Vonal2fY;
					break;
				case 'K':
					if (c2<'a') {
						id=KottaConsts.pngKoronaLe;
						w=KottaConsts.KoronaLeWIDTH; h=KottaConsts.KoronaLeHEIGHT;
						//vv=KottaConsts.KoronaLeVonal1Y;
						va=KottaConsts.KoronaLeVonal2aY; vf=KottaConsts.KoronaLeVonal2fY;
					} else {
						id=KottaConsts.pngKoronaFel;
						w=KottaConsts.KoronaFelWIDTH; h=KottaConsts.KoronaFelHEIGHT;
						//vv=KottaConsts.KoronaFelVonal1Y;
						va=KottaConsts.KoronaFelVonal2aY; vf=KottaConsts.KoronaFelVonal2fY;
					}
					break;
				case 'm':
					id=KottaConsts.pngMordent1;
					w=KottaConsts.Mordent1WIDTH; h=KottaConsts.Mordent1HEIGHT;
					//vv=KottaConsts.Mordent1Vonal1Y;
					va=KottaConsts.Mordent1Vonal2aY; vf=KottaConsts.Mordent1Vonal2fY;
					break;
				case 'M':
					id=KottaConsts.pngMordent2;
					w=KottaConsts.Mordent2WIDTH; h=KottaConsts.Mordent2HEIGHT;
					//vv=KottaConsts.Mordent2Vonal1Y;
					va=KottaConsts.Mordent2Vonal2aY; vf=KottaConsts.Mordent2Vonal2fY;
					break;
				case 't':
					id=KottaConsts.pngTrilla1;
					w=KottaConsts.Trilla1WIDTH; h=KottaConsts.Trilla1HEIGHT;
					//vv=KottaConsts.Trilla1Vonal1Y;
					va=KottaConsts.Trilla1Vonal2aY; vf=KottaConsts.Trilla1Vonal2fY;
					break;
				case 'T':
					id=KottaConsts.pngTrilla2;
					w=KottaConsts.Trilla2WIDTH; h=KottaConsts.Trilla2HEIGHT;
					//vv=KottaConsts.Trilla2Vonal1Y;
					va=KottaConsts.Trilla2Vonal2aY; vf=KottaConsts.Trilla2Vonal2fY;
					break;
				default: return;
			}
			rat=this.aLineY[1]/(va-vf);
			let ax1=(x1+x2-w*rat)/2.0;
			let ax2=ax1+w*rat;
			let ay1=(y1+y2-h*rat)/2.0+(c2<'a' ? -this.aLineY[1] : this.aLineY[1]);
			if (l1==l2 && (this.oState.cAgogika=='-' || this.oState.cAgogika=='.'))
				ay1+=h*rat;
			let ay2=ay1+h*rat;
			this.rajzPng(id,ax1,ay1,ax2,ay2);
		}
		if (this.oState.bPontozott) {
			rat=this.aLineY[1]/KottaConsts.PontVonalTav;
			x1=x2+mw/8.0;
			x2=x1+KottaConsts.PontWIDTH*rat;
			h=KottaConsts.PontHEIGHT*rat;
			y1=ym-(l1==l2 ? h : h/2.0);
			y2=y1+h;
			this.rajzPng(KottaConsts.pngPont,x1,y1,x2,y2);
		}
	}
	
	//kottaiv rajzolasa
	drawIv(c2, start) {
		if (start) {
			this.oState.IvTipusLesz=c2;
			return;
		}
		this.endIv(c2);
	}

	//kottaszaar rajzolas
	rajzSzaar(fej, lefele, ritmus) {
		if (this.oState.bSzaaratlan) return;
		if (ritmus!='2' && ritmus!='4' && ritmus!='8' && ritmus!='6') return;
		let szel=KottaConsts.ZaszloSzelesseg*this.fRatio;
		let sx1=0.0; let sy1=0.0; let sx2=0.0; let sy2=0.0;
		let zw=0.0; let zh=0.0; let zy1=0.0; let zy2=0.0;
		let id="";
		sy1=(fej.top()+fej.bottom())/2.0;
		if (lefele) {
			sx1=fej.left();
			sy2=sy1+this.aLineY[3];
			if (ritmus=='8') {
				id=KottaConsts.pngZaszlo8Le;
				zw=KottaConsts.Zaszlo8leWIDTH; zh=KottaConsts.Zaszlo8leHEIGHT;
			} else if (ritmus=='6') {
				id=KottaConsts.pngZaszlo16Le;
				zw=KottaConsts.Zaszlo8leWIDTH; zh=KottaConsts.Zaszlo16leHEIGHT;
			}
			zy2=sy2; zy1=sy2-zh*this.fRatio;
		} else {
			sx1=fej.right()-szel;
			sy2=sy1-this.aLineY[3];
			if (ritmus=='8') {
				id=KottaConsts.pngZaszlo8Fel;
				zw=KottaConsts.Zaszlo8felWIDTH; zh=KottaConsts.Zaszlo8felHEIGHT;
			} else if (ritmus=='6') {
				id=KottaConsts.pngZaszlo16Fel;
				zw=KottaConsts.Zaszlo8felWIDTH; zh=KottaConsts.Zaszlo16felHEIGHT;
			}
			zy1=sy2; zy2=sy2+zh*this.fRatio;
		}
		if (id!=="") {
			this.rajzPng(id,sx1,zy1,(sx1+zw*this.fRatio),zy2);
		}
		this.rajzVastagFuggo(sx1,sy1,sy2,szel);
	}

	//szaar megjegyzese gerenda rajzolashoz
	addSzaar(fej, lefele) {
		if (!this.pushGer(fej,lefele)) this.rajzSzaar(fej,lefele,this.oState.cRitmus);
	}
	
	//TRUE=mentette
	pushGer(fej, lefele) {
		if (!this.oState.bGerenda) return false;
		if (this.oState.bSzaaratlan || (this.oState.cRitmus!='8' && this.oState.cRitmus!='6')) {
			this.endGer();
			return false;
		}
		this.aGer[this.iGerIdx].rFej.assign(fej);
		this.aGer[this.iGerIdx].bLe=lefele;
		this.aGer[this.iGerIdx].cRitmus=this.oState.cRitmus;
		this.iGerIdx++;
		if (this.iGerIdx>=MAXGERENDA) this.endGer();
		return true;
	}

	//gerenda vegetert, tenyleges rajzolasa
	endGer() {
		if (this.iGerIdx<2) {
			if (this.iGerIdx>0) this.rajzSzaar(this.aGer[0].rFej,this.aGer[0].bLe,this.aGer[0].cRitmus);
			this.iGerIdx=0;
			return;
		}
		let mg1=this.iGerIdx-1;
		let X0 = []; let Y0 = []; let Y1 = [];
		for (let i=0; i<MAXGERENDA; i++) {
			X0[i]=0.0; Y0[i]=0.0; Y1[i]=0.0;
		}
		let vonalvast=this.aLineY[1]/2.0;
		let kozvast=vonalvast/2.0;
		let minlen=this.aLineY[2]; let normlen=this.aLineY[3];
		{
			let m=this.aGer[0].rFej.fH+vonalvast+vonalvast+kozvast;
			if (m>minlen) minlen=m;
			if (m>normlen) normlen=m;
		}
		let rat=(this.aGer[0].rFej.fH)/(KottaConsts.Hang4Vonal2aY-KottaConsts.Hang4Vonal2fY);
		let szel=KottaConsts.ZaszloSzelesseg*rat;
		
		for (let i=0; i<this.iGerIdx; i++) {
			X0[i]=(this.aGer[i].bLe ? this.aGer[i].rFej.left() : this.aGer[i].rFej.right()-szel);
			Y0[i]=this.aGer[i].rFej.centerY();
			Y1[i]=Y0[i]+(this.aGer[i].bLe ? minlen : -minlen);
		}
		
		//hosszak megkeresese
		let i=1; let le1=this.aGer[0].bLe;
		for (let cnt=0; cnt<100; cnt++) {
			if (i>=this.iGerIdx) break;
			let y1=Y1[0]+(X0[i]-X0[0])*(Y1[mg1]-Y1[0])/(X0[mg1]-X0[0]);
			let lei=this.aGer[i].bLe;
			if (le1!=lei) {
				Y1[i++]=y1;
				continue;
			}
			if (lei) {
				if (y1>=Y0[i]+minlen) {
					Y1[i++]=y1;
					continue;
				}
				let m=Y0[i]+minlen-y1;
				Y1[0]+=m;
				Y1[mg1]+=m;
				i=1;
			} else {
				if (y1<=Y0[i]-minlen) {
					Y1[i++]=y1;
					continue;
				}
				let m=y1-(Y0[i]-minlen);
				Y1[0]-=m;
				Y1[mg1]-=m;
				i=1;
			}
		}
		
		//szaarak rajzolasa
		for (let i=0; i<this.iGerIdx; i++) {
			let vx1=X0[i], vy0=Y0[i], vy1=Y1[i];
			this.rajzVastagFuggo(vx1,vy0,vy1,szel);
		}

		//atlos resz
		this.oEnv.oCtx.lineWidth=1;
		this.oEnv.oCtx.beginPath();
		let vx1=X0[0], vx2=X0[mg1];
		let vy1=Y1[0], vy2=Y1[mg1];
		this.adjustTri(vx1,vy1,vx2,vy2);
		if (this.aGer[0].bLe) vy1-=vonalvast;
		if (this.aGer[mg1].bLe) vy2-=vonalvast;
		let vyend=vy1+vonalvast;
		while (vy1<vyend) {
			this.oEnv.oCtx.moveTo(vx1,vy1);
			this.oEnv.oCtx.lineTo(vx2,vy2);
			vy1+=1.0; vy2+=1.0;
		}
			
		vy1=Y1[0]-vonalvast-kozvast-vonalvast;
		let vy1f=Y1[0]+vonalvast+kozvast;
		vy2=Y1[mg1]-vonalvast-kozvast-vonalvast;
		let vy2f=Y1[mg1]+vonalvast+kozvast;
		let w=this.aGer[0].rFej.width()/2.0;
		let prev16=true;
		for (let i=0; i<this.iGerIdx; i++) {
			let is16=(this.aGer[i].cRitmus=='6');
			if (!is16) {
				prev16=false;
				continue;
			}
			if (i==mg1 && prev16) break;
			let x1=0.0; let y1=0.0; let x2=0.0; let y2=0.0;
			prev16=(i==mg1 || this.aGer[i+1].cRitmus=='6');
			if (i!=mg1 && this.mGer[i].bLe!=this.aGer[i+1].bLe) prev16=false;
			if (prev16) {
				x1=X0[i]; x2=(i==mg1 ? x1-w : X0[i+1]);
			} else {
				x1=X0[i]-w; x2=X0[i]+w;
				if (i==0) x1=X0[0];
			}
			let ty1=vy1f, ty2=vy2f;
			if (this.aGer[i].bLe) { ty1=vy1; ty2=vy2; }
			y1=ty1+(ty2-ty1)*(x1-X0[0])/(X0[mg1]-X0[0]);
			y2=ty1+(ty2-ty1)*(x2-X0[0])/(X0[mg1]-X0[0]);
			let y1end=y1+vonalvast;
			while (y1<y1end) {
				this.oEnv.oCtx.moveTo(x1,y1);
				this.oEnv.oCtx.lineTo(x2,y2);
				y1+=1.0; y2+=1.0;
			}
		}
		//vege
		this.oEnv.oCtx.stroke();
		this.iGerIdx=0;
	}
	
	/////////////////////
	// kotoiv
	/////////////////////
	
	addIv(r, also) {
		if (this.oState.cIvTipus=='a' || this.oState.cIvTipus=='f') {  //kotoiven belul
			this.oState.fIvEndX=r.centerX(); this.oState.fIvEndY=r.centerY();
			if (this.oState.IvTipus=='a') {
				if (this.oState.fIvEndY>this.oState.fIvMaxY) this.oState.fIvMaxY=this.oState.fIvEndY;
			} else {
				if (this.oState.fIvMaxY<0.0) this.oState.fIvMaxY=this.oState.fIvEndY;
				else if (this.oState.fIvEndY<this.oState.fIvMaxY) this.oState.fIvMaxY=this.oState.fIvEndY;
				if (this.oState.fIvMaxY<0.0) this.oState.fIvMaxY=0.0;
			}
		} else {    //kotoiven kivul
			this.oState.fIvStartX=r.centerX(); this.oState.fIvStartY=r.centerY();
			this.oState.fIvMaxY=this.oState.fIvStartY;
		}
	}
	
	endIv(endtipus) {
		let fX = []; let fY = [];
// 0                                         1
//  \\                                     //
//   \10--------6-------3------7---------11/
//    \                                   /
//     8 -------4-------2------5-------- 9

		let vaneleje=(this.oState.cIvTipus=='a' || this.oState.cIvTipus=='f');
		let vanvege=(endtipus=='a' || endtipus=='f');
		if (this.oState.fIvBalX<0.0 || this.oState.fIvMaxY<0.0) return;
		if (!vaneleje && !vanvege) return;
		let also=(vanvege ? endtipus=='a' : this.oState.cIvTipus=='a');
		let Ykoz=this.aLineY[1]-this.aLineY[0];
		let aYkoz = (also ? Ykoz : -Ykoz);
		
		//1.bal sarok
		fX[0]=(vaneleje ? this.oState.fIvStartX : this.oState.fIvBalX);
		fY[0]=(vaneleje ? this.oState.fIvStartY : this.oState.fIvMaxY);
		
		//2.jobb sarok
		fX[1]=this.oState.fIvEndX; fY[1]=this.oState.fIvEndY;
		
		//eltolas a kottafejtol
		fY[0]+=aYkoz; fY[1]+=aYkoz;
		
		//iv hossza
		let xlen=fX[1]-fX[0], ylen=fY[1]-fY[0];
		let r=sqrt(xlen*xlen+ylen*ylen);
		let xlenperr=xlen/r, ylenperr=ylen/r;
		
		//3..4.kozep, belso kozep
		fX[2]=(fX[0]+fX[1])/2.0;
		fY[2]=(fY[0]+fY[1])/2.0;
		fX[3]=fX[2]; fY[3]=fY[2];
		fX[2]=fX[2]-aYkoz*ylenperr;
		fY[2]=fY[2]+aYkoz*xlenperr;
		fX[3]=fX[3]-aYkoz*0.75*ylenperr;
		fY[3]=fY[3]+aYkoz*0.75*xlenperr;
		
		//5..8.kozepek iranya
		let v=r/4.0;
		let vx=v*xlenperr, vy=v*ylenperr;
		fX[4]=fX[2]-vx; fY[4]=fY[2]-vy;
		fX[5]=fX[2]+vx; fY[5]=fY[2]+vy;
		fX[6]=fX[3]-vx; fY[6]=fY[3]-vy;
		fX[7]=fX[3]+vx; fY[7]=fY[3]+vy;
		
		//9..10.szelek iranya
		vx=Ykoz*xlenperr-aYkoz*ylenperr;
		vy=Ykoz*ylenperr+aYkoz*xlenperr;
		fX[8]=fX[0]+vx; fY[8]=fY[0]+vy;
		fX[9]=fX[1]-Ykoz*xlenperr-aYkoz*ylenperr;
		fY[9]=fY[1]-Ykoz*ylenperr+aYkoz*xlenperr;
		
		//11..12.belso szelek iranya
		vx=Ykoz*xlenperr-aYkoz*ylenperr*0.75;
		vy=Ykoz*ylenperr+aYkoz*xlenperr*0.75;
		fX[10]=fX[0]+vx; fY[10]=fY[0]+vy;
		fX[11]=fX[1]-Ykoz*xlenperr-aYkoz*ylenperr*0.75;
		fY[11]=fY[1]-Ykoz*ylenperr+aYkoz*xlenperr*0.75;

		//itt rajzolunk
// 0                                         1
//  \\                                     //
//   \10--------6-------3------7---------11/
//    \                                   /
//     8 -------4-------2------5-------- 9

		this.oEnv.oCtx.beginPath();
		
		//baloldalrol
		if (vaneleje) {
			this.oEnv.oCtx.moveTo(fX[0],fY[0]); 	//bal
			this.oEnv.oCtx.bezierCurveTo(fX[8],fY[8],		//balszel iranyultsag
								fX[4],fY[4],	//kozep bal irany
								fX[2],fY[2]);	//kozep
		} else {
			this.oEnv.oCtx.moveTo(fX[2],fY[3]);		//kozep
		}
		//kozepponttol
		if (vanvege) {
			this.oEnv.oCtx.bezierCurveTo(fX[5],fY[5],		//kozep jobb irany
						fX[9],fY[9],	//jobb irany
						fX[1],fY[1]);	//jobb
			this.oEnv.oCtx.bezierCurveTo(fX[11],fY[11],	//jobb bel irany
						fX[7],fY[7],	//kozepalja irany
						fX[3],fY[3]);	//kozepalja
		} else {
			this.oEnv.oCtx.bezierCurveTo(fX[3],fY[3],		//kozep irany
						fX[2],fY[2],	//kozepalja irany
						fX[3],fY[3]);	//kozepalja
		}
		//vissza balszelre
		if (vaneleje) {
			this.oEnv.oCtx.bezierCurveTo(fX[6],fY[6],		//kozepalja irany
						fX[10],fY[10],	//bal also irany
						fX[0],fY[0]);   //bal
		} else {
			this.oEnv.oCtx.bezierCurveTo(fX[2],fY[2],		//kozepalja irany
						fX[3],fY[3],	//kozep irany
						fX[2],fY[2]);   //vegpont
		}

		//rajzoljunk!
		this.oEnv.oCtx.closePath();
		this.oEnv.oCtx.fill();
		
		//kotoiv vege
		this.oState.IvTipus=' '; this.oState.IvTipusLesz=' ';
	}

	//triola kezdete
	startTri(c2) {
		this.oState.TriTipus=c2;
		this.oState.aTriPos.clear();
	}
	
	//triola vege
	endTri() {
		//triola vagy pentola?
		let tri = (this.oState.TriTipus=='3');
		if (!tri && this.oState.TriTipus!='5') return;
		this.oState.TriTipus=' ';
		
		if (this.oState.aTriPos.size()<2) {
			this.oState.aTriPos.clear();
			return;
		}
		let lp=this.oState.aTriPos.get(0), rp=this.oState.aTriPos.get(this.oState.aTriPos.size()-1);
		let w=(rp.x-lp.x);
		if (w<=0.0) {
			this.oState.aTriPos.clear();
			return;
		}
		for (let p of this.oState.aTriPos) {
			let y=lp.y+(rp.x-p.x)*(rp.y-lp.y)/w;
			let dif=y-p.y;
			if (this.oState.TriLe ? dif<0.0 : dif>0.0) {
				lp.y-=dif; rp.y-=dif;
			}
		}
		let half = this.aLineY[1]/2.0;
		if (this.oState.TriLe) {
			lp.y+=half; rp.y+=half;
		} else {
			lp.y-=half; rp.y-=half;
		}
		lp.x-=half; rp.x+=half;
		
		//number
		let id="";
		let nw=0.0, nh=0.0;
		if (this.oState.TriTipus=='3') {
			id="triola";
			nw=KottaConsts.TriolaWIDTH;
			nh=KottaConsts.TriolaHEIGHT;
		} else {
			id="pentola";
			nw=KottaConsts.PentolaWIDTH;
			nh=KottaConsts.PentolaHEIGHT;
		}
		//Drawable d=mRes.getDrawable(id);
		let nx=(rp.x+lp.x)/2.0;
		let ny=(rp.y+lp.y)/2.0;
		nw=nw*this.aLineY[1]/nh; nh=this.aLineY[1];
		nx-=nw/2.0;
		ny+=(this.oState.TriLe ? half : -half-this.aLineY[1]);
		rajzPng(id,nx,ny,nx+nw,ny+nh);
		
		//vonalak
		let x1=lp.x, y1=lp.y, x2=rp.x, y2=rp.y;
		let y1a=(this.oState.TriLe ? y1-half : y1+half);
		let y2a=(this.oState.TriLe ? y2-half : y2+half);
		this.oEnv.oCtx.lineWidth=1;
		this.oEnv.oCtx.beginPath();
		for (let i=0; i<mVonalSzel; i++) {
			this.oEnv.oCtx.moveTo(lp.x,y1);
			this.oEnv.oCtx.lineTo(rp.x,y2);
			this.oEnv.oCtx.moveTo(x1,lp.y);
			this.oEnv.oCtx.lineTo(x1,y1a);
			this.oEnv.oCtx.moveTo(x2,rp.y);
			this.oEnv.oCtx.lineTo(x2,y2a);
			y1++; y2++; x1++; x2--;
		}
		this.oEnv.oCtx.stroke();
		
		
	}
	
	addTri(r, lefele) {
		if (this.oState.TriTipus!='3' && this.oState.TriTipus!='5') return;
		if (this.oState.aTriPos.size()>0) lefele=this.oState.TriLe;
		this.oState.TriLe=lefele;
		let x,y;
		if (lefele) {
			x=r.left; y=r.centerY()+this.aLineY[3];
		} else {
			x=r.right; y=r.centerY()-this.aLineY[3];
		}
		this.oState.aTriPos.add(new PointF(x,y));
	}
	
	adjustTri(x1, y1, x2, y2) {
		let xd = x2-x1;
		if (xd<=0.0) return;
		for (let p of this.oState.aTriPos) {
			if (p.x<x1) continue;
			if (p.x>x2) break;
			let y = y1+(y2-y1)*(x2-p.x)/xd;
			if (this.oState.TriLe ? y<p.y : y>p.y) p.y=y;
		}
	}
	

};

export default KOTTA;
