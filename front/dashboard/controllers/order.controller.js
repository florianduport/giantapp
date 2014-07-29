var model = require('../models/order.model').OrderModel;

var OrderController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/order', {model: model});
	    });
	}

};

module.exports.OrderController = OrderController;