<?php
class FusionSC_ImageCarousel {

	private $image_carousel_counter = 1;

    public static $parent_args;
    public static $child_args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

        add_filter( 'fusion_attr_image-carousel-shortcode', array( $this, 'attr' ) );
        add_filter( 'fusion_attr_image-carousel-shortcode-slide-link', array( $this, 'slide_link_attr' ) );

        add_shortcode( 'images', array( $this, 'render_parent' ) );
        add_shortcode( 'image', array( $this, 'render_child' ) );

    }

    /**
     * Render the parent shortcode
     * @param  array $args    Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_parent( $args, $content = '') {

        $defaults = FusionCore_Plugin::set_shortcode_defaults(
        	array(
            'picture_size' => 'fixed',
				'class'		=> '',
				'id'		=> '',
				'lightbox'	=> 'no',

        ), $args );

        extract( $defaults );

        self::$parent_args = $defaults;
        
		$html = sprintf( '<div %s><div %s><div %s><ul>%s</ul></div><div %s><span %s></span><span %s></span></div></div></div>', 
						 FusionCore_Plugin::attributes( 'image-carousel-shortcode' ), FusionCore_Plugin::attributes( 'es-carousel-wrapper fusion-carousel-small' ), 
						 FusionCore_Plugin::attributes( 'es-carousel' ), do_shortcode($content), FusionCore_Plugin::attributes( 'es-nav' ),
						 FusionCore_Plugin::attributes( 'es-nav-prev' ), FusionCore_Plugin::attributes( 'es-nav-next' ) );        

		$this->image_carousel_counter++;

        return $html;

    }

    function attr() {

        $attr = array();

        $attr['class'] = 'images-carousel-container fusion-image-carousel';

        if( self::$parent_args['lightbox'] == 'yes' ) {
          $attr['class'] .= ' lightbox-enabled';
        }

        if( self::$parent_args['picture_size'] == 'auto' ) {
          $attr['class'] .= ' picture-size-auto';
        }

        if( self::$parent_args['class'] ) {
            $attr['class'] .= ' ' . self::$parent_args['class']; 
        }

        if( self::$parent_args['id'] ) {
            $attr['id'] = self::$parent_args['id']; 
        }

        return $attr;

    }


    /**
     * Render the child shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_child( $args, $content = '') {

        $defaults = FusionCore_Plugin::set_shortcode_defaults(
        	array(       	
				'alt'        	=> '',
	            'image'      	=> '',				
	            'link'       	=> '',
	            'linktarget' 	=> '_self',
        	), $args 
        );

        extract( $defaults );

        self::$child_args = $defaults;
        
		$image_id = FusionCore_Plugin::get_attachment_id_from_url( $image );

		if( ! $alt && empty( $alt ) && $image_id ) {
			self::$child_args['alt'] = $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		}
		
		if( $image_id ) {
			self::$child_args['title_attr'] = get_post_field( 'post_excerpt', $image_id );
		}
		
        $output = sprintf( '<img src="%s" alt="%s" />', $image, $alt );

        if( $link || self::$parent_args['lightbox'] == 'yes' ) {
            $output = sprintf( '<a %s>%s</a>', FusionCore_Plugin::attributes( 'image-carousel-shortcode-slide-link' ), $output );
        }

        $html = sprintf( '<li><div %s>%s</div></li>', FusionCore_Plugin::attributes( 'image' ), $output );
        
        return $html;

    }
    
    function slide_link_attr() {

        $attr = array();

        if( self::$parent_args['lightbox'] == 'yes' ) {
            
          	if( ! self::$child_args['link'] ) {
          		self::$child_args['link'] = self::$child_args['image'];
          	}
          	
          	$attr['rel'] = sprintf( 'prettyPhoto[gallery_image_%s]', $this->image_carousel_counter );
        }

        $attr['href'] = self::$child_args['link'];
        
        $attr['target'] = self::$child_args['linktarget'];

        return $attr;

    }    

}

new FusionSC_ImageCarousel();