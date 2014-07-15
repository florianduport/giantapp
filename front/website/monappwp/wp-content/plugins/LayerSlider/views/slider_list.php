<?php

	// Get screen options
	$lsScreenOptions = get_option('ls-screen-options', '0');
	$lsScreenOptions = ($lsScreenOptions == 0) ? array() : $lsScreenOptions;
	$lsScreenOptions = is_array($lsScreenOptions) ? $lsScreenOptions : unserialize($lsScreenOptions);

	// Defaults
	if(!isset($lsScreenOptions['showTooltips'])) { $lsScreenOptions['showTooltips'] = 'true'; }
	if(!isset($lsScreenOptions['showRemovedSliders'])) { $lsScreenOptions['showRemovedSliders'] = 'false'; }
	if(!isset($lsScreenOptions['numberOfSliders'])) { $lsScreenOptions['numberOfSliders'] = '10'; }

	// Get current page
	$curPage = (!empty($_GET['paged']) && is_numeric($_GET['paged'])) ? (int) $_GET['paged'] : 1;
	// $curPage = ($curPage >= $maxPage) ? $maxPage : $curPage;

	// Set filters
	$filters = array('page' => $curPage, 'limit' => (int) $lsScreenOptions['numberOfSliders']);
	if($lsScreenOptions['showRemovedSliders'] == 'true') {
		$filters['exclude'] = array('hidden'); }

	// Find sliders
	$sliders = LS_Sliders::find($filters);

	// Pager
	$maxItem = LS_Sliders::$count;
	$maxPage = ceil($maxItem / (int) $lsScreenOptions['numberOfSliders']);
	$maxPage = $maxPage ? $maxPage : 1;

	// Custom capability
	$custom_capability = $custom_role = get_option('layerslider_custom_capability', 'manage_options');
	$default_capabilities = array('manage_network', 'manage_options', 'publish_pages', 'publish_posts', 'edit_posts');

	if(in_array($custom_capability, $default_capabilities)) {
		$custom_capability = '';
	} else {
		$custom_role = 'custom';
	}

	// Auto-updates
	$code = get_option('layerslider-purchase-code', '');
	$validity = get_option('layerslider-validated', '0');
	$channel = get_option('layerslider-release-channel', 'stable');

	// Google Fonts
	$googleFonts = get_option('ls-google-fonts', array());

	// Box toggles
	$lsBoxToggles = get_option('ls-collapsed-boxes', array());
	$lsAdvSettingsToggle = isset($lsBoxToggles['ls-advanced-settings-toggle']) ? $lsBoxToggles['ls-advanced-settings-toggle'] : true;
	$lsGoogleFontsToggle = isset($lsBoxToggles['ls-google-fonts-toggle']) ? $lsBoxToggles['ls-google-fonts-toggle'] : true;

	// Notification messages
	$notifications = array(
		'removeSelectError' => __('No sliders were selected to remove.', 'LayerSlider'),
		'removeSuccess' => __('The selected sliders were removed.', 'LayerSlider'),
		'deleteSelectError' => __('No sliders were selected.', 'LayerSlider'),
		'deleteSuccess' => __('The selected sliders were deleted permanently.', 'LayerSlider'),
		'mergeSelectError' => __('You need to select at least 2 sliders to merge them.', 'LayerSlider'),
		'mergeSuccess' => __('The selected items were merged together as a new slider.', 'LayerSlider'),
		'restoreSelectError' => __('No sliders were selected.', 'LayerSlider'),
		'restoreSuccess' => __('The selected sliders were restored.', 'LayerSlider'),

		'exportSelectError' => __('No sliders were selected to export.', 'LayerSlider'),
		'exportZipError' => __('The PHP ZipArchive extension is required to import ZIPs.', 'LayerSlider'),

		'importSelectError' => __('Choose a file to import sliders.', 'LayerSlider'),
		'importFailed' => __('The import file seems to be invalid or corrupted.', 'LayerSlider'),
		'importSuccess' => __('Your slider has been imported.', 'LayerSlider'),
		'permissionError' => __('Your account does not have the necessary permission you chose, and your settings have not been saved to prevent locking yourself out of the plugin.', 'LayerSlider'),
		'permissionSuccess' => __('Permission changes has been updated.', 'LayerSlider'),
		'googleFontsUpdated' => __('Your Google Fonts library has been updated.', 'LayerSlider'),
		'generalUpdated' => __('Your settings has been updated.', 'LayerSlider')
	);
?>
<div id="ls-screen-options" class="metabox-prefs hidden">
	<div id="screen-options-wrap" class="hidden">
		<form id="ls-screen-options-form" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
			<h5><?php _e('Show on screen', 'LayerSlider') ?></h5>
			<label><input type="checkbox" name="showTooltips"<?php echo $lsScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> <?php _e('Tooltips', 'LayerSlider') ?></label>
			<label><input type="checkbox" name="showRemovedSliders" class="reload"<?php echo $lsScreenOptions['showRemovedSliders'] == 'true' ? ' checked="checked"' : ''?>> <?php _e('Removed sliders', 'LayerSlider') ?></label><br>

			<input type="number" name="numberOfSliders" min="3" step="1" value="<?php echo $lsScreenOptions['numberOfSliders'] ?>"> <?php _e('Sliders', 'LayerSlider') ?>
			<button class="button"><?php _e('Apply', 'LayerSlider') ?></button>
		</form>
	</div>
	<div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
		<a href="#screen-options-wrap" id="show-settings-link" class="show-settings"><?php _e('Screen Options', 'LayerSlider') ?></a>
	</div>
</div>
<div class="wrap" id="ls-list-page">
	<h2>
		<?php _e('LayerSlider sliders', 'LayerSlider') ?>
		<a href="#" id="ls-add-slider-button" class="add-new-h2"><?php _e('Add New', 'LayerSlider') ?></a>
		<a href="<?php echo wp_nonce_url('?page=layerslider&action=import_sample', 'import-sample-sliders') ?>" id="ls-import-samples-button" class="add-new-h2"><?php _e('Import sample sliders', 'LayerSlider') ?></a>
	</h2>

	<!-- Error messages -->
	<?php if(isset($_GET['message'])) : ?>
	<div class="ls-notification <?php echo isset($_GET['error']) ? 'warning' : 'changed' ?>">
		<div><?php echo $notifications[ $_GET['message'] ] ?></div>
	</div>
	<?php endif; ?>
	<!-- End of error messages -->

	<!-- Version number -->
	<?php if(strpos(LS_PLUGIN_VERSION, 'b') !== false) : ?>
	<div class="ls-version-number">
		<?php _e('Using beta version', 'LayerSlider') ?> (<?php echo LS_PLUGIN_VERSION ?>)
		<a href="mailto:support@kreaturamedia.com?subject=LayerSlider WP Beta Feedback"><?php _e('Send feedback', 'LayerSlider') ?></a>
	</div>
	<?php endif; ?>
	<!-- End of version number -->

	<!-- Add slider template -->
	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" id="ls-add-slider-template" class="ls-pointer ls-box">
		<?php wp_nonce_field('add-slider'); ?>
		<input type="hidden" name="ls-add-new-slider" value="1">
		<span class="ls-mce-arrow"></span>
		<h3 class="header"><?php _e('Give a name for your new slider', 'LayerSlider') ?></h3>
		<div class="inner">
			<input type="text" name="title" placeholder="<?php _e('e.g. Homepage slider', 'LayerSlider') ?>">
			<button class="button"><?php _e('Add slider', 'LayerSlider') ?></button>
		</div>
	</form>
	<!-- End of Add slider template -->


	<!-- Import sample sliders template -->
	<div id="ls-import-samples-template" class="ls-pointer ls-box">
		<span class="ls-mce-arrow"></span>
		<h3 class="header"><?php _e('Choose a demo slider to import', 'LayerSlider') ?></h3>
		<ul class="inner">
			<li>
				<a href="<?php echo wp_nonce_url('?page=layerslider&action=import_sample&slider=v5.zip', 'import-sample-sliders') ?>">
					<div class="preview"><img src="<?php echo LS_ROOT_URL.'/demos/v5.jpg' ?>"></div>
					<div class="title">LayerSlider 5 responsive demo slider</div>
				</a>
			</li>
			<li>
				<a href="<?php echo wp_nonce_url('?page=layerslider&action=import_sample&slider=fullwidth.zip', 'import-sample-sliders') ?>">
					<div class="preview"><img src="<?php echo LS_ROOT_URL.'/demos/fullwidth.jpg' ?>"></div>
					<div class="title">Full width demo slider</div>
				</a>
			</li>
			<li>
				<a href="<?php echo wp_nonce_url('?page=layerslider&action=import_sample&slider=carousel.zip', 'import-sample-sliders') ?>">
					<div class="preview"><img src="<?php echo LS_ROOT_URL.'/demos/carousel.jpg' ?>"></div>
					<div class="title">Carousel demo</div>
				</a>
			</li>
		</ul>
		<ul class="inner sep">
			<li>
				<a href="<?php echo wp_nonce_url('?page=layerslider&action=import_sample&slider=all', 'import-sample-sliders') ?>">
					Import all demo sliders (might be slow)
				</a>
			</li>
		</ul>
		<div class="inner">
			More demo content can be found in the downloaded package from CodeCanyon. You can import them in the usual way in the "Import and Export Sliders" section below.
		</div>
	</div>
	<!-- End of Import sample sliders template -->

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
		<input type="hidden" name="ls-bulk-action" value="1">
		<?php wp_nonce_field('bulk-action'); ?>
		<div class="ls-box ls-sliders-list">
			<table>
				<thead class="header">
					<tr>
						<td></td>
						<td><?php _e('ID', 'LayerSlider') ?></td>
						<td class="preview"><?php _e('Slider preview', 'LayerSlider') ?></td>
						<td><?php _e('Name', 'LayerSlider') ?></td>
						<td><?php _e('Shortcode', 'LayerSlider') ?></td>
						<td><?php _e('Slides', 'LayerSlider') ?></td>
						<td><?php _e('Created', 'LayerSlider') ?></td>
						<td><?php _e('Modified', 'LayerSlider') ?></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($sliders)) : ?>
					<?php foreach($sliders as $key => $item) : ?>
					<?php $class = ($item['flag_deleted'] == '1') ? ' class="faded"' : '' ?>
					<tr<?php echo $class ?>>
						<td><input type="checkbox" name="sliders[]" value="<?php echo $item['id'] ?>"></td>
						<td><?php echo $item['id'] ?></td>
						<td class="preview">
							<div>
								<a href="?page=layerslider&action=edit&id=<?php echo $item['id'] ?>">
									<img src="<?php echo apply_filters('ls_get_preview_for_slider', $item ) ?>" alt="Slider preview">
								</a>
							</div>
						</td>
						<td class="name">
							<a href="?page=layerslider&action=edit&id=<?php echo $item['id'] ?>">
								<?php echo apply_filters('ls_slider_title', $item['name'], 40) ?>
							</a>
						</td>
						<td><input type="text" class="ls-shortcode" value="[layerslider id=&quot;<?php echo !empty($item['slug']) ? $item['slug'] : $item['id'] ?>&quot;]" readonly></td>
						<td><?php echo count($item['data']['layers']) ?></td>
						<td><?php echo date('d/m/y', $item['date_c']) ?></td>
						<td><?php echo human_time_diff($item['date_m']) ?> <?php _e('ago', 'LayerSlider') ?></td>
						<td>
							<?php if(!$item['flag_deleted']) : ?>
							<a href="<?php echo wp_nonce_url('?page=layerslider&action=duplicate&id='.$item['id'], 'duplicate_'.$item['id']) ?>">
								<span class="dashicons dashicons-admin-page" data-help="<?php _e('Duplicate this slider', 'LayerSlider') ?>"></span>
							</a>
							<a href="<?php echo wp_nonce_url('?page=layerslider&action=remove&id='.$item['id'], 'remove_'.$item['id']) ?>">
								<span class="dashicons dashicons-post-trash" data-help="<?php _e('Remove this slider', 'LayerSlider') ?>"></span>
							</a>
							<?php else : ?>
							<a href="<?php echo wp_nonce_url('?page=layerslider&action=restore&id='.$item['id'], 'restore_'.$item['id']) ?>">
								<span class="dashicons dashicons-backup" data-help="<?php _e('Restore removed slider', 'LayerSlider') ?>"></span>
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if(empty($sliders)) : ?>
					<tr>
						<td colspan="9"><?php _e('You haven\'t created any a slider yet. Click on the "Add New" button above to add one.', 'LayerSlider') ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<div class="ls-bulk-actions">
			<select name="action">
				<option value="0"><?php _e('Choose an action', 'LayerSlider') ?></option>
				<option value="remove"><?php _e('Remove selected', 'LayerSlider') ?></option>
				<option value="delete"><?php _e('Delete permanently', 'LayerSlider') ?></option>
				<?php if($lsScreenOptions['showRemovedSliders'] == 'true') : ?>
				<option value="restore"><?php _e('Restore removed', 'LayerSlider') ?></option>
				<?php endif; ?>
				<option value="merge"><?php _e('Merge selected as new', 'LayerSlider') ?></option>
			</select>
			<button class="button"><?php _e('Apply', 'LayerSlider') ?></button>
		</div>
		</div>
	</form>
	<div class="ls-pagination tablenav bottom">
		<div class="tablenav-pages">
			<span class="displaying-num"><?php echo $maxItem ?> <?php _e('items', 'LayerSlider') ?></span>
			<span class="pagination-links">
				<a class="first-page<?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the first page" href="admin.php?page=layerslider">«</a>
				<a class="prev-page <?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the previous page" href="admin.php?page=layerslider&amp;paged=<?php echo ($curPage-1) ?>">‹</a>
				<form action="admin.php" method="get" class="paging-input">
					<input type="hidden" name="page" value="layerslider">
					<input class="current-page" title="Current page" type="text" name="paged" value="<?php echo $curPage ?>" size="1"> of
					<span class="total-pages"><?php echo $maxPage ?></span>
				</form>
				<a class="next-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the next page" href="admin.php?page=layerslider&amp;paged=<?php echo ($curPage+1) ?>">›</a>
				<a class="last-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the last page" href="admin.php?page=layerslider&amp;paged=<?php echo $maxPage ?>">»</a>
			</span>
		</div>
	</div>


	<div class="ls-export-wrapper columns clearfix">
		<div class="half">
			<div class="ls-import-export-box ls-box">
				<h3 class="header medium"><?php _e('Import & Export Sliders', 'LayerSlider') ?></h3>
				<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data" class="ls-import-box">
					<?php wp_nonce_field('import-sliders'); ?>
					<input type="hidden" name="ls-import" value="1">
					<table data-help="<?php _e('Choose a LayerSlider export file downloaded previously to import your sliders. To import from outdated versions, you need to create a file and paste the export code into it. The file needs to have a .json extension.', 'LayerSlider') ?>">
						<tbody>
							<tr>
								<td><?php  _e('Import Sliders', 'LayerSlider') ?></td>
								<td><input type="file" name="import_file"></td>
								<td><button class="button"><?php _e('Import', 'LayerSlider') ?></button></td>
							</tr>
						</tbody>
					</table>
				</form>
				<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-export-form">
					<?php wp_nonce_field('export-sliders'); ?>
					<input type="hidden" name="ls-export" value="1">
					<table>
						<tbody>
							<tr>
								<td valign="top"><?php _e('Export Sliders', 'LayerSlider') ?></td>
								<td>
									<select name="sliders[]" multiple="multiple" data-help="<?php _e('Downloads an export file that contains your selected sliders to import on your new site. You can select multiple sliders by holding the Ctrl/Cmd button while clicking.', 'LayerSlider') ?>">
										<option value="-1" selected> <?php _e('All Sliders', 'LayerSlider') ?></option>
										<?php foreach($sliders as $slider) : ?>
										<option value="<?php echo $slider['id'] ?>">
											#<?php echo str_replace(' ', '&nbsp;', str_pad($slider['id'], 3, " ")) ?> -
											<?php echo $slider['name'] ?>
										</option>
										<?php endforeach; ?>
									</select>

									<label>
										<input type="checkbox"  class="checkbox" name="exportWithImages" checked> Export with images
									</label>
									<button class="button"><?php _e('Export', 'LayerSlider') ?></button>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr data-help="The PHP ZipArchive extension is needed for exporting/importing images. The plugin will only copy your slider settings if it's not available. In that case please contact with your hosting provider.">
								<td>Status</td>
								<td colspan="2" class="<?php echo class_exists('ZipArchive') ? 'available' : 'notavailable' ?>">
									<?php echo class_exists('ZipArchive') ? 
										'ZipArchive is available to import/export images' : 
										'ZipArchive isn\'t avilable' 
									?>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>

		<div class="half">
			<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-import-export-box" id="ls-permission-form">
				<?php wp_nonce_field('save-access-permissions'); ?>
				<input type="hidden" name="ls-access-permission" value="1">
				<h3 class="header medium">
					<?php _e('Allow LayerSlider access to users with ...', 'LayerSlider') ?>
				</h3>
				<table>
					<tbody>
						<tr>
							<td><?php _e('Role', 'LayerSlider') ?></td>
							<td>
								<select name="custom_role">
									<?php if(is_multisite()) : ?>
									<option value="manage_network" <?php echo ($custom_role == 'manage_network') ? 'selected="selected"' : '' ?>> <?php _e('Super Admin', 'LayerSlider') ?></option>
									<?php endif; ?>
									<option value="manage_options" <?php echo ($custom_role == 'manage_options') ? 'selected="selected"' : '' ?>> <?php _e('Admin', 'LayerSlider') ?></option>
									<option value="publish_pages" <?php echo ($custom_role == 'publish_pages') ? 'selected="selected"' : '' ?>> <?php _e('Editor, Admin', 'LayerSlider') ?></option>
									<option value="publish_posts" <?php echo ($custom_role == 'publish_posts') ? 'selected="selected"' : '' ?>> <?php _e('Author, Editor, Admin', 'LayerSlider') ?></option>
									<option value="edit_posts" <?php echo ($custom_role == 'edit_posts') ? 'selected="selected"' : '' ?>> <?php _e('Contributor, Author, Editor, Admin', 'LayerSlider') ?></option>
									<option value="custom" <?php echo ($custom_role == 'custom') ? 'selected="selected"' : '' ?>> <?php _e('Custom', 'LayerSlider') ?></option>
								</select>
							</td>
							<td><button class="button"><?php _e('Update', 'LayerSlider') ?></button></td>
							<!-- <td class="desc"><?php _e('If you want to give access for other users than admins to this page, you can specify a custom capability. You can find all the available capabilities on', 'LayerSlider') ?> <a href="http://codex.wordpress.org/Roles_and_Capabilities#Capabilities" target="_blank"><?php _e('this page', 'LayerSlider') ?></a>.</td> -->
						</tr>
						<tr>
							<td><?php _e('Capability', 'LayerSlider') ?></td>
							<td><input type="text" name="custom_capability" value="<?php echo $custom_capability ?>" placeholder="Enter custom capability"></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>

		<div class="half">
			<?php if($GLOBALS['lsAutoUpdateBox'] == true) : ?>
			<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-settings ls-auto-update">
				<input type="hidden" name="action" value="layerslider_verify_purchase_code">
				<h3 class="header medium blue">
					<?php _e('Auto-updates', 'LayerSlider') ?>
					<figure><span>|</span><?php _e('Update notifications and one-click installation', 'LayerSlider') ?></figure>
				</h3>
				<table>
					<tbody>
						<tr>
							<td><?php _e('Purchase code', 'LayerSlider') ?></td>
							<td>
								<input type="text" name="purchase_code" value="<?php echo $code ?>"  class="key" placeholder="e.g. bc8e2b24-3f8c-4b21-8b4b-90d57a38e3c7" data-help="<?php _e('To receive auto-updates, you need to enter your item purchase code. You can find it on your CodeCanyon downloads page, just click on the Download button and choose the "Licence Certificate" option. This will download a text file that contains your purchase code.', 'LayerSlider') ?>">
							</td>
						</tr>
						<tr>
							<td><?php _e('Release channel', 'LayerSlider') ?></td>
							<td>
								<label><input type="radio" name="channel" value="stable" <?php echo ($channel === 'stable') ? 'checked="checked"' : ''?>> <?php _e('Stable', 'LayerSlider') ?></label>
								<label data-help="<?php _e('Although pre-release versions should be fine, they might contain unknown issues, and are not recommended for sites in production.', 'LayerSlider') ?>">
									<input type="radio" name="channel" value="beta" <?php echo ($channel === 'beta') ? 'checked="checked"' : ''?>> <?php _e('Beta', 'LayerSlider') ?>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="footer">
					<button class="button"><?php _e('Update', 'LayerSlider') ?></button>
					<span style="<?php echo ($validity == '0' && $code != '') ? 'color: #c33219;' : 'color: #4b982f'?>">
						<?php
							if($validity == '1') {
								_e('Thank you for purchasing LayerSlider WP.', 'LayerSlider');
								echo '<a href="update-core.php">', __('Check for update', 'LayerSlider'), '</a>';

							} else if($code != '') {
								_e("Your purchase code doesn't appear to be valid.", "LayerSlider");
							}
						?>
					</span>
				</div>
			</form>
			<?php else : ?>
			<div class="ls-box ls-settings ls-auto-update">
				<h3 class="header medium blue"><?php _e('Auto-updates', 'LayerSlider') ?></h3>
				<div class="inner" style="text-align: justify;">
					<?php _e("It seems you've received LayerSlider with your current theme. Our auto-update mechanism only works with a direct purchase of the plugin, thus you can receive newer versions by updating your theme. Please note, updates are available for everyone at the same time, but it might take some time while theme authors include them in their own releases.", "LayerSlider"); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>


	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-global-settings<?php echo ($lsAdvSettingsToggle) ? ' collapsed' : '' ?>">
		<?php wp_nonce_field('save-advanced-settings'); ?>
		<input type="hidden" name="ls-save-advanced-settings">
		<h2 class="header medium">
			<?php _e('Troubleshooting & Advanced Settings', 'LayerSlider') ?>
			<figure><span>|</span><?php _e("Don't change these settings without experience. LayerSlider will let you know when it encounters a problem.", "LayerSlider") ?></figure>
			<span id="ls-advanced-settings-toggle" class="dashicons dashicons-arrow-<?php echo $lsAdvSettingsToggle ? 'right' : 'down' ?> ls-ficon ls-box-toggle"></span>
		</h2>
		<div class="inner">
			<table>
				<tr>
					<td><?php _e('Use Google CDN version of jQuery', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="use_custom_jquery" <?php echo get_option('ls_use_custom_jquery', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e('This option will likely solve "Old jQuery" issues.', 'LayerSlider') ?></td>
				</tr>
				<tr>
					<td><?php _e("Include scripts in the footer", "LayerSlider") ?></td>
					<td><input type="checkbox" name="include_at_footer" <?php echo get_option('ls_include_at_footer', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e("Including resources in the footer could decrease load times, and solve other type of issues, but your theme might not support this method.", "LayerSlider") ?></td>
				</tr>
				<tr>
					<td><?php _e("Conditional script loading", "LayerSlider") ?></td>
					<td><input type="checkbox" name="conditional_script_loading" <?php echo get_option('ls_conditional_script_loading', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e("Increase your site's performance by loading resources only when needed. Outdated themes might not support this method.", "LayerSlider") ?></td>
				</tr>
				<tr>
					<td><?php _e('Concatenate output', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="concatenate_output" <?php echo get_option('ls_concatenate_output', true) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e("Concatenating the plugin's output could solve issues caused by custom filters your theme might use.", "LayerSlider") ?></td>
				</tr>
				<tr>
					<td><?php _e('Put JS includes to body', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="put_js_to_body" <?php echo get_option('ls_put_js_to_body', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e('This is the most common workaround for jQuery related issues, and is recommended when you experience problems with jQuery.', 'LayerSlider') ?></td>
				</tr>
			</table>
			<div class="footer">
				<button type="submit" class="button"><?php _e('Save changes', 'LayerSlider') ?></button>
			</div>
		</div>
	</form>

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-google-fonts<?php echo $lsGoogleFontsToggle ? ' collapsed' : '' ?>">
		<?php wp_nonce_field('save-google-fonts'); ?>
		<input type="hidden" name="ls-save-google-fonts" value="1">

		<!-- Google Fonts Header -->
		<h2 class="header medium">
			<?php _e('Load Google Fonts', 'LayerSlider') ?>
			<span id="ls-google-fonts-toggle" class="dashicons dashicons-arrow-<?php echo $lsGoogleFontsToggle ? 'right' : 'down' ?> ls-ficon ls-box-toggle"></span>
		</h2>

		<!-- Google Fonts list -->
		<div class="inner">
			<ul class="ls-font-list">
				<li class="ls-hidden">
					<a href="#" class="remove" title="Remove this font">x</a>
					<input type="text" name="urlParams[]" readonly="readonly">
					<input type="checkbox" name="onlyOnAdmin[]">
					<?php _e('Load only on admin interface', 'LayerSlider') ?>
				</li>
				<?php if(is_array($googleFonts) && !empty($googleFonts)) : ?>
				<?php foreach($googleFonts as $key => $item): ?>
				<li>
					<a href="#" class="remove" title="Remove this font">x</a>
					<input type="text" name="urlParams[<?php echo $key ?>]" value="<?php echo $item['param'] ?>" readonly="readonly">
					<input type="checkbox" name="onlyOnAdmin[<?php echo $key ?>]" <?php echo $item['admin'] ? ' checked="checked"' : '' ?>>
					<?php _e('Load only on admin interface', 'LayerSlider') ?>
				</li>
				<?php endforeach ?>
				<?php else : ?>
				<li class="ls-notice"><?php _e("You didn't add any Google font to your library yet.", "LayerSlider") ?></li>
				<?php endif ?>
			</ul>
		</div>

		<!-- Google Fonts search bar -->
		<div class="inner ls-font-search footer">
			<button type="submit" class="button"><?php _e('Save changes', 'LayerSlider') ?></button>

			<div class="right">
				<?php _e('Add font:', 'LayerSlider') ?>
				<input type="text" placeholder="Search Google Fonts library">
				<button class="button"><?php _e('Search', 'LayerSlider') ?></button>
			</div>

			<!-- Google Fonts search pointer -->
			<div class="ls-box ls-pointer">
				<h3 class="header"><?php _e('Choose a font family', 'LayerSlider') ?></h3>
				<div class="fonts">
					<ul class="inner"></ul>
				</div>
				<div class="variants">
					<ul class="inner"></ul>
					<div class="inner">
						<button class="button add-font"><?php _e('Add font', 'LayerSlider') ?></button>
						<button class="button right"><?php _e('Back to results', 'LayerSlider') ?></button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div class="ls-box ls-news">
		<div class="header medium">
			<h2><?php _e('LayerSlider News', 'LayerSlider') ?></h2>
			<div class="filters">
				<span><?php _e('Filter:', 'LayerSlider') ?></span>
				<ul>
					<li class="active" data-page="all"><?php _e('All', 'LayerSlider') ?></li>
					<li data-page="announcements"><?php _e('Announcements', 'LayerSlider') ?></li>
					<li data-page="changes"><?php _e('Release log', 'LayerSlider') ?></li>
					<li data-page="betas"><?php _e('Beta versions', 'LayerSlider') ?></li>
				</ul>
			</div>
			<div class="ls-version"<?php _e('>You have version', 'LayerSlider') ?> <?php echo LS_PLUGIN_VERSION ?> <?php _e('installed', 'LayerSlider') ?></div>
		</div>
		<div>
			<iframe src="http://news.kreaturamedia.com/layerslider/"></iframe>
		</div>
	</div>
</div>

<!-- Help menu WP Pointer -->
<?php

// Get users data
global $current_user;
get_currentuserinfo();

if(get_user_meta($current_user->ID, 'layerslider_help_wp_pointer', true) != '1') {
add_user_meta($current_user->ID, 'layerslider_help_wp_pointer', '1'); ?>
<script type="text/javascript">

	// Help
	jQuery(document).ready(function() {
		jQuery('#contextual-help-link-wrap').pointer({
			pointerClass : 'ls-help-pointer',
			pointerWidth : 320,
			content: '<h3><?php _e('The documentation is here', 'LayerSlider') ?></h3><div class="inner"><?php _e('This is a WordPress contextual help menu, we use it to give you fast access to our documentation. Please keep in mind that because this menu is contextual, it only shows the relevant information to the page that you are currently viewing. So if you search something, you should visit the corresponding page first and then open this help menu.', 'LayerSlider') ?></div>',
			position: {
				edge : 'top',
				align : 'right'
			}
		}).pointer('open');
	});
</script>
<?php } ?>
<script type="text/javascript">
	var lsScreenOptions = <?php echo json_encode($lsScreenOptions) ?>;
</script>
