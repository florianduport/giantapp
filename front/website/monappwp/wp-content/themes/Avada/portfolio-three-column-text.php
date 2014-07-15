<?php
// Template Name: Portfolio Three Column Text
get_header(); ?>
	<?php
	$content_css = 'width:100%';
	$sidebar_css = 'display:none';
	$content_class = '';
	$sidebar_exists = false;
	if(get_post_meta($post->ID, 'pyre_portfolio_full_width', true) == 'yes') {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$sidebar_exists = false;
	}
	elseif(get_post_meta($post->ID, 'pyre_portfolio_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
		$content_class = 'portfolio-three-sidebar';
		$sidebar_exists = true;
	} elseif(get_post_meta($post->ID, 'pyre_portfolio_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
		$content_class = 'portfolio-three-sidebar';
		$sidebar_exists = true;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default') {
		$content_class = 'portfolio-three-sidebar';
		if($smof_data['default_sidebar_pos'] == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
			$sidebar_exists = true;
		} elseif($smof_data['default_sidebar_pos'] == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
			$sidebar_exists = true;
		}
	}
	?>
	<div id="content" class="portfolio portfolio-three portfolio-three-text <?php echo $content_class; ?>" style="<?php echo $content_css; ?>">
		<?php while(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
			<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>	
			<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div>
		<?php $current_page_id = $post->ID; ?>
		<?php endwhile; ?>
		<?php
		if(is_front_page()) {
			$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		} else {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		$args = array(
			'post_type' => 'avada_portfolio',
			'paged' => $paged,
			'posts_per_page' => $smof_data['portfolio_items'],
		);
		$pcats = get_post_meta(get_the_ID(), 'pyre_portfolio_category', true);
		if($pcats && $pcats[0] == 0) {
			unset($pcats[0]);
		}
		if($pcats){
			$args['tax_query'][] = array(
				'taxonomy' => 'portfolio_category',
				'field' => 'term_id',
				'terms' => $pcats
			);
		}
		$gallery = new WP_Query($args);
		if(is_array($gallery->posts) && !empty($gallery->posts)) {
			foreach($gallery->posts as $gallery_post) {
				$post_taxs = wp_get_post_terms($gallery_post->ID, 'portfolio_category', array("fields" => "all"));


				if(is_array($post_taxs) && !empty($post_taxs)) {
					foreach($post_taxs as $post_tax) {
						if(is_array($pcats) && !empty($pcats) && (in_array($post_tax->term_id, $pcats) || in_array($post_tax->parent, $pcats )) )  {
							$portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
						}

						if(empty($pcats) || !isset($pcats)) {
							$portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
						}
					}
				}
			}
		}

		$all_terms = get_terms('portfolio_category');
		if( !empty( $all_terms ) && is_array( $all_terms ) ) {
			foreach( $all_terms as $term ) {
			
				if( array_key_exists ( urldecode($term->slug) , $portfolio_taxs ) ) {
					$sorted_taxs[urldecode($term->slug)] = $term->name;
				}
			}
		}

		$portfolio_taxs = $sorted_taxs;

		$portfolio_category = get_terms('portfolio_category');
		if( ! post_password_required($post->ID) ):
		if(is_array($portfolio_taxs) && !empty($portfolio_taxs) && get_post_meta($post->ID, 'pyre_portfolio_filters', true) != 'no'):
		?>
		<ul class="portfolio-tabs clearfix">
			<li class="active"><a data-filter="*" href="#"><?php echo __('All', 'Avada'); ?></a></li>
			<?php foreach($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name): ?>
			<li><a data-filter=".<?php echo $portfolio_tax_slug; ?>" href="#"><?php echo $portfolio_tax_name; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<div class="portfolio-wrapper">
			<?php
			while($gallery->have_posts()): $gallery->the_post();
				if($pcats) {
					$permalink = tf_addUrlParameter(get_permalink(), 'portfolioID', $current_page_id);
				} else {
					$permalink = get_permalink();
				}
				if(has_post_thumbnail() || get_post_meta($post->ID, 'pyre_video', true)):
			?>
			<?php
			$item_classes = '';
			$item_cats = get_the_terms($post->ID, 'portfolio_category');
			if($item_cats):
			foreach($item_cats as $item_cat) {
				$item_classes .= urldecode($item_cat->slug) . ' ';
			}
			endif;
			?>
			<div class="portfolio-item <?php echo $item_classes; ?>">
				<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
				<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
				<span class="updated" style="display: none;"><?php the_time('c'); ?></span>
				<?php if(has_post_thumbnail()): ?>
				<div class="image" aria-haspopup="true">
					<?php if($smof_data['image_rollover']): ?>
					<?php the_post_thumbnail('portfolio-three'); ?>
					<?php else: ?>
					<a href="<?php echo $permalink; ?>"><?php the_post_thumbnail('portfolio-three'); ?></a>
					<?php endif; ?>
					<?php
					if(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'link') {
						$link_icon_css = 'display:inline-block;';
						$zoom_icon_css = 'display:none;';
					} elseif(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'zoom') {
						$link_icon_css = 'display:none;';
						$zoom_icon_css = 'display:inline-block;';
					} elseif(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'no') {
						$link_icon_css = 'display:none;';
						$zoom_icon_css = 'display:none;';
					} else {
						$link_icon_css = 'display:inline-block;';
						$zoom_icon_css = 'display:inline-block;';
					}

					$link_target = "";
					$icon_url_check = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true); if(!empty($icon_url_check)) {
						$icon_permalink = get_post_meta($post->ID, 'pyre_link_icon_url', true);
						if(get_post_meta(get_the_ID(), 'pyre_link_icon_target', true) == "yes") {
							$link_target = ' target="_blank"';
						}
					} else {
						$icon_permalink = $permalink;
					}
					?>
					<div class="image-extras">
						<div class="image-extras-content">
							<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
							<a style="<?php echo $link_icon_css; ?>" class="icon link-icon" href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>>Permalink</a>
							<?php
							if(get_post_meta($post->ID, 'pyre_video_url', true)) {
								$full_image[0] = get_post_meta($post->ID, 'pyre_video_url', true);
							}
							?>
							<a style="<?php echo $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id($post->ID)); ?>"><img style="display:none;" alt="<?php echo get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true); ?>" />Gallery</a>
							<h3 class="entry-title"><a href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>><?php the_title(); ?></a></h3>
							<h4><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?></h4>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="portfolio-content">
					<h2 class="entry-title"><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h2>
					<h4><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?></h4>
					<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
					<span class="updated" style="display: none;"><?php the_time('c'); ?></span>
					<div class="post-content">
					<?php
					if(get_post_meta($current_page_id, 'pyre_portfolio_excerpt', true)) {
						$excerpt_length = get_post_meta($current_page_id, 'pyre_portfolio_excerpt', true);
					} else {
						$excerpt_length = $smof_data['excerpt_length_portfolio'];
					}
					?>
					<?php
					if($smof_data['portfolio_content_length'] == 'Excerpt') {
						$stripped_content = strip_shortcodes( tf_content( $excerpt_length, $smof_data['strip_html_excerpt'] ) );
						echo $stripped_content;
					} else {
						the_content();
					}
					?>
					</div>

				</div>
			</div>
			<?php endif; endwhile; ?>
		</div>
		<?php themefusion_pagination($gallery->max_num_pages, $range = 2); ?>
		<?php endif; ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>"><?php generated_dynamic_sidebar(); ?></div>
	<?php endif; ?>
<?php get_footer(); ?>