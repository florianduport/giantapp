/**
 * Configuration de l'application
 * @class ConfigurationHelper
 */
var ConfigurationLocalHelper = {

    /**
    * getLocalConfigFile
    * @params module id = chemin du ficheir appelant 
    * @return le chemin du fichier configuration.local.js
    */
    getLocalConfigFile : function(moduleId){
        if(moduleId.indexOf("titan") > 0)
            return './../../titan/configuration.local';
        else if(moduleId.indexOf("application") > 0)
            return './../../application/configuration.local';
        else if(moduleId.indexOf("dashboard") > 0)
            return './../../dashboard/configuration.local';
    }

};

module.exports.ConfigurationLocalHelper = ConfigurationLocalHelper;