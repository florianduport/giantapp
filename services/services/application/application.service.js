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
    * @param username : le nom d'utilisateur'
    * @param password : le mdp
    * @param done : la méthode de retour
    * @return True : si l'utilisateur existe. Sinon False.
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
    }
};

module.exports.ApplicationService = ApplicationService;
