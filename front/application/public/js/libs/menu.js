$(document).ready(function () {

/* On click menu functions */
function menuOpen() {
   
  var width = $("body > .container-fluid")[0].getBoundingClientRect().width;  
  width = width - $(".show-menu")[0].getBoundingClientRect().width;

  $('#menu').css("transform","translateX(0px)");
  //$('body > .container-fluid').css("left",width+"px");
  $('body > .container-fluid').css("transform","translateX("+width+"px)");;
  $('.navbar-toggle').addClass('hide-menu');
  $('.navbar-toggle').removeClass('show-menu');
  $('body').css("overflow", "hidden");
  if($("#menu")[0].style.cssText.indexOf("translate") == -1)
  {
	$("#menu").show();
  }
};

function menuClose() {

  var width = $("body > .container-fluid")[0].getBoundingClientRect().width;
  width = width - $(".hide-menu")[0].getBoundingClientRect().width;
  $('#menu').css("transform","translateX(-"+width+"px)");
  $('body > .container-fluid').css("left","0px");
  $('body > .container-fluid').css("transform","translateX(0px)");;
  $('.navbar-toggle').addClass('show-menu');
  $('.navbar-toggle').removeClass('hide-menu');  
  if($("#menu")[0].style.cssText.indexOf("translate") == -1)
  {
	$("#menu").hide();
  }
};

$(document).on("click", ".show-menu", function () {
  menuOpen(); // Menu Open function, you can call this function anywhere and will work like magic
});

$(document).on("click", ".hide-menu", function () {
  menuClose(); // Menu close function, you can call this function anywhere and will work like magic
});
});

/* Response js operation */
Response.action(function(){

  var width = $("#menu")[0].getBoundingClientRect().width;

$('#menu').css("transform","translateX(-"+width+"px)");
$('body > .container-fluid').css("left","0px");
$('body > .container-fluid').css("margin-left","0px");
$('body > .container-fluid').css("display","block");

});