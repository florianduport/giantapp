var model = require('../models/messages.model').getModel();

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/messages', {model: model});
    });
};