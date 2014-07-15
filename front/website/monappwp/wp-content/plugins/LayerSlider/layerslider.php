<?php

/*
Plugin Name: LayerSlider WP
Plugin URI: http://codecanyon.net/user/kreatura/
Description: LayerSlider is the most advanced responsive WordPress slider plugin with the famous Parallax Effect and over 200 2D & 3D transitions.
Version: 5.1.1
Author: Kreatura Media
Author URI: http://kreaturamedia.com/
*/

if(defined('LS_PLUGIN_VERSION') || isset($GLOBALS['lsPluginPath'])) {
	die('ERROR: It looks like you already have one instance of LayerSlider installed. WordPress cannot activate and handle two instanced at the same time, you need to remove the old version first.');
}

/********************************************************/
/*                        Actions                       */
/********************************************************/

	// Legacy, will be dropped
	$GLOBALS['lsAutoUpdateBox'] = true;

	// Constants
	define('LS_ROOT_FILE', __FILE__);
	define('LS_ROOT_PATH', dirname(__FILE__));
	define('LS_ROOT_URL', plugins_url('', __FILE__));
	define('LS_PLUGIN_VERSION', '5.1.1');
	define('LS_PLUGIN_SLUG', basename(dirname(__FILE__)));
	define('LS_PLUGIN_BASE', plugin_basename(__FILE__));
	define('LS_DB_TABLE', 'layerslider');

	if(!defined('NL')) { define("NL", "\r\n"); }
	if(!defined('TAB')) { define("TAB", "\t"); }

	// Shared
	include LS_ROOT_PATH.'/wp/scripts.php';
	include LS_ROOT_PATH.'/classes/layerslider.class.php';
	include LS_ROOT_PATH.'/wp/layerslider.php';
	include LS_ROOT_PATH.'/wp/menus.php';
	include LS_ROOT_PATH.'/wp/hooks.php';
	include LS_ROOT_PATH.'/wp/widgets.php';
	include LS_ROOT_PATH.'/wp/compatibility.php';

	// Back-end only
	if(is_admin()) {
		include LS_ROOT_PATH.'/wp/activation.php';
		include LS_ROOT_PATH.'/wp/tinymce.php';
		include LS_ROOT_PATH.'/wp/help.php';
		include LS_ROOT_PATH.'/wp/notices.php';
		include LS_ROOT_PATH.'/wp/actions.php';

	// Front-end only
	} else {
		include LS_ROOT_PATH.'/wp/shortcodes.php';
	}

	global $LSC;
	$LSC = new LayerSlider();

	require_once LS_ROOT_PATH.'/classes/class.km.autoupdate.plugins.php';
	if(get_option('layerslider-validated', '0')) {
		new KM_PluginUpdates(array(
			'root' => LS_ROOT_FILE,
			'version' => LS_PLUGIN_VERSION,
			'repo' => 'http://updates.kreaturamedia.com/plugins/',
			'channel' => get_option('layerslider-release-channel', 'stable'),
			'license' => get_option('layerslider-purchase-code', '')
		));
	}

	// Hook to trigger plugin override functions
	add_action('after_setup_theme', 'layerslider_loaded');
	add_action('plugins_loaded', 'layerslider_load_lang');


function layerslider_load_lang() {
	load_plugin_textdomain('LayerSlider', false, LS_PLUGIN_SLUG . '/locales/' );
}

/********************************************************/
/*                 Check purchase code                  */
/********************************************************/
add_action('wp_ajax_layerslider_verify_purchase_code', 'layerslider_verify_purchase_code');
function layerslider_verify_purchase_code() {

	global $wp_version;

	// Get data
	$pcode = get_option('layerslider-purchase-code', '');
	$validated = get_option('layerslider-validated', '0');
	$channel = ($_POST['channel'] === 'beta') ? 'beta' : 'stable';

	// Save sent data
	update_option('layerslider-release-channel', $channel);
	update_option('layerslider-purchase-code', $_POST['purchase_code']);

	// Release channel
	if($validated == 1) {
		if($pcode == $_POST['purchase_code']) {
			die(json_encode(array('success' => true, 'message' => __('Your settings were successfully saved.', 'LayerSlider') . '<a href="update-core.php">' . __('Check for update', 'LayerSlider') . '</a>' )));
		}
	}

	// Verify license
	$response = wp_remote_post('http://activate.kreaturamedia.com/', array(
		'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url'),
		'body' => array(
			'plugin' => urlencode('LayerSlider WP'),
			'license' => urlencode($_POST['purchase_code'])
		)
	));


	if($response['body'] == 'valid') {
		update_option('layerslider-validated', '1');
		die(json_encode(array('success' => true, 'message' => __('Thank you for purchasing LayerSlider WP.', 'LayerSlider') . '<a href="update-core.php">' . __('Check for update', 'LayerSlider') . '</a>')));

	// Invalid
	} else {
		update_option('layerslider-validated', '0');
		die(json_encode(array('success' => false, 'message' => __("Your purchase code doesn't appear to be valid.", "LayerSlider"))));
	}
}



/********************************************************/
/*                Enqueue Admin Scripts                 */
/********************************************************/




function layerslider_builder_convert_numbers(&$item, $key) {
	if(is_numeric($item)) {
		$item = (float) $item;
	}
}

function ls_ordinal_number($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    $mod100 = $number % 100;
    return $number . ($mod100 >= 11 && $mod100 <= 13 ? 'th' :  $ends[$number % 10]);
}


/********************************************************/
/*          WPML Layer's String Translation             */
/********************************************************/
function layerslider_register_wpml_strings($slider_id, $data) {


	global $wpdb;
	$table_name = $wpdb->prefix . "layerslider";

	$slider = $wpdb->get_row("SELECT * FROM $table_name WHERE id = ".(int)$slider_id." ORDER BY date_c DESC LIMIT 1" , ARRAY_A);
	$slider = json_decode($slider['data'], true);

	foreach($data['layers'] as $layerkey => $layer) {
		foreach($layer['sublayers'] as $sublayerkey => $sublayer) {
			if($sublayer['type'] != 'img') {
				icl_register_string('LayerSlider WP', '<'.$sublayer['type'].':'.substr(sha1($sublayer['html']), 0, 10).'> layer on slide #'.($layerkey+1).' in slider #'.$slider_id.'', $sublayer['html']);
			}
		}
	}
}




/********************************************************/
/*                        MISC                          */
/********************************************************/

function layerslider_check_unit($str) {

	if(strstr($str, 'px') == false && strstr($str, '%') == false) {
		return $str.'px';
	} else {
		return $str;
	}
}

function layerslider_convert_urls($arr) {

	// Layer BG
	if(strpos($arr['properties']['background'], 'http://') !== false) {
		$arr['properties']['background'] = parse_url($arr['properties']['background'], PHP_URL_PATH);
	}

	// Layer Thumb
	if(strpos($arr['properties']['thumbnail'], 'http://') !== false) {
		$arr['properties']['thumbnail'] = parse_url($arr['properties']['thumbnail'], PHP_URL_PATH);
	}

	// Image sublayers
	foreach($arr['sublayers'] as $sublayerkey => $sublayer) {

		if($sublayer['type'] == 'img') {
			if(strpos($sublayer['image'], 'http://') !== false) {
				$arr['sublayers'][$sublayerkey]['image'] = parse_url($sublayer['image'], PHP_URL_PATH);
			}
		}
	}

	return $arr;
}
