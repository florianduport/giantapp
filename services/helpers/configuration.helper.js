var GetDb = require('./database.helper').GetDatabase;
var GetLocalConfig = require('../configuration.local').GetLocalConfig;
var LogError = require('./logger.helper').LogError;

var GetConfig = function(options){
	
	GetDb(function(db){
        db.collection("Configuration", function(err, configurations){
        	
        	if (err || !configurations)
            {
                LogError("Services", "Configuration collection couldn't be found", options, err);
                GetLocalConfig(function(localConfig){
                    return options.done(localConfig);
                });
            }
            configurations.findOne({ application: options.application}, function(err, applicationConfig){
                if (err || !applicationConfig)
                {
                	LogError("Services", "Application configuration document couldn't be found", options, err);
                    GetLocalConfig(function(localConfig){
                        return options.done(localConfig);
                    });
                }
                
                var configuration = applicationConfig;

                var recursiveObjectMerge = function(parent, object){

                    if(Object.prototype.toString.call(object) === '[object Array]') { 
                        if(Object.prototype.toString.call(parent) !== '[object Array]')
                            parent = [];
                        for (var i = 0; i < object.length; i++) { 
                            parent[i] = recursiveObjectMerge(parent[i], object[i]);
                        }
                    }
                    else if(typeof(object) === "object") {
                        if(typeof(parent) !== "object")
                            parent = {};
                        for(var property in object){
                            parent[property] = recursiveObjectMerge(parent[property], object[property]);
                        }
                    }
                    else {
                        parent = object;
                    }

                    return parent;
                };

                GetLocalConfig(function(localConfig){
                    var configuration = recursiveObjectMerge(applicationConfig, localConfig);

                    if(options.attribute !== undefined){
                        if(configuration[options.attribute] !== undefined)
                            return options.done(configuration[options.attribute]);
                        else
                            return options.done(null);
                    }
                    else
                        return options.done(configuration);
                });
            });
        });
    });

};

module.exports.GetConfig = GetConfig;