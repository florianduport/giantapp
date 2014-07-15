<?php
function avada_header_template( $slider_position = 'Below' ) {
	global $smof_data;

	if( $smof_data['header_transparent'] ) {
		$smof_data['slider_position'] = 'Below';
		$slider_position = 'Below';
	}

	if( $slider_position == 'Below' ) {
		$reverse_position = 'Above';
	} else {
		$reverse_position = 'Below';
	}
	$c_pageID = get_queried_object_id();

	if( ( ! $smof_data['slider_position'] ||
	    ( $smof_data['slider_position'] == $slider_position && get_post_meta( $c_pageID, 'pyre_slider_position', true ) != strtolower( $reverse_position ) ) ||
	    ( $smof_data['slider_position'] != $slider_position && get_post_meta( $c_pageID, 'pyre_slider_position', true ) == strtolower( $slider_position ) ) ) &&
		! is_page_template( 'blank.php' ) &&
		get_post_meta($c_pageID, 'pyre_display_header', true) != 'no'
	) {
?>
			<div class="header-wrapper">
				<?php
				if($smof_data['header_layout']) {
					if(is_page('header-2')) {
						get_template_part('framework/headers/header-v2');
					} elseif(is_page('header-3')) {
						get_template_part('framework/headers/header-v3');
					} elseif(is_page('header-4')) {
						get_template_part('framework/headers/header-v4');
					} elseif(is_page('header-5')) {
						get_template_part('framework/headers/header-v5');
					} else {
						get_template_part('framework/headers/header-' . $smof_data['header_layout']);
					}
				} else {
					if(is_page('header-2')) {
						get_template_part('framework/headers/header-v2');
					} elseif(is_page('header-3')) {
						get_template_part('framework/headers/header-v3');
					} elseif(is_page('header-4')) {
						get_template_part('framework/headers/header-v4');
					} elseif(is_page('header-5')) {
						get_template_part('framework/headers/header-v5');
					} else {
						get_template_part('framework/headers/header-' . $smof_data['header_layout']);
					}
				}
				?>
				<div class="init-sticky-header"></div>		
			</div>
			<?php get_template_part('framework/headers/sticky-header'); ?>
<?php }
}