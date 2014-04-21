var model = require('../models/layout.model');

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./layout', {model: model});
    });
}