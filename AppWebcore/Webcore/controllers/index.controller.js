var model = require('../models/index.model');
exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/index', {model: model});
    });
}