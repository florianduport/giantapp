<?php
// Template Name: Blank Page
get_header(); ?>
	<div id="content" class="full-width">
		<?php while(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
			<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>	
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php global $smof_data; if(!$smof_data['featured_images_pages'] && has_post_thumbnail()): ?>
			<div class="image">
				<?php the_post_thumbnail('full'); ?>
			</div>
			<?php endif; ?>
			<?php endif; // password check ?>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
<?php get_footer(); ?>