var model = require('../models/invoices.model').InvoicesModel;

var InvoicesController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/invoices', {model: model});
	    });
	}

};

module.exports.InvoicesController = InvoicesController;