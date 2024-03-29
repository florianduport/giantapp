var model = require('../models/account.model').AccountModel;

/**
* Gestion du compte utilisateur du dashboard
* @class AccountController
*/
var AccountController = {

    /**
    * initialize : Affichage de la page mon compte
    * @param req : requête http
    * @param res : reponse http
    */
    initialize : function(req, res){
        model.initialize(req, function(model){
            model.error = false;
            model.accountUpdated = false;
            res.render('./pages/account', {model: model});
        });
    },

    /**
    * checkSignIn : Vérifie si l'utilisateur est connecté
    * @param req : requête http
    * @param res : reponse http
    * @param next : méthode de callback
    */
    checkSignIn : function(req, res, next){
        if(req.session.user !== undefined)
        {
            next();
        }
        else
        {
            model.displaySignIn(req, function(model){
                res.render('./pages/signIn', {model: model});
            }); 
        }
    },

    /**
    * signIn : Connexion au dashboard
    * @param req : requête http
    * @param res : reponse http
    */
    signIn : function(req, res){
        var done = function(authenticated){
            res.redirect(req.get('referer'));
        };
        model.signIn(req.body.username, req.body.password, req, done);
    },

    /**
    * signOut : Déconnexion au dashboard
    * @param req : requête http
    * @param res : reponse http
    */
    signOut : function(req, res){
        req.session.destroy();
        res.redirect('/');
    }

};

module.exports.AccountController = AccountController;