var model = require('../models/index.model');

exports.initialize = function(req, res){
    //if not signed in
    model.initialize(req, function(model){
        res.render('./pages/signIn', {model: model});
    });
    
    //if signed in already
    /*model.initialize(req, function(model){
        res.render('./pages/index', {model: model});
    });*/
}
exports.signIn = function(req, res){
    
}