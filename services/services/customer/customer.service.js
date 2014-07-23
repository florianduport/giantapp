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
                if (err || !customers)
                {
                    return done(false);
                } 
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
    getCustomerByUsername : function(username, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Customers", function(err, customers){
                if (err || !customers)
                {
                    return done(false);
                } 
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
    * updateCustomer : Modifie les informations de l'utilisateur
    * @param username : le nom d'utilisateur
    * @param data : les données du compte mis à jour
    * @param done : la méthode de retour
    * @return objet contenant les informations de l'utilisateur
    */
    updateCustomer : function(username, data, done){
        try{
            DatabaseHelper.getDatabase(function(db){
                db.collection("Customers", function(err, customers){
                    //password should be sent with sha1 encryption
                    customers.findOne({ username: username}, function(err, user){

                        var updatedUser = user;
                        
                        if(data.password !== undefined)
                            updatedUser.password = sha1(data.password);
                        
                        updatedUser.account.firstName = data.firstName;
                        updatedUser.account.lastName = data.lastName;
                        updatedUser.account.address.invoice = data.invoiceAddress;
                        updatedUser.account.address.shipping = data.shippingAddress;
                        updatedUser.account.phoneNumber = data.phoneNumber !== undefined ? data.phoneNumber : "";
                        
                        customerHelper.save(updatedUser, function(){
                            done(true);
                        });
                    });
                });
            });
        }
        catch(err){
            done(false);
        }
        
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
