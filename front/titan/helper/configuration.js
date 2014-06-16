/*var request = require('request');

exports.getConfiguration = function(done){
	request.get("http://localhost:8083/configuration/titan", function(err, resp, body){
		console.log(body);
		if(err || !body)
			return done(false);
		return done(JSON.parse(body));
	});
};
*/
var GetDb = require('../helper/database').GetDatabase;
exports.getConfig = function(done){
	GetDb(function(db){
		
        db.collection("Configuration", function(err, configurations){
        	
        	if (err || !configurations)
            {
            	//logger une erreur ici
                return done(false);
            }
            configurations.findOne({ application: "titan"}, function(err, applicationConfig){
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