<?php
/**
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $smof_data;

// Store column count for displaying the grid
if( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
}

// Reset according to sidebar or fullwidth pages
if( is_shop() || is_product_category() || is_product_tag() ) {
	$pageID = get_option( 'woocommerce_shop_page_id' );

	$custom_fields = get_post_custom_values( '_wp_page_template', $pageID );
	if( is_array( $custom_fields ) &&
		! empty( $custom_fields)
	) {
		$page_template = $custom_fields[0];
	} else {
		$page_template = '';
	}


	if( get_post_meta($pageID, 'pyre_full_width', true ) == 'yes' ||
		$page_template == 'full-width.php' ||
		( ( is_product_category() || is_product_tag() ) && $smof_data['woocommerce_archive_sidebar'] == 'None' )
	) {
		$woocommerce_loop['columns'] = 4;
	} else {
		$woocommerce_loop['columns'] = 3;
	}

}
?>
<ul class="products clearfix products-<?php echo $woocommerce_loop['columns']; ?>">