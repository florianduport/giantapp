var Base = require('../base/base.routes').BaseRoutes,
ApplicationService = require('./application.service').ApplicationService,
LoggerService = require('../logger/logger.service').LoggerService,
HmacHelper = require('./../../helpers/hmac.helper').HmacHelper;

/**
 * Routes du service Application
 * @class ApplicationRoutes
 */
var ApplicationRoutes = {

    Base : Base,

    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){

    	// get theme : /application/getTheme/:id
    
    	app.post(configuration.routes.application.getTheme, HmacHelper.verifyRequest, function(req, res){
    		//check parameters
            if(req.body === undefined || req.body.appId === undefined){
    			LoggerService.logError("services", "Get Theme : Missing appId parameter", {});
    			Base.send(req, res, false);
    		}
            
    		ApplicationService.getTheme(req.body.appId, function(result){
    			Base.send(req, res, result);
    		});
    	});
    	
    }
    
};

module.exports.ApplicationRoutes = ApplicationRoutes;