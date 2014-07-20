<?php global $smof_data; ?>
<div class="header-v1">
	<header id="header">
		<div class="avada-row" style="padding-top:<?php echo $smof_data['margin_header_top']; ?>;padding-bottom:<?php echo $smof_data['margin_header_bottom']; ?>;" data-padding-top="<?php echo $smof_data['margin_header_top']; ?>" data-padding-bottom="<?php echo $smof_data['margin_header_bottom']; ?>">
			<div class="logo" data-margin-right="<?php echo $smof_data['margin_logo_right']; ?>" data-margin-left="<?php echo $smof_data['margin_logo_left']; ?>" data-margin-top="<?php echo $smof_data['margin_logo_top']; ?>" data-margin-bottom="<?php echo $smof_data['margin_logo_bottom']; ?>" style="margin-right:<?php echo $smof_data['margin_logo_right']; ?>;margin-top:<?php echo $smof_data['margin_logo_top']; ?>;margin-left:<?php echo $smof_data['margin_logo_left']; ?>;margin-bottom:<?php echo $smof_data['margin_logo_bottom']; ?>;">
				<a href="<?php bloginfo('url'); ?>">
					<?php $image_size = getimagesize( $smof_data['logo'] ); ?>
					<img src="<?php echo $smof_data['logo']; ?>" alt="<?php bloginfo('name'); ?>" class="normal_logo" data-width="<?php echo $image_size[0]; ?>" data-height="<?php echo $image_size[1]; ?>" />
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
			<?php if($smof_data['ubermenu']): ?>
			<nav id="nav-uber">
			<?php else: ?>
			<nav id="nav" class="nav-holder" data-height="<?php echo $smof_data['nav_height']; ?>px">
			<?php endif; ?>
				<?php get_template_part('framework/headers/header-main-menu'); ?>
			</nav>
			<?php if(tf_checkIfMenuIsSetByLocation('main_navigation')): ?>
			<div class="mobile-nav-holder main-menu"></div>
			<?php endif; ?>
		</div>
	</header>
</div>