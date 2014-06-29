var base = require('./base.model').Base;

var ShopModel = {
    
    initialize : function(req, callback){
        base.common.call(this, req);
        callback(this);
    }

};

module.exports.ShopModel = ShopModel;