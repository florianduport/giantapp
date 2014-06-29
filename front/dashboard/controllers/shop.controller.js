var model = require('../models/shop.model').ShopModel;

var ShopController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	        res.render('./pages/shop', {model: model});
	    });
	}

};

module.exports.ShopController = ShopController;