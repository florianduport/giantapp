var ServiceHelper = require('../helpers/service.helper').ServiceHelper;

var LayoutModel = {

	initialize : function(req, callback){

	    //récupérer toutes les infos du menu
		ServiceHelper.getService('application', 'getNavigation', {data: {"appId" : appId}, method : "POST"}, function(navigation){
			this.navigation = navigation;
			callback(this);
		});
	},

	getCssTheme : function(appId, callback){
		
		ServiceHelper.getService('application', 'getTheme', {data: {"appId" : appId}, method : "POST"}, function(theme){
			this.navbar = theme.navbar;
			callback(this);
		});
	}

};

module.exports.LayoutModel = LayoutModel;