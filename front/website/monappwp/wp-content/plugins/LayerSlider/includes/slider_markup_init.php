 <?php

// Enqueue scripts
wp_enqueue_script('layerslider');
wp_enqueue_script('greensock');
wp_enqueue_script('layerslider-transitions');
wp_enqueue_script('ls-user-transitions');

$slider = array();

// Filter to override the defaults
if(has_filter('layerslider_override_defaults')) {
	$newDefaults = apply_filters('layerslider_override_defaults', $lsDefaults);
	if(!empty($newDefaults) && is_array($newDefaults)) {
		$lsDefaults = $newDefaults;
		unset($newDefaults);
	}
}

// Hook to alter slider data *before* filtering with defaults
if(has_filter('layerslider_pre_parse_defaults')) {
	$result = apply_filters('layerslider_pre_parse_defaults', $slides);
	if(!empty($result) && is_array($result)) {
		$slides = $result;
	}
}

// Filter slider data with defaults
$slides['properties'] = apply_filters('ls_parse_defaults', $lsDefaults['slider'], $slides['properties']);
$slides['properties']['attrs']['skinsPath'] = LS_ROOT_URL.'/static/skins/';
if(isset($slides['properties']['autoPauseSlideshow'])) {
	switch($slides['properties']['autoPauseSlideshow']) {
		case 'auto': $slides['properties']['autoPauseSlideshow'] = 'auto'; break;
		case 'enabled': $slides['properties']['autoPauseSlideshow'] = true; break;
		case 'disabled': $slides['properties']['autoPauseSlideshow'] = false; break;
	}
}

// Slides and layers
if(isset($slides['layers']) && is_array($slides['layers'])) {
	foreach($slides['layers'] as $slidekey => $slide) {
		$slider['slides'][$slidekey] = apply_filters('ls_parse_defaults', $lsDefaults['slides'], $slide['properties']);
		if(isset($slide['sublayers']) && is_array($slide['sublayers'])) {
			foreach($slide['sublayers'] as $layerkey => $layer) {
				if(!empty($layer['transition'])) {
					$layer = array_merge($layer, json_decode(stripslashes($layer['transition']), true));
				}
				$slider['slides'][$slidekey]['layers'][$layerkey] = apply_filters('ls_parse_defaults', $lsDefaults['layers'], $layer);
			}
		}
	}
}

// Hook to alter slider data *after* filtering with defaults
if(has_filter('layerslider_post_parse_defaults')) {
	$result = apply_filters('layerslider_post_parse_defaults', $slides);
	if(!empty($result) && is_array($result)) {
		$slides = $result;
	}
}

// // Demo site: skins
// $skin = $slides['properties']['attrs']['skin'];
// $skin = !empty($skin) ? $skin : $lsDefaults['slider']['skin']['value'];
// $slides['properties']['attrs']['skin'] = !empty($_GET['skin']) ? (string) $_GET['skin'] : $skin;

// // Demo site: navigation area
// $thumbNav = $slides['properties']['attrs']['thumbnailNavigation'];
// $thumbNav = !empty($thumbNav) ? $thumbNav : $lsDefaults['slider']['thumbnailNavigation']['value'];
// $slides['properties']['attrs']['thumbnailNavigation'] = !empty($_GET['nav']) ? (string) $_GET['nav'] : $thumbNav;

// Get init code
foreach($slides['properties']['attrs'] as $key => $val) {

	if(is_bool($val)) {
		$val = $val ? 'true' : 'false';
		$init[] = $key.': '.$val;
	} elseif(is_numeric($val)) { $init[] = $key.': '.$val;
	} elseif(substr($key, 0, 2) == 'cb' && empty($val)) { continue;
	} elseif(strpos($val, 'function(') === 0) { $init[] = $key.': '.$val;
	} else { $init[] = "$key: '$val'"; }
}
$init = implode(', ', $init);

// Fix multiple jQuery issue
$data[] = '<script type="text/javascript">';
$data[] = 'var lsjQuery = jQuery;';
// $data[] = "var curSkin = '{$slides['properties']['attrs']['skin']}';";
$data[] = '</script>';

// Include JS files to body option
    $data[] = '<script type="text/javascript" src="'.LS_ROOT_URL.'/static/js/layerslider.kreaturamedia.jquery.js?ver='.LS_PLUGIN_VERSION.'"></script>' . NL;
    $data[] = '<script type="text/javascript" src="'.LS_ROOT_URL.'/static/js/greensock.js?ver=1.11.2"></script>' . NL;

$data[] = '<script type="text/javascript">' . NL;
	$data[] = 'lsjQuery(document).ready(function() {' . NL;
		$data[] = 'if(typeof lsjQuery.fn.layerSlider == "undefined") { lsShowNotice(\'layerslider_'.$id.'\',\'jquery\'); }' . NL;
		$data[] = 'else {' . NL;
			$data[] = 'lsjQuery("#layerslider_'.$id.'").layerSlider({'.$init.'})' . NL;
		$data[] = '}' . NL;
	$data[] = '});' . NL;
$data[] = '</script>';


