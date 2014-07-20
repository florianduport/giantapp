<div class="pyre_metabox">
<h2 style="margin-top:0;">Page options:</h2>
<?php
$this->select(	'full_width',
				'Page: Full Width',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php sidebar_generator::edit_form(); ?>
<?php
$this->select(	'sidebar_position',
				'Page: Sidebar Position',
				array('default' => 'Default', 'right' => 'Right', 'left' => 'Left'),
				''
			);
?>
<?php
$this->select(	'display_header',
				'Display Header',
				array('yes' => 'Yes', 'no' => 'No'),
				''
			);
?>
<?php
$this->select(	'transparent_header',
				'Transparent Header',
				array('default' => 'Default', 'yes' => 'Yes', 'no' => 'No'),
				''
			);
?>
<?php
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
$menu_select['default'] = 'Default Menu';
foreach ( $menus as $menu ) {
	$menu_select[$menu->term_id] = $menu->name;
}
$this->select(	'displayed_menu',
				'Main Navigation Menu',
				$menu_select,
				''
			);
?>
<?php
$this->select(	'display_footer',
				'Display Footer Widget Area',
				array('default' => 'Default', 'yes' => 'Yes', 'no' => 'No'),
				''
			);
?>
<?php
$this->select(	'display_copyright',
				'Display Copyright Area',
				array('default' => 'Default', 'yes' => 'Yes', 'no' => 'No'),
				''
			);
?>
<h2>Slider options:</h2>
<?php
$this->select(	'slider_position',
				'Slider Position',
				array('default' => 'Default', 'below' => 'Below', 'above' => 'Above'),
				'Select if the slider shows below or above the header. This only works for the slider assigned in page options, not with shortcodes.'
			);
?>
<?php
$this->select(	'slider_type',
				'Slider Type',
				array('no' => 'No Slider', 'layer' => 'LayerSlider', 'flex' => 'Fusion Slider', 'rev' => 'Revolution Slider', 'elastic' => 'Elastic Slider'),
				''
			);
?>
<?php
global $wpdb;
$slides_array[0] = 'Select a slider';
// Table name
$table_name = $wpdb->prefix . "layerslider";

// Get sliders
$sliders = $wpdb->get_results( "SELECT * FROM $table_name
									WHERE flag_hidden = '0' AND flag_deleted = '0'
									ORDER BY date_c ASC" );

if(!empty($sliders)):
foreach($sliders as $key => $item):
	$slides[$item->id] = '';
endforeach;
endif;

if($slides){
foreach($slides as $key => $val){
	$slides_array[$key] = 'LayerSlider #'.($key);
}
}
$this->select(	'slider',
				'Select LayerSlider',
				$slides_array,
				''
			);
?>
<?php
$slides_array = array();
$slides = array();
$slides_array[0] = 'Select a slider';
$slides = get_terms('slide-page');
if($slides && !isset($slides->errors)){
$slides = is_array($slides) ? $slides : unserialize($slides);
foreach($slides as $key => $val){
	$slides_array[$val->slug] = $val->name;
}
}
$this->select(	'wooslider',
				'Select Fusion Slider',
				$slides_array,
				''
			);
?>
<?php
global $wpdb;
$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
$revsliders[0] = 'Select a slider';
if($get_sliders) {
	foreach($get_sliders as $slider) {
		$revsliders[$slider->alias] = $slider->title;
	}
}
$this->select(	'revslider',
				'Select Revolution Slider',
				$revsliders,
				''
			);
?>
<?php
$slides_array = array();
$slides_array[0] = 'Select a slider';
$slides = get_terms('themefusion_es_groups');
if($slides && !isset($slides->errors)){
$slides = is_array($slides) ? $slides : unserialize($slides);
foreach($slides as $key => $val){
	$slides_array[$val->slug] = $val->name;
}
}
$this->select(	'elasticslider',
				'Select Elastic Slider',
				$slides_array,
				''
			);
?>
<?php $this->upload('fallback', 'Slider Fallback Image'); ?>
<h2>Background options:</h2>
<?php
$this->select(	'page_bg_layout',
				'Layout',
				array('default' => 'Default', 'wide' => 'Wide', 'boxed' => 'Boxed')
			);
?>
<h2>Following options only work in boxed mode:</h2>
<?php $this->upload('page_bg', 'Background Image'); ?>
<?php
$this->text(	'page_bg_color',
				'Background Color (Hex Code)',
				''
			);
?>
<?php
$this->select(	'page_bg_full',
				'100% Background Image',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->select(	'page_bg_repeat',
				'Background Repeat',
				array('repeat' => 'Tile', 'repeat-x' => 'Tile Horizontally', 'repeat-y' => 'Tile Vertically', 'no-repeat' => 'No Repeat'),
				''
			);
?>
<h2>Following options work in boxed and wide mode:</h2>
<?php $this->upload('wide_page_bg', 'Background Image'); ?>
<?php
$this->text(	'wide_page_bg_color',
				'Background Color (Hex Code)',
				''
			);
?>
<?php
$this->select(	'wide_page_bg_full',
				'100% Background Image',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->select(	'wide_page_bg_repeat',
				'Background Repeat',
				array('repeat' => 'Tile', 'repeat-x' => 'Tile Horizontally', 'repeat-y' => 'Tile Vertically', 'no-repeat' => 'No Repeat'),
				''
			);
?>
<h2>Header background options:</h2>
<?php $this->upload('header_bg', 'Background Image'); ?>
<?php
$this->text(	'header_bg_color',
				'Background Color (Hex Code)',
				''
			);
?>
<?php
$this->select(	'header_bg_full',
				'100% Background Image',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->select(	'header_bg_repeat',
				'Background Repeat',
				array('repeat' => 'Tile', 'repeat-x' => 'Tile Horizontally', 'repeat-y' => 'Tile Vertically', 'no-repeat' => 'No Repeat'),
				''
			);
?>
<h2>Page title bar options:</h2>
<?php
$this->select(	'page_title',
				'Page Title Bar',
				array('default' => 'Default', 'yes' => 'Show', 'no' => 'Hide'),
				''
			);
?>
<?php
$this->select(	'page_title_text',
				'Page Title Bar Text',
				array('yes' => 'Show', 'no' => 'Hide'),
				''
			);
?>
<?php
$this->select(	'page_bg_repeat',
				'Background Repeat',
				array('repeat' => 'Tile', 'repeat-x' => 'Tile Horizontally', 'repeat-y' => 'Tile Vertically', 'no-repeat' => 'No Repeat'),
				''
			);
?>
<?php
$this->text(	'page_title_custom_text',
				'Page Title Bar Custom Text',
				''
			);
?>
<?php
$this->text(	'page_title_custom_subheader',
				'Page Title Bar Custom Subheader Text',
				''
			);
?>
<?php
$this->text(	'page_title_height',
				'Page Title Bar Height',
				''
			);
?>
<?php $this->upload('page_title_bar_bg', 'Page Title Bar Background'); ?>
<?php $this->upload('page_title_bar_bg_retina', 'Page Title Bar Background Retina'); ?>
<?php
$this->select(	'page_title_bar_bg_full',
				'100% Background Image',
				array('default' => 'Default', 'no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->text(	'page_title_bar_bg_color',
				'Page Title Bar Background Color (Hex Code)',
				''
			);
?>
<?php
$this->select(	'page_title_bg_parallax',
				'Parallax Background Image',
				array('default' => 'Default', 'no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
</div>