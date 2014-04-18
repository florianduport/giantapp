var express = require('express');
var indexController = require('./controllers/index.controller');

var app = express();
app.set('port', process.env.PORT || 3000);
app.set('views', __dirname + '/views');
app.set('view engine', 'jade');

//routes / mapping controller
app.get('/', indexController.initialize);

app.listen(process.env.PORT);