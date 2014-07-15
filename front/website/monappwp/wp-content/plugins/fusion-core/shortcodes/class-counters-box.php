<?php
class FusionSC_CountersBox {

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fusion_attr_counters-box-shortcode', array( $this, 'parent_attr' ) );
		add_shortcode( 'counters_box', array( $this, 'render_parent' ) );

		add_filter( 'fusion_attr_counter-box-shortcode', array( $this, 'child_attr' ) );
		add_filter( 'fusion_attr_counter-box-shortcode-icon', array( $this, 'icon_attr' ) );
		add_filter( 'fusion_attr_counter-box-shortcode-unit', array( $this, 'unit_attr' ) );
		add_filter( 'fusion_attr_counter-box-shortcode-counter', array( $this, 'counter_attr' ) );
		add_filter( 'fusion_attr_counter-box-shortcode-counter-container', array( $this, 'counter_container_attr' ) );
		add_filter( 'fusion_attr_counter-box-shortcode-content', array( $this, 'content_attr' ) );
		add_shortcode( 'counter_box', array( $this, 'render_child' ) );

	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render_parent( $args, $content = '' ) {

		$defaults =	FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class'		=> '',			
				'id'		=> '',
				'columns' 	=> '4',
			), $args
		);

		extract( $defaults );

		self::$parent_args = $defaults;

		$html = sprintf( '<div %s>%s</div><div class="clearfix"></div>', FusionCore_Plugin::attributes( 'counters-box-shortcode' ), do_shortcode( $content ) );

		return $html;

	}

	function parent_attr() {

		$attr['class'] = sprintf( 'fusion-counters-box counters-box row fusion-clearfix fusion-columns-%s',  self::$parent_args['columns'] );

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
	 * 
	 * @param  array  $args     Shortcode paramters
	 * @param  string $content  Content between shortcode
	 * @return string           HTML output
	 */
	function render_child( $args, $content = '' ) {
		global $smof_data;

		$defaults =	FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class'			=> '',
				'id'			=> '',
				'border'		=> 'yes',
				'color'			=> strtolower( $smof_data['counter_box_color'] ),
				'direction'		=> 'up',
				'icon'			=> '',
				'unit'  		=> '',	
				'unit_pos'		=> 'suffix',
				'value' 		=> '20',
				'icon_size'		=> 'large',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;

		self::$child_args['value'] = intval( $value );

		$unit_output = '';
		if( $unit ) {
			$unit_output = sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'counter-box-shortcode-unit' ), $unit );
		}

		if( $direction	== 'up' ) {
			$init_value = 0;
		} else {
			$init_value = self::$child_args['value'];
		}

		$counter = sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'counter-box-shortcode-counter' ), $init_value );

		$icon_output = '';
		if( $icon ) {
			$icon_output = sprintf( '<i %s></i>', FusionCore_Plugin::attributes( 'counter-box-shortcode-icon' ) );
		}

		if( $unit_pos == 'prefix' ) {
			$counter = $icon_output . $unit_output . $counter;
		} else {
			$counter = $icon_output . $counter . $unit_output;
		}

		$counter_wrapper = sprintf( '<div %s>%s</div>', FusionCore_Plugin::attributes( 'counter-box-shortcode-counter-container' ), $counter );

		$content_output = sprintf( '<div %s>%s</div>', FusionCore_Plugin::attributes( 'counter-box-shortcode-content' ), do_shortcode( $content ) );

		$border_class = '';
		if( $border == 'yes' ) {
			$border_class .= ' counter-box-border';
		}

		$html = sprintf( '<div %s><div %s>%s</div></div>', FusionCore_Plugin::attributes( 'counter-box-shortcode' ), FusionCore_Plugin::attributes( 'counter-box-container ' . $border_class ), 
						 $counter_wrapper . $content_output );

		return $html;

	}

	function child_attr() {

		if( self::$parent_args['columns'] ) {
			$columns = 12 / self::$parent_args['columns'];
		} else {
			$columns = 4;
		}

		$attr['class'] = 'fusion-counter-box fusion-column col-counter-box counter-box-wrapper col-lg-' . $columns . ' col-md-' . $columns . ' col-sm-' . $columns;
		
		if( self::$child_args['class'] ) {
			$attr['class'] .= ' ' . self::$child_args['class'];
		}		
		
		if( self::$child_args['id'] ) {
			$attr['id'] = self::$child_args['id'];
		}		

		return $attr;

	}
	
	function icon_attr() {

		$attr['class'] = sprintf( 'counter-box-icon fa fontawesome-icon %s size-%s', FusionCore_Plugin::font_awesome_name_handler( self::$child_args['icon'] ),  self::$child_args['icon_size'] );

		return $attr;

	}	

	function unit_attr() {

		$attr['class'] = 'unit';

		return $attr;

	}

	function counter_attr() {

		$attr['class'] = 'display-counter';
		$attr['data-value'] = self::$child_args['value'];
		$attr['data-direction'] = self::$child_args['direction'];

		return $attr;

	}

	function counter_container_attr() {

		$attr['class'] = 'content-box-percentage content-box-counter';
		
		if( self::$child_args['color'] ) {
			$attr['style'] = sprintf( 'color:%s;', self::$child_args['color'] );
		}	

		return $attr;

	}

	function content_attr() {

		$attr['class'] = 'counter-box-content';

		return $attr;

	}

}

new FusionSC_CountersBox();
