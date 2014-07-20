<!DOCTYPE html>
<html xmlns="http<?php echo (is_ssl())? 's' : ''; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>
	<?php
	if ( defined('WPSEO_VERSION') ) {
		wp_title('');
	} else {
		bloginfo('name'); ?> <?php wp_title(' - ', true, 'left');
	}
	?>
	</title>

	<?php global $smof_data, $woocommerce; ?>

	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
	<![endif]-->

	<?php
	if(is_page('header-2')) {
		$smof_data['header_right_content'] = 'Social Links';
		if($smof_data['scheme_type'] == 'Dark') {
			$smof_data['header_top_bg_color'] = '#29292a';
			$smof_data['header_icons_color'] = 'Light';
			$smof_data['snav_color'] = '#ffffff';
			$smof_data['header_top_first_border_color'] = '#3e3e3e';
		} else {
			$smof_data['header_top_bg_color'] = '#ffffff';
			$smof_data['header_icons_color'] = 'Dark';
			$smof_data['snav_color'] = '#747474';
			$smof_data['header_top_first_border_color'] = '#efefef';
		}
	} elseif(is_page('header-3')) {
		$smof_data['header_right_content'] = 'Social Links';
	} elseif(is_page('header-4')) {
		$smof_data['header_left_content'] = 'Social Links';
		$smof_data['header_right_content'] = 'Navigation';
	} elseif(is_page('header-5')) {
		$smof_data['header_right_content'] = 'Social Links';
	}
	?>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<?php if($smof_data['favicon']): ?>
	<link rel="shortcut icon" href="<?php echo $smof_data['favicon']; ?>" type="image/x-icon" />
	<?php endif; ?>

	<?php if($smof_data['iphone_icon']): ?>
	<!-- For iPhone -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $smof_data['iphone_icon']; ?>">
	<?php endif; ?>

	<?php if($smof_data['iphone_icon_retina']): ?>
	<!-- For iPhone 4 Retina display -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $smof_data['iphone_icon_retina']; ?>">
	<?php endif; ?>

	<?php if($smof_data['ipad_icon']): ?>
	<!-- For iPad -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $smof_data['ipad_icon']; ?>">
	<?php endif; ?>

	<?php if($smof_data['ipad_icon_retina']): ?>
	<!-- For iPad Retina display -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $smof_data['ipad_icon_retina']; ?>">
	<?php endif; ?>

	<?php wp_head(); ?>

	<?php
	$object_id = get_queried_object_id();
	if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
	    (get_option('page_for_posts') && is_archive() && !is_post_type_archive()) && !(is_tax('product_cat') || is_tax('product_tag')) || (get_option('page_for_posts') && is_search())) {
		$c_pageID = get_option('page_for_posts');
	} else {
		if(isset($object_id)) {
			$c_pageID = $object_id;
		}

		if(class_exists('Woocommerce')) {
			if(is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
				$c_pageID = get_option('woocommerce_shop_page_id');
			}
		}
	}
	?>

	<!--[if lte IE 8]>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	var imgs, i, w;
	var imgs = document.getElementsByTagName( 'img' );
	for( i = 0; i < imgs.length; i++ ) {
	    w = imgs[i].getAttribute( 'width' );
	    imgs[i].removeAttribute( 'width' );
	    imgs[i].removeAttribute( 'height' );
	}
	});
	</script>
	
	<script src="<?php echo get_template_directory_uri(); ?>/js/excanvas.js"></script>
	
	<![endif]-->
	
	<!--[if lte IE 9]>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	
	// Combine inline styles for body tag
	jQuery('body').each( function() {	
		var combined_styles = '<style>';

		jQuery( this ).find( 'style' ).each( function() {
			combined_styles += jQuery(this).html();
			jQuery(this).remove();
		});

		combined_styles += '</style>';

		jQuery( this ).prepend( combined_styles );
	});
	});
	</script>
	<![endif]-->
	
	<script type="text/javascript">
	/*@cc_on
		@if (@_jscript_version == 10)
	    	document.write('<style type="text/css">.search input,#searchform input {padding-left:10px;} .avada-select-parent .avada-select-arrow,.select-arrow{height:33px;<?php if($smof_data['form_bg_color']): ?>background-color:<?php echo $smof_data['form_bg_color']; ?>;<?php endif; ?>}.search input{padding-left:5px;}header .tagline{margin-top:3px;}.star-rating span:before {letter-spacing: 0;}.avada-select-parent .avada-select-arrow,.gravity-select-parent .select-arrow,.wpcf7-select-parent .select-arrow,.select-arrow{background: #fff;}.star-rating{width: 5.2em;}.star-rating span:before {letter-spacing: 0.1em;}</style>');
		@end
	@*/

	var doc = document.documentElement;
	doc.setAttribute('data-useragent', navigator.userAgent);
	</script>

	<style type="text/css">
	<?php	
	$theme_info = wp_get_theme();
	if ($theme_info->parent_theme) {
		$template_dir =  basename(get_template_directory());
		$theme_info = wp_get_theme($template_dir);
	}
	?>
	<?php echo $theme_info->get( 'Name' ) . "_" . $theme_info->get( 'Version' ); ?>{color:green;}
	
	<?php if( $smof_data['layout'] == 'Wide' && $smof_data['content_bg_color'] ): ?>
	html, body { background-color:<?php echo $smof_data['content_bg_color']; ?>; }
	<?php endif; ?>
	
	<?php if( $smof_data['layout'] == 'Boxed' && $smof_data['bg_color'] ): ?>
	html, body { background-color:<?php echo $smof_data['bg_color']; ?>; }
	<?php endif; ?>

	<?php
	//IE11
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false):
	?>
	.avada-select-parent .avada-select-arrow,.select-arrow, 
	.wpcf7-select-parent .select-arrow{height:33px;line-height:33px;}
	.gravity-select-parent .select-arrow{height:24px;line-height:24px;}
	
	#wrapper .gf_browser_ie.gform_wrapper .button,
	#wrapper .gf_browser_ie.gform_wrapper .gform_footer input.button{ padding: 0 20px; }
	<?php endif; ?>

	/*IE11 hack */
	@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
		.avada-select-parent .avada-select-arrow,.select-arrow, 
		.wpcf7-select-parent .select-arrow{height:33px;line-height:33px;}
		.gravity-select-parent .select-arrow{height:24px;line-height:24px;}
		
		#wrapper .gf_browser_ie.gform_wrapper .button,
		#wrapper .gf_browser_ie.gform_wrapper .gform_footer input.button{ padding: 0 20px; }
	}

	<?php
	ob_start();
	include_once get_template_directory() . '/framework/dynamic_css.php';
	$dynamic_css = ob_get_contents();
	ob_get_clean();

	if( is_page('header-2') || is_page('header-3') || is_page('header-4') || is_page('header-5') ) {
		$header_demo = true;
	} else {
		$header_demo = false;
	}

	echo $dynamic_css;
	?>
	<?php if($smof_data['layout'] == 'Boxed'): ?>
	html, body {
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>
	}
	body{
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php elseif($smof_data['bg_image']): ?>
		background-image:url(<?php echo $smof_data['bg_image']; ?>);
		background-repeat:<?php echo $smof_data['bg_repeat']; ?>;
			<?php if($smof_data['bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if($smof_data['bg_pattern_option'] && $smof_data['bg_pattern'] && !(get_post_meta($c_pageID, 'pyre_page_bg_color', true) || get_post_meta($c_pageID, 'pyre_page_bg', true))): ?>
		background-image:url("<?php echo get_bloginfo('template_directory') . '/images/patterns/' . $smof_data['bg_pattern'] . '.png'; ?>");
		background-repeat:repeat;
		<?php endif; ?>
	}
	#wrapper{
		width:1000px;
		margin:0 auto;
	}
	.wrapper_blank { display: block; }
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>

	<?php if($smof_data['layout'] == 'Wide'): ?>
	#wrapper{
		width:100%;
	}
	//.wrapper_blank { display: block; }
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'boxed'): ?>
	html, body {
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>
	}
	body{
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php elseif($smof_data['bg_image']): ?>
		background-image:url(<?php echo $smof_data['bg_image']; ?>);
		background-repeat:<?php echo $smof_data['bg_repeat']; ?>;
			<?php if($smof_data['bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if($smof_data['bg_pattern_option'] && $smof_data['bg_pattern'] && !(get_post_meta($c_pageID, 'pyre_page_bg_color', true) || get_post_meta($c_pageID, 'pyre_page_bg', true))): ?>
		background-image:url("<?php echo get_bloginfo('template_directory') . '/images/patterns/' . $smof_data['bg_pattern'] . '.png'; ?>");
		background-repeat:repeat;
		<?php endif; ?>
	}
	#wrapper{
		width:1000px;
		margin:0 auto;
	}
	.wrapper_blank { display: block; }
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'wide'): ?>
	#wrapper{
		width:100%;
	}
	//.wrapper_blank { display: block; }
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true)): ?>
	.page-title-container{
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true); ?>);
	}
	<?php elseif($smof_data['page_title_bg']): ?>
	.page-title-container{
		background-image:url(<?php echo $smof_data['page_title_bg']; ?>);
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true)): ?>
	.page-title-container{
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true); ?>;
	}
	<?php elseif($smof_data['page_title_bg_color']): ?>
	.page-title-container{
		background-color:<?php echo $smof_data['page_title_bg_color']; ?>;
	}
	<?php endif; ?>

	#header{
		<?php if($smof_data['header_bg_image']): ?>
		background-image:url(<?php echo $smof_data['header_bg_image']; ?>);
		<?php if($smof_data['header_bg_repeat'] == 'repeat-y' || $smof_data['header_bg_repeat'] == 'no-repeat'): ?>
		background-position: center center;
		<?php endif; ?>
		background-repeat:<?php echo $smof_data['header_bg_repeat']; ?>;
			<?php if($smof_data['header_bg_full']): ?>
			background-attachment:scroll;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>

		<?php if($smof_data['header_bg_parallax'] && ! ($smof_data['header_layout'] == 'v1' && $smof_data['headerv1_sticky_header'] == 'modern' )) : ?>
		background-attachment: fixed;
		background-position:top center;
		<?php endif; ?>
		<?php endif; ?>
	}

	#header{
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_header_bg_color', true); ?>;
		<?php endif; ?>
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_header_bg', true); ?>);
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg_repeat', true) == 'repeat-y' || get_post_meta($c_pageID, 'pyre_header_bg_repeat', true) == 'no-repeat'): ?>
		background-position: center center;
		<?php endif; ?>
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_header_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_header_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
	}

	<?php $main_bg_image = false; ?>

	#main{
		<?php if($smof_data['content_bg_image'] && !get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): $main_bg_image = true; ?>
		background-image:url(<?php echo $smof_data['content_bg_image']; ?>);
		background-repeat:<?php echo $smof_data['content_bg_repeat']; ?>;
			<?php if($smof_data['content_bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if($smof_data['main_top_padding'] && !get_post_meta($c_pageID, 'pyre_main_top_padding', true)): ?>
		padding-top: <?php echo $smof_data['main_top_padding']; ?>;
		<?php endif; ?>

		<?php if($smof_data['main_bottom_padding'] && !get_post_meta($c_pageID, 'pyre_main_bottom_padding', true)): ?>
		padding-bottom: <?php echo $smof_data['main_bottom_padding']; ?>;
		<?php endif; ?>
	}

	<?php if(get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'wide' && get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): ?>
	html, body, #wrapper {
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true); ?>;
	}
	<?php endif; ?>

	#main{
		<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true); ?>;
		<?php endif; ?>
		<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg', true)): $main_bg_image = true; ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_main_top_padding', true)): ?>
		padding-top:<?php echo get_post_meta($c_pageID, 'pyre_main_top_padding', true); ?>;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_main_bottom_padding', true)): ?>
		padding-bottom:<?php echo get_post_meta($c_pageID, 'pyre_main_bottom_padding', true); ?>;
		<?php endif; ?>

	}

	<?php if($main_bg_image): ?>
	#main #sidebar { background-color: transparent !important; }
	<?php endif; ?>

	.page-title-container{
		<?php if($smof_data['page_title_bg_full']): ?>
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_full', true) == 'yes'): ?>
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		<?php elseif(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_full', true) == 'no'): ?>
		-webkit-background-size: auto;
		-moz-background-size: auto;
		-o-background-size: auto;
		background-size: auto;
		<?php endif; ?>

		<?php if($smof_data['page_title_bg_parallax']): ?>
		background-attachment: fixed;
		background-position:top center;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_title_bg_parallax', true) == 'yes'): ?>
		background-attachment: fixed;
		background-position:top center;
		<?php elseif(get_post_meta($c_pageID, 'pyre_page_title_bg_parallax', true) == 'no'): ?>
		background-attachment: scroll;
		<?php endif; ?>

	}

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_height', true)): ?>
	.page-title-container{
		height:<?php echo get_post_meta($c_pageID, 'pyre_page_title_height', true); ?>;
	}
	<?php elseif($smof_data['page_title_height']): ?>
	.page-title-container{
		height:<?php echo $smof_data['page_title_height']; ?>;
	}
	<?php endif; ?>

	<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_width', true)): ?>
	<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) != 'auto'): ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow {max-width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?>;}
	<?php else: ?>
	.post-slideshow .flex-control-nav{position:relative;text-align:left;margin-top:10px;}
	<?php endif; ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow img{max-width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?>;}
		<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) == 'auto'): ?>
		#post-<?php echo $c_pageID; ?> .post-slideshow img{width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?>;}
		<?php endif; ?>
	<?php endif; ?>

	<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_height', true)): ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow, #post-<?php echo $c_pageID; ?> .post-slideshow img{max-height:<?php echo get_post_meta($c_pageID, 'pyre_fimg_height', true); ?>;}
	#post-<?php echo $c_pageID; ?> .post-slideshow .slides { max-height: 100%; }
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true)): ?>
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
		.page-title-container {
			background-image: url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true); ?>);
			-webkit-background-size:cover;
			   -moz-background-size:cover;
			     -o-background-size:cover;
			        background-size:cover;
		}
	}
	<?php elseif($smof_data['page_title_bg_retina']): ?>
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
		.page-title-container {
			background-image: url(<?php echo $smof_data['page_title_bg_retina']; ?>);
			-webkit-background-size:cover;
			   -moz-background-size:cover;
			     -o-background-size:cover;
			        background-size:cover;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_hundredp_padding', true)): ?>
	.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
		margin-left: -<?php echo get_post_meta($c_pageID, 'pyre_hundredp_padding', true); ?>; margin-right: -<?php echo get_post_meta($c_pageID, 'pyre_hundredp_padding', true); ?>;
	}
	<?php elseif($smof_data['hundredp_padding']): ?>
	.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
		margin-left: -<?php echo $smof_data['hundredp_padding'] ?>; margin-right: -<?php echo $smof_data['hundredp_padding'] ?>;
	}
	<?php endif; ?>

	<?php if((float) $wp_version < 3.8): ?>
	#wpadminbar *{color:#ccc;}
	#wpadminbar .hover a, #wpadminbar .hover a span{color:#464646;}
	<?php endif; ?>
	<?php echo $smof_data['custom_css']; ?>

	<?php if( ( ($smof_data['header_transparent'] && get_post_meta($object_id, 'pyre_transparent_header', true) != 'no') ||
			  ( ! $smof_data['header_transparent'] && get_post_meta($object_id, 'pyre_transparent_header', true) == 'yes') ) && ! is_search() ): ?>
		@media only screen and (min-width: 800px){
			#header,#small-nav,.header-v4 #small-nav, .header-v5 #small-nav{background:none;}
			.header-social, #header, .header-v4 #small-nav, .header-v5 #small-nav,.header-v5 #header{border:none;}
			.header-wrapper,.header-filler{position: absolute;left:0;right:0;z-index: 10000;}
			.header-filler{z-index: 1;}
			
			.nav-holder#nav .navigation > li > a{background:rgba(255,255,255,0);}
		}
	<?php endif; ?>

	.woocommerce-invalid:after { content: '<?php echo __('Please enter correct details for this required field.', 'Avada'); ?>'; display: inline-block; margin-top: 7px; color: red; }

	<?php if(get_post_meta($c_pageID, 'pyre_fallback', true)): ?>
	@media only screen and (max-width: 940px){
		#sliders-container{display:none;}
		#fallback-slide{display:block;}
	}
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait){
		#sliders-container{display:none;}
		#fallback-slide{display:block;}
	}
	<?php endif; ?>

	<?php if(is_page_template('contact.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	.avada-google-map{
		width:<?php echo $smof_data['gmap_width']; ?>;
		margin:0 auto;
		<?php if($smof_data['gmap_width'] != '100%'): ?>
		<?php if($smof_data['gmap_topmargin']): ?>
		margin-top:<?php echo $smof_data['gmap_topmargin']; ?>;
		<?php else: ?>
		margin-top:55px;
		<?php endif; ?>
		<?php endif; ?>

		<?php if($smof_data['gmap_height']): ?>
		height:<?php echo $smof_data['gmap_height']; ?>;
		<?php else: ?>
		height:415px;
		<?php endif; ?>
	}
	<?php endif; ?>

	<?php if(is_page_template('contact-2.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	.avada-google-map{
		margin:0 auto;
		margin-top:55px;
		height:415px !important;
		width:940px !important;		
	}
	<?php endif; ?>
	</style>

	<?php if($smof_data['google_body'] && $smof_data['google_body'] != 'Select Font'): ?>
	<?php $gfont[urlencode($smof_data['google_body'])] = '"' . urlencode($smof_data['google_body']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if($smof_data['google_nav'] && $smof_data['google_nav'] != 'Select Font' && $smof_data['google_nav'] != $smof_data['google_body']): ?>
	<?php $gfont[urlencode($smof_data['google_nav'])] = '"' . urlencode($smof_data['google_nav']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if($smof_data['google_headings'] && $smof_data['google_headings'] != 'Select Font' && $smof_data['google_headings'] != $smof_data['google_body'] && $smof_data['google_headings'] != $smof_data['google_nav']): ?>
	<?php $gfont[urlencode($smof_data['google_headings'])] = '"' . urlencode($smof_data['google_headings']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if($smof_data['google_footer_headings'] && $smof_data['google_footer_headings'] != 'Select Font' && $smof_data['google_footer_headings'] != $smof_data['google_body'] && $smof_data['google_footer_headings'] != $smof_data['google_nav'] && $smof_data['google_footer_headings'] != $smof_data['google_headings']): ?>
	<?php $gfont[urlencode($smof_data['google_footer_headings'])] = '"' . urlencode($smof_data['google_footer_headings']) . ':400,400italic,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"'; ?>
	<?php endif; ?>

	<?php if(isset( $gfont ) && $gfont): ?>
	<?php
	if(is_array($gfont) && !empty($gfont)) {
		$gfonts = implode($gfont, ', ');
	}
	?>
	<?php endif; ?>
	<script type="text/javascript">
	WebFontConfig = {
		<?php if(!empty($gfonts)): ?>google: { families: [ <?php echo $gfonts; ?> ] },<?php endif; ?>
		<?php if( ! $smof_data['status_fontawesome'] ): ?>custom: { families: ['FontAwesome'],
				  urls: 	['<?php bloginfo('template_directory'); ?>/fonts/fontawesome/font-awesome.css']
				}<?php endif; ?>
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})();
	</script>
	
	<?php echo $smof_data['google_analytics']; ?>

	<?php echo $smof_data['space_head']; ?>
</head>
<?php
$body_classes = array();
$wrapper_class = '';
if( is_page_template('blank.php') ) {
	$body_classes[] = 'body_blank';
	$wrapper_class = 'wrapper_blank';
}
if( ! $smof_data['header_sticky_tablet'] ) {
	$body_classes[] = 'no-tablet-sticky-header';
}
if( ! $smof_data['header_sticky_mobile'] ) {
	$body_classes[] = 'no-mobile-sticky-header';
}
if( $smof_data['mobile_slidingbar_widgets'] ) {
	$body_classes[] = 'no-mobile-slidingbar';
}
if( $smof_data['status_totop'] ) {
	$body_classes[] = 'no-totop';
}
if( ! $smof_data['status_totop_mobile'] ) {
	$body_classes[] = 'no-mobile-totop';
}
if( $smof_data['layout'] == 'Boxed' || get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'boxed' ) {
	$body_classes[] = 'layout-boxed-mode';
}
?>
<body <?php body_class( $body_classes ); ?> data-spy="scroll">
	<div id="wrapper" class="<?php echo $wrapper_class; ?>">
	<?php if( $smof_data['slidingbar_widgets'] && ! is_page_template( 'blank.php' ) ): ?>
	<?php get_template_part( 'slidingbar' ); ?>
	<?php endif; ?>
	<?php
	get_template_part( 'framework/templates/header' );
	avada_header_template( 'Below' );
	?>
	<div id="sliders-container">
	<?php
	if( is_search() ) {
		$slider_page_id = '';
	}
	if( ! is_search() ) {
		// Layer Slider
		$slider_page_id = '';
		if ( ! is_home() && ! is_front_page() && ! is_archive() && isset( $object_id ) ) {
			$slider_page_id = $object_id;
		}
		if ( ! is_home() && is_front_page() && isset( $object_id ) ) {
			$slider_page_id = $object_id;
		}
		if ( is_home() && ! is_front_page() ) {
			$slider_page_id = get_option( 'page_for_posts' );
		}
		if ( class_exists( 'Woocommerce' ) ) {
			if ( is_shop() ) {
				$slider_page_id = get_option( 'woocommerce_shop_page_id' );
			}
		}
		avada_slider( $slider_page_id );
	}
	?>
	</div>
	<?php if(get_post_meta($slider_page_id, 'pyre_fallback', true)): ?>
		<div id="fallback-slide">
			<img src="<?php echo get_post_meta($slider_page_id, 'pyre_fallback', true); ?>" alt="" />
		</div>
	<?php endif; ?>
	<?php
	avada_header_template( 'Above' );
	avada_current_page_title_bar( $c_pageID );
	?>
	<?php if(is_page_template('contact.php') && $smof_data['recaptcha_public'] && $smof_data['recaptcha_private']): ?>
	<script type="text/javascript">
	 var RecaptchaOptions = {
	    theme : '<?php echo $smof_data['recaptcha_color_scheme']; ?>'
	 };
 	</script>
 	<?php endif; ?>
	<?php if(is_page_template('contact.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	<?php
	if( ! $smof_data['map_popup'] ) {
		$map_popup = 'yes';
	} else {
		$map_popup = 'no';
	}
	if( ! $smof_data['map_scrollwheel'] ) {
		$map_scrollwheel = 'yes';
	} else {
		$map_scrollwheel = 'no';
	}
	if( ! $smof_data['map_scale'] ) {
		$map_scale = 'yes';
	} else {
		$map_scale = 'no';
	}
	if( ! $smof_data['map_zoomcontrol'] ) {
		$map_zoomcontrol = 'yes';
	} else {
		$map_zoomcontrol = 'no';
	}
	if( ! $smof_data['map_pin'] ) {
		$address_pin = 'yes';
	} else {
		$address_pin = 'no';
	}
	echo do_shortcode('[avada_map address="' . $smof_data['gmap_address'] . '" type="' . $smof_data['gmap_type'] . '" address_pin="' . $address_pin . '" map_style="' . $smof_data['map_styling'] . '" overlay_color="' . $smof_data['map_overlay_color'] . '" infobox="' . $smof_data['map_infobox_styling'] . '" infobox_background_color="' . $smof_data['map_infobox_bg_color'] . '" infobox_text_color="' . $smof_data['map_infobox_text_color'] . '" infobox_content="' . $smof_data['map_infobox_content'] . '" icon="' . $smof_data['map_custom_marker_icon'] . '" width="' . $smof_data['gmap_width'] . '" height="' . $smof_data['gmap_height'] . '" zoom="' . $smof_data['map_zoom_level'] . '" scrollwheel="' . $map_scrollwheel . '" scale="' . $map_scale . '" zoom_pancontrol="' . $map_zoomcontrol . '" popup="' . $map_popup . '"][/avada_map]');
	?>
	<?php endif; ?>
	<?php if(is_page_template('contact-2.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	<?php
	if( $smof_data['map_popup'] ) {
		$map_popup = 'yes';
	} else {
		$map_popup = 'no';
	}
	if( ! $smof_data['map_scrollwheel'] ) {
		$map_scrollwheel = 'yes';
	} else {
		$map_scrollwheel = 'no';
	}
	if( ! $smof_data['map_scale'] ) {
		$map_scale = 'yes';
	} else {
		$map_scale = 'no';
	}
	if( ! $smof_data['map_zoomcontrol'] ) {
		$map_zoomcontrol = 'yes';
	} else {
		$map_zoomcontrol = 'no';
	}
	echo do_shortcode('[avada_map address="' . $smof_data['gmap_address'] . '" type="' . $smof_data['gmap_type'] . '" map_style="' . $smof_data['map_styling'] . '" overlay_color="' . $smof_data['map_overlay_color'] . '" infobox="' . $smof_data['map_infobox_styling'] . '" infobox_background_color="' . $smof_data['map_infobox_bg_color'] . '" infobox_text_color="' . $smof_data['map_infobox_text_color'] . '" infobox_content="' . $smof_data['map_infobox_content'] . '" icon="' . $smof_data['map_custom_marker_icon'] . '" width="' . $smof_data['gmap_width'] . '" height="' . $smof_data['gmap_height'] . '" zoom="' . $smof_data['map_zoom_level'] . '" scrollwheel="' . $map_scrollwheel . '" scale="' . $map_scale . '" zoom_pancontrol="' . $map_zoomcontrol . '" popup="' . $map_popup . '"][/avada_map]');
	?>
	<?php endif; ?>
	<?php
	$main_css = '';
	$row_css = '';
	$main_class = '';
	$page_template = '';

	if (is_woocommerce()) {
		$custom_fields = get_post_custom_values('_wp_page_template', $c_pageID);
		if(is_array($custom_fields) && !empty($custom_fields)) {
			$page_template = $custom_fields[0];
		} else {
			$page_template = '';
		}
	}

	if(is_page_template('100-width.php') || is_page_template('blank.php') ||get_post_meta($slider_page_id, 'pyre_portfolio_width_100', true) == 'yes' || $page_template == '100-width.php') {
		$main_css = 'padding-left:0px;padding-right:0px;';
		if($smof_data['hundredp_padding'] && !get_post_meta($c_pageID, 'pyre_hundredp_padding', true)) {
			$main_css = 'padding-left:'.$smof_data['hundredp_padding'].';padding-right:'.$smof_data['hundredp_padding'];
		}
		if(get_post_meta($c_pageID, 'pyre_hundredp_padding', true)) {
			$main_css = 'padding-left:'.get_post_meta($c_pageID, 'pyre_hundredp_padding', true).';padding-right:'.get_post_meta($c_pageID, 'pyre_hundredp_padding', true);
		}
		$row_css = 'max-width:100%;';
		$main_class = 'width-100';
	}
	?>
	<div id="main" class="clearfix <?php echo $main_class; ?>" style="<?php echo $main_css; ?>">
		<div class="avada-row" style="<?php echo $row_css; ?>">