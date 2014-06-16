var sha1 = require('sha1');
var GetDb = require('./database.helper').GetDatabase;

function signIn(username, password, request, done) {
    GetDb(function(db){
        db.collection("Customers", function(err, customers){
            customers.findOne({ username: username, password: sha1(password) }, function(err, user){
                if (err || !user)
                {
                    request.session.error = true;
                    return done(false);
                }
                
                request.session.error = false;
                request.session.user = user.username; 
                return done(true); 
            });
        });
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