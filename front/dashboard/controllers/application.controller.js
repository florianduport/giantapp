var model = require('../models/application.model').ApplicationModel;

var ApplicationController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/application/application', {model: model});
	    });
	},

	edit : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/application/edit', {model: model});
	    });
	}

};

module.exports.ApplicationController = ApplicationController;