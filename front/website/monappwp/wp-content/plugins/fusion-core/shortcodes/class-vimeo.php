<?php
class FusionSC_Vimeo {

    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_vimeo-shortcode', array( $this, 'attr' ) );
		add_filter( 'fusion_attr_vimeo-shortcode-video-sc', array( $this, 'video_sc_attr' ) );

        add_shortcode('vimeo', array( $this, 'render' ) );

    }

    /**
     * Render the shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render( $args, $content = '' ) {

		$defaults = FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class' 		=> '',
				'api_params'	=> '',				
				'autoplay' 		=> 'no',				
				'center'		=> 'no',
				'height' 		=> 360,
				'id' 			=> '',				
				'width' 		=> 600
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		$protocol = ( is_ssl() ) ? 's' : '';

		if( $autoplay == 'true' ||
			$autoplay == 'yes'
		) {
			$autoplay = '?autoplay=1';
		} else {
			$autoplay = '?autoplay=0';
		}

		$html = sprintf( '<div %s><div %s><iframe src="http%s://player.vimeo.com/video/%s%s%s" width="%s" height="%s" frameborder="0"></iframe></div></div>',
						 FusionCore_Plugin::attributes( 'vimeo-shortcode' ), FusionCore_Plugin::attributes( 'vimeo-shortcode-video-sc' ), $protocol, $id, $autoplay, $api_params, $width, $height );


        return $html;

    }

	function attr() {

		$attr = array();

		$attr['class'] = 'fusion-vimeo';

		if( self::$args['center'] == 'yes' ) {
			$attr['class'] .= ' center-video';
		} else {
			$attr['style'] = sprintf( 'max-width:%spx;max-height:%spx;', self::$args['width'], self::$args['height'] );
		}

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class'];
        }

        return $attr;

    }

	function video_sc_attr() {

		$attr = array();

		$attr['class'] = 'video-shortcode';

		if( self::$args['center'] == 'yes' ) {
			$attr['style'] = sprintf( 'max-width:%spx;max-height:%spx;', self::$args['width'], self::$args['height'] );
		}

        return $attr;

    }

}

new FusionSC_Vimeo();