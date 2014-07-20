<?php
// Template Name: FAQs
get_header(); ?>
	<?php
	$sidebar_exists = true;
	if(get_post_meta($post->ID, 'pyre_full_width', true) == 'yes') {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$sidebar_exists = false;
	}
	elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default') {
		if($smof_data['default_sidebar_pos'] == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
		} elseif($smof_data['default_sidebar_pos'] == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
		}
	}
	?>
	<div id="content" class="faqs" style="<?php echo $content_css; ?>">
		<?php while(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div>
		<?php endwhile; ?>
		<?php if( ! post_password_required($post->ID) ): ?>
		<?php
		$portfolio_category = get_terms('faq_category');
		if($portfolio_category):
		?>
		<ul class="faq-tabs clearfix">
			<li class="active"><a data-filter="*" href="#"><?php echo __('All', 'Avada'); ?></a></li>
			<?php foreach($portfolio_category as $portfolio_cat): ?>
			<li><a data-filter=".<?php echo urldecode($portfolio_cat->slug); ?>" href="#"><?php echo $portfolio_cat->name; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<div class="portfolio-wrapper">
			<div class="accordian fusion-accordian">
				<div class="panel-group" id="accordian-one">
					<?php
					$args = array(
						'post_type' => 'avada_faq',
						'nopaging' => true
					);
					$gallery = new WP_Query($args);
					$count = 0;
					while($gallery->have_posts()): $gallery->the_post();
					$count++;
					?>
					<?php
					$item_classes = '';
					$item_cats = get_the_terms($post->ID, 'faq_category');
					if($item_cats):
					foreach($item_cats as $item_cat) {
						$item_classes .= urldecode($item_cat->slug) . ' ';
					}
					endif;
					?>
					<div class="panel panel-default faq-item <?php echo $item_classes; ?>">
						<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
						<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
						<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>
						<div class="panel-heading">
							<h4 class="panel-title toggle"><a data-toggle="collapse" class="collapsed" data-parent="#accordian-one" href="#collapse-<?php the_ID(); ?>"><i class="fa-fusion-box"></i><?php the_title(); ?></a></h4>
						</div>
						<div id="collapse-<?php the_ID(); ?>" class="panel-collapse collapse">
							<div class="panel-body toggle-content post-content">
								<?php
								if($smof_data['faq_featured_image']):
								if(has_post_thumbnail()):
								?>
								<div class="flexslider post-slideshow">
									<ul class="slides">
									   <?php $attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); ?>
										<li>
											<a href="<?php echo $attachment_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo the_title_attribute('echo=0'); ?>">
											   <?php the_post_thumbnail('blog-large'); ?>
									  		</a>;
										</li>
									</ul>
								</div>
								<?php endif; ?>
								<?php endif; ?>

								<?php the_content(); ?>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php endif; // password check ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>"><?php generated_dynamic_sidebar(); ?></div>
	<?php endif; ?>
<?php get_footer(); ?>