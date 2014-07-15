<?php
wp_reset_query();
global $post;
if(is_shop()) {
	$pageID = get_option('woocommerce_shop_page_id');
} else {
	$pageID = $post->ID;
}
$sidebar_exists = true;
if(get_post_meta($pageID, 'pyre_full_width', true) == 'yes') {
	$content_css = 'width:100%';
	$sidebar_css = 'display:none';
	$sidebar_exists = false;
}
elseif(get_post_meta($pageID, 'pyre_sidebar_position', true) == 'left') {
	$content_css = 'float:right;';
	$sidebar_css = 'float:left;';
} elseif(get_post_meta($pageID, 'pyre_sidebar_position', true) == 'right') {
	$content_css = 'float:left;';
	$sidebar_css = 'float:right;';
} elseif(get_post_meta($pageID, 'pyre_sidebar_position', true) == 'default') {
	if($smof_data['default_sidebar_pos'] == 'Left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif($smof_data['default_sidebar_pos'] == 'Right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	}
}
?>
<?php if( $sidebar_exists == true ): ?>
<div id="sidebar">
	<?php
	if(is_product()) {
		generated_dynamic_sidebar();
	} else {
		$shop_page_id = get_option('woocommerce_shop_page_id');
		$name = get_post_meta($shop_page_id, 'sbg_selected_sidebar_replacement', true);
		if($name) {
			generated_dynamic_sidebar($name[0]);
		}
	}
	?>
</div>
<?php endif; ?>