var base = require('./base.model');
var customerHelper = require('../helpers/customer.helper');

var Model = function(){
    this.initialize = function(req, callback){
        customerHelper.findOneByUsername({username: req.session.user, property: "invoices"}, function(invoices){
            base.common.call(this, req);
            this.invoices = invoices;
            callback(this);
        });
    };
};

exports.getModel = function(){ return new Model(); };