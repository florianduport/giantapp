var express = require('express');
var path = require('path');


//import de tous les services utilisés
var configurationService = require('./services/configuration/configurationService');
var loggerService = require('./services/logger/loggerService');
var customerService = require('./services/customer/customerService');

// Ne pas toucher ce bloc
var app = express();
configurationService.getConfig('services', function(configuration){
	app.set('port',  configuration.port || 3000);

	//routes / mapping controller
	app.get('/', function(req, res){
	    //debug only route - redirect to dev app id
	    res.redirect(404);
	});

	//configurationService
	app.get('/configuration/:application', function(req, res){ 
		configurationService.getConfig(req.params.application, function(configuration){
			res.json(configuration);
		}); 
	});

	//loggerService
	app.get('/logger/:application', function(req, res){
		//get 100 last logs
		loggerService.getLogs(req.params.application, function(logs){
			res.json(logs);
		});
	});

	//loggerService
	app.post('/customer/authenticate', function(req, res){
		//check custoemr login / password
		loggerService.logError("services", "fail post request", req);
		/*console.log("log error called");
		console.log(req.params);
		console.log(req.body);
		console.log(req.query);
		customerService.authenticateCustomer(req.body.username, req.body.password, function(result){
			res.json(result);
		});*/
		res.send(false);
	});	


	//lancement du serveur
	app.listen(configuration.port || 3000, function(){
	    console.log('services started on '+(configuration.port || 3000));    
	});
});
