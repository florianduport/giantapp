var PageController = require('./../controllers/page.controller').PageController,
LayoutController = require('./../controllers/layout.controller').LayoutController,
ArticleController = require('./../controllers/article.controller').ArticleController
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
		app.get('/:appId/', function(req, res){
			res.redirect(301, '/'+req.params.appId+'/homepage');
		});

		app.get('/:appId/error', PageController.initializeError);

		app.get('/:appId/articles', ArticleController.initialize);
		app.get('/:appId/articles/:articleId', ArticleController.initializeArticle);

		app.get('/:appId/:page', PageController.initialize);


		app.get('/:appId/css/theme.css', LayoutController.getCssTheme)
		
		app.get('/', function(req, res){
		    //debug only route - redirect to dev app id
		    res.redirect(301, '/53b70cfdb0937f4e48af3a3c/');
		});

    }

};

module.exports.Routes = Routes;