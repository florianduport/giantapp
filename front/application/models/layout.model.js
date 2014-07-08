var ServiceHelper = require('../helpers/service.helper').ServiceHelper;

var LayoutModel = {

	initialize : function(req, callback){

	    //récupérer toutes les infos du layout / menu
	    callback(this);
	},

	getCssTheme : function(appId, callback){
		
            console.log("route ok ");
		ServiceHelper.getService('application', 'getTheme', {data: {"appId" : appId}, method : "POST"}, function(theme){

			this.navbar = theme.navbar;

			callback(this);

		})
	}

};

module.exports.LayoutModel = LayoutModel;