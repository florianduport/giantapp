var express = require('express');
var path = require('path');
var configurationHelper = require('./helper/configuration');

//import de tous les controllers utilisés
var indexController = require('./controllers/index.controller');

// Ne pas toucher ce bloc
var app = express();
configurationHelper.getConfig(function(configuration){
	app.set('port', configuration.port || 3000);
	app.set('views', __dirname + '/views');
	app.set('view engine', 'jade');
	app.use(express.static(path.join(__dirname, 'public')));

	app.get('/', function(req, res){
	    //debug only route - redirect to dev app id
	    res.render('ok');
	});

	//lancement du serveur
	app.listen(configuration.port || 3000, function(){
	    console.log('titan started on ' + configuration.port || 3000);    
	});
});