<?php
class FusionSC_Tagline {

    private $tagline_box_counter = 1;

    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_tagline-shortcode', array( $this, 'attr' ) );
		add_filter( 'fusion_attr_tagline-shortcode-reading-box', array( $this, 'reading_box_attr' ) );
		add_filter( 'fusion_attr_tagline-shortcode-button', array( $this, 'button_attr' ) );

		add_shortcode('tagline_box', array( $this, 'render' ) );

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
				'id'                  	=> '',
				'backgroundcolor'		=> strtolower( $smof_data['tagline_bg'] ),
				'border' 				=> '0px',
				'bordercolor' 			=> strtolower( $smof_data['tagline_border_color'] ),
				'button' 				=> '',
				'buttoncolor' 			=> 'default',
				'button_shape'			=> strtolower( $smof_data['button_shape'] ),
				'button_size'			=> strtolower( $smof_data['button_size'] ),
				'button_type'			=> strtolower( $smof_data['button_type'] ),
				'content_alignment'		=> 'left',				
				'description'			=> '',
				'highlightposition' 	=> 'left',
				'link'					=> '',
				'linktarget' 			=> '_self',
				'shadow' 				=> 'no',
				'shadowopacity' 		=> '0.7',
				'title'					=> '',
				'animation_type' 		=> '',
				'animation_direction' 	=> 'left',
				'animation_speed' 		=> ''
        	), $args
        );

        extract( $defaults );

        self::$args = $defaults;
        $additional_content = '';
        
		$styles = "<style type='text/css'>.reading-box-container-{$this->tagline_box_counter} .element-bottomshadow:before,.reading-box-container-{$this->tagline_box_counter} .element-bottomshadow:after{opacity:{$shadowopacity};}</style>";

		if( ( isset( $link ) && $link ) && 
			( isset( $button ) && $button ) &&
			self::$args['content_alignment'] != 'center'
		) {
			self::$args['button_class'] = ' continue';
			$additional_content = sprintf( '<a %s>%s</a>', FusionCore_Plugin::attributes( 'tagline-shortcode-button' ), $button );
		}

		if( isset( $title ) && $title ) {
			$additional_content .= sprintf( '<h2>%s</h2>',  $title );
		}

		if( isset( $description ) && $description ) {
			$additional_content .= sprintf( '<p>%s</p>',  $description );
		}
		
		if( ( isset( $link ) && $link ) && 
			( isset( $button ) && $button ) &&
			self::$args['content_alignment'] == 'center'
		) {
			self::$args['button_class'] = ' continue';
			$additional_content .= sprintf( '<a %s>%s</a>', FusionCore_Plugin::attributes( 'tagline-shortcode-button' ), $button );
		}		

		if( ( isset( $link ) && $link ) && ( isset( $button ) && $button ) ) {
			self::$args['button_class'] = ' mobile-button';
			$additional_content .= sprintf( '<a %s>%s</a>', FusionCore_Plugin::attributes( 'tagline-shortcode-button' ), $button );
		}

		$html = sprintf('%s<div %s><section %s>%s%s</section></div>', $styles, FusionCore_Plugin::attributes( 'tagline-shortcode' ), FusionCore_Plugin::attributes( 'tagline-shortcode-reading-box' ), do_shortcode( $content ), $additional_content );

		$this->tagline_box_counter++;

        return $html;

    }

    function attr() {

    	$attr = array();

		// FIXXXME had clearfix class; group mixin working?
        $attr['class'] = 'fusion-reading-box-container reading-box-container-' . $this->tagline_box_counter;

        if( self::$args['animation_type'] ) {
            $animations = FusionCore_Plugin::animations( array(
                'type'      => self::$args['animation_type'],
                'direction' => self::$args['animation_direction'],
                'speed'     => self::$args['animation_speed'],
            ) );

            $attr = array_merge( $attr, $animations );
            
            $attr['class'] .= ' ' . $attr['animation_class'];             
        }

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class'];
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id'];
        }

        return $attr;

    }
    
    function reading_box_attr() {
    	global $smof_data;
    
    	$attr = array();
    	
		$attr['class'] = 'reading-box';
    	
        if( self::$args['content_alignment'] == 'right' ) {
			$attr['class'] .= ' reading-box-right';
        } elseif( self::$args['content_alignment'] == 'center' ) {
        	$attr['class'] .= ' reading-box-center';
        }

		if( self::$args['shadow'] == 'yes' ) {
			$attr['class'] .= ' element-bottomshadow';
		}   	
		
		$attr['style'] = sprintf( 'background-color:%s;', self::$args['backgroundcolor'] );
		$attr['style'] .= sprintf( 'border-width:%s;', self::$args['border'] );
		$attr['style'] .= sprintf( 'border-color:%s;', self::$args['bordercolor'] );
		if( self::$args['highlightposition'] != 'none' ) {
			if( str_replace( 'px', '', self::$args['border'] ) > 3  ) {
				$attr['style'] .= sprintf( 'border-%s-width:%s;', self::$args['highlightposition'], self::$args['border'] );
			} else {
				$attr['style'] .= sprintf( 'border-%s-width:3px;', self::$args['highlightposition'] );
			}
			$attr['style'] .= sprintf( 'border-%s-color:%s;', self::$args['highlightposition'], $smof_data['primary_color'] );
		}
		$attr['style'] .= 'border-style:solid;';

        return $attr;    
    }

    function button_attr() {

    	$attr = array();

        $attr['class'] = sprintf( 'btn button btn-default fusion-button button-%s button-%s button-%s button-%s%s default', self::$args['buttoncolor'], 
        						  self::$args['button_shape'], self::$args['button_size'], self::$args['button_type'], self::$args['button_class'] );

		if( self::$args['content_alignment'] == 'right' ) {
			$attr['class'] .= ' continue-left';
		} elseif( self::$args['content_alignment'] == 'center' ) {
			$attr['class'] .= ' continue-center';
		} else {
			$attr['class'] .= ' continue-right';
		}

		$attr['href'] = self::$args['link'];
		$attr['target'] = self::$args['linktarget'];
		$attr['type'] = 'button';

        return $attr;

    }

}

new FusionSC_Tagline();