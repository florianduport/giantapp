var crypto = require('crypto');
var LogError = require('./logger.helper').LogError;
var GetConfig = require('./configuration.helper').GetConfig;

var getHmac = function(){
	var date = new Date();
	var text      = 'giantapp'+date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear()+'giantapp';
	var key       = 'giantapp';
	var algorithm = 'sha1';
	var hmac = "";

	//improve with a better conditionnal hmac 
	//store it in db and check it instead of recaculate here

	hmac = crypto.createHmac(algorithm, key);
	hmac.setEncoding('hex');
	hmac.write(text);
	hmac.end();
	return hmac.read();
};

var VerifyRequest = function(req, res, next){
	var hmac = "";
	if(req.body !== undefined && req.body.hmac !== undefined)
		hmac = req.body.hmac;
	else if(req.params !== undefined && req.params.hmac !== undefined)
		hmac = req.params.hmac;
	else if(req.query !== undefined && req.query.hmac !== undefined)
		hmac = req.query.hmac;
	GetConfig({application : 'services', attribute : "hmacEnabled", done : function(hmacEnabled){
		if((hmac !== "" && hmac === getHmac()) || (hmacEnabled !== null && hmacEnabled === false))
			return next();
		else {
			res.send(404);
		}
	}
	});
	
};

module.exports.VerifyRequest = VerifyRequest;