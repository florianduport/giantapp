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

    	// get theme : /application/getTheme
    
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

        // get page infos : /application/getPage

        app.post(configuration.routes.application.getPage, HmacHelper.verifyRequest, function(req, res){
            //check parameters
            if(req.body === undefined || req.body.appId === undefined || req.body.page === undefined){
                LoggerService.logError("services", "Get Page : Missing parameter", {});
                Base.send(req, res, false);
            }
            
            ApplicationService.getPage(req.body.appId, req.body.page, function(result){
                Base.send(req, res, result);
            });
        });

        // get page infos : /application/getApplicationType

        app.post(configuration.routes.application.getApplicationType, HmacHelper.verifyRequest, function(req, res){

            //check parameters
            if(req.body === undefined || req.body.appId === undefined){
                LoggerService.logError("services", "Get Application Type : Missing parameter", {});
                Base.send(req, res, false);
            }
            
            ApplicationService.getApplicationType(req.body.appId, function(result){
                Base.send(req, res, result);
            });
        });
        
        // get navigation : /application/getNavigation

        app.post(configuration.routes.application.getNavigation, HmacHelper.verifyRequest, function(req, res){

            //check parameters
            if(req.body === undefined || req.body.appId === undefined){
                LoggerService.logError("services", "Get Navigation : Missing parameter", {});
                Base.send(req, res, false);
            }
            
            ApplicationService.getNavigation(req.body.appId, function(result){
                Base.send(req, res, result);
            });
        });

    	
    }
    
};

module.exports.ApplicationRoutes = ApplicationRoutes;