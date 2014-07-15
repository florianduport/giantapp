<?php

// Update notice
if(strpos($_SERVER['REQUEST_URI'], '?page=layerslider') !== false) {
	add_action('admin_notices', 'layerslider_update_notice');
	add_action('admin_notices', 'layerslider_dependency_notice');
}

// Storage notice
if(get_option('layerslider-slides') !== false) {

	global $pagenow;
	if($pagenow == 'plugins.php' || $pagenow == 'index.php' || strpos($_SERVER['REQUEST_URI'], 'layerslider')) {
		add_action('admin_notices', 'layerslider_compatibility_notice');
	}
}

function layerslider_update_notice() {

	// Get plugin updates
	$updates = get_plugin_updates();

	// Check for update
	if(isset($updates[LS_PLUGIN_BASE]) && isset($updates[LS_PLUGIN_BASE]->update)) {
		$update = $updates[LS_PLUGIN_BASE];
		add_thickbox();
		?>
		<div class="layerslider_notice">
			<img src="<?php echo LS_ROOT_URL.'/static/img/ls_80x80.png' ?>" alt="LayerSlider icon">
			<h1><?php _e('Update available for LayerSlider WP!', 'LayerSlider') ?></h1>
			<p>
				<?php echo sprintf(__('You have version %1$s. Update to version %2$s.', 'LayerSlider'), $update->Version, $update->update->new_version); ?><br>
				<i><?php echo $update->update->upgrade_notice ?></i>
				<a href="plugin-install.php?tab=plugin-information&plugin=LayerSlider&section=changelog&TB_iframe=true&width=640&height=747" class="thickbox">
					<?php _e('Review changes & Install', 'LayerSlider') ?>
				</a>
			</p>
			<div class="clear"></div>
		</div>
		<?php
	}
}


function layerslider_compatibility_notice() { ?>
	<div class="layerslider_notice">
		<img src="<?php echo LS_ROOT_URL.'/static/img/ls_80x80.png' ?>" alt="LayerSlider icon">
		<h1><?php _e('The new version of LayerSlider WP is almost ready!', 'LayerSlider') ?></h1>
		<p>
			<?php _e('For a faster and more reliable solution, LayerSlider WP needs to convert your data associated with the plugin. Your sliders and settings will remain still, and it only takes a click on this button.', 'LayerSlider') ?>

			<a href="<?php echo wp_nonce_url('?page=layerslider&action=convert', 'convertoldsliders') ?>">
				<?php _e('Convert Data', 'LayerSlider') ?>
			</a>
		</p>
		<div class="clear"></div>
	</div>
<?php }

function layerslider_dependency_notice() {
	if(version_compare(PHP_VERSION, '5.0.0', '<') || !function_exists('mb_eregi') || !class_exists('DOMDocument')) {
	?>
	<div class="layerslider_notice">
		<img src="<?php echo LS_ROOT_URL.'/static/img/ls_80x80.png' ?>" alt="LayerSlider icon">
		<h1><?php _e('Server configuration issues detected!', 'LayerSlider') ?></h1>
		<p>
			<?php _e('phpQuery, an external library in LayerSlider, have unmet dependencies. It requires PHP5 with the following extensions installed: PHP DOM extension, PHP Multibyte String extension. Please contact with your hosting provider to resolve these dependencies, as it will likely break LayerSlider to function properly.', 'LayerSlider') ?>
			<strong><?php _e('This issue could result a blank page in slider builder.') ?></strong>
		</p>
		<div class="clear"></div>
	</div>
<?php } }

?>
