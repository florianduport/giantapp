var GetDb = require('./database.helper').GetDatabase;

var GetConfig = function(options){
	
	GetDb(function(db){
        db.collection("Configuration", function(err, configurations){
        	
        	if (err || !configurations)
            {
            	//logger une erreur ici
                return done(false);
            }
            configurations.findOne({ application: options.application}, function(err, applicationConfig){
                if (err || !applicationConfig)
                {
                	//logger une erreur ici
                    return done(false);
                }
                if(options.attribute === undefined)
                	return options.done(applicationConfig);
                else
                	return options.done(applicationConfig[options.attribute]); 
            });
        });
    });

};

module.exports.GetConfig = GetConfig;