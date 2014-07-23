var Base = require('../base/base.routes').BaseRoutes,
AdminService = require('./admin.service').AdminService,
LoggerService = require('../logger/logger.service').LoggerService,
HmacHelper = require('./../../helpers/hmac.helper').HmacHelper;

/**
 * Routes du service Admin
 * @class CustomerRoutes
 */
var AdminRoutes = {

    Base : Base,

    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){

    	// authenticate admin : /admin/authenticateAdmin
    
    	app.post(configuration.routes.admin.authenticateAdmin, HmacHelper.verifyRequest, function(req, res){
    		//check parameters
            if(req.body === undefined || !req.body || req.body.username === undefined || !req.body.username || req.body.password === undefined || !req.body.password){
    			LoggerService.logError("services", "Wrong admin authenticate parameters", {username : req.body.username !== undefined ? req.body.username : ""});
    			Base.send(req, res, false);
    		}
    		AdminService.authenticateAdmin(req.body.username, req.body.password, function(result){
    			Base.send(req, res, result);
    		});
    	});

        // get admin by username : /admin/getByUsername

        app.post(configuration.routes.admin.getAdminByUsername, HmacHelper.verifyRequest, function(req, res){
            //check parameters
            if(req.body === undefined || !req.body || req.body.username === undefined || !req.body.username){
                LoggerService.logError("services", "Wrong admin get by username parameters", {});
                Base.send(req, res, false);
            }
            AdminService.getAdminByUsername(req.body.username, function(result){
                Base.send(req, res, result);
            });
        });

        app.post(configuration.routes.admin.exportDatabase, HmacHelper.verifyRequest, function(req, res){
            //check parameters
            
            AdminService.exportDatabase(function(result){
                Base.send(req, res, result);
            });
        });
    	
    }
    
};

module.exports.AdminRoutes = AdminRoutes;