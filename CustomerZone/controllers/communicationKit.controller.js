var model = require('../models/communicationKit.model').getModel();

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/communicationKit', {model: model});
    });
};