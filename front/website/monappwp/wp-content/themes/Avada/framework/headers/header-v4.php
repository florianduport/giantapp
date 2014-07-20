<?php global $smof_data; ?>
<div class="header-v4">
	<?php if($smof_data['header_left_content'] != 'Leave Empty' || $smof_data['header_right_content'] != 'Leave Empty'): ?>
	<div class="header-social">
		<div class="avada-row">
			<div class="alignleft">
				<?php
				if($smof_data['header_left_content'] == 'Contact Info') {
					get_template_part('framework/headers/header-info');
				} elseif($smof_data['header_left_content'] == 'Social Links') {
					get_template_part('framework/headers/header-social');
				} elseif($smof_data['header_left_content'] == 'Navigation') {
					get_template_part('framework/headers/header-menu');
				}
				?>
			</div>
			<div class="alignright">
				<?php
				if($smof_data['header_right_content'] == 'Contact Info') {
					get_template_part('framework/headers/header-info');
				} elseif($smof_data['header_right_content'] == 'Social Links') {
					get_template_part('framework/headers/header-social');
				} elseif($smof_data['header_right_content'] == 'Navigation') {
					get_template_part('framework/headers/header-menu');
				}
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<header id="header">
		<div class="avada-row" style="padding-top:<?php echo $smof_data['margin_header_top']; ?>;padding-bottom:<?php echo $smof_data['margin_header_bottom']; ?>;">
			<div class="logo" data-margin-right="<?php echo $smof_data['margin_logo_right']; ?>" data-margin-left="<?php echo $smof_data['margin_logo_left']; ?>" data-margin-top="<?php echo $smof_data['margin_logo_top']; ?>" data-margin-bottom="<?php echo $smof_data['margin_logo_bottom']; ?>" style="margin-right:<?php echo $smof_data['margin_logo_right']; ?>;margin-top:<?php echo $smof_data['margin_logo_top']; ?>;margin-left:<?php echo $smof_data['margin_logo_left']; ?>;margin-bottom:<?php echo $smof_data['margin_logo_bottom']; ?>;">
				<a href="<?php bloginfo('url'); ?>">
					<img src="<?php echo $smof_data['logo']; ?>" alt="<?php bloginfo('name'); ?>" class="normal_logo" />
					<?php if($smof_data['logo_retina'] && $smof_data['retina_logo_width'] && $smof_data['retina_logo_height']): ?>
					<?php
					$pixels ="";
					if(is_numeric($smof_data['retina_logo_width']) && is_numeric($smof_data['retina_logo_height'])):
					$pixels ="px";
					endif; ?>
					<img src="<?php echo $smof_data["logo_retina"]; ?>" alt="<?php bloginfo('name'); ?>" style="width:<?php echo $smof_data["retina_logo_width"].$pixels; ?>;max-height:<?php echo $smof_data["retina_logo_height"].$pixels; ?>; height: auto !important" class="retina_logo" />
					<?php endif; ?>
				</a>
			</div>

			<?php if($smof_data['header_v4_content'] == 'TaglineAndSearch'): ?>
			<?php if($smof_data['logo_alignment'] == 'Left' || $smof_data['logo_alignment'] == 'Center'): ?>
				<form role="search" id="searchform" class="search" method="get" action="<?php echo home_url( '/' ); ?>">
					<div class="search-table">
						<div class="search-field">
							<input type="text" placeholder="<?php echo _e( 'Search...', 'Avada' ); ?>" value="" name="s" id="s" />
						</div>
						<div class="search-button">
							<input type="submit" id="searchsubmit" value="&#xf002;" />
						</div>
					</div>
				</form>
				<?php if($smof_data['header_tagline']): ?>
				<h3 class="tagline"><?php echo $smof_data['header_tagline']; ?></h3>
				<?php endif; ?>
			<?php elseif($smof_data['logo_alignment'] == 'Right'): ?>
				<?php if($smof_data['header_tagline']): ?>
				<h3 class="tagline"><?php echo $smof_data['header_tagline']; ?></h3>
				<?php endif; ?>
				<form role="search" id="searchform" class="search" method="get" action="<?php echo home_url( '/' ); ?>">
					<div class="search-table">
						<div class="search-field">
							<input type="text" placeholder="<?php echo _e( 'Search...', 'Avada' ); ?>" value="" name="s" id="s" />
						</div>
						<div class="search-button">
							<input type="submit" id="searchsubmit" value="&#xf002;" />
						</div>
					</div>
				</form>
			<?php endif; ?>
			<?php elseif($smof_data['header_v4_content'] == 'Tagline'): ?>
			<?php if($smof_data['header_tagline']): ?>
			<h3 class="tagline"><?php echo $smof_data['header_tagline']; ?></h3>
			<?php endif; ?>
			<?php elseif($smof_data['header_v4_content'] == 'Search'): ?>
			<form role="search" id="searchform" class="search" method="get" action="<?php echo home_url( '/' ); ?>">
				<div class="search-table">
					<div class="search-field">
						<input type="text" placeholder="<?php echo _e( 'Search...', 'Avada' ); ?>" value="" name="s" id="s" />
					</div>
					<div class="search-button">
						<input type="submit" id="searchsubmit" value="&#xf002;" />
					</div>
				</div>
			</form>
			<?php elseif($smof_data['header_v4_content'] == 'Banner'): ?>
			<div id="header-banner">
			<?php echo $smof_data['header_banner_code']; ?>
			</div>
			<?php endif; ?>
		</div>
	</header>
	<div id="small-nav">
		<div class="avada-row">
			<?php if($smof_data['ubermenu']): ?>
			<nav id="nav-uber">
			<?php else: ?>
			<nav id="nav" class="nav-holder">
			<?php endif; ?>
				<?php get_template_part('framework/headers/header-main-menu'); ?>
			</nav>
			<?php if(tf_checkIfMenuIsSetByLocation('main_navigation')): ?>
			<div class="mobile-nav-holder main-menu"></div>
			<?php endif; ?>
		</div>
	</div>
</div>