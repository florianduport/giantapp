var express = require('express'),
path = require('path'),
cookieParser = require('cookie-parser'),
session = require('express-session'),
bodyParser = require('body-parser'),
Routes = require('./routes/routes').Routes,
ConfigurationHelper = require('./helpers/configuration.helper').ConfigurationHelper;


var Main = {

	start : function(){
	
		ConfigurationHelper.getConfig({application : 'titan', done : function(configuration){

			var app = express();

			app.use(cookieParser());
			app.use(session({ secret: 'giantapp'}));
			app.set('port', configuration.port);
			app.set('views', __dirname + '/views');
			app.set('view engine', 'jade');
			app.use(express.static(path.join(__dirname, 'public')));
			app.use(bodyParser());

			Routes.loadRoutes(app, configuration);

			//lancement du serveur
        	app.listen(configuration.port, function(){
        	    console.log('titan started on '+(configuration.addressBasePath+":"+configuration.port));    
        	});

		}});

	}

};

Main.start();