var model = require('../models/application.model').getModel();

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/application/application', {model: model});
    });
};
exports.edit = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/application/edit', {model: model});
    });
};