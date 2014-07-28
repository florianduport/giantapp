var HomepageController = require('./../controllers/homepage.controller').HomepageController,
AccountController = require('./../controllers/account.controller').AccountController,
TechnicalController = require('./../controllers/technical.controller').TechnicalController
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

        app.get('/technical', AccountController.checkSignIn, TechnicalController.initialize);
        app.get('/technical/logs', AccountController.checkSignIn, TechnicalController.showLogs);
        app.get('/technical/exportDatabase', AccountController.checkSignIn, TechnicalController.exportDatabase);

    }

};

module.exports.Routes = Routes;