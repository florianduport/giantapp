var DatabaseHelper = require('../../helpers/database.helper').DatabaseHelper;

/**
 * Service Customer
 * @class CustomerService
 */
var CustomerService = {


    /**
    * authenticateCustomer : Vérifie si le couple user / mdp existe en base
    * @param username : le nom d'utilisateur'
    * @param password : le mdp
    * @param done : la méthode de retour
    * @return True : si l'utilisateur existe. Sinon False.
    */
    authenticateCustomer : function(username, password, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Customers", function(err, customers){
                //password should be sent with sha1 encryption
                customers.findOne({ username: username, password: password }, function(err, user){
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
    * getCustomer : Récupère les informations de l'utilisateur
    * @param username : le nom d'utilisateur'
    * @param done : la méthode de retour
    * @return objet contenant les informations de l'utilisateur
    */
    getCustomer : function(username, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Customers", function(err, customers){
                //password should be sent with sha1 encryption
                customers.findOne({ username: username}, function(err, user){
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
    * getCustomer : Récupère les 100 derniers utilisateurs
    * @param done : la méthode de retour
    * @return objet contenant les 100 derniers utilisateurs
    */
    getCustomers : function(done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Customers", function(err, customersCollection){
                //password should be sent with sha1 encryption
                customersCollection.find({}, {}, {limit : 100}).toArray(function(err, customers){
                    if (err || !user)
                    {
                        return done(false);
                    }
                    
                    return done(customers); 
                });
            });
        });   
    }
};

module.exports.CustomerService = CustomerService;
