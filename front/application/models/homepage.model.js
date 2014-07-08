var HomepageModel = {

	initialize : function(req, callback){
		this.appId = req.params.appId;
	    callback(this);
	}

};

module.exports.HomepageModel = HomepageModel;