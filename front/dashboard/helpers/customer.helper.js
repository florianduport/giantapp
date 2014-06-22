var sha1 = require('sha1');
var GetDb = require('./database.helper').GetDatabase;
var GetService = require('./service.helper').GetService;

function signIn(username, password, req, done) {
    GetService("customer", "authenticateCustomer", {data : {username : username, password : sha1(password)}, method: "POST"}, function(resp){
        if(resp === undefined || !resp || resp !== true)
        {
            req.session.error = true;
            return done(false);
        }
        req.session.error = false;
        req.session.user = username;

        return done(true);
    });
}

function findOneByUsername(params, done) {
    GetDb(function(db){
            db.collection("Customers", function(err, customers){
                customers.findOne({ username: params.username }, function(err, user){
                    if (err || !user)
                    {
                        return done(null);
                    }
                    if(params.property !== undefined)
                        return done(user[params.property]);
                    else
                        return done(user);
                });
            });
    });
}

function save(updatedUser, callback) {
        GetDb(function(db){
            db.collection("Customers", function(err, customers){
                customers.save(updatedUser, callback);
            });
        });
}
  
module.exports.findOneByUsername = findOneByUsername;
module.exports.signIn = signIn;
module.exports.save = save;