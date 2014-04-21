var GetDatabase = require('../helper/database').GetDatabase();

exports.initialize = function(req, callback){
    GetDatabase(function(db){
        console.log(db);
    });
    //récupérer toutes les infos du layout / menu
    callback(this);
}