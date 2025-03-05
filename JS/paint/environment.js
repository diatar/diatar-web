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
	
	//name containing bold/italic style and size info
	getFontName(bd,it) {
		return (bd ? "bold " : "")+(it ? "italic " : "") + this.nFontsize + "pt " + this.sFontfamily;
	};
	setFont(bd,it) {
		this.oCtx.font = this.getFontName(bd,it);
	};	
};

export default ENVIRONMENT;
