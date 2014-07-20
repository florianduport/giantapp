var DatabaseHelper = require('../../helpers/database.helper').DatabaseHelper;

/**
 * Service Admin
 * @class AdminService
 */
var AdminService = {

    /**
    * authenticateAdmin : Vérifie si le couple user / mdp existe en base
    * @param username : le nom d'utilisateur
    * @param password : le mdp
    * @param done : la méthode de retour
    * @return True : si l'utilisateur existe. Sinon False.
    */
    authenticateAdmin : function(username, password, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Admins", function(err, admins){
                if (err || !admins)
                {
                    return done(false);
                } 
                //password should be sent with sha1 encryption
                admins.findOne({ username: username, password: password }, function(err, user){
                    if (err || !user)
                    {
                        return done(false);
                    }    
                    return done(true); 
                });
            });
        });
    },
    
    /**
    * getAdmin : Récupère les informations de l'utilisateur
    * @param username : le nom d'utilisateur'
    * @param done : la méthode de retour
    * @return objet contenant les informations de l'utilisateur
    */
    getAdminByUsername : function(username, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Admins", function(err, admins){
                if (err || !admins)
                {
                    return done(false);
                } 
                //password should be sent with sha1 encryption
                admins.findOne({ username: username}, function(err, user){
                    if (err || !user)
                    {
                        return done(false);
                    }
    
                    return done(user.account); 
                });
            });
        });   
    },

    /**
    * exportDatabase : Exporte toute la base de donnée au format JSON
    * @param done : la méthode de retour
    * @return objet contenant toute la bdd giantapp
    */
    exportDatabase : function(done){

        var databaseToExport = {};

        AdminService._getCollection(databaseToExport, "Admins", function(databaseToExport){
            AdminService._getCollection(databaseToExport, "Applications", function(databaseToExport){
                AdminService._getCollection(databaseToExport, "Articles", function(databaseToExport){
                    AdminService._getCollection(databaseToExport, "Configurations", function(databaseToExport){
                        AdminService._getCollection(databaseToExport, "Invoices", function(databaseToExport){
                            AdminService._getCollection(databaseToExport, "Logs", function(databaseToExport){
                                done(databaseToExport);
                            });
                        });
                    });
                });
            });
        });
    },

    _getCollection : function(parent, collectionName, next){
        DatabaseHelper.getDatabase(function(db){
            db.collection(collectionName, function(err, collection){
                collection.find({}).toArray(function(err, documents){
                    parent[collectionName] = documents;
                    next(parent);
                });
            });
        });
    }
};

module.exports.AdminService = AdminService;
