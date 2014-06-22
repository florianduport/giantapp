var loggerService = require('./logger.service');
var VerifyRequest = require('./../../helpers/hmac.helper').VerifyRequest;

exports.loadRoutes = function(app, configuration){

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

};