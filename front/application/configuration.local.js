/**
 * Surcharge de la configuration en BDD
 * @class LocalConfig 
 */
var LocalConfig = {

	/**
	* Override attributes form db config here
	*/
	//pbligatoire
	database : {
		address : "mongodb://giantapp:Answer&&Pigeon2010@94.23.203.174:27017/giantapp"
	},
	hmacEnabled : false
	
};

module.exports.LocalConfig = LocalConfig;