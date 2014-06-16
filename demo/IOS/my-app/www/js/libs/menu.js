$(document).ready(function () {

/* On click menu functions */
function menuOpen() {
   
  var width = $("#menu")[0].getBoundingClientRect().width;  
  $('#menu').css("transform","translateX(0px)");
  $('#wrapper').css("left",width+"px");
  $('#header').css("left",width+"px");
  $('.menu-icon').addClass('hide-menu');
  $('.menu-icon').removeClass('show-menu');
  $('body').css("overflow", "hidden");
  if($("#menu")[0].style.cssText.indexOf("translate") == -1)
  {
	$("#menu").show();
  }
};

function menuClose() {

  var width = $("#menu")[0].getBoundingClientRect().width;
  $('#menu').css("transform","translateX(-"+width+"px)");
  $('#wrapper').css("left","0px");
  $('#header').css("left","0px");
  $('.menu-icon').addClass('show-menu');
  $('.menu-icon').removeClass('hide-menu');  
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
$('#header').css("left","0px");
$('#wrapper').css("margin-left","0px");
$('#header').css("display","block");

});