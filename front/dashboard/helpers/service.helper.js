var GetDb = require('./database.helper').GetDatabase;
var GetConfig = require('./configuration.helper').GetConfig;
var GetHmac = require('./hmac.helper').GetHmac;
var LogError = require('./logger.helper').LogError;
var Request = require('request');

function GetService(serviceName, method, options, done){
     GetConfig({application : "services", done : function(config){
     	if(config["routes"][serviceName] !== undefined && config["routes"][serviceName][method] !== undefined){
               
               if(config.hmacEnabled)
                    options.data.hmac = GetHmac();

               Request({
                    uri : config.addressBasePath+":"+config.port+config["routes"][serviceName][method],
                    method : options.method !== undefined ? options.method : "POST",
                    headers: {
                         "Content-Type": "application/json"
                    },
                    timeout : 5000,
                    json : options.data !== undefined ? options.data : {}
               }, function(error, response, body){
                    console.log(error);
                    if(!error)
                         done(body);
                    else {
                         LogError("dashboard", "error on service call", options.data !== undefined ? options.data : {});
                    } 
               });
               
     	}

     }});
};

module.exports.GetService = GetService;