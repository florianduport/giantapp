var Base = require('../base/base.routes').BaseRoutes,
CustomerService = require('./customer.service').CustomerService,
LoggerService = require('../logger/logger.service').LoggerService,
HmacHelper = require('./../../helpers/hmac.helper').HmacHelper;

/**
 * Routes du service Customer
 * @class CustomerRoutes
 */
var CustomerRoutes = {

    Base : Base,

    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){

    	// get logs : /customer/authenticateCustomer
    
    	app.post(configuration.routes.customer.authenticateCustomer, HmacHelper.verifyRequest, function(req, res){
    		//check parameters
            if(req.body === undefined || !req.body || req.body.username === undefined || !req.body.username || req.body.password === undefined || !req.body.password){
    			LoggerService.logError("services", "Wront customer authenticate parameters", {username : req.body.username !== undefined ? req.body.username : ""});
    			Base.send(req, res, false);
    		}
    
    		CustomerService.authenticateCustomer(req.body.username, req.body.password, function(result){
    			Base.send(req, res, result);
    		});
    	});
    	
    }
    
};

module.exports.CustomerRoutes = CustomerRoutes;