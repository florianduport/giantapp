var sha1 = require('sha1');
base = require('./base.model'),
ServiceHelper = require('./../helpers/service.helper').ServiceHelper;

var AccountModel = function(){

    this.initialize = function(req, callback){

        ServiceHelper.getService("customer", "findOneByUsername", {data: {username: req.session.user}}, function(user){
            base.common.call(this, req);
            this.user = user;
            callback(this);
        });
        
    },

    this.updateAccount = function(req, data, callback){
        base.common.call(this, req);
        
        ServiceHelper.getService("customer", "updateAccount", {data: data}, function(user){
            /*this.user = user;
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
            });*/
            callback(this);
        });
        
    },

    this.signIn = function(username, password, req, done){

        ServiceHelper.getService("customer", "authenticateCustomer", {data : {username : username, password : sha1(password)}, method: "POST"}, function(resp){
            if(resp === undefined || !resp || resp !== true)
            {
                req.session.error = true;
                return done(false);
            }
            req.session.error = false;
            req.session.user = username;

            return done(true);
        });

    },

    this.displaySignIn = function(req, callback){
        base.common.call(this, req);
        if(req.session.error)
            this.error = req.session.error;
        else
            this.error = false;
        callback(this);
    }
};

module.exports.AccountModel = function(){ return new AccountModel(); };