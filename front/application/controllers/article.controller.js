var model = require('../models/article.model').ArticleModel;

var ArticleController = {

	initialize : function(req, res){
	    model.initialize(req, function(model){
	    	if(!model)
	    		res.redirect(301, '/'+req.params.appId+'/error');
	    	else
	        	res.render(model.type+'/pages/articles', {model: model});
	    });
	},

	initializeArticle : function(req, res){
		model.initializeArticle(req, function(model){
	    	if(!model)
	    		res.redirect(301, '/'+req.params.appId+'/error');
	    	else
	        	res.render(model.type+"/pages/article", {model: model});
	    });
	}

};

module.exports.ArticleController = ArticleController;

