<?php get_header(); ?>
	<?php
	$sidebar_exists = true;

	if($smof_data['blog_archive_sidebar'] == 'None') {
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

	$container_class = '';
	$post_class = '';
	if($smof_data['blog_archive_layout'] == 'Large Alternate') {
		$post_class = 'large-alternate';
	} elseif($smof_data['blog_archive_layout'] == 'Medium Alternate') {
		$post_class = 'medium-alternate';
	} elseif($smof_data['blog_archive_layout'] == 'Grid') {
		$post_class = 'grid-post';
		$container_class = sprintf( 'grid-layout grid-layout-%s', $smof_data['blog_grid_columns'] );
	} elseif($smof_data['blog_archive_layout'] == 'Timeline') {
		$post_class = 'timeline-post';
		$container_class = 'timeline-layout';
		if($smof_data['blog_archive_sidebar'] != 'None') {
			$container_class = 'timeline-layout timeline-sidebar-layout';
		}
	}

	$author_id    = get_the_author_meta('ID');
	$name         = get_the_author_meta('display_name', $author_id);
	$avatar       = get_avatar( get_the_author_meta('email', $author_id), '82' );
	$description  = get_the_author_meta('description', $author_id);

	if(empty($description)) {
		$description  = __("This author has not yet filled in any details.",'Avada');
		$description .= '</br>'.sprintf( __( 'So far %s has created %s entries.' ), $name, count_user_posts( $author_id ) );
	}
	?>
	<div id="content" class="<?php echo $content_class; ?>" style="<?php echo $content_css; ?>">
		<div class="author">
			<div class="avatar">
			<?php echo $avatar ?>
			</div>
			<div class="author_description">
			<h3 class='author_title vcard'><?php echo __("About",'Avada'); ?> <span class="fn"><?php echo $name; ?></span>
			<?php if(current_user_can('edit_users') || get_current_user_id() == $author_id): ?>
			<span class="edit_profile">(<a href="<?php admin_url( 'profile.php?user_id=' . $author_id ); ?>"><?php echo __( 'Edit profile' ) ?></a>)</span>
			<?php endif; ?>
			</h3>
			<?php echo $description; ?>
			</div>
			<div style="clear:both;"></div>
			<div class="author_social clearfix">
			<div class="custom_msg">
			<?php if(get_the_author_meta('author_custom')): ?>
			<?php echo get_the_author_meta('author_custom'); ?>
			<?php endif; ?>
			</div>
			<?php
			$author_soical_icon_options = array (
				'authorpage'		=> 'yes',
				'author_id'			=> $author_id,
				'icon_colors' 		=> $smof_data['social_links_icon_color'],
				'box_colors' 		=> $smof_data['social_links_box_color'],
				'icon_boxed' 		=> $smof_data['social_links_boxed'],
				'icon_boxed_radius' => $smof_data['social_links_boxed_radius'],
				'tooltip_placement'	=> $smof_data['social_links_tooltip_placement'],
				'linktarget'		=> '_blank',
			);

			echo $social_icons->render_social_icons( $author_soical_icon_options );
			?>
			</div>
		</div>

		<?php if($smof_data['blog_archive_layout'] == 'Timeline'): ?>
		<div class="timeline-icon"><i class="icon-comments-alt"></i></div>
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
			<?php if($smof_data['blog_archive_layout'] == 'Timeline'): ?>
			<?php if($prev_post_month != $post_month): ?>
				<div class="timeline-date"><h3 class="timeline-title"><?php echo get_the_date($smof_data['timeline_date_format']); ?></h3></div>
			<?php endif; ?>
			<?php endif; ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class($post_class.getClassAlign($post_count).' clearfix'); ?>>
				<?php if($smof_data['blog_archive_layout'] == 'Medium Alternate'): ?>
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
					<?php if($smof_data['blog_archive_layout'] == 'Timeline'): ?>
					<div class="timeline-circle"></div>
					<div class="timeline-arrow"></div>
					<?php endif; ?>
					<?php if($smof_data['blog_archive_layout'] != 'Large Alternate' && $smof_data['blog_archive_layout'] != 'Medium Alternate' && $smof_data['blog_archive_layout'] != 'Grid'  && $smof_data['blog_archive_layout'] != 'Timeline'): ?>
					<h2 class=entry-title><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>
					<?php if($smof_data['blog_archive_layout'] == 'Large Alternate'): ?>
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
						<?php if($smof_data['blog_archive_layout'] == 'Large Alternate' || $smof_data['blog_archive_layout'] == 'Medium Alternate'  || $smof_data['blog_archive_layout'] == 'Grid' || $smof_data['blog_archive_layout'] == 'Timeline'): ?>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if($smof_data['post_meta'] && ( ! $smof_data['post_meta_author'] || ! $smof_data['post_meta_date'] || ! $smof_data['post_meta_cats'] || ! $smof_data['post_meta_tags'] || ! $smof_data['post_meta_comments'] ) ): ?>
						<?php if($smof_data['blog_archive_layout'] == 'Grid' || $smof_data['blog_archive_layout'] == 'Timeline'): ?>
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
					<div style="clear:both;"></div>
					<?php if($smof_data['post_meta']): ?>
					<div class="meta-info">
						<?php if($smof_data['blog_archive_layout'] == 'Grid' || $smof_data['blog_archive_layout'] == 'Timeline'): ?>
						<?php if($smof_data['blog_archive_layout'] != 'Large Alternate' && $smof_data['blog_archive_layout'] != 'Medium Alternate'): ?>
						<div class="alignleft">
							<?php if(!$smof_data['post_meta_read']): ?><a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read More', 'Avada'); ?></a><?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="alignright">
							<?php if(!$smof_data['post_meta_comments']): ?><?php comments_popup_link('<i class="icon-bubbles"></i>&nbsp;'.__('0', 'Avada'), '<i class="icon-bubbles"></i>&nbsp;'.__('1', 'Avada'), '<i class="icon-bubbles"></i>&nbsp;'.'%'); ?><?php endif; ?>
						</div>
						<?php else: ?>
						<?php if($smof_data['blog_archive_layout'] != 'Large Alternate' && $smof_data['blog_archive_layout'] != 'Medium Alternate'): ?>
						<div class="alignleft vcard">
							<?php if(!$smof_data['post_meta_author']): ?><?php echo __('By', 'Avada'); ?> <span class="fn"><?php the_author_posts_link(); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_date']): ?><span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span><span class="published"><?php the_time($smof_data['date_format']); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_cats']): ?><?php if(!$smof_data['post_meta_tags']){ echo __('Categories:', 'Avada') . ' '; } ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_tags']): ?><span class="meta-tags"><?php the_tags( ); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_comments']): ?><?php comments_popup_link(__('0 Comments', 'Avada'), __('1 Comment', 'Avada'), '% '.__('Comments', 'Avada')); ?><?php endif; ?>
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
	if ($smof_data['blog_archive_sidebar'] != 'None' && function_exists('dynamic_sidebar')) {
		generated_dynamic_sidebar($smof_data['blog_archive_sidebar']);
	}
	?>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>