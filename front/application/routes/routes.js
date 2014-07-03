var HomepageController = require('./../controllers/homepage.controller').HomepageController,
LayoutController = require('./../controllers/layout.controller').LayoutController
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
		app.get('/:appId/', HomepageController.initialize);

		app.get('/index.html', function(req, res){
		    res.redirect(301, '/1/');
		});

		app.get('/css/theme.css', LayoutController.getCssTheme)
		
		app.get('/', function(req, res){
		    //debug only route - redirect to dev app id
		    res.redirect(301, '/1/');
		});

    }

};

module.exports.Routes = Routes;