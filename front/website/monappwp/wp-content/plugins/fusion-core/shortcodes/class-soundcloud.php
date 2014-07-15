<?php
class FusionSC_Soundcloud {

    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_soundcloud-shortcode', array( $this, 'attr' ) );
        add_shortcode('soundcloud', array( $this, 'render' ) );

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
				'class' 	=> 'fusion-soundcloud',
				'id' 		=> '',
				'auto_play' => 'true',
				'color' 	=> 'ff7700',
				'comments' 	=> 'true',
				'height' 	=> 81,
				'url' 		=> '',
				'width' 	=> '100%'
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		if( $comments == 'yes' ) {
			$comments = 'true';
		} elseif( $comments == 'no' ) {
			$comments = 'false';
		}

		if( $auto_play  == 'yes' ) {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}

		if( $color ) {
			$color = str_replace( '#', '', $color );
		}

		$html = sprintf( '<div %s><iframe width="%s" height="%s" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=%s&amp;show_comments=%s&amp;auto_play=%s&amp;color=%s"></iframe></div>',
						  FusionCore_Plugin::attributes( 'soundcloud-shortcode' ), $width, $height, $url, $comments, $autoplay, $color );

        return $html;

    }

	function attr() {

		$attr = array();

        if( self::$args['class'] ) {
            $attr['class'] = self::$args['class'];
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id'];
        }

        return $attr;

    }

}

new FusionSC_Soundcloud();