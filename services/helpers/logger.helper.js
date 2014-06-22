var GetDb = require('./database.helper').GetDatabase;

function LogError(application, message, params, errorObject){
    var log = {application : application, type : "error", message : message, params : params, errorObject : errorObject}
    GetDb(function(db){
        db.collection("Logs", function(err, logsCollection){
            if (err || !logsCollection)
            {
                console.log("Error while logging : DB is probably down");
            }
            logsCollection.insert(log, { w: 0 });
        });
    });
}
module.exports.LogError = LogError;