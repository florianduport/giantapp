var base = require('./base.model').Base,
ServiceHelper = require('./../helpers/service.helper').ServiceHelper;

var InvoicesModel = {
    
    initialize : function(req, callback){

        //WARNING
        //TO CHANGE => call invoices service
		ServiceHelper.getService("customer", "getCustomerByUsername", {data: {username: req.session.user}}, function(user){
            base.common.call(this, req);
            this.account = user.invoices;
            callback(this);
        });

    }

};

module.exports.InvoicesModel = InvoicesModel;