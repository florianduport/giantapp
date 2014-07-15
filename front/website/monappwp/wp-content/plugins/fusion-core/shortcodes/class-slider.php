<?php
class FusionSC_Slider {

	public static $parent_args;
	public static $child_args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_slider-shortcode', array( $this, 'attr' ) );
		add_filter( 'fusion_attr_slider-shortcode-slide-link', array( $this, 'slide_link_attr' ) );
		add_filter( 'fusion_attr_slider-shortcode-slide-li', array( $this, 'slide_li_attr' ) );	
		add_filter( 'fusion_attr_slider-shortcode-slide-img', array( $this, 'slide_img_attr' ) );

		add_shortcode( 'slider', array( $this, 'render_parent' ) );
		add_shortcode( 'slide', array( $this, 'render_child' ) );

    }

    /**
     * Render the parent shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_parent( $args, $content = '') {

		$defaults = shortcode_atts(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'height' 			=> '100%',				
				'width' 			=> '100%',
			), $args
		);

		extract( $defaults );

		self::$parent_args = $defaults;
		
		$html = sprintf( '<div %s><ul %s>%s</ul></div>', FusionCore_Plugin::attributes( 'slider-shortcode' ), FusionCore_Plugin::attributes( 'slides' ), do_shortcode( $content ) );

        return $html;

    }

	function attr() {

        $attr = array();

		// FIXXXME had clearfix class; group mixin working?
		$attr['class'] = 'fusion-slider-sc flexslider';

		$attr['style'] = sprintf( 'max-width:%s;height:%s;', self::$parent_args['width'], self::$parent_args['height'] );

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

		$defaults = shortcode_atts(
			array(
				'lightbox' 		=> 'no',
				'link' 			=> NULL,
				'linktarget' 	=> '_self',
				'type'			=> 'image',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
			
		self::$child_args['alt'] = '';
		self::$child_args['title'] = '';
		self::$child_args['src'] = $src = str_replace( '&#215;', 'x', $content );
		
		if( $lightbox == 'yes' && $type == 'image' ) {
		
			if( ! empty( $link ) && $link ) {
				$image_id = FusionCore_Plugin::get_attachment_id_from_url( $link );
			} else {
				$image_id = FusionCore_Plugin::get_attachment_id_from_url( $src );
			}

			if( $image_id ) {
				self::$child_args['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				self::$child_args['title'] = get_post_field( "post_excerpt", $image_id );
			}
		}
	
		if( isset( $link ) && empty( $link ) && ! $link && $type == 'image' ) {
			self::$child_args['link'] = $link = $src;
		}

		$html = sprintf( '<li %s>', FusionCore_Plugin::attributes( 'slider-shortcode-slide-li' ) );

		if( !empty( $link ) && $link ) {
			$html .= sprintf( '<a %s>', FusionCore_Plugin::attributes( 'slider-shortcode-slide-link' ) );
		}
		
		if( !empty( $type ) && $type == 'video') {
			$html .= sprintf( '<div %s>%s</div>', FusionCore_Plugin::attributes( 'full-video' ), do_shortcode($content) );
		} else {
			$html .= sprintf( '<img %s />', FusionCore_Plugin::attributes( 'slider-shortcode-slide-img' ) );
		}
		
		if( ! empty( $link ) && $link ) {
			$html .= '</a>';
		}
		
		$html .= '</li>';		

        return $html;

    }

	function slide_link_attr() {

		$attr = array();

		if( self::$child_args['lightbox'] == 'yes' ) {
			$attr['class'] = 'lightbox';
			$attr['rel'] = 'prettyPhoto';
		}
		
		$attr['href'] = self::$child_args['link'];
		$attr['target'] = self::$child_args['linktarget'];
		$attr['title'] = self::$child_args['title'];

		return $attr;

    }
    
	function slide_li_attr() {

		$attr = array();

		if( self::$child_args['type'] == 'video' ) {
			$attr['class'] = 'video';
		} else {
			$attr['class'] = 'image';
		}

		return $attr;

    }
    
	function slide_img_attr() {

		$attr = array();

		$attr['src'] = self::$child_args['src'];

		$attr['alt'] = self::$child_args['alt'];
	
		return $attr;

    }       

}

new FusionSC_Slider();