(function($){
  var Menu = Backbone.Model.extend({
    defaults: {
      elements: [
		{
			name : "accueil",
			link : ""
		},
		{
			name : "fiches conseil",
			link : ""
		}
	  ]
    }
  });
  
  var List = Backbone.Collection.extend({
    model: Menu
  });

  var ListView = Backbone.View.extend({
    //type d'élément html posé par backbooooner
	el: $('body'),
    events: {
      'click button#showMenu': 'showMenu'
    },
	
	initialize: function(){
      _.bindAll(this, 'render', 'showMenu'); // remember: every function that uses 'this' as the current object should be in here

      this.render();
    },
	
    render: function(){
	  //first state render
	  
	  var self = this;
      //$(this.el).prepend("<button id='showMenu'>Show Menu</button>");
     
    },
	
	showMenu: function(){      
	  //test function
	  //alert('Bonjour Mariiiiie !!');
    }
  });
  
  //Let's View !
  var listView = new ListView();
})(jQuery);