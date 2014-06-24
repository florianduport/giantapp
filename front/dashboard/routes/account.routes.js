var AccountController = require('./../controllers/account.controller').AccountController;

/**
* Charge les routes de account controller
* @class AccountRoutes
*/
var AccountRoutes = {
    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){

		app.post('/signin', AccountController.signIn);
		app.get('/signout', AccountController.signOut);

    }

};

module.exports.AccountRoutes = AccountRoutes;