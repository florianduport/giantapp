var express = require('express');
var path = require('path');

//import de tous les controllers utilisés
var indexController = require('./controllers/index.controller');
var layoutController = require('./controllers/layout.controller');

// Ne pas toucher ce bloc
var app = express();
app.set('port', process.env.PORT || 3000);
app.set('views', __dirname + '/views');
app.set('view engine', 'jade');
app.use(express.static(path.join(__dirname, 'public')));

//routes / mapping controller
app.get('/:appId/', layoutController.initialize);
app.get('/index.html', function(req, res){
    res.redirect(301, '/1/');
});
app.get('/', function(req, res){
    //debug only route - redirect to dev app id
    res.redirect(301, '/1/');
});

//lancement du serveur
app.listen(process.env.PORT, function(){
    console.log('application started');    
});