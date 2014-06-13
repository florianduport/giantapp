var express = require('express');
var indexController = require('./controllers/index.controller');

var app = express();
app.set('port', 3000);
app.set('views', __dirname + '/views');
app.set('view engine', 'jade');

//routes / mapping controller
app.get('/', indexController.initialize);

app.listen(3000);