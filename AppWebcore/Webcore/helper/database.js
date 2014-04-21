var MongoClient = require('mongodb').MongoClient;

function GetDatabase(){
    return function(ToExecute){
        MongoClient.connect("mongodb://MonApp:MonApp@94.23.203.174:27017/monapp", function(err, db) {
            console.log(err);
            ToExecute(db);
        }); 
    }
};

module.exports.GetDatabase = GetDatabase;