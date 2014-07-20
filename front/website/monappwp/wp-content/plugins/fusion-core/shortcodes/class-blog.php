<?php
class FusionSC_Blog {

	private $post_count = 1;
	private $post_id = 0;
	private $post_month = null;
	private $header = array();
	private $query = '';

    public static $args;

    /**
     * Initiate the shortcode
     */
    public function __construct() {

		// containers
		add_action( 'fusion_blog_shortcode_before_loop', array( $this, 'before_loop' ) );
		add_action( 'fusion_blog_shortcode_before_loop_timeline', array( $this, 'before_loop_timeline' ) );
		add_action( 'fusion_blog_shortcode_after_loop', array( $this, 'after_loop' ) );

		// post / loop basic structure
		add_action( 'fusion_blog_shortcode_loop_header', array( $this, 'loop_header' ) );
		add_action( 'fusion_blog_shortcode_loop_footer', array( $this, 'loop_footer' ) );
		add_action( 'fusion_blog_shortcode_loop_content', array( $this, 'loop_content' ) );
		add_action( 'fusion_blog_shortcode_loop_content', array( $this, 'page_links' ) );
		add_action( 'fusion_blog_shortcode_loop', array( $this, 'loop' ) );

		// special blog layout structure
		add_action( 'fusion_blog_shortcode_wrap_loop_open', array( $this, 'wrap_loop_open' ) );
		add_action( 'fusion_blog_shortcode_wrap_loop_close', array( $this, 'wrap_loop_close' ) );
		add_action( 'fusion_blog_shortcode_date_and_format', array( $this, 'date_and_format' ) );
		add_action( 'fusion_blog_shortcode_timeline_date', array( $this, 'timeline_date' ) );
		add_action( 'fusion_blog_shortcode_entry_meta_alternate', array( $this, 'entry_meta_alternate' ) );
		add_action( 'fusion_blog_shortcode_entry_meta_grid_timeline', array( $this, 'entry_meta_grid_timeline' ) );

		// loop footer content
		add_action( 'fusion_blog_shortcode_entry_meta_default', array( $this, 'entry_meta_default' ) );

		// element attributes
		add_filter( 'fusion_attr_blog-shortcode', array( $this, 'attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-posts-container', array( $this, 'posts_container_attr' ) );
		
		
		add_filter( 'fusion_attr_blog-shortcode-loop', array( $this, 'loop_attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-post-title', array( $this, 'post_title_attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-entry-meta', array( $this, 'entry_meta_attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-entry-meta-details', array( $this, 'entry_meta_details_attr' ) );		
		add_filter( 'fusion_attr_blog-shortcode-meta-author', array( $this, 'meta_author_attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-meta-author-link', array( $this, 'meta_author_link_attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-meta-date', array( $this, 'meta_date_attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-meta-date-updated', array( $this, 'meta_date_updated_attr' ) );
		add_filter( 'fusion_attr_blog-shortcode-meta-tags', array( $this, 'meta_tags_attr' ) );
		
        add_shortcode( 'blog', array( $this, 'render' ) );

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
				'class'               	=> '',
				'id'                 	=> '',
				'blog_grid_columns'   	=> '3',
				'cat_slug'			  	=> '',
				'excerpt'			  	=> 'yes',
				'excerpt_length'	 	=> '',
				'excerpt_words'		  	=> '50',	//depracted	
				'exclude_cats'		  	=> '',
				'layout' 			  	=> 'large',
				'meta_all'			  	=> 'yes',
				'meta_author' 		  	=> 'yes',
				'meta_categories'  	  	=> 'yes',
				'meta_comments'  	  	=> 'yes',
				'meta_date' 		  	=> 'yes',
				'meta_link'  	  	  	=> 'yes',
				'meta_read'				=> 'yes',
				'meta_tags'  	  	  	=> 'no',
				'number_posts'			=> '',
				'order'               	=> 'DESC',
				'paging'			  	=> 'yes',
				'scrolling'		      	=> 'infinite',
				'strip_html'		  	=> 'yes',
				'thumbnail'			  	=> 'yes',
				'title'				  	=> 'yes',
				'title_link'			=> 'yes',
				'nopaging'				=> false,	//depracted
				'posts_per_page'	  	=> '-1',
				'taxonomy'            	=> 'category'
        	), $args
        );

        extract( $defaults );

		if( is_front_page() || 
			is_home() 
		) {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
		} else {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		}

		$defaults['paged'] = $paged;
		
		// covert all attributes to correct values for WP query		
		if( $defaults['number_posts'] ) {
			$defaults['posts_per_page'] = $defaults['number_posts'];
		}
		
		if( $defaults['posts_per_page'] == -1 ) {
			$defaults['nopaging'] = true;
		}

		( $defaults['excerpt'] == "yes" ) 			? ( $defaults['excerpt'] = true ) 			: ( $defaults['excerpt'] = false );
		( $defaults['meta_all'] == "yes" ) 			? ( $defaults['meta_all'] = true ) 			: ( $defaults['meta_all'] = false );
		( $defaults['meta_author'] == "yes" ) 		? ( $defaults['meta_author'] = true ) 		: ( $defaults['meta_author'] = false );
		( $defaults['meta_categories'] == "yes" ) 	? ( $defaults['meta_categories'] = true ) 	: ( $defaults['meta_categories'] = false );
		( $defaults['meta_comments'] == "yes" ) 	? ( $defaults['meta_comments'] = true) 		: ( $defaults['meta_comments'] = false );
		( $defaults['meta_date'] == "yes" ) 		? ( $defaults['meta_date'] = true ) 		: ( $defaults['meta_date'] = false );
		( $defaults['meta_link'] == "yes" ) 		? ( $defaults['meta_link'] = true ) 		: ( $defaults['meta_link'] = false );
		( $defaults['meta_tags'] == "yes" ) 		? ( $defaults['meta_tags'] = true ) 		: ( $defaults['meta_tags'] = false );
		( $defaults['paging'] == "yes" ) 			? ( $defaults['paging'] = true ) 			: ( $defaults['paging'] = false );
		( $defaults['scrolling'] == "infinite" ) 	? ( $defaults['paging'] = true ) 			: ( $defaults['paging'] = $defaults['paging'] );
		( $defaults['strip_html'] == "yes" ) 		? ( $defaults['strip_html'] = true ) 		: ( $defaults['strip_html'] = false );
		( $defaults['thumbnail'] == "yes" ) 		? ( $defaults['thumbnail'] = true ) 		: ( $defaults['thumbnail'] = false );
		( $defaults['title'] == "yes" ) 			? ( $defaults['title'] = true ) 			: ( $defaults['title'] = false );
		( $defaults['title_link'] == "yes" ) 		? ( $defaults['title_link'] = true ) 		: ( $defaults['title_link'] = false );
	
		if( $defaults['excerpt_length'] || 
			$defaults['excerpt_length'] === '0' 
		) {
			$defaults['excerpt_words'] = $defaults['excerpt_length'];
		}

		//check for cats to exclude; needs to be checked via exclude_cats param and '-' prefixed cats on cats param
		//exclution via exclude_cats param 
		$cats_to_exclude = explode( ',' , $defaults['exclude_cats'] );
		$cats_id_to_exclude = array();
		if( $cats_to_exclude ) {
			foreach( $cats_to_exclude as $cat_to_exclude ) {
				$id_obj = get_category_by_slug( $cat_to_exclude );
				if( $id_obj ) {
					$cats_id_to_exclude[] = $id_obj->term_id;
				}
			}
			if( $cats_id_to_exclude ) {
				$defaults['category__not_in'] = $cats_id_to_exclude;
			}
		}

		//setting up cats to be used and exclution using '-' prefix on cats param; transform slugs to ids
		$cat_ids ='';
		$categories = explode( ',' , $defaults['cat_slug'] );
		if ( isset( $categories ) && 
			 $categories 
		) {
			foreach ( $categories as $category ) {
			
				$id_obj = get_category_by_slug( $category );
				
				if( $id_obj ) {
					if( strpos( $category, '-' ) === 0 ) {
						$cat_ids .= '-' . $id_obj->cat_ID . ',';
					} else {
						$cat_ids .= $id_obj->cat_ID . ',';
					}
				}
			}
		}
		$defaults['cat'] = substr( $cat_ids, 0, -1 );
		
		self::$args = $defaults;

		$fusion_query = new WP_Query( $defaults );	

		$this->query = $fusion_query;

		//prepare needed wrapping containers
		$html = '';

		$html .= sprintf( '<div %s>', FusionCore_Plugin::attributes( 'blog-shortcode' ) );

		$html .= sprintf( '<div %s>', FusionCore_Plugin::attributes( 'blog-shortcode-posts-container' ) );

		ob_start();
		do_action( 'fusion_blog_shortcode_wrap_loop_open' );
		$wrap_loop_open = ob_get_contents();
		ob_get_clean();		
		
		$html .= $wrap_loop_open;

		if(	self::$args['layout'] == 'timeline' ) {
			$this->post_count = 1;

			$prev_post_timestamp = null;
			$prev_post_month = null;
			$first_timeline_loop = false;
		}

		//do the loop
		if ( $fusion_query->have_posts() ) : while ( $fusion_query->have_posts() ) : $fusion_query->the_post();

			$this->post_id = get_the_ID();
			
			if(	self::$args['layout'] == 'timeline' ) {
				$post_timestamp = strtotime( get_the_date() );
				$this->post_month = date( 'n', $post_timestamp );
				$post_year = get_the_date( 'o' );
				$current_date = get_the_date( 'o-n' );

				$date_params['prev_post_month'] = $prev_post_month;
				$date_params['post_month'] = $this->post_month;
				
				ob_start();
				do_action( 'fusion_blog_shortcode_timeline_date', $date_params );
				
				do_action( 'fusion_blog_shortcode_before_loop_timeline' );
				$before_loop_timeline_action = ob_get_contents();
				ob_get_clean();		

				$html .= $before_loop_timeline_action;

			} else {

				ob_start();
				do_action( 'fusion_blog_shortcode_before_loop' );
				$before_loop_action = ob_get_contents();
				ob_get_clean();		

				$html .= $before_loop_action;

			}
			
			if( self::$args['layout'] == 'grid' || 
				self::$args['layout'] == 'timeline'
			) {
				$html .= sprintf( '<div %s>', FusionCore_Plugin::attributes( 'post-content-wrapper' ) );
			}

			$this->header = array(
				'title_link' => true,
			);
			
			ob_start();
			do_action( 'fusion_blog_shortcode_loop_header' );

			do_action( 'fusion_blog_shortcode_loop_content' );

			do_action( 'fusion_blog_shortcode_loop_footer' );
			
			do_action( 'fusion_blog_shortcode_after_loop' );
			$loop_actions = ob_get_contents();
			ob_get_clean();		

			$html .= $loop_actions;
			
			if( self::$args['layout'] == 'grid' || 
				self::$args['layout'] == 'timeline'
			) {
				$html .= '</div>';
			}			

			if(	self::$args['layout'] == 'timeline' ) {
				$prev_post_timestamp = $post_timestamp;
				$prev_post_month = $this->post_month;
				$this->post_count++;
			}

		endwhile;
		else:
		endif;
		
		ob_start();
		do_action( 'fusion_blog_shortcode_wrap_loop_close' );

		$wrap_loop_close_action = ob_get_contents();
		ob_get_clean();		

		$html .= $wrap_loop_close_action;
		
		$html .= '</div>';
		
		if( self::$args['paging'] ) {
			ob_start();
			themefusion_pagination( $this->query->max_num_pages, $range = 2, $this->query );
			$pagination = ob_get_contents();
			ob_get_clean();

			$html .= $pagination;
		}

		$html .= '</div>';

        return $html;

    }

    function attr() {

		$attr = array();

		$blog_layout = '';
		if( self::$args['layout'] == 'large alternate' ) {
			$blog_layout = 'large-alternate';
		} elseif( self::$args['layout'] == 'medium alternate' ) {
			$blog_layout = 'medium-alternate';
		} else {
			$blog_layout = self::$args['layout'];
		}

        $attr['class'] = sprintf( 'fusion-blog-shortcode fusion-blog-%s fusion-blog-%s', $blog_layout, self::$args['scrolling'] );

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class'];
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id'];
        }

        return $attr;

    }

    function posts_container_attr() {

		$attr = array();
		
        $attr['class'] = sprintf( 'fusion-posts-container posts-container-%s', self::$args['scrolling'] );		
		if ( self::$args['layout'] == 'grid' ) {
			 $attr['class'] .= sprintf( ' grid-layout grid-layout-%s', self::$args['blog_grid_columns'] );
		}

        return $attr;

    }

	function wrap_loop_open() {

		$wrapper = '';

		if( self::$args['layout'] == 'timeline' ) {

			$wrapper = sprintf( '<div %s><i %s></i></div>', FusionCore_Plugin::attributes( 'timeline-icon' ), FusionCore_Plugin::attributes( 'icon-bubbles' ) );
			$wrapper .= sprintf( '<div %s>', FusionCore_Plugin::attributes( 'blog-timeline-layout' ) );

		}

		echo $wrapper;

	} // end wrap_loop_open()

	function wrap_loop_close() {

		$wrapper = '';

		if( self::$args['layout'] == 'timeline' ) {
			$wrapper = '<div class="fusion-clearfix"></div>';
			$wrapper .= '</div>';
		}
		
		if( self::$args['layout'] == 'grid' ||
			self::$args['layout'] == 'timeline'
		) {
			$wrapper .= '<div class="fusion-clearfix"></div>';
		}

		echo $wrapper;

	} // end wrap_loop_close()

	function before_loop() {

		echo sprintf( '<div %s>', FusionCore_Plugin::attributes( 'blog-shortcode-loop' ) ) . "\n";

	} // end before_loop()

	function before_loop_timeline( $args ) {

		echo sprintf( '<div %s>', FusionCore_Plugin::attributes( 'blog-shortcode-loop' ) ) . "\n";

	} // end before_loop_timeline()

	function after_loop() {

		echo '</div>' . "\n";

	} // end after_loop()

	function loop_attr() {

		$defaults = array(
			'post_id' => '',
			'post_count' => '',
		);
		
		$args['post_id'] = $this->post_id;
		$args['post_count'] = $this->post_count;

		$args = wp_parse_args( $args, $defaults );

		$post_id = $args['post_id'];

		$post_count = $args['post_count'];

		$attr['id'] = 'post-' . $post_id;

		$extra_classes = array();

		if ( self::$args['layout'] == 'medium' ) {
			$extra_classes[] = 'blog-medium';
		}

		if ( self::$args['layout'] == 'medium alternate' ) {
			$extra_classes[] = 'blog-medium-alternate';
		}

		if ( self::$args['layout'] == 'large' ) {
			$extra_classes[] = 'blog-large';
		}

		if ( self::$args['layout'] == 'large alternate' ) {
			$extra_classes[] = 'blog-large-alternate';
		}

		if ( self::$args['layout'] == 'grid' ) {

			$column_width = 12 / self::$args['blog_grid_columns'];

			$extra_classes[] = 'blog-grid';
			$extra_classes[] = sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width );
		}

		if ( self::$args['layout'] == 'timeline' ) {

			if( ( $post_count % 2 ) > 0 ) {
				$timeline_align = ' timeline-align-left';
			} else {
				$timeline_align = ' timeline-align-right';
			}

			$extra_classes[] = 'blog-timeline fusion-clearfix';
			$extra_classes[] = 'col-lg-5 col-md-5 col-sm-5' . $timeline_align;
		}

		$post_class = get_post_class( $extra_classes, $post_id );

		if( $post_class && is_array( $post_class ) ) {

			$classes = implode( ' ', get_post_class( $extra_classes, $post_id ) );
			$attr['class'] = $classes;

		}

		if( current_theme_supports( 'fusion-schema' ) ) {
			$attr['itemtype'] = 'http://schema.org/BlogPosting';
			$attr['itemprop'] = 'blogPost';
		}

		return $attr;

	} // end loop_attr();
	
	function get_slideshow() {
		global $smof_data;
	
		$html = '';

		$slideshow = array(
			'images' => $this->get_post_thumbnails( get_the_ID(), $smof_data['posts_slideshow_number']  )
		);

		if( get_post_meta( $this->post_id, 'pyre_video', true) ) {
			$slideshow['video'] = get_post_meta( $this->post_id, 'pyre_video', true );
		}

		if( self::$args['layout'] == 'medium' || 
			self::$args['layout'] == 'medium alternate'
		) {

			if(	self::$args['layout'] == 'medium_alternate' ) {
				ob_start();
				do_action( 'fusion_blog_shortcode_date_and_format' );
				$date_and_format_action = ob_get_contents();
				ob_get_clean();		

				$html .= $date_and_format_action;					
			}

			$slideshow['size'] = 'blog-medium';

			$html .= sprintf( '<div %s>', FusionCore_Plugin::attributes( 'blog-medium-slideshow-container' ) );

			ob_start();
			$atts = self::$args;
			if($smof_data['legacy_posts_slideshow']) {
				include(locate_template('legacy-slideshow-blog-shortcode.php', false));
			} else {
				include(locate_template('new-slideshow-blog-shortcode.php', false));

			}
			$post_slideshow_action = ob_get_contents();
			ob_get_clean();		

			$html .= $post_slideshow_action;

			$html .= '</div>';
		} else {
			ob_start();
			$atts = self::$args;
			if($smof_data['legacy_posts_slideshow']) {
				include(locate_template('legacy-slideshow-blog-shortcode.php', false));
			} else {
				include(locate_template('new-slideshow-blog-shortcode.php', false));

			}
			$post_slideshow_action = ob_get_contents();
			ob_get_clean();		

			$html .= $post_slideshow_action;

		}
		
		return $html;
	}

	function get_post_thumbnails( $post_id, $count = '' ) {
		global $smof_data;

		$attachment_ids = array();

		if( get_post_thumbnail_id( $post_id ) ) {
			$attachment_ids[] = get_post_thumbnail_id( $post_id );
		}

		if( $smof_data['posts_slideshow'] ) {
			$i = 2;
			while( $i <= $smof_data['posts_slideshow_number'] ) {

				if( kd_mfi_get_featured_image_id( 'featured-image-' . $i, 'post' ) ) {
					$attachment_ids[] = kd_mfi_get_featured_image_id( 'featured-image-' . $i, 'post' );
				}

				$i++;
			}
		}

		if( isset( $count ) && $count >= 1 ) {
			$attachment_ids = array_slice( $attachment_ids, 0, $count );
		}

		return $attachment_ids;

	} // end get_post_thumbnails()


	function loop_header() {

		$defaults = array(
			'title_link' => false,
		);

		$args = wp_parse_args( $this->header, $defaults );

		$pre_title_content = '';
		$meta_data = '';
		$content_sep = '';
		$link = '';
		
		
		if(	self::$args['thumbnail'] && self::$args['layout'] != 'medium alternate' ) {		
			$pre_title_content = $this->get_slideshow();
		}

		if(	self::$args['layout'] == 'medium alternate' || 
			self::$args['layout'] == 'large alternate' ) {
			ob_start();
			do_action( 'fusion_blog_shortcode_date_and_format' );
			$pre_title_content .= ob_get_contents();
			ob_get_clean();

			if( self::$args['thumbnail'] && self::$args['layout'] == 'medium alternate' ) {		
				$pre_title_content .= $this->get_slideshow();		
			}


			if( self::$args['meta_all'] ) {
				ob_start();
				do_action( 'fusion_blog_shortcode_entry_meta_alternate' );
				$meta_data = ob_get_contents();
				ob_get_clean();
			}
		}

		if( self::$args['layout'] == 'grid' ||
			self::$args['layout'] == 'timeline'
		) {
			if( ( ! self::$args['meta_all'] && self::$args['excerpt_words'] == '0' ) ||
				( ! self::$args['meta_author'] && ! self::$args['meta_date'] && ! self::$args['meta_categories'] && ! self::$args['meta_tags'] && ! self::$args['meta_comments'] && ! self::$args['meta_link'] && self::$args['excerpt_words'] == '0' )
			) {				
				$content_sep = sprintf( '<div %s></div>', FusionCore_Plugin::attributes('no-content-sep' ) );
			} else {
				$content_sep = sprintf( '<div %s></div>', FusionCore_Plugin::attributes('content-sep' ) );
			}

			if( self::$args['meta_all'] ) {
				ob_start();
				do_action( 'fusion_blog_shortcode_entry_meta_grid_timeline' );
				$meta_data = ob_get_contents();
				ob_get_clean();
			}
		}

		$pre_title_content .=  sprintf( '<div %s>', FusionCore_Plugin::attributes( 'post-content-container' ) );
		
		if( self::$args['title'] ) {
			if( self::$args['title_link'] ) {
				$link = sprintf( '<a href="%s">%s</a>', get_permalink(), get_the_title() );
			} else {
				$link = get_the_title();
			}
		}

		if( self::$args['layout'] == 'timeline' ) {
			$pre_title_content .= sprintf( '<div %s></div><div %s></div>', FusionCore_Plugin::attributes( 'timeline-circle' ), FusionCore_Plugin::attributes( 'timeline-arrow' ) );
		}

		$html = sprintf( '%s<h2 %s>%s</h2>%s%s', $pre_title_content, FusionCore_Plugin::attributes( 'blog-shortcode-post-title' ), $link, $meta_data, $content_sep );

		echo $html;

	} // end loop_header()


	function post_title_attr() {

		$attr['class'] = 'entry-title';

		if( current_theme_supports( 'fusion-schema' ) ) {
			$attr['itemprop'] = 'headline';
		}

		return $attr;

	} // end post_title_attr();

	function loop_footer() {
		
		if( self::$args['meta_all'] && (self::$args['layout'] == 'medium' || 
			self::$args['layout'] == 'large')
		) {
			do_action( 'fusion_blog_shortcode_entry_meta_default' );
		}

		if(	self::$args['meta_all'] && (self::$args['layout'] == 'large alternate' ||
			self::$args['layout'] == 'grid' ||
			self::$args['layout'] == 'timeline')
		) {
			echo $this->read_more();
		}

		if( self::$args['meta_all'] && (self::$args['layout'] == 'grid' || 
			self::$args['layout'] == 'timeline')
		) {
			echo $this->grid_timeline_comments();
			echo '<div class="fusion-clearfix"></div>';
		}
		
		echo '</div>';
		echo '<div class="fusion-clearfix"></div>';
		
		if(	self::$args['meta_all'] && self::$args['layout'] == 'medium alternate' ) {
			echo $this->read_more();
		}		

	} // end loop_footer()

	function date_and_format() {
		global $smof_data;
	
		$inner_content = sprintf( '<div %s>', FusionCore_Plugin::attributes( 'date-and-formats' ) );
		$inner_content .= sprintf( '<div %s>', FusionCore_Plugin::attributes( 'date-box updated' ) );

		$inner_content .= sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'date' ), get_the_time( $smof_data['alternate_date_format_day'] ) );
		$inner_content .= sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'month-year' ), get_the_time( $smof_data['alternate_date_format_month_year'] ) );

		switch( get_post_format() ) {
			case 'gallery':
				$format_class = 'images';
				break;
			case 'link':
				$format_class = 'link';
				break;
			case 'image':
				$format_class = 'image';
				break;
			case 'quote':
				$format_class = 'quotes-left';
				break;
			case 'video':
				$format_class = 'film';
				break;
			case 'audio':
				$format_class = 'headphones';
				break;
			case 'chat':
				$format_class = 'bubbles';
				break;
			default:
				$format_class = 'pen';
				break;
		}

		$inner_content .= sprintf( '</div>
										<div %s>
											<i %s></i>
										</div>
									</div>', FusionCore_Plugin::attributes( 'format-box' ), FusionCore_Plugin::attributes( 'icon-'.$format_class ) );

		echo $inner_content;

	} // end add_date_and_format()

	function timeline_date( $date_params ) {
		global $smof_data;

		$defaults = array(
			'prev_post_month' 	=> null,
			'post_month' 		=> 'null'
		);

		$args = wp_parse_args( $date_params, $defaults );
		$inner_content = '';

		if( $args['prev_post_month'] != $args['post_month'] ) {
			$inner_content = sprintf( '<div %s><h3 %s>%s</h3></div>', FusionCore_Plugin::attributes( 'timeline-date' ), FusionCore_Plugin::attributes( 'timeline-title' ), 
									  get_the_date( $smof_data['timeline_date_format'] ) );
		}

		echo $inner_content;

	} // end timeline_date()

	function entry_meta_default() {

		$inner_content = $this->post_meta_data( true );

		$inner_content .= $this->read_more();

		$entry_meta = sprintf( '<div %s></div><div %s>%s</div>', FusionCore_Plugin::attributes( 'fusion-clearfix' ), 
							   FusionCore_Plugin::attributes( 'blog-shortcode-entry-meta' ), $inner_content );

		echo $entry_meta;

	} // end entry_meta_default()

	function entry_meta_alternate() {

		$inner_content = $this->post_meta_data( true );

		$entry_meta = sprintf( '<div %s>%s</div>', FusionCore_Plugin::attributes( 'blog-shortcode-entry-meta' ), $inner_content );

		echo $entry_meta;

	} // end entry_meta_alternate()

	function entry_meta_grid_timeline() {

		$inner_content = $this->post_meta_data( false );

		$entry_meta = sprintf( '<div %s>%s</div>', FusionCore_Plugin::attributes( 'blog-shortcode-entry-meta' ), $inner_content );

		echo $entry_meta;

	} // end entry_meta_grid_timeline()

	function post_meta_data( $return_all_meta = false ) {
		global $smof_data;

		$inner_content = sprintf( '<p %s>', FusionCore_Plugin::attributes( 'blog-shortcode-entry-meta-details' ) );

		if( self::$args['meta_author'] ) {
			$inner_content .= sprintf( '<span %s>' . __( 'By', 'fusion-framework' ) . ' <a %s>%s</a>' . '</span><span %s>|</span>', FusionCore_Plugin::attributes( 'blog-shortcode-meta-author' ), 
									   FusionCore_Plugin::attributes( 'blog-shortcode-meta-author-link' ), get_the_author_meta( 'display_name' ), FusionCore_Plugin::attributes( 'meta-separator' ) );
		}

		if( self::$args['meta_date'] ) {
			$inner_content .= sprintf( '<span %s><span %s>%s</span><time %s>%s</time></span><span %s>|</span>', FusionCore_Plugin::attributes( 'entry-time' ), FusionCore_Plugin::attributes( 'blog-shortcode-meta-date-updated' ), 
									   get_the_modified_time( 'c' ), FusionCore_Plugin::attributes( 'blog-shortcode-meta-date' ), get_the_time( $smof_data['date_format'] ), FusionCore_Plugin::attributes( 'meta-separator' ) );
		}

		if( $return_all_meta ) {

			if( self::$args['meta_categories'] ) {

				$categories = get_the_category();
				$no_of_categories = count( $categories );
				$separator = ', ';
				$output = __( 'Categories:', 'Avada' ) . ' ';
				$count = 1;

				foreach( $categories as $category ) {

					$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>';

					if( $count < $no_of_categories ) {
						$output .= $separator;
					}

					$count++;

				}

				$inner_content .= sprintf( '<span %s>%s</span><span %s>|</span>', FusionCore_Plugin::attributes( 'entry-categories' ), $output, FusionCore_Plugin::attributes( 'meta-separator' ) );

			}

			if( self::$args['meta_tags'] ) {
				$inner_content .= sprintf( '%s<span %s>|</span>', $this->post_meta_tags(), FusionCore_Plugin::attributes( 'meta-separator' ) );
			}

			if( self::$args['meta_comments'] ) {

				ob_start();
				comments_popup_link( __( '0 Comments', 'fusion-framework' ), __( '1 Comment', 'fusion-framework' ), __( '% Comments', 'fusion-framework' ) );
				$comments = ob_get_contents();
				ob_get_clean();

				$inner_content .= sprintf( '<span %s>%s</span><span %s>|</span>', FusionCore_Plugin::attributes( 'entry-comments' ), $comments, FusionCore_Plugin::attributes( 'meta-separator' ) );

			}

		}

		$inner_content .= '</p>';

		return $inner_content;

	} // end post_meta_data()

	function grid_timeline_comments() {

		if( self::$args['meta_comments'] ) {

			$comments_icon = sprintf( '<i %s></i>&nbsp;', FusionCore_Plugin::attributes( 'icon-bubbles' ) );
			ob_start();
			comments_popup_link( $comments_icon . __( '0', 'fusion-framework' ), $comments_icon . __( '1', 'fusion-framework' ), $comments_icon . __( '%', 'fusion-framework' ) );
			$comments = ob_get_contents();
			ob_get_clean();

			$inner_content = sprintf( '<p %s>%s</p>', FusionCore_Plugin::attributes( 'entry-comments' ), $comments );

			return $inner_content;

		}

	} // end grid_timeline_comments()
	
	function post_meta_tags() {

		$inner_content = '';
		
		if( self::$args['meta_tags'] ) {

			ob_start();
			echo __('Tags:', 'Avada') . ' '; the_tags( '' );
			$tags = ob_get_contents();
			ob_get_clean();

			$inner_content = sprintf( '<span %s>%s</span>', FusionCore_Plugin::attributes( 'blog-shortcode-meta-tags' ), $tags );

		}

		return $inner_content;

	} // end post_meta_tags()	

	function read_more() {

		if( self::$args['meta_link'] ) {
			$inner_content = '';

			if( self::$args['meta_read'] ) {

				$inner_content .= sprintf( '<p %s>', FusionCore_Plugin::attributes( 'entry-read-more' ) );
				$inner_content .= sprintf( '<a href="%s">%s</a>', get_permalink(),  __( 'Read More', 'fusion-framework' ) );
				$inner_content .= '</p>';

			}

			return $inner_content;
		}

	} // end read_more()

	function entry_meta_attr() {
	
		$attr = array();
	
		if( self::$args['layout'] == 'grid' || 
			self::$args['layout'] == 'timeline'
		) {
			$attr['class'] = 'entry-meta-single';
		} else {
			$attr['class'] = 'entry-meta';
		}

		return $attr;

	} // end entry_meta_attr();	
	
	function entry_meta_details_attr() {
	
		$attr = array();

		$attr['class'] = 'entry-meta-details';

		return $attr;

	} // end entry_meta_attr();		

	function meta_tags_attr() {
	
		$attr = array();

		$attr['class'] = 'meta-tags';

		return $attr;

	} // end meta_tags_attr();

	function meta_author_attr() {
	
		$attr = array();

		$attr['class'] = 'entry-author fn';

		if( current_theme_supports( 'fusion-schema' ) ) {
			$attr['itemprop'] = 'author';
			$attr['itemscope'] = 'itemscope';
			$attr['itemtype'] = 'http://schema.org/Person';
		}

		return $attr;

	} // end meta_author_attr();

	function meta_author_link_attr() {
	
		$attr = array();

		$attr['href'] = get_author_posts_url( get_the_author_meta( 'ID' ) );

		if( current_theme_supports( 'fusion-schema' ) ) {
			$attr['itemprop'] = 'url';
			$attr['rel'] = 'author';
		}

		return $attr;

	} // end meta_author_link_attr();

	function meta_date_attr() {
	
		$attr = array();
		
		$attr['class'] = 'published';

		if( current_theme_supports( 'fusion-schema' ) ) {
			$attr['datetime'] = get_the_time( 'c' );
		}

		return $attr;

	} // end meta_date_attr();
	
	function meta_date_updated_attr() {
	
		$attr = array();
		
		$attr['class'] = 'updated';
		
		$attr['style'] = 'display:none;';

		return $attr;

	} // end meta_date_attr();	

	function loop_content() {

		// get the post content according to the chosen kind of delivery
		if( self::$args['excerpt'] ) {
			$content = tf_content( self::$args['excerpt_words'], self::$args['strip_html'] );
		} else {
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
		}	

		echo $content;


	} // end loop_content()

	function page_links() {

		wp_link_pages();

	} // end page_links()

}

new FusionSC_Blog();