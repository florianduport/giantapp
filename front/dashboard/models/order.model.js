var base = require('./base.model').Base;

var OrderModel = {
    
    initialize : function(req, callback){
        base.common.call(this, req);
        callback(this);
    }

};

module.exports.OrderModel = OrderModel;

