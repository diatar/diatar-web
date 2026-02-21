//drawing environment
class ENVIRONMENT {
	//fields:
	oCtx;				//canvas context
	oKotta;				//music sheet drawer object
	nWidth;				//screen width (pixel)
	nHeight;			//screen height (pixel)
	nFontsize;			//font size (pt)
	sFontfamily;		//font family name
	nFontascent2;		//half ascent (for strikethrough)
	nFontdescent2;		//half descent (for underline)
	nSpaceWidth;		//avg width of one space (pixel)
	nFontHeight;		//height of font (pixel)
	bHasAccord = false;	//are there chords in text?
	bDrawAccord = true;	//we would like to draw chords?
	bHasKotta = false;	//are there music notes in text?
	bDrawKotta = true;	//we would like to draw music sheet?
	
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
