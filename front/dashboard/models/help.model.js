var base = require('./base.model').Base;

var HelpModel = {

    initialize : function(req, callback){
        base.common.call(this, req);
        callback(this);
    }
    
};

module.exports.HelpModel = HelpModel;