var model = require('../models/page.model').PageModel;

var PageController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	    	if(!model)
	    		res.redirect(301, '/'+req.params.appId+'/error');
	    	else
	        	res.render(model.page.type, {model: model});
	    });
	},

	initializeError : function(req, res){
		model.initializeError(req, function(model){
	        res.render(model.type+"/error", {model: model});
	    });
	}

};

module.exports.PageController = PageController;

