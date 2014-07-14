var model = require('../models/layout.model').LayoutModel;

var LayoutController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./layout', {model: model});
	    });
	},

	getCssTheme : function(req, res){
		model.getCssTheme(req.params.appId, function(model){
			res.set('Content-Type', 'text/css');
	        //res.send("body{ background-color:#000000 !important; }");

	        res.render('./dentist/theme', {model: model});
	    });
	}

};

module.exports.LayoutController = LayoutController;
