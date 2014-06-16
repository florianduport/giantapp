var MongoClient = require('mongodb').MongoClient;

function GetDatabase(ToExecute){
        MongoClient.connect("mongodb://MonApp:MonApp@94.23.203.174:27017/monapp", function(err, db) {
            if(err)
            	console.log(err);
            ToExecute(db);
        });
};


module.exports.GetDatabase = GetDatabase;