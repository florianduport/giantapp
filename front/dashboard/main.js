var express = require('express'),
path = require('path'),
cookieParser = require('cookie-parser'),
session = require('express-session'),
customerHelper = require('./helpers/customer.helper'),
bodyParser = require('body-parser'),

homepageController = require('./controllers/homepage.controller'),
applicationController = require('./controllers/application.controller'),
communicationKitController = require('./controllers/communicationKit.controller'),
AccountController = require('./controllers/account.controller').AccountController,
invoicesController = require('./controllers/invoices.controller'),
messagesController = require('./controllers/messages.controller'),
subscriptionController = require('./controllers/subscription.controller'),
helpController = require('./controllers/help.controller');

var Main = {

	start : function(){

		var app = express();

		app.use(cookieParser());
		app.use(session({ secret: 'monapp'}));
		app.set('port', 3000);
		app.set('views', __dirname + '/views');
		app.set('view engine', 'jade');
		app.use(express.static(path.join(__dirname, 'public')));
		app.use(bodyParser());

		//routes / mapping controller
		app.get('/', AccountController.checkSignIn, homepageController.initialize);

		app.post('/signin', AccountController.signIn);
		app.get('/signout', AccountController.signOut);

		app.get('/application', AccountController.checkSignIn, applicationController.initialize);
		app.get('/application/edit', AccountController.checkSignIn, applicationController.edit);

		app.get('/communicationkit', AccountController.checkSignIn, communicationKitController.initialize);

		app.get('/account', AccountController.checkSignIn, AccountController.initialize);
		app.post('/account', AccountController.checkSignIn, AccountController.updateAccount);

		app.get('/invoices', AccountController.checkSignIn, invoicesController.initialize);
		app.get('/messages', AccountController.checkSignIn, messagesController.initialize);
		app.get('/subscription', AccountController.checkSignIn, subscriptionController.initialize);

		app.get('/help', AccountController.checkSignIn, helpController.initialize);
		app.get('/contact', AccountController.checkSignIn, helpController.contactUs);


		app.listen(3000);
	}

};

Main.start();