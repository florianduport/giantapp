var DatabaseHelper = require('../../helpers/database.helper').DatabaseHelper,
ObjectId = require('mongodb').ObjectID,
LoggerHelper = require('../../helpers/logger.helper').LoggerHelper;

/**
 * Service Articles
 * @class ArticleService
 */
var ArticleService = {

    /**
    * getArticles : Récupère les fiches conseils de l'application
    * @param appId : l'id de l'application
    * @param done : la méthode de retour
    * @return Les fiches conseils. Sinon False.
    */
    getArticles : function(appId, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Applications", function(err, applications){
                //password should be sent with sha1 encryption
                applications.findOne({ _id: ObjectId(appId)}, function(err, application){
                    if (err || !application)
                    {
                        LoggerHelper.logError("services", "cannot find application for getArticles", appId, {});
                        return done(false);
                    }

                    db.collection("Articles", function(err, articlesCollection){
                        articlesCollection.find({type: application.type}, function(err, articles){
                            if (err || !articles)
                            {
                                LoggerHelper.logError("services", "cannot find articles for getArticles", appId, {});
                                return done(false);
                            }
                            return done(articles);
                        });
                    });
                });
            });
        });
    },

    /**
    * getArticle : Récupère une fiche conseil
    * @param appId : l'id de l'application
    * @param articleId : la fiche conseil à récupérer
    * @param done : la méthode de retour
    * @return La fiche conseil. Sinon False.
    */
    getArticle : function(appId, articleId, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Applications", function(err, applications){
                //password should be sent with sha1 encryption
                applications.findOne({ _id: ObjectId(appId)}, function(err, application){
                    if (err || !application)
                    {
                        LoggerHelper.logError("services", "cannot find application for getArticle", appId, {});
                        return done(false);
                    }

                    db.collection("Articles", function(err, articlesCollection){
                        articlesCollection.findOne({type: application.type, _id: ObjectId(articleId)}, function(err, article){
                            if (err || !article)
                            {
                                LoggerHelper.logError("services", "cannot find article for getArticle", appId, {});
                                return done(false);
                            }
                            return done(article);
                        });
                    });
                });
            });
        });
    },

};

module.exports.ArticleService = ArticleService;
