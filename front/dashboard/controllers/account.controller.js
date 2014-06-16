var model = require('../models/account.model').getModel();
var customerHelper = require('../helpers/customer.helper');

exports.initialize = function(req, res){
    model.initialize(req, function(model){
        model.error = false;
        model.accountUpdated = false;
        res.render('./pages/account', {model: model});
    });
};
exports.updateAccount = function(req, res){
    var data = {};
    
    if(req.body.updatePassword !== undefined && req.body.updatePassword && req.body.newPassword !== undefined && req.body.newPassword.length > 0)
        data.password = req.body.newPassword;
    
    var updateProperty = function(property){
        if(req.body[property] !== undefined && req.body[property].length > 0)
        {
            data[property] = req.body[property];
            return false;
        }
        else
            return true;
    };
    
    var error = false;
    error = updateProperty("firstName");
    error = updateProperty("lastName");
    error = updateProperty("invoiceAddress");
    error = updateProperty("shippingAddress");
    updateProperty("phoneNumber");
    
    if(error)
    {
        model.initialize(req, function(model){
            model.error = true;
            model.accountUpdated = false;
            res.render('./pages/account', {model: model});
        });
    }
    else
    {
        model.updateAccount(req, data, function(model){
            if(model.error === undefined || !model.error) 
                model.accountUpdated = true;
            res.render('./pages/account', {model: model});
        });
    }
};
exports.checkSignIn = function(req, res, next){
    if(req.session.user !== undefined)
    {
        next();
    }
    else
    {
        model.displaySignIn(req, function(model){
            res.render('./pages/signIn', {model: model});
        }); 
    }
};
exports.signIn = function(req, res){
    var done = function(authenticated){
        res.redirect(req.get('referer'));
    };
    customerHelper.signIn(req.body.username, req.body.password, req, done);
};
exports.signOut = function(req, res){
    req.session.destroy();
    res.redirect('/');
};