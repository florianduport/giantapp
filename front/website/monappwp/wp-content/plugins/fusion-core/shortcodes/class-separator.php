<?php
class FusionSC_Separator {

    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

        add_filter( 'fusion_attr_separator-shortcode', array( $this, 'attr' ) );
        add_filter( 'fusion_attr_separator-shortcode-icon-wrapper', array( $this, 'icon_wrapper_attr' ) );
        add_filter( 'fusion_attr_separator-shortcode-icon', array( $this, 'icon_attr' ) );
        
        add_shortcode( 'separator', array( $this, 'render' ) );

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
				'class'			=> '',
				'id'			=> '',
				'bottom_margin'	=> '',
				'icon'			=> '',
				'sep_color'		=> $smof_data['sep_color'],
                'style_type'    => 'none',
			   	'top_margin'	=> '',
			   	'width'			=> '',
			   	'bottom'		=> '',	//deprecated
			   	'color'			=> '',	//deprecated
			   	'style' 		=> '',	//deprecated
			   	'top'			=> '',	//deprecated
        	), $args 
        );

        if( $defaults['style'] ) {
            $defaults['style_type'] = $defaults['style'];
        }		

        extract( $defaults );

        self::$args = $defaults;
        
        if( $bottom ) {
        	self::$args['bottom_margin'] = $bottom;
        }
        
        if( $color ) {
        	self::$args['sep_color'] = $color;
        }

		if( $top ) {
        	self::$args['top_margin'] = $top;
        	
        	if( ! $bottom && $defaults['style'] != 'none' ) {
        		self::$args['bottom_margin'] = $top;
        	}
        }
        
        if ( $icon && 
        	 $style_type != 'none'
        ) {
        	$icon_insert = sprintf( '<span %s><i %s></i></span>', FusionCore_Plugin::attributes( 'separator-shortcode-icon-wrapper' ), FusionCore_Plugin::attributes( 'separator-shortcode-icon' ) );
        } else {
            $icon_insert = '';
        }

		$html = sprintf( '<div %s></div><div %s>%s</div>', FusionCore_Plugin::attributes( 'fusion-sep-clear' ), FusionCore_Plugin::attributes( 'separator-shortcode' ), $icon_insert );

        return $html;

    }

    function attr() {
    
    	$attr = array();
    
		$attr['class'] = sprintf( 'fusion-separator' );    
        $attr['style'] = '';

		$styles = explode( '|', self::$args['style_type'] );
		
		if( ! in_array( 'none', $styles ) && 
			! in_array( 'single', $styles ) && 
			! in_array( 'double', $styles ) && 
			! in_array( 'shadow', $styles ) 
		) {
			$styles[] .= 'single';
		}

		foreach ( $styles as $style ) {
			$attr['class'] .= ' sep-' . $style;
		}

		if( self::$args['sep_color'] ) {
			$attr['style'] = sprintf( 'border-color:%s;', self::$args['sep_color'] );
		}
		
		$attr['style'] .= sprintf( 'margin-top:%spx;', self::$args['top_margin'] );		
	
		if( self::$args['bottom_margin'] ) {
			$attr['style'] .= sprintf( 'margin-bottom:%spx;', self::$args['bottom_margin'] );
		}
		
		if( self::$args['width'] ) {
			$attr['style'] .= sprintf( 'width:%s;', self::$args['width'] );
		}

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class']; 
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id']; 
        }

        return $attr;

    }
    
    function icon_wrapper_attr() {
    
    	$attr = array();
    	
    	$attr['class'] = 'icon-wrapper';
    	
    	$attr['style'] = sprintf( 'border-color:%s;', self::$args['sep_color'] );
    	
        return $attr;

    }
    
    function icon_attr() {
    
    	$attr = array();
    	
    	$attr['class'] = sprintf( 'fa %s', FusionCore_Plugin::font_awesome_name_handler( self::$args['icon'] ) );
    	
    	$attr['style'] = sprintf( 'color:%s;', self::$args['sep_color'] );
    	
        return $attr;

    }       

}

new FusionSC_Separator();