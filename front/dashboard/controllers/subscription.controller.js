var model = require('../models/subscription.model').SubscriptionModel;

var SubscriptionController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/subscription', {model: model});
	    });
	}

}

module.exports.SubscriptionController = SubscriptionController;