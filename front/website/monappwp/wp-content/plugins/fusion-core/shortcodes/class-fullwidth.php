<?php
class FusionSC_FullWidth {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fusion_attr_fullwidth-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'fullwidth', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {
		global $smof_data;

		$defaults =	FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',
				'id'						=> '',
				//'autoplay' 				=> 'no', not yet used
				'backgroundattachment' 		=> 'scroll',				
				'backgroundcolor'			=> $smof_data['full_width_bg_color'],
				'backgroundimage' 			=> '',
				'backgroundposition' 		=> 'left top',				
				'backgroundrepeat' 			=> 'no-repeat',
				'bordercolor' 				=> $smof_data['full_width_border_color'],
				'bordersize' 				=> $smof_data['full_width_border_size'],
				'borderstyle' 				=> 'solid',
				'menu_anchor' 				=> '',
				'paddingbottom' 			=> '20px',
				'paddingtop'				=> '20px',
				//'video_id' 				=> '', not yet used
				//'video_type'				=> '', not yet used
				'paddingBottom' 			=> '', // deprecated
				'paddingTop' 				=> '', // deprecated			
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		$this->depracted_args();

		if( $defaults['menu_anchor'] ) {
			$html = sprintf( '<div id="%s"><div %s><div %s>%s</div></div></div>', $defaults['menu_anchor'], FusionCore_Plugin::attributes( 'fullwidth-shortcode' ), FusionCore_Plugin::attributes( 'avada-row' ), do_shortcode( $content ) );
		} else {
			$html = sprintf( '<div %s><div %s>%s</div></div>', FusionCore_Plugin::attributes( 'fullwidth-shortcode' ), FusionCore_Plugin::attributes( 'avada-row' ), do_shortcode( $content ) );
		}

		return $html;

	}

	function attr() {

		$attr['class'] = 'fusion-fullwidth fullwidth-box hentry';
		$attr['style'] = '';

		/*if( self::$args['video_type'] ) {
			$attr['class'] .= ' video-background';
		}*/

		if( self::$args['backgroundattachment'] ) {
			$attr['style'] .= sprintf( 'background-attachment:%s;', self::$args['backgroundattachment'] );
		}

		if( self::$args['backgroundcolor'] ) {
			$attr['style'] .= sprintf( 'background-color:%s;', self::$args['backgroundcolor'] );
		}

		if( self::$args['backgroundimage'] ) {
			$attr['style'] .= sprintf( 'background-image: url(%s);', self::$args['backgroundimage'] );
		}

		if( self::$args['backgroundposition'] ) {
			$attr['style'] .= sprintf( 'background-position:%s;', self::$args['backgroundposition'] );
		}

		if( self::$args['backgroundrepeat'] ) {
			$attr['style'] .= sprintf( 'background-repeat:%s;', self::$args['backgroundrepeat'] );
		}
		
		if( self::$args['backgroundrepeat'] == 'no-repeat') {
			$attr['style'] .= '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
		}		

		if( self::$args['bordercolor'] ) {
			$attr['style'] .= sprintf( 'border-color:%s;', self::$args['bordercolor'] );
		}

		if( self::$args['bordersize'] ) {
			$attr['style'] .= sprintf( 'border-bottom-width: %s;border-top-width: %s;', self::$args['bordersize'], self::$args['bordersize'] );
		}
		
		if( self::$args['borderstyle'] ) {
			$attr['style'] .= sprintf( 'border-bottom-style: %s;border-top-style: %s;', self::$args['borderstyle'], self::$args['borderstyle'] );
		}		

		if( self::$args['paddingbottom'] ) {
			$attr['style'] .= sprintf( 'padding-bottom:%s;', self::$args['paddingbottom'] );
		}

		if( self::$args['paddingtop'] ) {
			$attr['style'] .= sprintf( 'padding-top:%s;', self::$args['paddingtop'] );
		}
		
		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}		

		return $attr;

	}
	
	private function depracted_args() {
		if( self::$args['paddingBottom'] ) {
			self::$args['paddingbottom'] = self::$args['paddingBottom'];
		}
		
		if( self::$args['paddingTop'] ) {
			self::$args['paddingtop'] = self::$args['paddingTop'];
		}		
	}

}

new FusionSC_FullWidth();
