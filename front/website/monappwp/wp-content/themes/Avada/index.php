<?php get_header(); ?>
	<?php
	$container_class = '';
	$post_class = '';
	$content_class = '';

	$sidebar_exists = true;
	if($smof_data['blog_full_width']) {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$content_class= 'full-width';
		$sidebar_exists = false;
	} elseif($smof_data['blog_sidebar_position'] == 'Left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif($smof_data['blog_sidebar_position'] == 'Right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	}

	if($smof_data['blog_layout'] == 'Large Alternate') {
		$post_class = 'large-alternate';
	} elseif($smof_data['blog_layout'] == 'Medium Alternate') {
		$post_class = 'medium-alternate';
	} elseif($smof_data['blog_layout'] == 'Grid') {
		$post_class = 'grid-post';
		$container_class = sprintf( 'grid-layout grid-layout-%s', $smof_data['blog_grid_columns'] );
	} elseif($smof_data['blog_layout'] == 'Timeline') {
		$post_class = 'timeline-post';
		$container_class = 'timeline-layout';
		if(!$smof_data['blog_full_width']) {
			$container_class = 'timeline-layout timeline-sidebar-layout';
		}
	}
	?>
	<div id="content" class="<?php echo $content_class; ?>" style="<?php echo $content_css; ?>">
		<?php if($smof_data['blog_layout'] == 'Timeline'): ?>
		<div class="timeline-icon"><i class="icon-bubbles"></i></div>
		<?php endif; ?>
		<div id="posts-container" class="<?php echo $container_class; ?> clearfix">
			<?php
			$post_count = 1;

			$prev_post_timestamp = null;
			$prev_post_month = null;
			$first_timeline_loop = false;

			while(have_posts()): the_post();
				$post_timestamp = strtotime($post->post_date);
				$post_month = date('n', $post_timestamp);
				$post_year = get_the_date('o');
				$current_date = get_the_date('o-n');
			?>
			<?php if($smof_data['blog_layout'] == 'Timeline'): ?>
			<?php if($prev_post_month != $post_month): ?>
				<div class="timeline-date"><h3 class="timeline-title"><?php echo get_the_date($smof_data['timeline_date_format']); ?></h3></div>
			<?php endif; ?>
			<?php endif; ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class($post_class.getClassAlign($post_count).' clearfix'); ?>>
				<?php if($smof_data['blog_layout'] == 'Medium Alternate'): ?>
				<div class="date-and-formats">
					<div class="date-box">
						<span class="date"><?php the_time($smof_data['alternate_date_format_day']); ?></span>
						<span class="month-year"><?php the_time($smof_data['alternate_date_format_month_year']); ?></span>
					</div>
					<div class="format-box">
						<?php
						switch(get_post_format()) {
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
						?>
						<i class="icon-<?php echo $format_class; ?>"></i>
					</div>
				</div>
				<?php endif; ?>
				<?php
				if($smof_data['featured_images']):
				if($smof_data['legacy_posts_slideshow']) {
					get_template_part('legacy-slideshow');
				} else {
					get_template_part('new-slideshow');
				}
				endif;
				?>
				<div class="post-content-container">
				<?php if($smof_data['blog_layout'] == 'Timeline'): ?>
				<div class="timeline-circle"></div>
				<div class="timeline-arrow"></div>
				<?php endif; ?>
					<?php if($smof_data['blog_layout'] != 'Large Alternate' && $smof_data['blog_layout'] != 'Medium Alternate' && $smof_data['blog_layout'] != 'Grid'  && $smof_data['blog_layout'] != 'Timeline'): ?>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>
					<?php if($smof_data['blog_layout'] == 'Large Alternate'): ?>
					<div class="date-and-formats">
						<div class="date-box">
							<span class="date"><?php the_time($smof_data['alternate_date_format_day']); ?></span>
							<span class="month-year"><?php the_time($smof_data['alternate_date_format_month_year']); ?></span>
						</div>
						<div class="format-box">
							<?php
							switch(get_post_format()) {
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
							?>
							<i class="icon-<?php echo $format_class; ?>"></i>
						</div>
					</div>
					<?php endif; ?>
					<div class="post-content">
						<?php if($smof_data['blog_layout'] == 'Large Alternate' || $smof_data['blog_layout'] == 'Medium Alternate'  || $smof_data['blog_layout'] == 'Grid' || $smof_data['blog_layout'] == 'Timeline'): ?>
						<h2 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if($smof_data['post_meta'] && ( ! $smof_data['post_meta_author'] || ! $smof_data['post_meta_date'] || ! $smof_data['post_meta_cats'] || ! $smof_data['post_meta_tags'] || ! $smof_data['post_meta_comments'] ) ): ?>
						<?php if($smof_data['blog_layout'] == 'Grid' || $smof_data['blog_layout'] == 'Timeline'): ?>
						<p class="single-line-meta vcard"><?php if(!$smof_data['post_meta_author']): ?><?php echo __('By', 'Avada'); ?> <span class="fn"><?php the_author_posts_link(); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_date']): ?><span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span><span class="published"><?php the_time($smof_data['date_format']); ?></span><span class="sep">|</span><?php endif; ?></p>
						<?php else: ?>
						<p class="single-line-meta vcard"><?php if(!$smof_data['post_meta_author']): ?><?php echo __('By', 'Avada'); ?> <span class="fn"><?php the_author_posts_link(); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_date']): ?><span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span><span class="published"><?php the_time($smof_data['date_format']); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_cats']): ?><?php if(!$smof_data['post_meta_tags']){ echo __('Categories:', 'Avada') . ' '; } ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_tags']): ?><span class="meta-tags"><?php echo __('Tags:', 'Avada') . ' '; the_tags( '' ); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_comments']): ?><?php comments_popup_link(__('0 Comments', 'Avada'), __('1 Comment', 'Avada'), '% '.__('Comments', 'Avada')); ?><?php endif; ?></p>
						<?php endif; ?>
						<?php endif; ?>
						<?php endif; ?>
						<?php if( ( ! $smof_data['post_meta'] && $smof_data['excerpt_length_blog'] == '0' ) || ( $smof_data['post_meta_author'] && $smof_data['post_meta_date'] && $smof_data['post_meta_cats'] && $smof_data['post_meta_tags'] && $smof_data['post_meta_comments'] && $smof_data['post_meta_read'] && $smof_data['excerpt_length_blog'] == '0' ) ): ?>
						<?php if( ! $smof_data['post_meta'] ): ?> 
						<div class="no-content-sep"></div>
						<?php endif; ?>
						<?php else: ?>
						<div class="content-sep"></div>
						<?php endif; ?>
						<?php
						if($smof_data['content_length'] == 'Excerpt') {
							$stripped_content = tf_content( $smof_data['excerpt_length_blog'], $smof_data['strip_html_excerpt'] );
							echo $stripped_content;
						} else {
							the_content('');
						}
						?>
					</div>
					<div class="fusion-clearfix"></div>
					<?php if($smof_data['post_meta']): ?>
					<div class="meta-info">
						<?php if($smof_data['blog_layout'] == 'Grid' || $smof_data['blog_layout'] == 'Timeline'): ?>
						<?php if($smof_data['blog_layout'] != 'Large Alternate' && $smof_data['blog_layout'] != 'Medium Alternate'): ?>
						<div class="alignleft">
							<?php if(!$smof_data['post_meta_read']): ?><a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read More', 'Avada'); ?></a><?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="alignright">
							<?php if(!$smof_data['post_meta_comments']): ?><?php comments_popup_link('<i class="icon-bubbles"></i>&nbsp;'.__('0', 'Avada'), '<i class="icon-bubbles"></i>&nbsp;'.__('1', 'Avada'), '<i class="icon-bubbles"></i>&nbsp;'.'%'); ?><?php endif; ?>
						</div>
						<?php else: ?>
						<?php if($smof_data['blog_layout'] != 'Large Alternate' && $smof_data['blog_layout'] != 'Medium Alternate'): ?>
						<div class="alignleft vcard">
							<?php if(!$smof_data['post_meta_author']): ?><?php echo __('By', 'Avada'); ?> <span class="fn"><?php the_author_posts_link(); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_date']): ?><span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span><span class="published"><?php the_time($smof_data['date_format']); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_cats']): ?><?php if(!$smof_data['post_meta_tags']){ echo __('Categories:', 'Avada') . ' '; } ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_tags']): ?><span class="meta-tags"><?php echo __('Tags:', 'Avada') . ' '; the_tags( '' ); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_comments']): ?><?php comments_popup_link(__('0 Comments', 'Avada'), __('1 Comment', 'Avada'), '% '.__('Comments', 'Avada')); ?><?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="alignright">
							<?php if(!$smof_data['post_meta_read']): ?><a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read More', 'Avada'); ?></a><?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
			$prev_post_timestamp = $post_timestamp;
			$prev_post_month = $post_month;
			$post_count++;
			endwhile;
			?>
		</div>
		<?php themefusion_pagination($pages = '', $range = 2); ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>">
		<?php
		if(is_home()) {
			$name = get_post_meta(get_option('page_for_posts'), 'sbg_selected_sidebar_replacement', true);
			if($name) {
				generated_dynamic_sidebar($name[0]);
			}
		}
		if(is_front_page()) {
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Sidebar')):
			endif;
		}
		?>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>