var model = require('../models/help.model').HelpModel;

var HelpController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/help', {model: model});
	    });
	},

	contactUs : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/contact', {model: model});
	    });
	}

};

module.exports.HelpController = HelpController;