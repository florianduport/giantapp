<?php
// Template Name: Side Navigation
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
	<div id="content" style="<?php echo $content_css; ?>">
		<?php while(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
			<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>
			<?php global $smof_data;
			if( ! post_password_required($post->ID) ):
			if(!$smof_data['featured_images_pages'] && has_post_thumbnail()): ?>
			<div class="image">
				<?php the_post_thumbnail('blog-large'); ?>
			</div>
			<?php endif; ?>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if($smof_data['comments_pages']): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>">
		<ul class="side-nav">
			<?php
			$post_ancestors = get_ancestors($post->ID, 'page');
			$post_parent = end($post_ancestors);
			?>
			<?php if(is_page($post_parent)): ?><?php endif; ?>
			<li <?php if(is_page($post_parent)): ?>class="current_page_item"<?php endif; ?>><a href="<?php echo get_permalink($post_parent); ?>" title="<?php echo __('Back to Parent Page', 'Avada'); ?>"><?php echo get_the_title($post_parent); ?></a></li>
			<?php
			if($post_parent) {
				$children = wp_list_pages("title_li=&child_of=".$post_parent."&echo=0");
			}
 			else {
				$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
			}
			if ($children) {
			?>
			<?php echo $children; ?>
			<?php } ?>
		</ul>
		<?php
		$selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
		if(!$selected_sidebar_replacement[0] == 0) {
			generated_dynamic_sidebar();
		}
		?>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>