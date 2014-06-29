var base = require('./base.model').Base;

var SubscriptionModel = {

    initialize : function(req, callback){
        base.common.call(this, req);
        callback(this);
    }
    
};

module.exports.SubscriptionModel = SubscriptionModel;