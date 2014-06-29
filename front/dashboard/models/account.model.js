var base = require('./base.model').Base, 
sha1 = require('sha1'),
ServiceHelper = require('./../helpers/service.helper').ServiceHelper;

var AccountModel = {

    initialize : function(req, callback){
        base.common.call(this, req);

        ServiceHelper.getService("customer", "getCustomerByUsername", {data: {username: req.session.user}}, function(user){
            
            this.user = user;
            callback(this);
        });
        
    },

    updateAccount : function(req, data, callback){
        base.common.call(this, req);
        
        ServiceHelper.getService("customer", "updateAccount", {data: {username : req.session.user, account : data}}, function(result){
            if(!result)
                this.error = true;
            callback(this);
        });
        
    },

    signIn : function(username, password, req, done){

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

    displaySignIn : function(req, callback){
        base.common.call(this, req);
        
        if(req.session.error)
            this.error = req.session.error;
        else
            this.error = false;
        callback(this);
    }
};

module.exports.AccountModel = AccountModel;