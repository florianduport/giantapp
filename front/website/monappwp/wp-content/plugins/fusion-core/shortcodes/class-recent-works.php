<?php
class FusionSC_RecentWorks {

	private $column;
	private $icon_permalink;
	private $image_size;
	private $link_icon_css;
	private $link_target;
	private $zoom_icon_css;
	
	private $recent_works_counter = 1;
	
	public static $args;


    /**
     * Initiate the shortcode
     */
    public function __construct() {

		add_filter( 'fusion_attr_recentworks-shortcode', array( $this, 'attr' ) );	
		add_filter( 'fusion_attr_recentworks-shortcode-slideshow', array( $this, 'slideshow_attr' ) );
		add_filter( 'fusion_attr_recentworks-shortcode-img-div', array( $this, 'img_div_attr' ) );
		add_filter( 'fusion_attr_recentworks-shortcode-img-link-icon', array( $this, 'img_link_icon_attr' ) );
		add_filter( 'fusion_attr_recentworks-shortcode-img-zoom-icon', array( $this, 'img_zoom_icon_attr' ) );
		add_filter( 'fusion_attr_recentworks-shortcode-img-h3-link', array( $this, 'img_h3_link_attr' ) );
		add_filter( 'fusion_attr_recentworks-shortcode-filter-link', array( $this, 'filter_link_attr' ) );
		add_filter( 'fusion_attr_recentworks-shortcode-img', array( $this, 'img_attr' ) );

		add_shortcode( 'recent_works', array( $this, 'render' ) );

    }

    /**
     * Render the parent shortcode
     * @param  array $args     Shortcode paramters
     * @param  string $content Content between shortcode
     * @return string          HTML output
     */
    function render( $args, $content = '') {
    	global $smof_data;

		$defaults = FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class' 				=> '',
				'id' 					=> '',
				'cat_slug' 				=> '',
				'columns' 				=> 3,
				'exclude_cats' 			=> '',
				'excerpt_length' 		=> '',
				'excerpt_words' 		=> '15',  // depracted
				'filters'				=> 'yes',
				'layout' 				=> 'carousel',
				'number_posts' 			=> 8,
				'animation_direction' 	=> 'left',
				'animation_speed' 		=> '',
				'animation_type' 		=> '',
				'picture_size'			=> 'fixed',
			), $args
		);

		( $defaults['filters'] == 'yes' || $defaults['filters'] == 'true' ) ? ( $defaults['filters'] = true ) : ( $defaults['filters'] = false );
		
		extract( $defaults );

		self::$args = $defaults;
		
		// set the image size for the slideshow
		$this->set_image_size();
		
		if( $excerpt_length || 
			$excerpt_length === '0' 
		) {
			$excerpt_words = $excerpt_length;
		}
				
		$args = array(
			'post_type' 			=> 'avada_portfolio',
			'paged' 				=> 1,
			'posts_per_page' 		=> $number_posts,
			'has_password' => false
		);
		
		if( $defaults['exclude_cats'] ) {
			$cats_to_exclude = explode( ',' , $defaults['exclude_cats'] );
		}

		if( $defaults['cat_slug'] ) {
			$cat_slugs = explode(',', $defaults['cat_slug']);

			if( isset ( $cats_to_exclude ) && $cats_to_exclude ) {
			
				$args['tax_query'] = array(
					'relation' 		=> 'AND',
					array(
						'taxonomy' 	=> 'portfolio_category',
						'field' 	=> 'slug',
						'terms' 	=> $cat_slugs,
						'operator' 	=> 'IN'
					),
					array(
						'taxonomy' 	=> 'portfolio_category',
						'field' 	=> 'slug',
						'terms' 	=> $cats_to_exclude,
						'operator' 	=> 'NOT IN'
					)					
				);			
			
			} else {

				$args['tax_query'] = array(
					array(
						'taxonomy' 	=> 'portfolio_category',
						'field' 	=> 'slug',
						'terms' 	=> $cat_slugs
					)
				);
			
			}
		}		
		
		wp_reset_query();

		$recent_works = new WP_Query( $args );
		
		$works = '';
		
		while( $recent_works->have_posts() ) { 
			$recent_works->the_post();
			
			$item_classes = $terms = $image_wrapper = $item_content = $buttons = $url = '';
			
			// set classes, link and target for the image extras content
			$this->set_image_extras( get_the_ID() );
			

			if( $layout == 'carousel' ) {
				if( has_post_thumbnail() ) {

					if( $smof_data['image_rollover'] ) {
						$image = get_the_post_thumbnail( get_the_ID(), $this->image_size );
						
						$image .= $this->get_image_extras( get_the_ID() );
					} else {
						$image = sprintf( '<a href="%s">%s</a>', get_permalink( get_the_ID() ), get_the_post_thumbnail( get_the_ID(), $this->image_size ) );
					}

					$works .= sprintf( '<li><div %s>%s</div></li>', FusionCore_Plugin::attributes( 'recentworks-shortcode-img-div' ), $image );
				}
			} else {

				if( has_post_thumbnail() || 
					get_post_meta( get_the_ID(), 'pyre_video', true ) 
				) {
					$item_cats = get_the_terms( get_the_ID(), 'portfolio_category' );
					if( $item_cats ) {
						foreach( $item_cats as $item_cat ) {
							$item_classes .= $item_cat->slug . ' ';
						}
					}

					$permalink = get_permalink();

					if( has_post_thumbnail() ) {
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $this->image_size );
						$src = $thumbnail[0];
						$alt = get_post_field( 'post_excerpt', get_post_thumbnail_id( get_the_ID() ) );

						if( $smof_data['image_rollover'] ) {
							$image = sprintf( '<img %s />', FusionCore_Plugin::attributes( 'recentworks-shortcode-img', array( 'src' => $src, 'alt' => $alt ) ) );
							
							$image .= $this->get_image_extras( get_the_ID() );
						} else {
							$image = sprintf( '<a href="%s"><img %s /></a>', $permalink, FusionCore_Plugin::attributes( 'recentworks-shortcode-img', array( 'src' => $src, 'alt' => $alt ) ) );
						}

						$image_wrapper = sprintf( '<div %s>%s</div>', FusionCore_Plugin::attributes( 'recentworks-shortcode-img-div' ), $image );

					}

					if( $layout == 'grid-with-excerpts' ) {

						$stripped_content = strip_shortcodes( tf_content( $excerpt_words, $smof_data['strip_html_excerpt'] ) );

						if( $columns == 1 ) {

							if( get_post_meta( get_the_ID(), 'pyre_project_url', true ) ) {
								$url = sprintf( '<a href="%s" %s>%s</a>', get_post_meta( get_the_ID(), 'pyre_project_url', true ), 
												FusionCore_Plugin::attributes( 'fusion-button medium default' ), __( 'View Project', 'Avada' ) );
							}					

							$buttons = sprintf( '<div %s><a href="%s" %s>%s</a>%s</div>', FusionCore_Plugin::attributes( 'buttons' ), $permalink, 
												FusionCore_Plugin::attributes( 'fusion-button medium default' ), __( 'Learn More', 'Avada' ), $url );
						}

						$item_content = sprintf( '<div %s><h2><a href="%s">%s</a></h2><h4>%s</h4>%s</div>', FusionCore_Plugin::attributes( 'portfolio-content' ), 
												 $permalink, get_the_title(), get_the_term_list(get_the_ID(), 'portfolio_category', '', ', ', ''), $stripped_content );
					}

					$works .= sprintf( '<div %s>%s%s</div>', FusionCore_Plugin::attributes( 'portfolio-item ' . $item_classes ), $image_wrapper, $item_content );
				}
			}
		}
		wp_reset_query();
		
		if( $layout == 'carousel' ) {
			$html = sprintf( '<div %s><div %s><div %s><ul>%s</ul></div><div %s><span %s></span><span %s></span></div></div></div>', FusionCore_Plugin::attributes( 'recentworks-shortcode' ),
							  FusionCore_Plugin::attributes( 'es-carousel-wrapper fusion-carousel-large' ), FusionCore_Plugin::attributes( 'es-carousel' ), $works,
							  FusionCore_Plugin::attributes( 'es-nav' ), FusionCore_Plugin::attributes( 'es-nav-prev' ), FusionCore_Plugin::attributes( 'es-nav-next' ) );
		
		} else {
		
			$portfolio_category = get_terms( 'portfolio_category' );
			$filter = '';
			$filter_wrapper = '';
			
			if( $portfolio_category && 
				$filters == true
			) {
				$filter = sprintf( '<li %s><a %s>%s</a></li>', FusionCore_Plugin::attributes( 'active' ),
								   FusionCore_Plugin::attributes( 'recentworks-shortcode-filter-link', array( 'data-filter' => '*' ) ), __( 'All', 'Avada' ) );

				foreach( $portfolio_category as $portfolio_cat ) {
					if( isset( $args['cat_slug'] ) && $args['cat_slug'] ) {
						$cat_slug = preg_replace('/\s+/', '', $args['cat_slug'] );
						$cat_slug = explode( ',', $cat_slug ) ;

						if( in_array( $portfolio_cat->slug, $cat_slug ) ) {
							$filter .= sprintf( '<li><a %s>%s</a></li>', 
												FusionCore_Plugin::attributes( 'recentworks-shortcode-filter-link', array( 'data-filter' => '.' . $portfolio_cat->slug ) ), $portfolio_cat->name );
						}
					} else {

						$filter .= sprintf( '<li><a %s>%s</a></li>', 
											FusionCore_Plugin::attributes( 'recentworks-shortcode-filter-link', array( 'data-filter' => '.' . $portfolio_cat->slug ) ), $portfolio_cat->name );						
					}
				}
				
				$filter_wrapper = sprintf( '<ul %s>%s</ul>', FusionCore_Plugin::attributes( 'portfolio-tabs' ), $filter );

			}	
		
			$html = sprintf( '<div %s>%s<div %s>%s</div></div>', FusionCore_Plugin::attributes( 'recentworks-shortcode' ), $filter_wrapper, 
							 FusionCore_Plugin::attributes( 'portfolio-wrapper' ), $works );

		}

		$this->recent_works_counter++;

        return $html;

    }

	function attr() {

        $attr = array();

		$attr['class'] = sprintf( 'fusion-recent-works layout-%s', self::$args['layout'] );

        if( self::$args['layout'] == 'carousel' ) {
        	$attr['class'] .= ' recent-works-carousel';
	        if( self::$args['picture_size'] == 'auto' ) {
	            $attr['class'] .= ' picture-size-auto';
	        }
        } else {
			$attr['class'] .= sprintf( ' portfolio portfolio-%s', $this->column );
			
			$attr['data-columns'] = $this->column;
        }

        if( self::$args['layout'] == 'grid' ) {
        	$attr['class'] .= ' portfolio-grid';
        }
        
        if( self::$args['layout'] == 'grid-with-excerpts' ) {
        	$attr['class'] .= sprintf( ' portfolio-%s-text', $this->column );
        }

        if( self::$args['class'] ) {
            $attr['class'] .= ' ' . self::$args['class'];
        }

        if( self::$args['id'] ) {
            $attr['id'] = self::$args['id'];
        }
        
        if( self::$args['animation_type'] ) {
            $animations = FusionCore_Plugin::animations( array(
                'type'      => self::$args['animation_type'],
                'direction' => self::$args['animation_direction'],
                'speed'     => self::$args['animation_speed'],
            ) );

            $attr = array_merge( $attr, $animations );
            
            $attr['class'] .= ' ' . $attr['animation_class']; 
        }        

        return $attr;

    }
    
	function img_div_attr( $args ) {

        $attr = array();

		$attr['class'] = 'image';

		$attr['aria-haspopup'] = 'true';

        return $attr;

    }   
    
	function img_link_icon_attr() {

        $attr = array();

		$attr['class'] = 'icon link-icon';
		
		$attr['href'] = $this->icon_permalink;

		$attr['style'] = $this->link_icon_css;

        return $attr;

    }
    
	function img_zoom_icon_attr( $args ) {

        $attr = array();

		$attr['class'] = 'icon gallery-icon';
		
		$attr['href'] = $args['href'];
		
		$attr['rel'] = sprintf( 'prettyPhoto[gallery_recent_%s]', $this->recent_works_counter );

		$attr['style'] = $this->zoom_icon_css;

        return $attr;

    }
    
	function img_h3_link_attr() {

        $attr = array();
		
		$attr['href'] = $this->icon_permalink;
		
		$attr['target'] = $this->link_target;

        return $attr;

    }
    
	function filter_link_attr( $args ) {

        $attr = array();

		$attr['href'] = '#';

		if( $args['data-filter'] ) {
			$attr['data-filter'] = $args['data-filter'];
		}

        return $attr;

    }    
    
	function img_attr( $args ) {

        $attr = array();

		$attr['src'] = $args['src'];

		if( $args['alt'] ) {
			$attr['alt'] = $args['alt'];
		}

        return $attr;

    }
    
    function set_image_size() {
    
    	if( self::$args['layout'] == 'carousel' ) {
    		$this->image_size = 'related-img';
    		if( self::$args['picture_size'] == 'auto' ) {
    			$this->image_size = 'full';
    		}
		} elseif( self::$args['columns'] == 1 ) {
			$this->image_size = 'full';
			$this->column = 'one';
		} elseif( self::$args['columns'] == 2 ) {
			$this->image_size = 'portfolio-two';
			$this->column = 'two';
		} elseif( self::$args['columns'] == 3 ) {
			$this->image_size = 'portfolio-three';
			$this->column = 'three';
		} elseif( self::$args['columns'] == 4 ) {
			$this->image_size = 'portfolio-four';
			$this->column = 'four';
		}
    }
    
    function set_image_extras( $id ) {
		if( get_post_meta( $id, 'pyre_image_rollover_icons', true ) == 'link' ) {
			$this->link_icon_css = 'display:inline-block;';
			$this->zoom_icon_css = 'display:none;';
		} elseif( get_post_meta( $id, 'pyre_image_rollover_icons', true ) == 'zoom' ) {
			$this->link_icon_css = 'display:none;';
			$this->zoom_icon_css = 'display:inline-block;';
		} elseif( get_post_meta( $id, 'pyre_image_rollover_icons', true ) == 'no' ) {
			$this->link_icon_css = 'display:none;';
			$this->zoom_icon_css = 'display:none;';
		} else {
			$this->link_icon_css = 'display:inline-block;';
			$this->zoom_icon_css = 'display:inline-block;';
		}

		$this->link_target = '';
		$icon_url_check = get_post_meta( $id, 'pyre_link_icon_url', true ); 
		
		if( ! empty( $icon_url_check ) ) {
			$this->icon_permalink = get_post_meta( $id, 'pyre_link_icon_url', true );
			
			if( get_post_meta( $is, 'pyre_link_icon_target', true ) == 'yes' ) {
				$this->link_target = '_blank';
			}
		} else {
			$this->icon_permalink = get_permalink( $id );
		}
	}
	
	function get_image_extras( $id ) {
		$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
		if( get_post_meta( $id, 'pyre_video_url', true ) ) {
			$full_image[0] = get_post_meta( $id, 'pyre_video_url', true );
		}
		
		$terms = '';
		if( self::$args['layout'] != 'carousel' ) {
			$terms = sprintf( '<h4>%s</h4>', get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ) );
		}

		$image_extras = sprintf( '<div %s><div %s><a %s></a><a %s></a><h3 %s><a %s>%s</a></h3>%s</div></div>', FusionCore_Plugin::attributes( 'image-extras' ), 
								 FusionCore_Plugin::attributes( 'image-extras-content' ), FusionCore_Plugin::attributes( 'recentworks-shortcode-img-link-icon' ), 
							 	 FusionCore_Plugin::attributes( 'recentworks-shortcode-img-zoom-icon', array( 'href' => $full_image[0] ) ), 
								 FusionCore_Plugin::attributes( 'entry-title' ), FusionCore_Plugin::attributes( 'recentworks-shortcode-img-h3-link' ), get_the_title( $id ),
								 $terms );	

		return $image_extras;
	}
    
}

new FusionSC_RecentWorks();