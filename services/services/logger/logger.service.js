var GetDb = require('../../helpers/database.helper').GetDatabase;

exports.getLogs = function(application, done){
    GetDb(function(db){
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
                console.log("Error while logging : DB is probably down");
            }
            logsCollection.insert(log, { w: 0 });
        });
    });
};