(function() {
	tinymce.create('tinymce.plugins.revslider', {
 
		init : function(ed, url) {
		},
		createControl : function(n, cm) {
 
            if(n=='revslider'){
                var mlb = cm.createListBox('revslider', {
                     title : 'revslider',
                     onselect : function(v) {
                     	if(tinyMCE.activeEditor.selection.getContent() == ''){
                            tinyMCE.activeEditor.selection.setContent( v )
                        }
                     }
                });
 
                for(var i in revslider_shortcodes)
                	mlb.add(revslider_shortcodes[i],revslider_shortcodes[i]);
 
                return mlb;
            }
            return null;
        }
 
 
	});
	tinymce.PluginManager.add('revslider', tinymce.plugins.revslider);
})();