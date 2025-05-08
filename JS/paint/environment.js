//drawing environment
class ENVIRONMENT {
	//fields:
	oCtx;				//canvas context
	nWidth;				//screen width
	nHeight;			//screen height
	nFontsize;			//font size
	sFontfamily;		//font family
	nFontascent2;		//half ascent (for strikethrough)
	nFontdescent2;		//half descent (for underline)
	nSpaceWidth;		//avg width of one space
	nFontHeight;		//height of font
	bHasAccord = false;	//are there chords in text?
	bDrawAccord = true;	//we would like to draw chords?
	
	//name containing bold/italic style and size info
	getFontName(bd,it) {
		return (bd ? "bold " : "")+(it ? "italic " : "") + this.nFontsize + "pt " + this.sFontfamily;
	};
	//set up font for output
	setFont(bd,it) {
		this.oCtx.font = this.getFontName(bd,it);
	};
	//set up for reduced font size (perc=0..100)
	setFontPercent(perc,bd,it) {
		let origsize = this.nFontsize;
		this.nFontsize=(this.nFontsize*perc)/100;
		this.setFont(bd,it);
		this.nFontsize=origsize;
	}
};

export default ENVIRONMENT;
