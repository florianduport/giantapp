var MongoClient = require('mongodb').MongoClient;
ConfigurationLocalHelper = require('./configuration.local.helper').ConfigurationLocalHelper,
LocalConfig = require(ConfigurationLocalHelper.getLocalConfigFile(module.parent.parent.id)).LocalConfig;

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