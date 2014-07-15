<?php
class FusionSC_WooFeaturedProductsSlider {

    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_woo-featured-products-slider-shortcode', array( $this, 'attr' ) );
        add_shortcode('featured_products_slider', array( $this, 'render' ) );

    }

    /**
     * Render the shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render( $args, $content = '' ) {
		global $woocommerce, $smof_data;

		$html = '';

		if( class_exists( 'Woocommerce' ) ) {

			$defaults = FusionCore_Plugin::set_shortcode_defaults(
				array(
					'class' 			=> '',
					'id' 				=> '',
					'post_type' 		=> 'product',
					'posts_per_page' 	=> -1,
					'meta_key' 			=> '_featured',
					'meta_value' 		=> 'yes',
				), $args
			);		

			extract( $defaults );

			self::$args = $defaults;

			$products = new WP_Query( self::$args );
			$products_wrapper = $product = '';

			if( $products->have_posts() ) {

				while( $products->have_posts() ) {
					$products->the_post();

					$image = $price_tag = $terms = $buttons = '';

					if( has_post_thumbnail() ) {

						if( $smof_data['image_rollover'] ) {
							$image = get_the_post_thumbnail( get_the_ID(), 'shop_single' );
						} else {
							$image = sprintf( '<a href="%s">%s</a>', get_permalink( get_the_ID() ), get_the_post_thumbnail( get_the_ID(), 'shop_single' ) );
						}

						$terms = get_the_term_list( get_the_ID(), 'product_cat', sprintf( '<span %s>', FusionCore_Plugin::attributes( 'cats' ) ), ', ', '</span>' );

						ob_start();
						woocommerce_get_template( 'loop/price.php' );
						$price = ob_get_contents();
						ob_end_clean();

						if( $price ) {
							$price_tag = $price;
						}

						ob_start();
						woocommerce_get_template('loop/add-to-cart.php');
						$cart_button = ob_get_contents();
						ob_end_clean();
						
						$buttons = sprintf( '<div %s>%s<a href="%s" %s>%s</a></div>', FusionCore_Plugin::attributes( 'product-buttons' ), $cart_button,
											get_permalink(), FusionCore_Plugin::attributes( 'show_details_button' ), __( 'Details', 'Avada' ) );						

						$product .= sprintf( '<li><div %s aria-haspopup="true">%s<div %s><div %s><h2><a href="%s">%s</a></h2>%s%s%s</div></div></div></li>', 
											 FusionCore_Plugin::attributes( 'image' ), $image,
											 FusionCore_Plugin::attributes( 'image-extras' ), FusionCore_Plugin::attributes( 'image-extras-content' ),
											 get_permalink(), get_the_title(), $terms, $price_tag, $buttons );

					}

				}

				$products_wrapper = sprintf('<ul>%s</ul>', $product );

			}

			$html = sprintf( '<div %s><div %s>%s</div><div %s><span %s></span><span %s></span></div><div class="fusion-clearfix"></div></div>', 
							 FusionCore_Plugin::attributes( 'woo-featured-products-slider-shortcode' ), FusionCore_Plugin::attributes( 'products-slider es-carousel' ), $products_wrapper,
							 FusionCore_Plugin::attributes( 'es-nav' ), FusionCore_Plugin::attributes( 'es-nav-prev' ), FusionCore_Plugin::attributes( 'es-nav-next' ) );

		}

		return $html;

    }

	function attr() {
	
		$attr['class'] = 'fusion-woo-featured-products-slider es-carousel-wrapper';

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class'];
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id'];
        }

        return $attr;

    }

}

new FusionSC_WooFeaturedProductsSlider();