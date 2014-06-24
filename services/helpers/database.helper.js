var MongoClient = require('mongodb').MongoClient,
LocalConfig = require('./../configuration.local').LocalConfig;
/**
 * Connexion à la BDD
 * @class DatabaseHelper
 */
var DatabaseHelper = {

    getDatabase : function(ToExecute){
        MongoClient.connect(LocalConfig.database.address, function(err, db) {
            if(err)
            	console.log(err);
            ToExecute(db);
        });
    }

};


module.exports.DatabaseHelper = DatabaseHelper;