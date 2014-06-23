var DatabaseHelper = require('../../helper/database').DatabaseHelper;

/**
 * Service Customer
 * @class CustomerService
 */
var InvoiceService = {

    /**
    * getInvoicesByCustomer : 
    * @param username : le nom d'utilisateur
    * @param done : la méthode de retour
    * @return La liste des factures par utilisateur
    */
    getInvoicesByCustomer : function(username, done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Invoices", function(err, invoicesCollection){
                invoicesCollection.find({ username: username}).toArray(function(err, invoices){
                    if (err || !invoices)
                    {
                        return done(false);
                    }
                    
                    return done(invoices); 
                });
            });
        });
    },
    
    getInvoices : function(done){
        DatabaseHelper.getDatabase(function(db){
            db.collection("Invoices", function(err, invoicesCollection){
                //password should be sent with sha1 encryption
                invoicesCollection.find({}, {}, {limit : 100}).toArray(function(err, invoices){
                    if (err || !invoices)
                    {
                        return done(false);
                    }
                    
                    return done(invoices); 
                });
            });
        });
    }

};
