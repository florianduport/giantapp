var DatabaseHelper = require('../../helpers/database.helper').DatabaseHelper,
ObjectId = require('mongodb').ObjectID,
LoggerHelper = require('../../helpers/logger.helper').LoggerHelper;

/**
 * Service Application
 * @class ApplicationService
 */
var ApplicationService = {

    /**
    * getTheme : Récupère le theme de l'application
    * @param appId : l'id de l'application
    * @param done : la méthode de retour
    * @return Le theme de l'app. Sinon False.
    */
    getTheme : function(appId, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Applications", function(err, applications){
                //password should be sent with sha1 encryption
                applications.findOne({ _id: ObjectId(appId)}, function(err, application){
                    if (err || !application)
                    {
                        LoggerHelper.logError("services", "cannot find application for theme", appId, {});
                        return done(false);
                    }    
                    return done(application.theme); 
                });
            });
        });
    },

    /**
    * getPage : Récupère une page de l'application
    * @param appId : l'id de l'application
    * @param page : la page à récupérer
    * @param done : la méthode de retour
    * @return L'objet page. Sinon False.
    */
    getPage : function(appId, page, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Applications", function(err, applications){
                //password should be sent with sha1 encryption
                applications.findOne({ _id: ObjectId(appId)}, function(err, application){
                    if (err || !application)
                    {
                        LoggerHelper.logError("services", "cannot find application for page", appId, {});
                        return done(false);
                    }

                    var navigation = [];

                    for (var i = application.navigation.length - 1; i >= 0; i--) {
                        navigation[i] = {
                            name : application.navigation[i].name,
                            type : application.navigation[i].type,
                            link : application.navigation[i].link
                        };
                    };

                    for (var i = application.navigation.length - 1; i >= 0; i--) {
                            if(application.navigation[i].type == application.type+"/pages/"+page) {
                                application.navigation[i].navigation = navigation;
                                return done(application.navigation[i]); 
                            }
                    };

                    LoggerHelper.logError("services", "cannot find page in application", appId, {});    
                    return done(false); 
                });
            });
        });
    },

    /**
    * getApplicationType : Récupère le type d'application (dentist etc)
    * @param appId : l'id de l'application
    * @param done : la méthode de retour
    * @return le type d'app. Sinon False.
    */
    getApplicationType : function(appId, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Applications", function(err, applications){
                //password should be sent with sha1 encryption
                applications.findOne({ _id: ObjectId(appId)}, function(err, application){
                    if (err || !application || !application.type)
                    {
                        LoggerHelper.logError("services", "cannot find application for app type", appId, {});
                        return done(false);
                    }
                    return done(application.type); 
                });
            });
        });
    },

    /**
    * getNavigation : Récupère la navigation de l'appli (menu)
    * @param appId : l'id de l'application
    * @param done : la méthode de retour
    * @return la navigation de l'app. Sinon False.
    */
    getNavigation : function(appId, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Applications", function(err, applications){
                //password should be sent with sha1 encryption
                applications.findOne({ _id: ObjectId(appId)}, function(err, application){
                    if (err || !application || !application.type)
                    {
                        LoggerHelper.logError("services", "cannot find application for get navigation", appId, {});
                        return done(false);
                    }
                    var navigation = [];

                    for (var i = application.navigation.length - 1; i >= 0; i--) {
                        navigation[i] = {
                            name : application.navigation[i].name,
                            type : application.navigation[i].type,
                            link : application.navigation[i].link
                        };
                    };

                    return done(navigation); 
                });
            });
        });
    }

};

module.exports.ApplicationService = ApplicationService;
