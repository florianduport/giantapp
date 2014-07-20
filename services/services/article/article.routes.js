var Base = require('../base/base.routes').BaseRoutes,
ApplicationService = require('./article.service').ArticleService,
LoggerService = require('../logger/logger.service').LoggerService,
HmacHelper = require('./../../helpers/hmac.helper').HmacHelper;

/**
 * Routes du service Articles
 * @class ArticleRoutes
 */
var ArticleRoutes = {

    Base : Base,

    /**
    * loadRoutes : Charge les routes dans Express pour les rendre accessible
    * @param app : l'application express
    * @param configuration : la configuration de l'application (contient le chemin de l'url)
    */
    loadRoutes : function(app, configuration){

    	// get theme : /article/getArticles
    
    	app.post(configuration.routes.article.getArticles, HmacHelper.verifyRequest, function(req, res){
    		//check parameters
            if(req.body === undefined || req.body.appId === undefined){
    			LoggerService.logError("services", "Get Theme : Missing appId parameter", {});
    			Base.send(req, res, false);
    		}
            
    		ArticleService.getArticles(req.body.appId, function(result){
    			Base.send(req, res, result);
    		});
    	});

        // get page infos : /article/getArticle

        app.post(configuration.routes.article.getArticle, HmacHelper.verifyRequest, function(req, res){
            //check parameters
            if(req.body === undefined || req.body.appId === undefined || req.body.articleId === undefined){
                LoggerService.logError("services", "Get Page : Missing parameter", {});
                Base.send(req, res, false);
            }
            
            ArticleService.getArticle(req.body.appId, req.body.articleId, function(result){
                Base.send(req, res, result);
            });
        });
    	
    }
    
};

module.exports.ArticleRoutes = ArticleRoutes;