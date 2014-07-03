var LayoutModel = {

	initialize : function(req, callback){

	    //récupérer toutes les infos du layout / menu
	    callback(this);
	},

	getCssTheme : function(req, callback){
		
		this.backgroundColor = "#ffffff";
		this.navbar = {};
		this.navbar.backgroundColor = "#03a9f4";
		this.navbar.textColor = "#ffffff";

		callback(this);
	}

};

module.exports.LayoutModel = LayoutModel;