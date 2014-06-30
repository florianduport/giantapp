var model = require('../models/homepage.model').HomepageModel;

var HomepageController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/homepage', {model: model, test: "testezz"});
	    });
	}

};

module.exports.HomepageController = HomepageController;

