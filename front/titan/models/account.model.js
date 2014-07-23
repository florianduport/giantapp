var base = require('./base.model').Base, 
sha1 = require('sha1'),
ServiceHelper = require('./../helpers/service.helper').ServiceHelper;

var AccountModel = {

    initialize : function(req, callback){
        base.common.call(this, req);

        ServiceHelper.getService("admin", "getAdminByUsername", {data: {username: req.session.user}}, function(user){
            
            this.user = user;
            callback(this);
        });
        
    },

    signIn : function(username, password, req, done){

        ServiceHelper.getService("admin", "authenticateAdmin", {data : {username : username, password : sha1(password)}}, function(resp){
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