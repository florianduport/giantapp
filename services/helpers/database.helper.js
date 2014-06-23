var MongoClient = require('mongodb').MongoClient;

/**
 * Connexion à la BDD
 * @class DatabaseHelper
 */
var DatabaseHelper = {

    getDatabase : function(ToExecute){
        MongoClient.connect("mongodb://giantapp:Answer&&Pigeon2010@94.23.203.174:27017/giantapp", function(err, db) {
            if(err)
            	console.log(err);
            ToExecute(db);
        });
    }

};


module.exports.DatabaseHelper = DatabaseHelper;