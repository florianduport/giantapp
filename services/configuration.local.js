var localConfig = {

	//override attributes form db config here
	newConfAttribute : 1337
};

var GetLocalConfig = function(done){
	return done(localConfig);
};

module.exports.GetLocalConfig = GetLocalConfig;