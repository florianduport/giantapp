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

    	// authenticate customer : /customer/authenticateCustomer
    
    	app.post(configuration.routes.customer.authenticateCustomer, HmacHelper.verifyRequest, function(req, res){
    		//check parameters
            if(req.body === undefined || !req.body || req.body.username === undefined || !req.body.username || req.body.password === undefined || !req.body.password){
    			LoggerService.logError("services", "Wrong customer authenticate parameters", {username : req.body.username !== undefined ? req.body.username : ""});
    			Base.send(req, res, false);
    		}
    
    		CustomerService.authenticateCustomer(req.body.username, req.body.password, function(result){
    			Base.send(req, res, result);
    		});
    	});

        // get customer by username : /customer/getByUsername

        app.post(configuration.routes.customer.getCustomerByUsername, HmacHelper.verifyRequest, function(req, res){
            //check parameters
            if(req.body === undefined || !req.body || req.body.username === undefined || !req.body.username){
                LoggerService.logError("services", "Wrong customer get by username parameters", {});
                Base.send(req, res, false);
            }
            CustomerService.getCustomerByUsername(req.body.username, function(result){
                Base.send(req, res, result);
            });
        });

        // update : /customer/update

        app.post(configuration.routes.customer.updateCustomer, HmacHelper.verifyRequest, function(req, res){
            //check parameters
            if(req.body === undefined || !req.body || req.body.username === undefined || !req.body.username || req.body.account === undefined || !req.body.account){
                LoggerService.logError("services", "Wrong update customer parameters", {});
                Base.send(req, res, false);
            }
            CustomerService.updateCustomer(req.body.username, req.body.account, function(result){
                Base.send(req, res, result);
            });
        });
    	
    }
    
};

module.exports.CustomerRoutes = CustomerRoutes;