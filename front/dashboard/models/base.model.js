var instance;

var getInstance = function(instanceName){
    if(instance === undefined)
        instance = new instanceName();
    return instance;
};

var common = function(req){
    if(req !== undefined && req.route !== undefined && req.route.path !== undefined)
        this.activeMenu = req.route.path;
};

exports.common = common;
exports.getInstance = getInstance;