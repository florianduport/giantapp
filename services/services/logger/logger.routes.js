var loggerService = require('./logger.service');
var VerifyRequest = require('./../../helpers/hmac.helper').VerifyRequest;

/**
 * Routes du service Customer
 * @class LoggerRoutes
 */
var LoggerRoutes = {

    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){
    
    	// get logs : /logger/
    
    	app.get(configuration.routes.logger.getLogs, VerifyRequest, function(req, res){
    		var application = "";
    		if(req.body !== undefined && req.body.application !== undefined)
    			application = req.body.application;
    		//get 100 last logs
    		loggerService.getLogs(application, function(logs){
    			res.json(logs);
    		});
    	});
    
    }

};

module.exports.LoggerRoutes = LoggerRoutes;

