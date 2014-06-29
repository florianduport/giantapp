var model = require('../models/layout.model').LayoutModel;

var LayoutController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./layout', {model: model});
	    });
	}

};

module.exports.LayoutController = LayoutController;
