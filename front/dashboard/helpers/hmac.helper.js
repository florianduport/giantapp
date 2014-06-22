var crypto = require('crypto');
var LogError = require('./logger.helper').LogError;

var GetHmac = function(){
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

module.exports.GetHmac = GetHmac;