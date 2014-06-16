var model = require('../models/homepage.model').getModel();
var customerHelper = require('../helpers/customer.helper');

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        res.render('./pages/homepage', {model: model});
    });
};