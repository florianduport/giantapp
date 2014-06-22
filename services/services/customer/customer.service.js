var GetDb = require('../../helpers/database.helper').GetDatabase;

exports.authenticateCustomer = function(username, password, done){
    GetDb(function(db){
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
};

exports.getCustomer = function(username, done){
    GetDb(function(db){
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
}

exports.getCustomers = function(done){
    GetDb(function(db){
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