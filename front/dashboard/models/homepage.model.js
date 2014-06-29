var base = require('./base.model').Base,
ServiceHelper = require('./../helpers/service.helper').ServiceHelper;

var HomepageModel = {

    initialize : function(req, callback){
		base.common.call(HomepageModel, req);

		ServiceHelper.getService("customer", "getCustomerByUsername", {data: {username: req.session.user}}, function(user){
            HomepageModel.account = user;
            callback(HomepageModel);
        });

    }
};

module.exports.HomepageModel = HomepageModel;