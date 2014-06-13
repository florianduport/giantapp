var model = require('../models/invoices.model').getModel();

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/invoices', {model: model});
    });
};