<?php get_header(); ?>
	<?php
	$content_css = '';
	$sidebar_css = '';
	$sidebar_exists = true;
	$content_class = '';
	if(get_post_meta($post->ID, 'pyre_full_width', true) == 'yes') {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$sidebar_exists = false;
		$content_class= 'full-width';
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
	if($smof_data['bbpress_global_sidebar'] && $smof_data['ppbress_sidebar'] == 'None') {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$sidebar_exists = false;
	}
	?>
	<div id="content" class="<?php echo $content_class; ?>" style="<?php echo $content_css; ?>">
		<?php
		if(have_posts()): the_post();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
			<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>				
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(!$smof_data['featured_images_pages'] && has_post_thumbnail()): ?>
			<div class="image">
				<?php the_post_thumbnail('blog-large'); ?>
			</div>
			<?php endif; ?>
			<?php endif; // password check ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(class_exists('Woocommerce')): ?>
			<?php if($smof_data['comments_pages'] && !is_cart() && !is_checkout() && !is_account_page() && !is_page(get_option('woocommerce_thanks_page_id'))): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php else: ?>
			<?php if($smof_data['comments_pages']): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; // password check ?>
		</div>
		<?php endif; ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>">
	<?php
	wp_reset_query();
	if(get_post_type() == 'forum') {
		$id_for_sidebar = bbp_get_forum_id();
	} elseif(get_post_type() == 'topic') {
		$id_for_sidebar = bbp_get_topic_id();
	} else {
		$id_for_sidebar = '';
	}
	$name = get_post_meta($id_for_sidebar, 'sbg_selected_sidebar_replacement', true);
	if( isset($name) && $name && $name[0] != '0') {
		generated_dynamic_sidebar($name[0]);
	} else {
		if ($smof_data['bbpress_global_sidebar'] && $smof_data['ppbress_sidebar'] != "None") {
			generated_dynamic_sidebar($smof_data['ppbress_sidebar']);
		} else if(!$smof_data['bbpress_global_sidebar']) {
			generated_dynamic_sidebar();
		}
	}
	?>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>