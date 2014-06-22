var express = require('express');
var path = require('path');
var bodyParser = require('body-parser');

var GetConfig = require('./helpers/configuration.helper').GetConfig;

var routes = [
	require('./services/logger/logger.routes'),
	require('./services/customer/customer.routes')
];

// Ne pas toucher ce bloc
var app = express();
app.use(bodyParser.json());


GetConfig({application : 'services', done : function(configuration){
	app.set('port',  configuration.port);

	//load all routes
	for(var i = 0; i < routes.length; i++){
		routes[i].loadRoutes(app, configuration);
	}

	//lancement du serveur
	app.listen(configuration.port, function(){
	    console.log('services started on '+(configuration.addressBasePath+":"+configuration.port));    
	});
}});
