<?php


add_shortcode("layerslider","layerslider_init");

function layerslider_init($atts) {

	// ID check
	if(empty($atts['id'])) {
		return '[LayerSliderWP] '.__('Invalid shortcode', 'LayerSlider').'';
	}

	// Get slider if any
	if(!$slider = LS_Sliders::find($atts['id'])) {
		return '[LayerSliderWP] '.__('Slider not found', 'LayerSlider').'';
	}

	// Slider and markup data
	$slides = $slider['data'];
	$id = $atts['id'];
	$data = '';

	// Include slider file
	if(is_array($slides)) {

		// For posts
		global $LSC;

		// Get phpQuery
		if(!class_exists('phpQuery')) {
			libxml_use_internal_errors(true);
			include LS_ROOT_PATH.'/helpers/phpQuery.php';
		}

		include LS_ROOT_PATH.'/config/defaults.php';
		include LS_ROOT_PATH.'/includes/slider_markup_init.php';
		include LS_ROOT_PATH.'/includes/slider_markup_html.php';
		$data = implode('', $data);
	}

	// Return data
	if(get_option('ls_concatenate_output', true)) {
		$data = trim(preg_replace('/\s+/', ' ', $data));
	}

	return $data;
}

?>
