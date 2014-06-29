var base = require('./base.model').Base;

var ApplicationModel = {

    initialize : function(req, callback){
        base.common.call(this, req);
        callback(this);
    }

};

module.exports.ApplicationModel = ApplicationModel;