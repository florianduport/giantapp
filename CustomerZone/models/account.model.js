var sha1 = require('sha1');
var base = require('./base.model');
var customerHelper = require('../helpers/customer.helper');

var Model = function(){
    this.initialize = function(req, callback){

        customerHelper.findOneByUsername({username: req.session.user}, function(user){
            base.common.call(this, req);
            this.user = user;
            callback(this);
        });
        
    },
    this.updateAccount = function(req, data, callback){
        base.common.call(this, req);
        
        customerHelper.findOneByUsername({username: req.session.user}, function(user){
            this.user = user;
            console.log(this.user);
            var updatedUser = user;
            
            if(data.password !== undefined)
                updatedUser.password = sha1(data.password);
            
            updatedUser.account.firstName = data.firstName;
            updatedUser.account.lastName = data.lastName;
            updatedUser.account.address.invoice = data.invoiceAddress;
            updatedUser.account.address.shipping = data.shippingAddress;
            updatedUser.account.phoneNumber = data.phoneNumber !== undefined ? data.phoneNumber : "";
            
            customerHelper.save(updatedUser, function(){
                callback(this);
            });
            
        });
        
    },
    this.displaySignIn = function(req, callback){
        base.common.call(this, req);
        if(req.session.error)
            this.error = req.session.error;
        else
            this.error = false;
        callback(this);
    };
};
exports.getModel = function(){ return new Model(); };