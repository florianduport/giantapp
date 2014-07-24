(function($) {
    $(document).ready(function() {
    	console.log("ok");
      	$.slidebars();

      	toggleSidebar();

    });
}) (jQuery);

var toggleSidebar = function(){
	$(".sb-close").length > 0 ? $(".sb-close").addClass("sb-open-left").removeClass("sb-close") : $(".sb-open-left").addClass("sb-close").removeClass("sb-open-left");
};