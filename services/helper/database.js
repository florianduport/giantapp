var MongoClient = require('mongodb').MongoClient;

function GetDatabase(ToExecute){
        MongoClient.connect("mongodb://giantapp:Answer&&Pigeon2010@94.23.203.174:27017/giantapp", function(err, db) {
            if(err)
            	console.log(err);
            ToExecute(db);
        });
};


module.exports.GetDatabase = GetDatabase;