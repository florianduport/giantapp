var model = require('../models/technical.model').TechnicalModel;

var TechnicalController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/technical', {model: model});
	    });
	},
	exportDatabase : function(req, res){
	    model.exportDatabase(req, function(model){
	        res.send(model.database);
	    });
	}

};

module.exports.TechnicalController = TechnicalController;