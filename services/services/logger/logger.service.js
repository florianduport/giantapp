var DatabaseHelper = require('../../helpers/database.helper').DatabaseHelper;

/**
 * Service Logger
 * @class LoggerService
 */
var LoggerService = {
    
    /**
    * getLogs : Retourne les 100 derniers logs
    * @param application : l'application voulue / vide si toutes les applications
    * @param done : la méthode de retour
    * @return Les 100 derniers logs
    */
    getLogs : function(application, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Logs", function(err, logsCollection){
            	if (err || !logsCollection){
                    return done(false);
                }
                if(application === ""){
                    logsCollection.find({}, {}, {limit : 100}).toArray(function(err, items){
                        if (err || !items){
                            return done(false);
                        }
                        return done(items); 
                    });
                }
                else{
                    logsCollection.find({ application: application}, {}, {limit : 100}).toArray(function(err, items){
                        if (err || !items){
                            return done(false);
                        }
                        return done(items); 
                    });
                }
            });
        });
    },
    
    /**
    * logError : Enregistre un log de type Erreur
    * @param application : l'application voulue / vide si toutes les applications
    * @param message : le message du log
    * @param params : l'objet concerné par le log
    */
    logError : function(application, message, params){
        this._log({application : application, type : "error", message : message, params : params});
    },
    
    /**
    * logMessage : Enregistre un log de type Message
    * @param application : l'application voulue / vide si toutes les applications
    * @param message : le message du log
    * @param params : l'objet concerné par le log
    */
    logMessage : function(application, message, params){
        this._log({application : application, type : "message", message : message, params : params});
    },
    
    /**
    * _log : Enregistre un log
    * @param log : l'objet log à enregistrer
    */
    _log : function(log){
        
        log.date = new Date().getTime();

        DatabaseHelper.getDatabase(function(db){
            db.collection("Logs", function(err, logsCollection){
                if (err || !logsCollection)
                {
                    console.log("Error while logging : DB is probably down");
                }
                logsCollection.insert(log, { w: 0 });
            });
        });
    }

};

module.exports.LoggerService = LoggerService;