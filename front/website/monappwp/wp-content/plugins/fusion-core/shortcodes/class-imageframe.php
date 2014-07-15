<?php
class FusionSC_Imageframe {

	private $imageframe_counter = 1;
    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

        add_filter( 'fusion_attr_imageframe-shortcode', array( $this, 'attr' ) );
        add_filter( 'fusion_attr_imageframe-shortcode-link', array( $this, 'link_attr' ) );
        
        add_shortcode( 'imageframe', array( $this, 'render' ) );

    }

    /**
     * Render the shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render( $args, $content = '') {
    	global $smof_data;

        $defaults = FusionCore_Plugin::set_shortcode_defaults(
        	array(
				'class'					=> '',        	
				'id'					=> '',				
				'align' 				=> '',
				'bordercolor' 			=> '',
				'bordersize' 			=> $smof_data['imageframe_border_size'],
				'lightbox' 				=> 'no',				
				'style' 				=> '',
				'style_type'			=> 'none',				
				'stylecolor' 			=> '',
				'animation_type' 		=> '',
				'animation_direction' 	=> 'left',
				'animation_speed' 		=> ''
        	), $args 
        );

        extract( $defaults );


		if( ! $style ) {
			$defaults['style'] = $style_type;
		}

        self::$args = $defaults;
        
		if( ! $bordercolor ) {
			$bordercolor = $smof_data['imgframe_border_color'];
		}

		if( ! $stylecolor ) {
			$stylecolor = $smof_data['imgframe_style_color'];
		}
		
		$rgb = FusionCore_Plugin::hex2rgb( $stylecolor );
		$styles = '';

		if( $bordersize != '0' ) {
			$styles .= ".imageframe-{$this->imageframe_counter} img{border:{$bordersize} solid {$bordercolor};}";
		}
		
		if( $style == 'glow' ) {
			$styles .= ".imageframe-{$this->imageframe_counter}.imageframe-glow img{
				-moz-box-shadow: 0 0 3px rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},.3);
				-webkit-box-shadow: 0 0 3px rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},.3);
				box-shadow: 0 0 3px rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},.3);
			}";
		}
		
		if( $style == 'dropshadow' ) {
			$styles .= ".imageframe-{$this->imageframe_counter}.imageframe-dropshadow img{
				-moz-box-shadow: 2px 3px 7px rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},.3);
				-webkit-box-shadow: 2px 3px 7px rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},.3);
				box-shadow: 2px 3px 7px rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},.3);
			}";
		}
		
		$styles = sprintf('<style type="text/css">%s</style>', $styles );
		
		$html = sprintf( '%s<span %s>', $styles, FusionCore_Plugin::attributes( 'imageframe-shortcode' ) );
		
		preg_match( '/(class=["\'](.*?)["\'])/', $content, $classes );
		$class_style = '';
		if ( $style == 'circle' ) {
			$class_style = ' img-circle';
		}

		if( $classes ) {
			$content = str_replace( $classes[0], sprintf( 'class="img-responsive %s%s"', $classes[2], $class_style ) , $content );
		} else {
			$content = str_replace( '/>', sprintf( 'class="img-responsive%s" />', $class_style ) , $content );
		}

		$alt_tag = '';
		
		if( isset( $image_id ) && $image_id ) {
			$alt_tag = sprintf( 'alt="%s"', get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
		}

		if( strpos( $content, 'alt=""' ) !== false && $alt_tag ) {
			$content = str_replace( 'alt=""', $alt_tag, $content );
		} elseif ( strpos( $content, 'alt' ) === false && $alt_tag ) {
			$content = str_replace( '/> ', $alt_tag . ' />', $content );
		}
		
		$output = do_shortcode( $content );		
		
		if( $lightbox == 'yes' ) {
			preg_match( '/(src=["\'](.*?)["\'])/', $content, $src );
			self::$args['link'] = $src[2];
			$image_id = FusionCore_Plugin::get_attachment_id_from_url( self::$args['link'] );
			self::$args['title_attr'] = '';
			if( $image_id ) {
				self::$args['title_attr'] = get_post_field( 'post_excerpt', $image_id );
			}
			$output = sprintf( '<a %s>%s</a>', FusionCore_Plugin::attributes( 'imageframe-shortcode-link' ), do_shortcode( $content ) );
		}

		$html .= $output . '</span>';

		if( $align == 'center' ) {
			$html = sprintf( '<div %s>%s</div>', FusionCore_Plugin::attributes( 'imageframe-align-center' ), $html );
		}

		$this->imageframe_counter++;		

        return $html;

    }

    function attr() {
    
    	$attr = array();
    	$attr['style'] = '';

        $attr['class'] = sprintf( 'fusion-imageframe imageframe imageframe-%s imageframe-%s', self::$args['style'], $this->imageframe_counter );

        if( self::$args['style'] == 'bottomshadow' ) {
            $attr['class'] .= ' element-bottomshadow'; 
        }		

        if( self::$args['align'] == 'left' ) {
            $attr['style'] .= 'margin-right:25px;float:left;'; 
        } elseif( self::$args['align'] == 'right' ) {
        	$attr['style'] .= 'margin-left:25px;float:right;';
		}      	

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class']; 
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id']; 
        }

        if( self::$args['animation_type'] ) {
            $animations = FusionCore_Plugin::animations( array(
                'type'      => self::$args['animation_type'],
                'direction' => self::$args['animation_direction'],
                'speed'     => self::$args['animation_speed'],
            ) );

            $attr = array_merge( $attr, $animations );
            
            $attr['class'] .= ' ' . $attr['animation_class'];             
        }

        return $attr;

    }
    
    function link_attr() {
    
    	$attr = array();

        $attr['href'] = self::$args['link'];
		$attr['class'] = 'lightbox-shortcode';
		$attr['rel'] = 'prettyPhoto';

        return $attr;

    }    

}

new FusionSC_Imageframe();