var Base = require('../base/base.routes').BaseRoutes,
LoggerService = require('./logger.service').LoggerService,
HmacHelper = require('./../../helpers/hmac.helper').HmacHelper;

/**
 * Routes du service Customer
 * @class LoggerRoutes
 */
var LoggerRoutes = {

    Base : Base,

    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){
        
    	// get logs : /logger/
    
    	app.get(configuration.routes.logger.getLogs, HmacHelper.verifyRequest, function(req, res){
    		var application = "";
    		if(req.body !== undefined && req.body.application !== undefined)
    			application = req.body.application;
    		//get 100 last logs
    		LoggerService.getLogs(application, function(logs){
    			Base.send(req, res, logs);
    		});
    	});
    
    }

};

module.exports.LoggerRoutes = LoggerRoutes;

