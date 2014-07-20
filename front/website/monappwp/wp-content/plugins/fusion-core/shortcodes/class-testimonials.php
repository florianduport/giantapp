<?php
class FusionSC_Testimonials {

	private $testimonials_counter = 1;

	public static $parent_args;
	public static $child_args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_testimonials-shortcode', array( $this, 'attr' ) );
		add_filter( 'fusion_attr_testimonials-shortcode-testimonials', array( $this, 'testimonials_attr' ) );
		add_filter( 'fusion_attr_testimonials-shortcode-quote', array( $this, 'quote_attr' ) );		
		add_filter( 'fusion_attr_testimonials-shortcode-review', array( $this, 'review_attr' ) );		
		add_filter( 'fusion_attr_testimonials-shortcode-thumbnail', array( $this, 'thumbnail_attr' ) );
		add_filter( 'fusion_attr_testimonials-shortcode-image', array( $this, 'image_attr' ) );

		add_shortcode( 'testimonials', array( $this, 'render_parent' ) );
		add_shortcode( 'testimonial', array( $this, 'render_child' ) );

    }

    /**
     * Render the parent shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_parent( $args, $content = '') {
    	global $smof_data;

		$defaults = FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'backgroundcolor' 	=> strtolower( $smof_data['testimonial_bg_color'] ),
				'textcolor' 		=> strtolower( $smof_data['testimonial_text_color'] ),
			), $args
		);

		extract( $defaults );

		self::$parent_args = $defaults;

		$styles = "<style type='text/css'>
		.fusion-testimonials.fusion-testimonials-{$this->testimonials_counter} .author:after{border-top-color:{$backgroundcolor} !important;}
		</style>
		";

		$html = sprintf( '<div %s>%s<div %s>%s</div></div>', FusionCore_Plugin::attributes( 'testimonials-shortcode' ), $styles,
						 FusionCore_Plugin::attributes( 'testimonials-shortcode-testimonials' ), do_shortcode($content) );

		$this->testimonials_counter++;

        return $html;

    }

	function attr() {

        $attr = array();

        $attr['class'] = 'fusion-testimonials fusion-testimonials-' . $this->testimonials_counter;

        if( self::$parent_args['class'] ) {
            $attr['class'] .= ' ' . self::$parent_args['class'];
        }

        if( self::$parent_args['id'] ) {
            $attr['id'] = self::$parent_args['id'];
        }

        return $attr;

    }

	function testimonials_attr() {

        $attr = array();

        $attr['class'] = 'reviews';

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
				'avatar'		=> 'male',
				'company'		=> '',
				'image'			=> '',
				'link'			=> '',
				'name'	 		=> '',
				'target'		=> '_self',
				
				'gender' 		=> '',	// Deprecated
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;	
		
		// check for deprecated
        if( $gender ) {
        	self::$child_args['avatar'] = $gender;
        }

		$inner_content = $thumbnail = $pic = '';
		if( $name ) {

			if( self::$child_args['avatar'] == 'image' && 
				$image 
			) {

				$image_id = FusionCore_Plugin::get_attachment_id_from_url( $image );
				self::$child_args['alt'] = '';
				if( $image_id ) {
					self::$child_args['alt'] = get_post_field( 'post_excerpt', $image_id );
				}

				$pic = sprintf( '<img %s />', FusionCore_Plugin::attributes( 'testimonials-shortcode-image' ) );
			}
			
			if( self::$child_args['avatar'] == 'image' && 
				! self::$child_args['image'] 
			) {
				self::$child_args['avatar'] = 'none';
			}
			
			if( self::$child_args['avatar'] != 'none' ) {
				$thumbnail = sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'testimonials-shortcode-thumbnail' ), $pic );
			}
			
			$inner_content .= sprintf( '<div %s>%s<span %s><strong>%s</strong>', FusionCore_Plugin::attributes( 'author' ), $thumbnail, FusionCore_Plugin::attributes( 'company-name' ), $name );

			if( $company ) {

				if( ! empty( $link ) && 
					$link 
				) {

					$inner_content .= sprintf( ', <a href="%s" target="%s">%s</a>', $link, $target, sprintf( '<span>%s</span>', $company ) );

				} else {

					$inner_content .= sprintf( ', <span>%s</span>', $company );

				}

			}

			$inner_content .= '</span></div>';
		}

		$html = sprintf( '<div %s><blockquote><q %s>%s</q></blockquote>%s</div>', FusionCore_Plugin::attributes( 'testimonials-shortcode-review' ), 
						 FusionCore_Plugin::attributes( 'testimonials-shortcode-quote' ), do_shortcode( $content ), $inner_content );


        return $html;

    }
    
	function quote_attr() {

        $attr = array();

		$attr['style'] = sprintf( 'background-color:%s;', self::$parent_args['backgroundcolor'] );
		$attr['style'] .= sprintf( 'color:%s;', self::$parent_args['textcolor'] );

        return $attr;

    }     
    
	function review_attr() {

        $attr = array();

        $attr['class'] = 'review ';

		if( self::$child_args['avatar'] == 'none' ) {
	        $attr['class'] .= 'no-avatar';
	    } else {
	   		$attr['class'] .= self::$child_args['avatar'];
	    }

        return $attr;

    }    

	function thumbnail_attr() {

        $attr = array();

        $attr['class'] = 'testimonial-thumbnail';

		if( self::$child_args['avatar'] != 'image' ) {
	        $attr['class'] .= ' doe';
	       }

        return $attr;

    }

	function image_attr() {

        $attr = array();

        $attr['class'] = 'testimonial-image';
		$attr['src'] = self::$child_args['image'];
		$attr['alt'] = self::$child_args['alt'];

        return $attr;

    }

}

new FusionSC_Testimonials();