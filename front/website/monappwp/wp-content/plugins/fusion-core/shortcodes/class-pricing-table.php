<?php
class FusionSC_PricingTable {

	private $pricing_table_counter = 1;
	private $is_first_row = true;
	private $is_first_column = true;
	private $is_list_group_closed = false;

	public static $parent_args;
	public static $child_column_args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_pricingtable-shortcode', array( $this, 'attr' ) );
		add_filter( 'fusion_attr_pricingtable-shortcode-column-wrapper', array( $this, 'column_wrapper_attr' ) );	
		add_filter( 'fusion_attr_pricingtable-shortcode-price', array( $this, 'price_attr' ) );
		add_filter( 'fusion_attr_pricingtable-shortcode-row', array( $this, 'row_attr' ) );
		add_filter( 'fusion_attr_pricingtable-shortcode-footer', array( $this, 'footer_attr' ) );

		add_shortcode( 'pricing_table', array( $this, 'render_parent' ) );
		add_shortcode( 'pricing_column', array( $this, 'render_child_column' ) );
		add_shortcode( 'pricing_price', array( $this, 'render_child_price' ) );
		add_shortcode( 'pricing_row', array( $this, 'render_child_row' ) );
		add_shortcode( 'pricing_footer', array( $this, 'render_child_footer' ) );

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
				'backgroundcolor' 	=> $smof_data['pricing_bg_color'],
				'bordercolor' 		=> $smof_data['pricing_border_color'],
				'columns'			=> '',
				'dividercolor' 		=> $smof_data['pricing_divider_color'],
				'type'				=> '1',
			), $args
		);

		extract( $defaults );

		self::$parent_args = $defaults;
		
		$this->set_num_of_columns( $content );		
		
		$this->is_first_column = true;

		$styles = "<style type='text/css'>
		.pricing-table-{$this->pricing_table_counter} .panel-container, .pricing-table-{$this->pricing_table_counter} .standout .panel-container,
		.pricing-table-{$this->pricing_table_counter}.full-boxed-pricing {background-color:{$bordercolor};}
		.pricing-table-{$this->pricing_table_counter} .list-group .list-group-item,
		.pricing-table-{$this->pricing_table_counter} .list-group .list-group-item:last-child{background-color:{$backgroundcolor}; border-color:{$dividercolor};}
		.pricing-table-{$this->pricing_table_counter}.full-boxed-pricing .panel-wrapper:hover .panel-heading,
		.pricing-table-{$this->pricing_table_counter} .panel-wrapper:hover .list-group-item {background-color:$bordercolor;}
		.pricing-table-{$this->pricing_table_counter}.full-boxed-pricing .panel-heading{background-color:{$backgroundcolor};}
		.pricing-table-{$this->pricing_table_counter} .panel, .pricing-table-{$this->pricing_table_counter} .panel-wrapper:last-child .panel, 
		.pricing-table-{$this->pricing_table_counter} .standout .panel, .pricing-table-{$this->pricing_table_counter}  .panel-heading, 
		.pricing-table-{$this->pricing_table_counter} .panel-body, .pricing-table-{$this->pricing_table_counter} .panel-footer{border-color:{$dividercolor};}
		.pricing-table-{$this->pricing_table_counter} .panel-body,.pricing-table-{$this->pricing_table_counter} .panel-footer{background-color:{$bordercolor};}
		</style>";		

		$html = sprintf( '%s<div %s>%s</div>', $styles, FusionCore_Plugin::attributes( 'pricingtable-shortcode' ), do_shortcode($content) );

		$this->pricing_table_counter++;

        return $html;

    }

	function attr() {

        $attr = array();
        
		if( self::$parent_args['type'] == '1' ) {
			$type = 'full';
		} else {
			$type = 'sep';
		}
        
        $attr['class'] = sprintf( 'fusion-pricing-table pricing-table-%s %s-boxed-pricing row fusion-columns-%s columns-%s fusion-clearfix', 
        						  $this->pricing_table_counter, $type, self::$parent_args['columns'], self::$parent_args['columns'] );

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
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_child_column( $args, $content = '') {

		$defaults = FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class' 	=> 'fusion-pricingtable-column',
				'id' 		=> '',			
				'standout'	=> 'no',
				'title'		=> '',
			), $args
		);

		extract( $defaults );
		
		self::$child_column_args = $defaults;	
		
		$this->is_first_row = true;

		$html = sprintf( '<div %s><div %s><div %s><div %s><h3 %s>%s</h3></div>%s', FusionCore_Plugin::attributes( 'pricingtable-shortcode-column-wrapper' ), 
						 FusionCore_Plugin::attributes( 'panel-container' ), FusionCore_Plugin::attributes( 'panel' ), FusionCore_Plugin::attributes( 'panel-heading' ), 
						 FusionCore_Plugin::attributes( 'title-row' ), $title, do_shortcode( $content ) );

		if( ! $this->is_list_group_closed ) {
			$html .= '</ul>';
		}
		
		$html .= '</div></div></div>';

        return $html;

    }
    
	function column_wrapper_attr() {
	
		$attr = array();

		if( self::$parent_args['type'] == '1' && self::$parent_args['columns'] > 6 ) {
			self::$parent_args['columns'] = 6;
		}
		
		if( self::$parent_args['type'] == '2' && self::$parent_args['columns'] > 4 ) {
			self::$parent_args['columns'] = 4;
		}		
		
		if( self::$parent_args['columns'] ) {
			$columns = 12 / self::$parent_args['columns'];
		} else {
			$columns = 4;
		}
		
		$attr['class'] = 'panel-wrapper fusion-column column col-lg-' . $columns . ' col-md-' . $columns . ' col-sm-' . $columns;
		
		if( self::$parent_args['columns'] == '5'  ) {
			$attr['class'] = 'panel-wrapper col-lg-2 col-md-2 col-sm-2';
		}
		
		if( self::$child_column_args['standout'] == 'yes' ) {
			$attr['class'] .= ' standout';
		}
				
		if( self::$child_column_args['class'] ) {
			$attr['class'] .= ' ' . self::$child_column_args['class'];
		}

		if( self::$child_column_args['id'] ) {
			$attr['id'] = self::$child_column_args['id'];
		}

        return $attr;

    }
    
    /**
     * Render the child shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_child_price( $args, $content = '') {

		$defaults = FusionCore_Plugin::set_shortcode_defaults(
			array(
				'currency'			=> '$',
				'currency_position' => 'left',
				'price'				=> '15.55',
				'time'				=> 'monthly',
			), $args
		);

		extract( $defaults );
		
		if( isset( $currency ) && ! empty( $currency ) && isset( $price ) && ( ! empty( $price ) || ( $price == '0') ) ) {

			$pricing_class = $pricing = '';
			$price = explode( '.' , $price );
			if( $price[1] ){
				$pricing_class = 'price-with-decimal';
			}

			if( $currency_position != 'right' ){
				$pricing = sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'currency' ), $currency );
			}
			
			$pricing .= sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'integer-part' ), $price[0] );			
			
			if( $price[1] ){
				$pricing .= sprintf( '<sup %s>%s</sup>', FusionCore_Plugin::attributes( 'decimal-part' ), $price[1] );
			}
			
			if( $currency_position == 'right' ){
				$pricing .= sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'currency pos-right' ), $currency );
				
				if( $time ) {
					$pricing .= sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'time pos-right' ), $time );
				}				
			}			
			
			if( $time &&
				$currency_position != 'right'
			) {
				$pricing .= sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'time' ), $time );
			}			
		
			$html = sprintf( '<div %s><div %s>%s</div></div>%s', FusionCore_Plugin::attributes( 'panel-body pricing-row' ), FusionCore_Plugin::attributes( 'price ' . $pricing_class ), 
							  $pricing, do_shortcode( $content ) );
			
		} else {
		
			$html = do_shortcode( $content );
		
		}

        return $html;

    }
    
    /**
     * Render the child shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_child_row( $args, $content = '') {
		
		$html = '';
		
		if( $this->is_first_row ) {
			$html = sprintf( '<ul %s>', FusionCore_Plugin::attributes( 'list-group' ) );
			$this->is_first_row = false;
		}	
		
		$html .= sprintf( '<li %s>%s</li>', FusionCore_Plugin::attributes( 'list-group-item normal-row' ), do_shortcode( $content ) );

        return $html;

    }
    
    /**
     * Render the child shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render_child_footer( $args, $content = '') {
		
		$html = sprintf( '</ul><div %s>%s</div>', FusionCore_Plugin::attributes( 'panel-footer footer-row' ), do_shortcode( $content ) );

		$this->is_list_group_closed = true;

        return $html;

    }
    
    /**
     * Calculate the number of columns automatically
     * @param  string $content Content to be parsed
     */    
    function set_num_of_columns( $content ) {
		if( ! self::$parent_args['columns'] ) {
			preg_match_all( '/(\[pricing_column (.*?)\](.*?)\[\/pricing_column\])/s', $content, $matches );
			if( is_array( $matches ) && 
				! empty( $matches ) 
			) {
				self::$parent_args['columns'] = count( $matches[0] );
				if( self::$parent_args['type'] == '1' && 
					self::$parent_args['columns'] > 6 
				) {
					self::$parent_args['columns'] = 6;
				}
				
				if( self::$parent_args['type'] == '2' && 
					self::$parent_args['columns'] > 5 
				) {
					self::$parent_args['columns'] = 5;
				}				
			} else {
				if( self::$parent_args['type'] == '1' ) {
					self::$parent_args['columns'] = 6;
				} else {
					self::$parent_args['columns'] = 5;
				}
			}
		} elseif( self::$parent_args['type'] == '1' && 
				  self::$parent_args['columns'] > 6 
		) {
			self::$parent_args['columns'] = 6;
		} elseif( self::$parent_args['type'] == '2' && 
			self::$parent_args['columns'] > 5 
		) {
			self::$parent_args['columns'] = 5;
		}
	}

}

new FusionSC_PricingTable();