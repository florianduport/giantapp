var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var session = require('express-session');
var customerHelper = require('./helpers/customer.helper');
var bodyParser = require('body-parser');

var homepageController = require('./controllers/homepage.controller');
var applicationController = require('./controllers/application.controller');
var communicationKitController = require('./controllers/communicationKit.controller');
var accountController = require('./controllers/account.controller');
var invoicesController = require('./controllers/invoices.controller');
var messagesController = require('./controllers/messages.controller');
var subscriptionController = require('./controllers/subscription.controller');
var helpController = require('./controllers/help.controller');

var app = express();
app.use(cookieParser());
app.use(session({ secret: 'monapp'}));
app.set('port', process.env.PORT || 3000);
app.set('views', __dirname + '/views');
app.set('view engine', 'jade');
app.use(express.static(path.join(__dirname, 'public')));
app.use(bodyParser());

//routes / mapping controller
app.get('/', accountController.checkSignIn, homepageController.initialize);

app.post('/signin', accountController.signIn);
app.get('/signout', accountController.signOut);

app.get('/application', accountController.checkSignIn, applicationController.initialize);
app.get('/application/edit', accountController.checkSignIn, applicationController.edit);

app.get('/communicationkit', accountController.checkSignIn, communicationKitController.initialize);

app.get('/account', accountController.checkSignIn, accountController.initialize);
app.post('/account', accountController.checkSignIn, accountController.updateAccount);

app.get('/invoices', accountController.checkSignIn, invoicesController.initialize);
app.get('/messages', accountController.checkSignIn, messagesController.initialize);
app.get('/subscription', accountController.checkSignIn, subscriptionController.initialize);

app.get('/help', accountController.checkSignIn, helpController.initialize);
app.get('/contact', accountController.checkSignIn, helpController.contactUs);


app.listen(process.env.PORT);