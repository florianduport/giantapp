var base = require('./base.model').Base,
ServiceHelper = require('./../helpers/service.helper').ServiceHelper;

var TechnicalModel = {

    initialize : function(req, callback){
		base.common.call(TechnicalModel, req);
		callback(TechnicalModel);
    },
    showLogs : function(req, callback){
        base.common.call(TechnicalModel, req);
        ServiceHelper.getService("logger", "getLogs", {data: {}}, function(logs){
            console.log(logs);
            TechnicalModel.logs = logs;
            callback(TechnicalModel);
        });
    }, 
    exportDatabase : function(req, callback){
		base.common.call(TechnicalModel, req);
		ServiceHelper.getService("admin", "exportDatabase", {data: {}}, function(database){
			TechnicalModel.database = database;
            callback(TechnicalModel);
        });
    }
};

module.exports.TechnicalModel = TechnicalModel;