var model = require('../models/subscription.model').getModel();

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/subscription', {model: model});
    });
};