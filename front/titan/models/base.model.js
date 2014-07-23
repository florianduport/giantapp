var instance;

var Base = {

	getInstance : function(instanceName){
	    if(instance === undefined)
	        instance = new instanceName();
	    return instance;
	},

	common : function(req){
	    if(req !== undefined && req.route !== undefined && req.route.path !== undefined)
	        this.activeMenu = req.route.path;
	}

}

module.exports.Base = Base;