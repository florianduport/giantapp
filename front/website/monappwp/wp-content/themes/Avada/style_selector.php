<style type="text/css">
.demo_bg{
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index:-1;
	height: 100%;
}
#style_selector{
	background:#fff;
	width:215px;
	position:fixed;
	right:0;
	top:90px;
	z-index:100;
}
#style_selector_container{
	-webkit-box-shadow: 0 2px 9px 2px rgba(0,0,0,0.14);
	-moz-box-shadow: 0 2px 9px 2px rgba(0,0,0,0.14);
	box-shadow: 0 2px 9px 2px rgba(0,0,0,0.14);
	border:1px solid rgba(23,24,26,0.15);
	-webkit-border-top-left-radius: 2px;
	-webkit-border-bottom-left-radius: 2px;
	-moz-border-radius-topleft: 2px;
	-moz-border-radius-bottomleft: 2px;
	border-top-left-radius: 2px;
	border-bottom-left-radius: 2px;
}
.style-main-title{
	color:#000000;
	font-size:15px;
	height:44px;
	line-height:44px;
	text-align:center;
	border-bottom:1px solid rgba(23,24,26,0.15);

	background-image: linear-gradient(top, #FFFFFF 0%, #F7F4F4 100%);
	background-image: -o-linear-gradient(top, #FFFFFF 0%, #F7F4F4 100%);
	background-image: -moz-linear-gradient(top, #FFFFFF 0%, #F7F4F4 100%);
	background-image: -webkit-linear-gradient(top, #FFFFFF 0%, #F7F4F4 100%);
	background-image: -ms-linear-gradient(top, #FFFFFF 0%, #F7F4F4 100%);

	background-image: -webkit-gradient(
		linear,
		left top,
		left bottom,
		color-stop(0, #FFFFFF),
		color-stop(1, #F7F4F4)
	);
}
.box-title{
	font-size:12px;
	height:41px;
	line-height:41px;
	text-align:center;
	border-bottom:1px solid rgba(23,24,26,0.15);
}
.input-box{
	padding:10px;
	padding-left:40px;
	border-bottom:1px solid rgba(23,24,26,0.15);
}
.input-box input[type=text]{
	background:#f7f7f7;
	width:60px;
	border:1px solid rgba(23,24,26,0.15);
	font-size:11px;
	color:#000000;
	padding:3px;
	margin-left:10px;
}
.input-box select{
	background:#f7f7f7;
	width:120px;
	border:1px solid rgba(23,24,26,0.15);
	font-size:11px;
	color:#000000;
	margin-left:5px;
}
#style_selector .style-toggle{
	width:35px;
	height:41px;
	cursor:pointer;
}
#style_selector .close {
    background: #FFFFFF;
    border: 1px solid #DCDDDD;
    -moz-border-radius: 5px 0 0 5px;
    -webkit-border-radius: 5px 0 0 5px;
    border-radius: 5px 0 0 5px;
    left: -36px;
    position: absolute;
    top: 45px;
    width: 35px;
}
#style_selector .close:before {
    color: #333333;
    content: "\f105";
    font-family: fontawesome;
    font-size: 23px;
    font-weight: lighter !important;
    line-height: 41px;
    padding-left: 15px;
}
#style_selector .open{
    background: #FFFFFF;
    border: 1px solid #DCDDDD;
    -moz-border-radius: 5px 0 0 5px;
    -webkit-border-radius: 5px 0 0 5px;
    border-radius: 5px 0 0 5px;
	position:absolute;
	top:45px;
	right:0;
	width:35px;
}
#style_selector .open:before {
    color: #333333;
    content: "\f104";
    font-family: fontawesome;
    font-size: 23px;
    font-weight: lighter !important;
    line-height: 41px;
    padding-left: 15px;
}
#style_selector .images{
	padding-left:25px;
	margin-top:15px;
	border-bottom:1px solid rgba(23,24,26,0.15);
	padding-bottom:10px;
	position:relative;
	z-index:1000000;
}
#style_selector .images img{
	width:25px;
	height:24px;
	margin-right:7px;
	margin-bottom:7px;
	z-index:1000;
}
#style_selector .images img.active{
	border:0px solid #ccc;
	opacity:0.5;
}

#style_selector .images a { background: url(<?php bloginfo('template_directory'); ?>/images/style-selector.png) no-repeat top left; display: inline-block; margin-bottom: 7px; margin-right: 7px;}

#style_selector .images .bkgd1 { background-position: -126px 0; width: 25px; height: 24px; }
#style_selector .images .bkgd2 { background-position: -171px 0; width: 25px; height: 24px; }
#style_selector .images .bkgd3 { background-position: -216px 0; width: 25px; height: 24px; }
#style_selector .images .bkgd4 { background-position: -261px 0; width: 25px; height: 24px; }

#style_selector .images .pattern1 { background-position: -621px 0; width: 25px; height: 24px; }
#style_selector .images .pattern2 { background-position: -718px 0; width: 25px; height: 24px; }
#style_selector .images .pattern3 { background-position: -769px 0; width: 25px; height: 24px; }
#style_selector .images .pattern4 { background-position: -829px 0; width: 25px; height: 24px; }
#style_selector .images .pattern5 { background-position: -879px 0; width: 25px; height: 24px; }
#style_selector .images .pattern6 { background-position: -929px 0; width: 25px; height: 24px; }
#style_selector .images .pattern7 { background-position: -1030px 0; width: 25px; height: 24px; }
#style_selector .images .pattern8 { background-position: -1080px 0; width: 25px; height: 24px; }
#style_selector .images .pattern9 { background-position: -1134px 0; width: 25px; height: 24px; }
#style_selector .images .pattern10 { background-position: -668px 0; width: 25px; height: 24px; }

#style_selector .images .green { background-position: -441px 0; width: 25px; height: 24px; }
#style_selector .images .darkgreen { background-position: -396px 0; width: 25px; height: 24px; }
#style_selector .images .yellow { background-position: -1280px 0; width: 25px; height: 24px; }
#style_selector .images .lightblue { background-position: -486px 0; width: 25px; height: 24px; }
#style_selector .images .lightred { background-position: -576px 0; width: 25px; height: 24px; }
#style_selector .images .pink { background-position: -1190px 0; width: 25px; height: 24px; }
#style_selector .images .lightgrey { background-position: -531px 0; width: 25px; height: 24px; }
#style_selector .images .brown { background-position: -351px 0; width: 25px; height: 24px; }
#style_selector .images .red { background-position: -1235px 0; width: 25px; height: 24px; }
#style_selector .images .blue { background-position: -306px 0; width: 25px; height: 24px; }

</style>
<script type="text/javascript">
boxed_style_selector_change = function(current) {
	if(current == 'Boxed') {
		var html = 'body{background-color:#d7d6d6;background-image:url("http://isharis.dnsalias.com/wp-content/themes/Avada/images/patterns/pattern1.png");background-repeat:repeat;}#wrapper{background:#fff;width:1000px;margin:0 auto;}';
		jQuery('head').append('<style type="text/css" id="ss"></style>');
		jQuery('style#ss').append(html);
	} else {
		jQuery('style#ss').empty();
		jQuery('body').attr('style', '');
	}
};
style_selector_change = function(name) {
	if(name == 'green') {
	    var green = new Array();
	    green['primary_color']='#a0ce4e';
	    green['pricing_box_color']='#92C563';
	    green['image_gradient_top_color']='#D1E990';
	    green['image_gradient_bottom_color']='#AAD75B';
	    green['button_gradient_top_color']='#D1E990';
	    green['button_gradient_bottom_color']='#AAD75B';
	    green['button_gradient_text_color']='#54770f';

	    var color = green;
	}

	if(name == 'darkgreen') {
	    var darkgreen = new Array();
	    darkgreen['primary_color']='#9db668';
	    darkgreen['pricing_box_color']='#a5c462';
	    darkgreen['image_gradient_top_color']='#cce890';
	    darkgreen['image_gradient_bottom_color']='#afd65a';
	    darkgreen['button_gradient_top_color']='#cce890';
	    darkgreen['button_gradient_bottom_color']='#AAD75B';
	    darkgreen['button_gradient_text_color']='#577810';

	    var color = darkgreen;
	}

	if(name == 'yellow') {
	    var orange = new Array();
	    orange['primary_color']='#e9a825';
	    orange['pricing_box_color']='#c4a362';
	    orange['image_gradient_top_color']='#e8cb90';
	    orange['image_gradient_bottom_color']='#d6ad5a';
	    orange['button_gradient_top_color']='#e8cb90';
	    orange['button_gradient_bottom_color']='#d6ad5a';
	    orange['button_gradient_text_color']='#785510';

	    var color = orange;
	}

	if(name == 'lightblue') {
	    var lightblue = new Array();
	    lightblue['primary_color']='#67b7e1';
	    lightblue['pricing_box_color']='#62a2c4';
	    lightblue['image_gradient_top_color']='#90c9e8';
	    lightblue['image_gradient_bottom_color']='#5aabd6';
	    lightblue['button_gradient_top_color']='#90c9e8';
	    lightblue['button_gradient_bottom_color']='#5aabd6';
	    lightblue['button_gradient_text_color']='#105378';

	    var color = lightblue;
	}

	if(name == 'lightred') {
	    var lightred = new Array();
	    lightred['primary_color']='#f05858';
	    lightred['pricing_box_color']='#c46262';
	    lightred['image_gradient_top_color']='#e89090';
	    lightred['image_gradient_bottom_color']='#d65a5a';
	    lightred['button_gradient_top_color']='#e89090';
	    lightred['button_gradient_bottom_color']='#d65a5a';
	    lightred['button_gradient_text_color']='#781010';

	    var color = lightred;
	}

	if(name == 'pink') {
	    var pink = new Array();
	    pink['primary_color']='#e67fb9';
	    pink['pricing_box_color']='#c46299';
	    pink['image_gradient_top_color']='#e890c2';
	    pink['image_gradient_bottom_color']='#d65aa0';
	    pink['button_gradient_top_color']='#e890c2';
	    pink['button_gradient_bottom_color']='#d65aa0';
	    pink['button_gradient_text_color']='#78104b';

	    var color = pink;
	}

	if(name == 'lightgrey') {
	    var lightgrey = new Array();
	    lightgrey['primary_color']='#9e9e9e';
	    lightgrey['pricing_box_color']='#c4c4c4';
	    lightgrey['image_gradient_top_color']='#e8e8e8';
	    lightgrey['image_gradient_bottom_color']='#d6d6d6';
	    lightgrey['button_gradient_top_color']='#e8e8e8';
	    lightgrey['button_gradient_bottom_color']='#d6d6d6';
	    lightgrey['button_gradient_text_color']='#787878';

	    var color = lightgrey;
	}

	if(name == 'brown') {
	    var brown = new Array();
	    brown['primary_color']='#ab8b65';
	    brown['pricing_box_color']='#c49862';
	    brown['image_gradient_top_color']='#e8c090';
	    brown['image_gradient_bottom_color']='#d69e5a';
	    brown['button_gradient_top_color']='#e8c090';
	    brown['button_gradient_bottom_color']='#d69e5a';
	    brown['button_gradient_text_color']='#784910';

	    var color = brown;
	}

	if(name == 'red') {
	    var red = new Array();
	    red['primary_color']='#e10707';
	    red['pricing_box_color']='#c40606';
	    red['image_gradient_top_color']='#e80707';
	    red['image_gradient_bottom_color']='#d60707';
	    red['button_gradient_top_color']='#e80707';
	    red['button_gradient_bottom_color']='#d60707';
	    red['button_gradient_text_color']='#780404';

	    var color = red;
	}

	if(name == 'blue') {
	    var blue = new Array();
	    blue['primary_color']='#1a80b6';
	    blue['pricing_box_color']='#62a2c4';
	    blue['image_gradient_top_color']='#90c9e8';
	    blue['image_gradient_bottom_color']='#5aabd6';
	    blue['button_gradient_top_color']='#90c9e8';
	    blue['button_gradient_bottom_color']='#5aabd6';
	    blue['button_gradient_text_color']='#105378';

	    var color = blue;
	}

	color['counter_filled_color'] = color['primary_color'];
	color['menu_hover_first_color'] = color['primary_color'];

	var colorObject = jQuery.extend({}, color);

	var data = {
		action: 'avada_style_selector',
		color: colorObject
	};

	jQuery.post(
		'<?php echo admin_url("admin-ajax.php") ?>', data, function(response) {
			jQuery('head').append('<style type="text/css" id="color_ss"></style>');
			jQuery('style#color_ss').append(response);
		}
	);

	jQuery('.reading-box').each(function() {
		var borderLeft = jQuery(this).css('border-left-color');
		var borderRight = jQuery(this).css('border-right-color');
		var borderTop = jQuery(this).css('border-top-color');
		var borderBottom = jQuery(this).css('border-bottom-color');

		if(borderLeft == 'rgb(160, 206, 78)') {
			jQuery(this).css('border-left-color', '');
			jQuery(this).css('border-left-color', color['primary_color']+'!important');
		}

		if(borderRight == 'rgb(160, 206, 78)') {
			jQuery(this).css('border-right-color', '');
			jQuery(this).css('border-right-color', color['primary_color']+'!important');
		}

		if(borderTop == 'rgb(160, 206, 78)') {
			jQuery(this).css('border-top-color', '');
			jQuery(this).css('border-top-color', color['primary_color']+'!important');
		}

		if(borderBottom == 'rgb(160, 206, 78)') {
			jQuery(this).css('border-bottom-color', '');
			jQuery(this).css('border-bottom-color', color['primary_color']+'!important');
		}
	});

	jQuery('.progress-bar-content').each(function() {
		var width = jQuery(this).css('width');
		jQuery(this).removeAttr('style');
		jQuery(this).css('background-color', '');
		jQuery(this).css('border-color', '');
		jQuery(this).css('background-color', color['primary_color']+' !important');
		jQuery(this).css('border-color', color['primary_color']+' !important');
		jQuery(this).css('width', width);
	});

	jQuery('.button.large,.button.medium,.button.small').removeClass('green darkgreen orange lightblue lightred pink lightgrey brown red blue').addClass('default');

	if(jQuery('.header-v2').length >= 1) {
		jQuery('.header-social').attr('style', 'background-color: white !important; border-bottom: 1px solid #E1E1E1 !important;')
	} else {
		jQuery('.header-social').attr('style', 'border-bottom: 1px solid #E1E1E1 !important;')
	}
};
pattern_style_selector = function(current, name) {
	if(current == 'Boxed') {
		if(name == 'bkgd1' || name == 'bkgd2' || name == 'bkgd3' || name == 'bkgd4' || name == 'bkgd5') {
			jQuery('body').css('background', 'url(<?php bloginfo("template_directory"); ?>/images/patterns/'+name+'.jpg) no-repeat center center fixed');
			jQuery('body').css('background-size', 'cover');
		} else {
			jQuery('body').css('background', 'url(<?php bloginfo("template_directory"); ?>/images/patterns/'+name+'.png) repeat center center scroll');
			jQuery('body').css('background-size', 'auto');
		}
	} else {
		alert('Select boxed layout');
	}
};
jQuery(document).ready(function() {
	/*!
	 * jQuery Cookie Plugin v1.3.1
	 * https://github.com/carhartl/jquery-cookie
	 *
	 * Copyright 2013 Klaus Hartl
	 * Released under the MIT license
	 */
	(function(d){"function"===typeof define&&define.amd?define(["jquery"],d):d(jQuery)})(function(d){function k(a){return e.raw?a:decodeURIComponent(a.replace(n," "))}function l(a){0===a.indexOf('"')&&(a=a.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));a=k(a);try{return e.json?JSON.parse(a):a}catch(c){}}var n=/\+/g,e=d.cookie=function(a,c,b){if(void 0!==c){b=d.extend({},e.defaults,b);if("number"===typeof b.expires){var f=b.expires,h=b.expires=new Date;h.setDate(h.getDate()+f)}c=e.json?JSON.stringify(c):
	String(c);return document.cookie=[e.raw?a:encodeURIComponent(a),"=",e.raw?c:encodeURIComponent(c),b.expires?"; expires="+b.expires.toUTCString():"",b.path?"; path="+b.path:"",b.domain?"; domain="+b.domain:"",b.secure?"; secure":""].join("")}c=document.cookie.split("; ");b=a?void 0:{};f=0;for(h=c.length;f<h;f++){var g=c[f].split("="),m=k(g.shift()),g=g.join("=");if(a&&a===m){b=l(g);break}a||(b[m]=l(g))}return b};e.defaults={};d.removeCookie=function(a,c){return void 0!==d.cookie(a)?(d.cookie(a,"",
	d.extend({},c,{expires:-1})),!0):!1}});

	jQuery('#style_selector select[name=layout]').change(function() {
		var current = jQuery(this).find('option:selected').val();

		jQuery.removeCookie('boxed_style_selector', {path:'/'});
		jQuery.cookie('boxed_style_selector', current, {path:'/'});

		boxed_style_selector_change(current);
	});

	if(jQuery.cookie('boxed_style_selector')) {
		boxed_style_selector_change(jQuery.cookie('boxed_style_selector'));

		if(jQuery.cookie('boxed_style_selector') == 'Boxed') {
			jQuery('select[name=layout]').val('Boxed');
		}
	}

	jQuery('#style_selector select[name=color_skin]').change(function() {
		var current = jQuery(this).find('option:selected').val();

		if(current == 'Light') {
			window.location = 'http://theme-fusion.com/avada/';
		} else {
			window.location = 'http://theme-fusion.com/avadadark/';
		}

	});

	if(jQuery.cookie('style_selector_status') == 'disabled') {

		jQuery('#style_selector_container').hide();
		jQuery('#style_selector .close').hide();
		jQuery('#style_selector .open').show();

	}

	jQuery('#style_selector .close').click(function(e) {
		e.preventDefault();

		jQuery('#style_selector_container').hide();

		jQuery(this).hide();
		jQuery('#style_selector .open').show();

		jQuery.removeCookie('style_selector_status', {path:'/'});
		jQuery.cookie('style_selector_status', 'disabled', {path:'/'});
	});


	jQuery('#style_selector .open').click(function(e) {
		e.preventDefault();

		jQuery('#style_selector_container').show();

		jQuery(this).hide();
		jQuery('#style_selector .close').show();

		jQuery.removeCookie('style_selector_status', {path:'/'});
		jQuery.cookie('style_selector_status', 'enabled', {path:'/'});
	});

	jQuery('.patterns a').click(function(e) {
		e.preventDefault();

		var current = jQuery('#style_selector select[name=layout]').find('option:selected').val();
		var name = jQuery(this).attr('name');

		jQuery.removeCookie('pattern_style_selector_current', {path:'/'});
		jQuery.cookie('pattern_style_selector_current', current, {path:'/'});

		jQuery.removeCookie('pattern_style_selector_name', {path:'/'});
		jQuery.cookie('pattern_style_selector_name', name, {path:'/'});

		pattern_style_selector(current, name);
	});

	if(jQuery.cookie('pattern_style_selector_current') && jQuery.cookie('pattern_style_selector_name')) {
		pattern_style_selector(jQuery.cookie('pattern_style_selector_current'), jQuery.cookie('pattern_style_selector_name'));
	}

	if(jQuery.cookie('style_selector')) {
		style_selector_change(jQuery.cookie('style_selector'));
	}

	jQuery('.predefined a').click(function(e) {
		e.preventDefault();

		jQuery(this).parent().find('img').removeClass('active');
		jQuery(this).find('img').addClass('active');

		var name = jQuery(this).attr('name');

		jQuery.removeCookie('style_selector', {path:'/'});
		jQuery.cookie('style_selector', name, {path:'/'});

		style_selector_change(name);
	});

	jQuery('.clear_style_selector').click(function(e) {
		e.preventDefault();

		jQuery.removeCookie('style_selector', { path: '/' });
		jQuery.removeCookie('boxed_style_selector', {path:'/'});
		jQuery.removeCookie('pattern_style_selector_current', {path:'/'});
		jQuery.removeCookie('pattern_style_selector_name', {path:'/'});
		jQuery.removeCookie('style_selector_status', {path:'/'});

		document.location.reload(true);
	});
});
</script>
<div id="style_selector">
	<div id="style_selector_container">
	<div class="style-main-title">Style Selector</div>
	<div class="box-title">Choose Your Layout Style</div>
	<div class="input-box">
		<div class="input">
			<select name="layout">
				<option>Wide</option>
				<option>Boxed</option>
			</select>
		</div>
	</div>
	<div class="box-title">Choose Your Color Skin</div>
	<div class="input-box">
		<div class="input">
			<select name="color_skin">
				<option>Light</option>
				<option>Dark</option>
			</select>
		</div>
	</div>
	<div class="box-title">Patterns for Boxed Version</div>
	<div class="images patterns">
		<a href="#" class="pattern1 active" name="pattern1"></a>
		<a href="#" class="pattern2" name="pattern2"></a>
		<a href="#" class="pattern3" name="pattern3"></a>
		<a href="#" class="pattern4" name="pattern4"></a>
		<a href="#" class="pattern5" name="pattern5"></a>
		<a href="#" class="pattern6" name="pattern6"></a>
		<a href="#" class="pattern7" name="pattern7"></a>
		<a href="#" class="pattern8" name="pattern8"></a>
		<a href="#" class="pattern9" name="pattern9"></a>
		<a href="#" class="pattern10" name="pattern10"></a>
	</div>
    <div class="box-title">Images for Boxed Version</div>
	<div class="images patterns">
		<a href="#" class="bkgd bkgd1" name="bkgd1"></a>
		<a href="#" class="bkgd bkgd2" name="bkgd2"></a>
		<a href="#" class="bkgd bkgd3" name="bkgd3"></a>
		<a href="#" class="bkgd bkgd4" name="bkgd4"></a>
	</div>
	<div class="box-title">10 Predefined Color Schemes</div>
	<div class="images predefined">
		<a href="#" class="green" name="green"></a>
		<a href="#" class="darkgreen" name="darkgreen"></a>
		<a href="#" class="yellow" name="yellow"></a>
		<a href="#" class="lightblue" name="lightblue"></a>
		<a href="#" class="lightred" name="lightred"></a>
		<a href="#" class="pink" name="pink"></a>
		<a href="#" class="lightgrey" name="lightgrey"></a>
		<a href="#" class="brown" name="brown"></a>
		<a href="#" class="red" name="red"></a>
		<a href="#" class="blue" name="blue"></a>
		<p style="margin:0;line-height:normal;margin-left:-10px;display:none;"><small>These are just examples and you can build your own color scheme in the backend.</small></p>
	</div>
	<div class="box-title" style="height:25px;line-height:25px;"><a href="#" class="clear_style_selector" style="color:#000 !important;">Clear Styles</a></div>
	</div>
	<div class="style-toggle close"></div>
	<div class="style-toggle open" style="display:none;"></div>
</div>