var model = require('../models/messages.model').MessagesModel;

var MessagesController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/messages', {model: model});
	    });
	}

};

module.exports.MessagesController = MessagesController;