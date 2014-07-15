<?php
class FusionSC_SectionSeparator {

    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

        add_filter( 'fusion_attr_section-separator-shortcode', array( $this, 'attr' ) );
        add_filter( 'fusion_attr_section-separator-shortcode-icon', array( $this, 'icon_attr' ) );
        add_filter( 'fusion_attr_section-separator-shortcode-divider-candy', array( $this, 'divider_candy_attr' ) );
        
        add_shortcode( 'section_separator', array( $this, 'render' ) );

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
				'class'				=> '',
				'id'				=> '',
				'backgroundcolor' 	=> $smof_data['section_sep_bg'],
				'bordersize' 		=> $smof_data['section_sep_border_size'],
				'bordercolor' 		=> $smof_data['section_sep_border_color'],
				'divider_candy' 	=> '',
				'icon' 				=> '',
				'icon_color' 		=> $smof_data['icon_color'],
        	), $args 
        );
        
		extract( $defaults );

		self::$args = $defaults;        
        
		if( $icon ) {
			if( ! $icon_color ) {
				self::$args['icon_color'] = $bordercolor;
			}

			$icon = sprintf( '<div %s></div>', FusionCore_Plugin::attributes( 'section-separator-shortcode-icon' ) );
		}

		if( $divider_candy == 'bottom' ) {
			$candy = sprintf( '<div %s></div>', FusionCore_Plugin::attributes( 'section-separator-shortcode-divider-candy', array( 'divider_candy' => 'bottom' ) ) );
		} elseif( $divider_candy == 'top' ) {
			$candy = sprintf( '<div %s></div>', FusionCore_Plugin::attributes( 'section-separator-shortcode-divider-candy', array( 'divider_candy' => 'top' ) ) );
		} elseif( strpos($divider_candy, 'top') !== false && 
				  strpos($divider_candy, 'bottom') !== false 
		) {
			$candy = sprintf( '<div %s></div><div %s></div>', FusionCore_Plugin::attributes( 'section-separator-shortcode-divider-candy', array( 'divider_candy' => 'top' ) ), 
							  FusionCore_Plugin::attributes( 'section-separator-shortcode-divider-candy', array( 'divider_candy' => 'bottom' ) ) );
		}
	
		$html = sprintf( '<div %s>%s%s</div>', FusionCore_Plugin::attributes( 'section-separator-shortcode' ), $icon, $candy );

        return $html;

    }

    function attr() {
    
    	$attr = array();
    
		$attr['class'] = 'fusion-section-separator section-separator';
    
		if( self::$args['bordercolor'] ) {
			$attr['style'] = sprintf( 'border:%s solid %s;', self::$args['bordersize'], self::$args['bordercolor'] );
		}

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class']; 
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id']; 
        }

        return $attr;

    }
    
    
    function icon_attr() {
    
    	$attr = array();
    	
    	$attr['class'] = sprintf( 'section-separator-icon icon fa %s', FusionCore_Plugin::font_awesome_name_handler( self::$args['icon'] ) );
    	
    	$attr['style'] = sprintf( 'color:%s;', self::$args['icon_color'] );
    	
        return $attr;

    }
    
    function divider_candy_attr( $args ) {
    
    	$attr = array();
    	
    	$attr['class'] = 'divider-candy';

		if( $args['divider_candy'] == 'bottom' ) {
			$attr['class'] .= ' bottom';
			
			$attr['style'] = sprintf( 'background-color:%s;border-bottom:%s solid %s;border-left:%s; solid %s', self::$args['backgroundcolor'], self::$args['bordersize'], self::$args['bordercolor'], self::$args['bordersize'], self::$args['bordercolor'] );
			
		} elseif( $args['divider_candy'] == 'top' ) {
			$attr['class'] .= ' top';
			
			$attr['style'] = sprintf( 'background-color:%s;border-bottom:%s solid %s;border-left:%s; solid %s', self::$args['backgroundcolor'], self::$args['bordersize'], self::$args['bordercolor'], self::$args['bordersize'], self::$args['bordercolor'] );
		
		}
		
        return $attr;

    }    

}

new FusionSC_SectionSeparator();