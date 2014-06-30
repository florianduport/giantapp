var express = require('express'),
path = require('path'),
Routes = require('./routes/routes').Routes,
ConfigurationHelper = require('./helpers/configuration.helper').ConfigurationHelper;

/**
 * Classe principale - Keep it simple in here
 * @class Main 
 */
var Main = {

    /**
    * start : lance l'application express
    */
    start : function(){

    	ConfigurationHelper.getConfig({application : 'application', done : function(configuration){

			// Ne pas toucher ce bloc
			var app = express();
			app.set('port', configuration.port);
			app.set('views', __dirname + '/views');
			app.set('view engine', 'jade');
			app.use(express.static(path.join(__dirname, 'public')));

			Routes.loadRoutes(app, configuration);

			//lancement du serveur
			app.listen(configuration.port, function(){
			    console.log('application started on '+(configuration.addressBasePath+":"+configuration.port));      
			});

		}});

	}

};

Main.start();