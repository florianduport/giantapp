var model = require('../models/help.model').getModel();

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/help', {model: model});
    });
};

exports.contactUs = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/contact', {model: model});
    });
};