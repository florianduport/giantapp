var HomepageController = require('./../controllers/homepage.controller').HomepageController,
ApplicationController = require('./../controllers/application.controller').ApplicationController,
ShopController = require('./../controllers/shop.controller').ShopController,
AccountController = require('./../controllers/account.controller').AccountController,
InvoicesController = require('./../controllers/invoices.controller').InvoicesController,
MessagesController = require('./../controllers/messages.controller').MessagesController,
SubscriptionController = require('./../controllers/subscription.controller').SubscriptionController,
HelpController = require('./../controllers/help.controller').HelpController;
/**
* Charge les routes de account controller
* @class AccountRoutes
*/
var Routes = {
    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){

		//routes / mapping controller
		app.get('/', AccountController.checkSignIn, HomepageController.initialize);

		app.post('/signin', AccountController.signIn);
		app.get('/signout', AccountController.signOut);

		app.get('/application', AccountController.checkSignIn, ApplicationController.initialize);
		app.get('/application/edit', AccountController.checkSignIn, ApplicationController.edit);

		app.get('/shop', AccountController.checkSignIn, ShopController.initialize);

		app.get('/account', AccountController.checkSignIn, AccountController.initialize);
		app.post('/account', AccountController.checkSignIn, AccountController.updateAccount);

		app.get('/invoices', AccountController.checkSignIn, InvoicesController.initialize);
		app.get('/messages', AccountController.checkSignIn, MessagesController.initialize);
		app.get('/subscription', AccountController.checkSignIn, SubscriptionController.initialize);

		app.get('/help', AccountController.checkSignIn, HelpController.initialize);
		app.get('/contact', AccountController.checkSignIn, HelpController.contactUs);

    }

};

module.exports.Routes = Routes;