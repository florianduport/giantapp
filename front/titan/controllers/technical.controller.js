var model = require('../models/technical.model').TechnicalModel;

var TechnicalController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/technical', {model: model});
	    });
	},
	showLogs: function(req, res){
		model.showLogs(req, function(model){
	        res.render('./pages/technical/logs', {model: model});
	    });
	},
	exportDatabase : function(req, res){
	    model.exportDatabase(req, function(model){
	        res.send(model.database);
	    });
	}

};

module.exports.TechnicalController = TechnicalController;