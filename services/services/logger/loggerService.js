var GetDb = require('../../helper/database').GetDatabase;

exports.getLogs = function(application, done){
	GetDb(function(db){
        db.collection("Logs", function(err, logsCollection){
        	
        	if (err || !logsCollection)
            {
            	//logger une erreur ici
                return done(false);
            }
            logsCollection.find({ application: application}, {}, {limit : 100}).toArray(function(err, items){
                if (err || !items)
                {
                	//logger une erreur ici
                    return done(false);
                }
                return done(items); 
            });
        });
    });
};
exports.logError = function(application, message, params){
    log({application : application, type : "error", message : message, params : params});
};
exports.logMessage = function(application, message, params){
    log({application : application, type : "message", message : message, params : params});
};

function log(log){
    GetDb(function(db){
        db.collection("Logs", function(err, logsCollection){
            if (err || !logsCollection)
            {
                //logger une erreur ici
                return done(false);
            }
            logsCollection.save(log, function(err, inserted){});
        });
    });
};