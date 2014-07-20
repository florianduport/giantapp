<?php global $smof_data, $social_icons; ?>
<div class="fusion-social-links-header">
<?php 
$header_soical_icon_options = array (
	'icon_colors' 		=> $smof_data['header_social_links_icon_color'],
	'box_colors' 		=> $smof_data['header_social_links_box_color'],
	'icon_boxed' 		=> $smof_data['header_social_links_boxed'],
	'icon_boxed_radius' => $smof_data['header_social_links_boxed_radius'],
	'tooltip_placement'	=> $smof_data['header_social_links_tooltip_placement'],
	'linktarget'		=> $smof_data['social_icons_new']
);

echo $social_icons->render_social_icons( $header_soical_icon_options );
?>
</div>
