var base = require('./base.model');

var Model = function(){
    this.initialize = function(req, callback){
        base.common.call(this, req);
        callback(this);
    };
};
exports.getModel = function(){ return new Model(); };