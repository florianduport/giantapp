var ServiceHelper = require('../helpers/service.helper').ServiceHelper;

var PageModel = {

	initialize : function(req, callback){
		this.appId = req.params.appId;

		ServiceHelper.getService('application', 'getPage', {data: {"appId" : this.appId, "page" : req.params.page}, method : "POST"}, function(page){
			if(!page)
				callback(false);
			else {
				this.page = page;
				this.navigation = page.navigation;
				callback(this);
			}
		})
	},

	initializeError : function(req, callback){
		this.appId = req.params.appId;

		ServiceHelper.getService('application', 'getApplicationType', {data: {"appId" : this.appId}, method : "POST"}, function(type){
			if(type === false)
				callback(false);
			this.type = type;
			callback(this);
		})
	}

};

module.exports.PageModel = PageModel;