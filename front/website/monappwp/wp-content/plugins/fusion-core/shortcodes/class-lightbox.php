<?php
class FusionSC_Lightbox {

	public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_lightbox-shortcode', array( $this, 'attr' ) );
		
        add_shortcode('lightbox', array( $this, 'render' ) );

    }

    /**
     * Render the shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render( $args, $content = '' ) {

		$defaults = shortcode_atts(
			array(
				'class' 			=> 'fusion-lightbox',
				'id' 				=> '',
				'caption'			=> '',
				'content_type'		=> 'image',
				'lightbox_height'	=> '',				
				'lightbox_width'	=> '',				
				'src'				=> '',
				'thumbnail' 		=> '',
				'title'				=> '',
			), $args
		);
		
		extract( $defaults );

		self::$args = $defaults ;		

		$html = sprintf( '<a %s>%s</a>', FusionCore_Plugin::attributes( 'lightbox-shortcode' ), do_shortcode( $content ) );

        return $html;

    }

	function attr() {

		$attr = array();
		$options = array();

		$attr['class'] = 'lightbox-shortcode';

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' .  self::$args['class'];
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id'];
        }
        
        $attr['href'] = self::$args['src'];
        
        if( self::$args['caption'] ) {
	    	$attr['data-caption'] = self::$args['caption'];
        }
        
        if( self::$args['title'] ) {
	    	$attr['data-title'] = self::$args['title'];
        }
        
        if( self::$args['content_type'] ) {
	    	$attr['data-type'] = self::$args['content_type'];
        }     

		if( self::$args['thumbnail'] ) {
	    	$options['thumbnail'] = sprintf( '\'%s\'', self::$args['thumbnail'] );
        }
        
       	if( $attr['data-type'] ==  'video' ) {
			$options['icon'] ='\'video\'';
        }

		if( self::$args['lightbox_height'] ) {
		   	$options['height'] = self::$args['lightbox_height'];
        }
        
		if( self::$args['lightbox_width'] ) {
		   	$options['width'] = self::$args['lightbox_width'];
        }
        
        foreach ( $options as $key => $value ) {
        	$attr['data-options'] .= sprintf( '%s: %s, ', $key, $value );
        }
        
        return $attr;

    }

}

new FusionSC_Lightbox();