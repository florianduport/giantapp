var GetDb = require('../../helper/database').GetDatabase;

exports.getConfig = function(application, done){
	GetDb(function(db){
        db.collection("Configuration", function(err, configurations){
        	
        	if (err || !configurations)
            {
            	//logger une erreur ici
                return done(false);
            }
            configurations.findOne({ application: application}, function(err, applicationConfig){
                if (err || !applicationConfig)
                {
                	//logger une erreur ici
                    return done(false);
                }
                return done(applicationConfig); 
            });
        });
    });

};