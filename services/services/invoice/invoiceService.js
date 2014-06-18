var GetDb = require('../../helper/database').GetDatabase;

exports.getInvoicesByCustomer = function(username, done){
    GetDb(function(db){
        db.collection("Invoices", function(err, invoicesCollection){
            //password should be sent with sha1 encryption
            invoicesCollection.find({ username: username}).toArray(function(err, invoices){
                if (err || !user)
                {
                    return done(false);
                }
                
                return done(invoices); 
            });
        });
    });
};

exports.getInvoices = function(done){
    GetDb(function(db){
        db.collection("Invoices", function(err, invoicesCollection){
            //password should be sent with sha1 encryption
            invoicesCollection.find({}, {}, {limit : 100}).toArray(function(err, invoices){
                if (err || !user)
                {
                    return done(false);
                }
                
                return done(invoices); 
            });
        });
    });
};