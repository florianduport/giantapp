var customerService = require('./customer.service');
var loggerService = require('../logger/logger.service');
var VerifyRequest = require('../../helpers/hmac.helper').VerifyRequest;

exports.loadRoutes = function(app, configuration){

	// get logs : /customer/authenticateCustomer

	app.post(configuration.routes.customer.authenticateCustomer, VerifyRequest, function(req, res){
		//check parameters
		if(req.body === undefined || !req.body || req.body.username === undefined || !req.body.username || req.body.password === undefined || !req.body.password){
			loggerService.logError("services", "Wront customer authenticate parameters", {username : req.body.username !== undefined ? req.body.username : ""});
			res.send(false);
		}

		customerService.authenticateCustomer(req.body.username, req.body.password, function(result){
			res.send(result);
		});
	});
	
};