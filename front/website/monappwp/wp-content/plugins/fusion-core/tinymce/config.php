<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/

// Number of posts array
function fusion_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 ) {
	if( $all ) {
		$number_of_posts['-1'] = 'All';
	}

	if( $default ) {
		$number_of_posts[''] = 'Default';
	}

	foreach( range( $range_start, $range ) as $number ) {
		$number_of_posts[$number] = $number;
	}

	return $number_of_posts;
}

// Taxonomies
function fusion_shortcodes_categories ( $taxonomy, $empty_choice = false ) {
	if( $empty_choice == true ) {
		$post_categories[''] = 'Default';
	}

	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

	if( ! array_key_exists('errors', $get_categories) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
				$post_categories[$cat->slug] = $cat->name;
			}
		}

		if( isset( $post_categories ) ) {
			return $post_categories;
		}
	}
}

$choices = array( 'yes' => 'Yes', 'no' => 'No' );
$reverse_choices = array( 'no' => 'No', 'yes' => 'Yes' );
$choices_with_default = array( '' => 'Default', 'yes' => 'Yes', 'no' => 'No' );
$reverse_choices_with_default = array( '' => 'Default', 'no' => 'No', 'yes' => 'Yes' );
$leftright = array( 'left' => 'Left', 'right' => 'Right' );
$dec_numbers = array( '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' );

// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = FUSION_TINYMCE_DIR . '/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	@$subject = file_get_contents( $fontawesome_path );
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	$icons[$match[1]] = $match[2];
}

$checklist_icons = array ( 'icon-check' => '\f00c', 'icon-star' => '\f006', 'icon-angle-right' => '\f105', 'icon-asterisk' => '\f069', 'icon-remove' => '\f00d', 'icon-plus' => '\f067' );

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Alert Type', 'fusion-core' ),
			'desc' => __( 'Select the type of alert message. Choose custom for advanced color options below.', 'fusion-core' ),
			'options' => array(
				'general' => 'General',
				'error' => 'Error',
				'success' => 'Success',
				'notice' => 'Notice',
				'custom' => 'Custom',
			)
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Set the border, text and icon color for custom alert boxes.', 'fusion-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Set the background color for custom alert boxes.', 'fusion-core')
		),
		'bordersize' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'fusion-core' ),
			'desc' => 'Custom setting only. For custom alert boxes. In pixels (px), ex: 1px.'
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Click an icon to select, click again to deselect', 'fusion-core' ),
			'options' => $icons
		),
		'boxshadow' => array(
			'type' => 'select',
			'label' => __( 'Box Shadow', 'fusion-core' ),
			'desc' =>  __( 'Display a box shadow below the alert box.', 'fusion-core' ),
			'options' => $choices
		),		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'fusion-core' ),
			'desc' => __( 'Insert the alert\'s content', 'fusion-core' ),
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'fusion-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'fusion-core' ),
			'options' => array(
				'0' => 'None',
				'bounce' => 'Bounce',
				'fade' => 'Fade',
				'flash' => 'Flash',
				'shake' => 'Shake',
				'slide' => 'Slide',
			)
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'fusion-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'fusion-core' ),
			'options' => array(
				'down' => 'Down',
				'left' => 'Left',
				'right' => 'Right',
				'up' => 'Up',
			)
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'fusion-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'fusion-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),		
	),
	'shortcode' => '[alert type="{{type}}" accent_color="{{accentcolor}}" background_color="{{backgroundcolor}}" border_size="{{bordersize}}" icon="{{icon}}" box_shadow="{{boxshadow}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]{{content}}[/alert]',
	'popup_title' => __( 'Alert Shortcode', 'fusion-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['blog'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Blog Layout', 'fusion-core' ),
			'desc' => __( 'Select the layout for the blog shortcode', 'fusion-core' ),
			'options' => array(
				'large' => 'Large',
				'medium' => 'Medium',
				'large alternate' => 'Large Alternate',
				'medium alternate' => 'Medium Alternate',
				'grid' => 'Grid',
				'timeline' => 'Timeline'
			)
		),
		'posts_per_page' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'fusion-core' ),
			'desc' => __( 'Select number of posts per page', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 25, true, true )
		),
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'fusion-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'fusion-core' ),
			'desc' => __( 'Select a category to exclude', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'category' )
		),
		'title' => array(
			'type' => 'select',
			'label' => __( 'Show Title', 'fusion-core' ),
			'desc' =>  __( 'Display the post title below the featured image', 'fusion-core' ),
			'options' => $choices
		),
		'title_link' => array(
			'type' => 'select',
			'label' => __( 'Link Title To Post', 'fusion-core' ),
			'desc' =>  __( 'Choose if the title should be a link to the single post page.', 'fusion-core' ),
			'options' => $choices
		),		
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Show Thumbnail', 'fusion-core' ),
			'desc' =>  __( 'Display the post featured image', 'fusion-core' ),
			'options' => $choices
		),
		'excerpt' => array(
			'type' => 'select',
			'label' => __( 'Show Excerpt', 'fusion-core' ),
			'desc' =>  __( 'Show excerpt or choose "no" for full content', 'fusion-core' ),
			'options' => $choices
		),
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Number of words/characters in Excerpt', 'fusion-core' ),
			'desc' =>  __( 'Controls the excerpt length based on words or characters that is set in Theme Options > Extra.', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 60, false )
		),
		'meta_all' => array(
			'type' => 'select',
			'label' => __( 'Show Meta Info', 'fusion-core' ),
			'desc' =>  __( 'Choose to show all meta data', 'fusion-core' ),
			'options' => $choices
		),
		'meta_author' => array(
			'type' => 'select',
			'label' => __( 'Show Author Name', 'fusion-core' ),
			'desc' =>  __( 'Choose to show the author', 'fusion-core' ),
			'options' => $choices
		),
		'meta_categories' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'fusion-core' ),
			'desc' =>  __( 'Choose to show the categories', 'fusion-core' ),
			'options' => $choices
		),
		'meta_comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comment Count', 'fusion-core' ),
			'desc' =>  __( 'Choose to show the comments', 'fusion-core' ),
			'options' => $choices
		),
		'meta_date' => array(
			'type' => 'select',
			'label' => __( 'Show Date', 'fusion-core' ),
			'desc' =>  __( 'Choose to show the date', 'fusion-core' ),
			'options' => $choices
		),
		'meta_link' => array(
			'type' => 'select',
			'label' => __( 'Show Read More Link', 'fusion-core' ),
			'desc' =>  __( 'Choose to show the link', 'fusion-core' ),
			'options' => $choices
		),
		'meta_tags' => array(
			'type' => 'select',
			'label' => __( 'Show Tags', 'fusion-core' ),
			'desc' =>  __( 'Choose to show the tags', 'fusion-core' ),
			'options' => $choices
		),
		'paging' => array(
			'type' => 'select',
			'label' => __( 'Show Pagination', 'fusion-core' ),
			'desc' =>  __( 'Show numerical pagination boxes', 'fusion-core' ),
			'options' => $choices
		),
		'scrolling' => array(
			'type' => 'select',
			'label' => __( 'Infinite Scrolling', 'fusion-core' ),
			'desc' =>  __( 'Choose the type of scrolling', 'fusion-core' ),
			'options' => array(
				'pagination' => 'Pagination',
				'infinite' => 'Infinite Scrolling'
			)
		),
		'blog_grid_columns' => array(
			'type' => 'select',
			'label' => __( 'Grid Layout # of Columns', 'fusion-core' ),
			'desc' => __( 'Select whether to display the grid layout in 2, 3 or 4 column.', 'fusion-core' ),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			)
		),
		'strip_html' => array(
			'type' => 'select',
			'label' => __( 'Strip HTML from Posts Content', 'fusion-core' ),
			'desc' =>  __( 'Strip HTML from the post excerpt', 'fusion-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),		
	),
	'shortcode' => '[blog number_posts="{{posts_per_page}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" title="{{title}}" title_link="{{title_link}}" thumbnail="{{thumbnail}}" excerpt="{{excerpt}}" excerpt_length="{{excerpt_length}}" meta_all="{{meta_all}}" meta_author="{{meta_author}}" meta_categories="{{meta_categories}}" meta_comments="{{meta_comments}}" meta_date="{{meta_date}}" meta_link="{{meta_link}}" meta_tags="{{meta_tags}}" paging="{{paging}}" scrolling="{{scrolling}}" strip_html="{{strip_html}}" blog_grid_columns="{{blog_grid_columns}}" layout="{{layout}}" class="{{class}}" id="{{id}}"][/blog]',
	'popup_title' => __( 'Blog Shortcode', 'fusion-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button URL', 'fusion-core' ),
			'desc' => __( 'Add the button\'s url ex: http://example.com.', 'fusion-core' )
		),
		'style' => array(
			'type' => 'select',
			'label' => __( 'Button Style', 'fusion-core' ),
			'desc' => __( 'Select the button\'s color. Select default or color name for theme options, or select custom to use advanced color options below.', 'fusion-core' ),
			'options' => array(
				'default' => 'Default',
				'custom' => 'Custom',
				'green' => 'Green',
				'darkgreen' => 'Dark Green',
				'orange' => 'Orange',
				'blue' => 'Blue',
				'red' => 'Red',
				'pink' => 'Pink',
				'darkgray' => 'Dark Gray',
				'lightgray' => 'Light Gray',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'fusion-core' ),
			'desc' => __( 'Select the button\'s size. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
				'xlarge' => 'XLarge',
			)
		),
		'type' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'fusion-core' ),
			'desc' => __( 'Select the button\'s type. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'flat' => 'Flat',
				'3d' => '3D',
			)
		),
		'shape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'fusion-core' ),
			'desc' => __( 'Select the button\'s shape. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'square' => 'Square',
				'pill' => 'Pill',
				'round' => 'Round',
			)
		),				
		'target' => array(
			'type' => 'select',
			'label' => __( 'Button Target', 'fusion-core' ),
			'desc' => __( '_self = open in same window <br />_blank = open in new window.', 'fusion-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Title Attribute', 'fusion-core' ),
			'desc' => __( 'Set a title attribute for the button link.', 'fusion-core' ),
		),
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __( 'Button\'s Text', 'fusion-core' ),
			'desc' => __( 'Add the text that will display in the button.', 'fusion-core' ),
		),
		'gradtopcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Set the top color of the button background.', 'fusion-core' )
		),
		'gradbottomcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Set the bottom color of the button background or leave empty for solid color.', 'fusion-core' )
		),
		'gradtopcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color Hover', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Set the top hover color of the button background.', 'fusion-core' )
		),
		'gradbottomcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color Hover', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Set the bottom hover color of the button background or leave empty for solid color.', 'fusion-core' )
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'fusion-core' ),
			'desc' => __( 'Custom setting only. This option controls the color of the button border, divider, text and icon.', 'fusion-core' )
		),
		'accenthovercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Hover Color', 'fusion-core' ),
			'desc' => __( 'Custom setting only. This option controls the hover color of the button border, divider, text and icon.', 'fusion-core' )
		),		
		'bevelcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Bevel Color (3D Mode only)', 'fusion-core' ),
			'desc' => __( 'Custom setting only. Set the bevel color of 3D buttons.', 'fusion-core' )
		),		
		'borderwidth' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'fusion-core' ),
			'desc' => __( 'Custom setting only. In pixels (px), ex: 1px.  Leave blank for theme option selection.', 'fusion-core' )
		),
		/*
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'fusion-core' ),
			'desc' => 'Custom setting. Backside.'
		),
		'borderhovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Hover Color', 'fusion-core' ),
			'desc' => 'Custom setting. Backside.'
		),		
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Color', 'fusion-core' ),
			'desc' => 'Custom setting. Backside.'
		),
		'texthovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Hover Color', 'fusion-core' ),
			'desc' => 'Custom setting. Backside.'
		),
		*/
		'shadow' => array(
			'type' => 'select',
			'label' => __( 'Shadow', 'fusion-core' ),
			'desc' => __( 'Choose to enable/disable the shadows. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'yes' => 'Yes',
				'no' => 'No',
			),
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'fusion-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'fusion-core' ),
			'options' => $icons
		),
		/*
		'iconcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Icon Color', 'fusion-core' ),
			'desc' => 'Custom setting. Leave blank for theme option selection.'
		),
		*/
		'iconposition' => array(
			'type' => 'select',
			'label' => __( 'Icon Position', 'fusion-core' ),
			'desc' => __( 'Choose the position of the icon on the button.', 'fusion-core' ),
			'options' => $leftright
		),			
		'icondivider' => array(
			'type' => 'select',
			'label' => __( 'Icon Divider', 'fusion-core' ),
			'desc' => __( 'Choose to display a divider between icon and text.', 'fusion-core' ),
			'options' => $choices
		),
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Window Anchor', 'fusion-core' ),
			'desc' => __( 'Add the class name of the modal window you want to open on button click.', 'fusion-core' ),
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'fusion-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'fusion-core' ),
			'options' => array(
				'0' => 'None',
				'bounce' => 'Bounce',
				'fade' => 'Fade',
				'flash' => 'Flash',
				'shake' => 'Shake',
				'slide' => 'Slide',
			)
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'fusion-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'fusion-core' ),
			'options' => array(
				'down' => 'Down',
				'left' => 'Left',
				'right' => 'Right',
				'up' => 'Up',
			)
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'fusion-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'fusion-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),			
	),
	//'shortcode' => '[button link="{{url}}" color="{{style}}" size="{{size}}" type="{{type}}" shape="{{shape}}" target="{{target}}" title="{{title}}" gradient_colors="{{gradtopcolor}}|{{gradbottomcolor}}" gradient_hover_colors="{{gradtopcolorhover}}|{{gradbottomcolorhover}}" bevel_color="{{bevelcolor}}" border_width="{{bordersize}}" border_color="{{bordercolor}}" border_hover_color="{{borderhovercolor}}" text_color="{{textcolor}}" text_hover_color="{{texthovercolor}}" shadow="{{shadow}}" icon="{{icon}}" icon_color="{{iconcolor}}" icon_divider="{{icondivider}}" icon_position="{{iconposition}}" modal="{{modal}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]{{content}}[/button]',
	'shortcode' => '[button link="{{url}}" color="{{style}}" size="{{size}}" type="{{type}}" shape="{{shape}}" target="{{target}}" title="{{title}}" gradient_colors="{{gradtopcolor}}|{{gradbottomcolor}}" gradient_hover_colors="{{gradtopcolorhover}}|{{gradbottomcolorhover}}" accent_color="{{accentcolor}}" accent_hover_color="{{accenthovercolor}}" bevel_color="{{bevelcolor}}" border_width="{{borderwidth}}" shadow="{{shadow}}" icon="{{icon}}" icon_divider="{{icondivider}}" icon_position="{{iconposition}}" modal="{{modal}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]{{content}}[/button]',
	'popup_title' => __( 'Button Shortcode', 'fusion-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Checklist Config
/*-----------------------------------------------------------------------------------*/
$fusion_shortcodes['checklist'] = array(
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'fusion-core' ),
			'desc' => __( 'Global setting for all list items, this can be overridden individually below. Click an icon to select, click again to deselect.', 'fusion-core' ),
			'options' => $icons
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'fusion-core' ),
			'desc' => __( 'Global setting for all list items, this can be overridden individually below. Choose to display the icon in a circle.', 'fusion-core' ),
			'options' => $choices
		),	
		'size' => array(
			'type' => 'select',
			'label' => __( 'Item Size', 'fusion-core' ),
			'desc' => __( 'Select the list item\'s size.', 'fusion-core' ),
			'options' => array(
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
			)
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),		
	),

	'shortcode' => '[checklist icon="{{icon}}" circle="{{circle}}" size="{{size}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/checklist]',
	'popup_title' => __( 'Checklist Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Select Icon', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core' ),
				'options' => $icons
			),
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core')
			),
			'circle' => array(
				'type' => 'select',
				'label' => __( 'Icon in Circle', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core' ),
				'options' => $choices_with_default
			),
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Circle Color', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core')
			),				
			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'List Item Content', 'fusion-core' ),
				'desc' => __( 'Add list item content', 'fusion-core' ),
			),
		),
		'shortcode' => '[li_item icon="{{icon}}" iconcolor="{{iconcolor}}" circle="{{circle}}" circlecolor="{{circlecolor}}"]{{content}}[/li_item]',
		'clone_button' => __( 'Add New List Item', 'fusion-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Client Slider Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['clientslider'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'fusion-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'fusion-core' ),
			'options' => array(
				'fixed' => 'Fixed',
				'auto' => 'Auto'
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),		
	),
	'shortcode' => '[clients picture_size="{{picture_size}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/clients]', // as there is no wrapper shortcode
	'popup_title' => __( 'Client Slider Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Client Website Link', 'fusion-core' ),
				'desc' => __( 'Add the url to client\'s website <br />ex: http://example.com', 'fusion-core')
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'fusion-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'fusion-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Client Image', 'fusion-core' ),
				'desc' => __( 'Upload the client image', 'fusion-core' ),
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Alt Text', 'fusion-core' ),
				'desc' => 'The alt attribute provides alternative information if an image cannot be viewed'
			),				
		),
		'shortcode' => '[client link="{{url}}" linktarget="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' => __( 'Add New Client Image', 'fusion-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['columns'] = array(
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Columns Shortcode', 'fusion-core' ),
	'no_preview' => true,
	'params' => array(),

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __( 'Column Type', 'fusion-core' ),
				'desc' => __( 'Select the width of the column', 'fusion-core' ),
				'options' => array(
					'one_third' => 'One Third',
					'two_third' => 'Two Thirds',
					'one_half' => 'One Half',
					'one_fourth' => 'One Fourth',
					'three_fourth' => 'Three Fourth',
				)
			),
			'last' => array(
				'type' => 'select',
				'label' => __( 'Last Column', 'fusion-core' ),
				'desc' => 'Choose if the column is last in a set. This has to be set to "Yes" for the last column in a set',
				'options' => $reverse_choices
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Column Content', 'fusion-core' ),
				'desc' => __( 'Insert the column content', 'fusion-core' ),
			),
			'class' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS Class', 'fusion-core' ),
				'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
			),
			'id' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS ID', 'fusion-core' ),
				'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
			),			
		),
		'shortcode' => '[{{column}} last="{{last}}" class="{{class}}" id="{{id}}"]{{content}}[/{{column}}] ',
		'clone_button' => __( 'Add Column', 'fusion-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Content Boxes Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['contentboxes'] = array(
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Box Layout', 'fusion-core' ),
			'desc' => __( 'Select the layout for the content box', 'fusion-core' ),
			'options' => array(
				'icon-with-title' => 'Icon beside Title',
				'icon-on-top' => 'Icon on Top of Title',
				'icon-on-side' => 'Icon beside Title and Content aligned with Title',
				'icon-boxed' => 'Icon Boxed',
			)
		),
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'fusion-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 5, false )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),			
	),
	'shortcode' => '[content_boxes layout="{{layout}}" columns="{{columns}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/content_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Content Boxes Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'fusion-core')
			),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'fusion-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'fusion-core' ),
				'options' => $icons
			),
			'backgroundcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Content Box Background Color', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core')
			),			
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core')
			),
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Background Color', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Border Color', 'fusion-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'fusion-core')
			),			
			'iconflip' => array(
				'type' => 'select',
				'label' => __( 'Flip Icon', 'fusion-core' ),
				'desc' => __( 'Choose to flip the icon.', 'fusion-core' ),
				'options' => array(
					''	=> 'None',
					'horizontal' => 'Horizontal',
					'vertical' => 'Vertical',
				)
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'fusion-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'fusion-core' ),
				'options' => array(
					''	=> 'None',
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'fusion-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'fusion-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'fusion-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'fusion-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'fusion-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'fusion-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'fusion-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'fusion-core' ),
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Read More Link Url', 'fusion-core' ),
				'desc' => __( 'Add the link\'s url ex: http://example.com', 'fusion-core' ),

			),
			'linktext' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Read More Link Text', 'fusion-core' ),
				'desc' => __( 'Insert the text to display as the link', 'fusion-core' ),

			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Read More Link Target', 'fusion-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'fusion-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Content Box Content', 'fusion-core' ),
				'desc' => __( 'Add content for content box', 'fusion-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'fusion-core' ),
				'desc' => __( 'Select the type on animation to use on the shortcode', 'fusion-core' ),
				'options' => array(
					'0' => 'None',
					'bounce' => 'Bounce',
					'fade' => 'Fade',
					'flash' => 'Flash',
					'shake' => 'Shake',
					'slide' => 'Slide',
				)
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'fusion-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'fusion-core' ),
				'options' => array(
					'down' => 'Down',
					'left' => 'Left',
					'right' => 'Right',
					'up' => 'Up',
				)
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'fusion-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'fusion-core' ),
				'options' => $dec_numbers,
			)
		),
		'shortcode' => '[content_box title="{{title}}" backgroundcolor="{{backgroundcolor}}" icon="{{icon}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" iconflip="{{iconflip}}" iconrotate="{{iconrotate}}" iconspin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" link="{{link}}" linktarget="{{target}}" linktext="{{linktext}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}"]{{content}}[/content_box]',
		'clone_button' => __( 'Add New Content Box', 'fusion-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Counters Box Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['countersbox'] = array(
	'params' => array(
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'fusion-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 4, false )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),
	),
	'shortcode' => '[counters_box columns="{{columns}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/counters_box]', // as there is no wrapper shortcode
	'popup_title' => __( 'Counters Box Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'value' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Counter Value', 'fusion-core' ),
				'desc' => __( 'The number to which the counter will animate.', 'fusion-core')
			),
			'unit' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Counter Box Unit', 'fusion-core' ),
				'desc' => __( 'Insert a unit for the counter. ex %', 'fusion-core' ),
			),
			'unitpos' => array(
				'type' => 'select',
				'label' => __( 'Unit Position', 'fusion-core' ),
				'desc' => __( 'Choose the positioning of the unit.', 'fusion-core' ),
				'options' => array(
					'suffix' => 'After Counter',
					'prefix' => 'Before Counter',
				)
			),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'fusion-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'fusion-core' ),
				'options' => $icons
			),			
			'border' => array(
				'type' => 'select',
				'label' => __( 'Show Border', 'fusion-core' ),
				'desc' => __( 'Choose to show a box border.', 'fusion-core' ),
				'options' => $choices
			),
			'color' => array(
				'type' => 'colorpicker',
				'label' => __( 'Color Of Counter', 'fusion-core' ),
				'desc' => __( 'Controls the color of the counter text and icon. Leave blank for theme option selection.', 'fusion-core')
			),
			'direction' => array(
				'type' => 'select',
				'label' => __( 'Counter Diection', 'fusion-core' ),
				'desc' => __( 'Choose to count up or down.', 'fusion-core' ),
				'options' => array(
					'up' => 'Countup',
					'down' => 'Countdown',
				)
			),			
			'content' => array(
				'std' => 'Text',
				'type' => 'text',
				'label' => __( 'Counter Box Text', 'fusion-core' ),
				'desc' => __( 'Insert text for counter box', 'fusion-core' ),
			)
		),
		'shortcode' => '[counter_box value="{{value}}" unit="{{unit}}" unit_pos="{{unitpos}}" icon="{{icon}}" border="{{border}}" color="{{color}}" direction="{{direction}}"]{{content}}[/counter_box]',
		'clone_button' => __( 'Add New Counter Box', 'fusion-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Counters Circle Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['counterscircle'] = array(
	'params' => array(
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),
	),
	'shortcode' => '[counters_circle class="{{class}}" id="{{id}}"]{{child_shortcode}}[/counters_circle]', // as there is no wrapper shortcode
	'popup_title' => __( 'Counters Circle Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'value' => array(
				'type' => 'select',
				'label' => __( 'Filled Area Percentage', 'fusion-core' ),
				'desc' => __( 'From 1% to 100%', 'fusion-core' ),
				'options' => fusion_shortcodes_range(100, false)
			),
			'filledcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Filled Color', 'fusion-core' ),
				'desc' => __( 'Controls the color of the filled in area. Leave blank for theme option selection.', 'fusion-core')
			),
			'unfilledcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Unfilled Color', 'fusion-core' ),
				'desc' => __( 'Controls the color of the unfilled in area. Leave blank for theme option selection.', 'fusion-core')
			),
			'size' => array(
				'std' => '220',
				'type' => 'text',
				'label' => __( 'Size of the Counter', 'fusion-core' ),
				'desc' => __( 'Insert size of the counter in px. ex: 220', 'fusion-core' ),
			),
			'scales' => array(
				'type' => 'select',
				'label' => __( 'Show Scales', 'fusion-core' ),
				'desc' => __( 'Choose to show a scale around circles.', 'fusion-core' ),
				'options' => $reverse_choices
			),		
			'countdown' => array(
				'type' => 'select',
				'label' => __( 'Countdown', 'fusion-core' ),
				'desc' => __( 'Choose to let the circle filling move counter clockwise.', 'fusion-core' ),
				'options' => $reverse_choices
			),					
			'speed' => array(
				'std' => '1500',
				'type' => 'text',
				'label' => __( 'Animation Speed', 'fusion-core' ),
				'desc' => __( 'Insert animation speed in milliseconds', 'fusion-core' ),
			),
			'content' => array(
				'std' => 'Text',
				'type' => 'text',
				'label' => __( 'Counter Circle Text', 'fusion-core' ),
				'desc' => __( 'Insert text for counter circle box, keep it short', 'fusion-core' ),
			),			
		),
		'shortcode' => '[counter_circle filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}" size="{{size}}" scales="{{scales}}" countdown="{{countdown}}" speed="{{speed}}" value="{{value}}"]{{content}}[/counter_circle]',
		'clone_button' => __( 'Add New Counter Circle', 'fusion-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Dropcap Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => 'A',
			'type' => 'textarea',
			'label' => __( 'Dropcap Letter', 'fusion-core' ),
			'desc' => __( 'Add the letter to be used as dropcap', 'fusion-core' ),
		),
		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Color', 'fusion-core' ),
			'desc' => __( 'Controls the color of the dropcap letter. Leave blank for theme option selection.', 'fusion-core ')
		),		
		'boxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Dropcap', 'fusion-core' ),
			'desc' => __( 'Choose to get a boxed dropcap.', 'fusion-core' ),
			'options' => $reverse_choices
		),
		'boxedradius' => array(
			'std' => '8px',
			'type' => 'text',
			'label' => __( 'Box Radius', 'fusion-core' ),
			'desc' => 'Choose the radius of the boxed dropcap. In pixels (px), ex: 1px, or "round".'
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),
	),
	'shortcode' => '[dropcap color="{{color}}" boxed="{{boxed}}" boxed_radius="{{boxedradius}}" class="{{class}}" id="{{id}}"]{{content}}[/dropcap]',
	'popup_title' => __( 'Dropcap Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Post Slider Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['postslider'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'fusion-core' ),
			'desc' => __( 'Choose a layout style for Post Slider.', 'fusion-core' ),
			'options' => array(
				'posts' => 'Posts with Title',
				'posts-with-excerpt' => 'Posts with Title and Excerpt',
				'attachments' => 'Attachment Layout, Only Images Attached to Post/Page'
			)
		),
		'excerpt' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Excerpt Number of Words', 'fusion-core' ),
			'desc' => __( 'Insert the number of words you want to show in the excerpt.', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 50, false)
		),
		'category' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Category', 'fusion-core' ),
			'desc' => __( 'Select a category of posts to display.', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'category', true )
		),
		'limit' => array(
			'std' => 3,
			'type' => 'select',
			'label' => __( 'Number of Slides', 'fusion-core' ),
			'desc' => __( 'Select the number of slides to display.', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 10, false )
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Lightbox on Click', 'fusion-core' ),
			'desc' => __( 'Only works on attachment layout.', 'fusion-core' ),
			'options' => $choices
		),
		'image' => array(
			'type' => 'gallery',
			'label' => __( 'Attach Images to Post/Page Gallery', 'fusion-core' ),
			'desc' => __( 'Only works for attachments layout.', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),		
	),
	'shortcode' => '[postslider layout="{{type}}" excerpt="{{excerpt}}" category="{{category}}" limit="{{limit}}" id="" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"][/postslider]',
	'popup_title' => __( 'Post Slider Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Flip Boxes Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['flipboxes'] = array(
	'params' => array(

		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'fusion-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 4, false )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[flip_boxes columns="{{columns}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/flip_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Flip Boxes Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'titlefront' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'text',
				'label' => __( 'Flip Box Frontside Heading', 'fusion-core' ),
				'desc' => __( 'Add a heading for the frontside of the flip box.', 'fusion-core' ),
			),			
			'titleback' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'text',
				'label' => __( 'Flip Box Backside Heading', 'fusion-core' ),
				'desc' => __( 'Add a heading for the backside of the flip box.', 'fusion-core' ),
			),			
			'textfront' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Flip Box Frontside Content', 'fusion-core' ),
				'desc' => __( 'Add content for the frontside of the flip box.', 'fusion-core' ),
			),			
			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Flip Box Backside Content', 'fusion-core' ),
				'desc' => __( 'Add content for the backside of the flip box.', 'fusion-core' ),
			),		
			'backgroundcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Frontside', 'fusion-core' ),
				'desc' => __( 'Controls the background color of the frontside. Leave blank for theme option selection.', 'fusion-core' )
			),
			'titlecolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Frontside', 'fusion-core' ),
				'desc' => __( 'Controls the heading color of the frontside. Leave blank for theme option selection.', 'fusion-core' )
			),
			'textcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Frontside', 'fusion-core' ),
				'desc' => __( 'Controls the text color of the frontside. Leave blank for theme option selection.', 'fusion-core' )
			),			
			'backgroundcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Backside', 'fusion-core' ),
				'desc' => __( 'Controls the background color of the backside. Leave blank for theme option selection.', 'fusion-core' )
			),
			'titlecolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Backside', 'fusion-core' ),
				'desc' => __( 'Controls the heading color of the backside. Leave blank for theme option selection.', 'fusion-core' )
			),				
			'textcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Backside', 'fusion-core' ),
				'desc' => __( 'Controls the text color of the backside. Leave blank for theme option selection.', 'fusion-core' )
			),			
			'bordersize' => array(
				'std' => '1px',
				'type' => 'text',
				'label' => __( 'Border Size', 'fusion-core' ),
				'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'fusion-core' ),
			),
			'bordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Border Color', 'fusion-core' ),
				'desc' => __( 'Controls the border color.  Leave blank for theme option selection.', 'fusion-core' )
			),
			'borderradius' => array(
				'std' => '4px',
				'type' => 'text',
				'label' => __( 'BorderRadius', 'fusion-core' ),
				'desc' => __( 'Choose the radius of the flip box. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'fusion-core' ),
			),			
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'fusion-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'fusion-core' ),
				'options' => $icons
			),			
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'fusion-core' ),
				'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'fusion-core' )
			),
			'circle' => array(
				'std' => 0,
				'type' => 'select',
				'label' => __( 'Icon Circle', 'fusion-core' ),
				'desc' => __( 'Choose to use a circled background on the icon.', 'fusion-core' ),
				'options' => $choices
			),			
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Background Color', 'fusion-core' ),
				'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'fusion-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Border Color', 'fusion-core' ),
				'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'fusion-core')
			),			
			'iconflip' => array(
				'type' => 'select',
				'label' => __( 'Flip Icon', 'fusion-core' ),
				'desc' => __( 'Choose to flip the icon.', 'fusion-core' ),
				'options' => array(
					''	=> 'None',
					'horizontal' => 'Horizontal',
					'vertical' => 'Vertical',
				)
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'fusion-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'fusion-core' ),
				'options' => array(
					''	=> 'None',
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'fusion-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'fusion-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'fusion-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'fusion-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'fusion-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'fusion-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'fusion-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'fusion-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'fusion-core' ),
				'desc' => __( 'Select the type on animation to use on the shortcode.', 'fusion-core' ),
				'options' => array(
					'0' => 'None',
					'bounce' => 'Bounce',
					'fade' => 'Fade',
					'flash' => 'Flash',
					'shake' => 'Shake',
					'slide' => 'Slide',
				)
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'fusion-core' ),
				'desc' => __( 'Select the incoming direction for the animation.', 'fusion-core' ),
				'options' => array(
					'down' => 'Down',
					'left' => 'Left',
					'right' => 'Right',
					'up' => 'Up',
				)
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'fusion-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'fusion-core' ),
				'options' => $dec_numbers,
			)
		),
		'shortcode' => '[flip_box title_front="{{titlefront}}" title_back="{{titleback}}" text_front="{{textfront}}" border_color="{{bordercolor}}" border_radius="{{borderradius}}" border_size="{{bordersize}}" background_color_front="{{backgroundcolorfront}}" title_front_color="{{titlecolorfront}}" text_front_color="{{textcolorfront}}" background_color_back="{{backgroundcolorback}}" title_back_color="{{titlecolorback}}" text_back_color="{{textcolorback}}" icon="{{icon}}" icon_color="{{iconcolor}}" circle="{{circle}}" circle_color="{{circlecolor}}" circle_border_color="{{circlebordercolor}}" icon_flip="{{iconflip}}" icon_rotate="{{iconrotate}}" icon_spin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}"]{{content}}[/flip_box]',
		'clone_button' => __( 'Add New Flip Box', 'fusion-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	FontAwesome Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['fontawesome'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'fusion-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'fusion-core' ),
			'options' => $icons
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'fusion-core' ),
			'desc' => __( 'Choose to display the icon in a circle.', 'fusion-core' ),
			'options' => $choices
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size of Icon', 'fusion-core' ),
			'desc' => __( 'Select the size of the icon.', 'fusion-core' ),
			'options' => array(
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
			)
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'fusion-core' ),
			'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'fusion-core')
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'fusion-core')
		),
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Border Color', 'fusion-core' ),
			'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'fusion-core')
		),
		'flip' => array(
			'type' => 'select',
			'label' => __( 'Flip Icon', 'fusion-core' ),
			'desc' => __( 'Choose to flip the icon.', 'fusion-core' ),
			'options' => array(
				''	=> 'None',
				'horizontal' => 'Horizontal',
				'vertical' => 'Vertical',
			)
		),
		'rotate' => array(
			'type' => 'select',
			'label' => __( 'Rotate Icon', 'fusion-core' ),
			'desc' => __( 'Choose to rotate the icon.', 'fusion-core' ),
			'options' => array(
				''	=> 'None',
				'90' => '90',
				'180' => '180',
				'270' => '270',					
			)
		),				
		'spin' => array(
			'type' => 'select',
			'label' => __( 'Spinning Icon', 'fusion-core' ),
			'desc' => __( 'Choose to let the icon spin.', 'fusion-core' ),
			'options' => $reverse_choices
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'fusion-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode.', 'fusion-core' ),
			'options' => array(
				'0' => 'None',
				'bounce' => 'Bounce',
				'fade' => 'Fade',
				'flash' => 'Flash',
				'shake' => 'Shake',
				'slide' => 'Slide',
			)
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'fusion-core' ),
			'desc' => __( 'Select the incoming direction for the animation.', 'fusion-core' ),
			'options' => array(
				'down' => 'Down',
				'left' => 'Left',
				'right' => 'Right',
				'up' => 'Up',
			)
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'fusion-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'fusion-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),		
	),
	'shortcode' => '[fontawesome icon="{{icon}}" circle="{{circle}}" size="{{size}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" flip="{{flip}}" rotate="{{rotate}}" spin="{{spin}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Font Awesome Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Fullwidth Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['fullwidth'] = array(
	'no_preview' => true,
	'params' => array(
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the background color.  Leave blank for theme option selection.', 'fusion-core')
		),
		'backgroundimage' => array(
			'type' => 'uploader',
			'label' => __( 'Backgrond Image', 'fusion-core' ),
			'desc' => 'Upload an image to display in the background'
		),
		'backgroundrepeat' => array(
			'type' => 'select',
			'label' => __( 'Background Repeat', 'fusion-core' ),
			'desc' => 'Choose how the background image repeats.',
			'options' => array(
				'no-repeat' => 'No Repeat',
				'repeat' => 'Repeat Vertically and Horizontally',
				'repeat-x' => 'Repeat Horizontally',
				'repeat-y' => 'Repeat Vertically'
			)
		),
		'backgroundposition' => array(
			'type' => 'select',
			'label' => __( 'Background Position', 'fusion-core' ),
			'desc' => 'Choose the postion of the background image',
			'options' => array(
				'left top' => 'Left Top',
				'left center' => 'Left Center',
				'left bottom' => 'Left Bottom',
				'right top' => 'Right Top',
				'right center' => 'Right Center',
				'right bottom' => 'Right Bottom',
				'center top' => 'Center Top',
				'center center' => 'Center Center',
				'center bottom' => 'Center Bottom'
			)
		),
		'backgroundattachment' => array(
			'type' => 'select',
			'label' => __( 'Background Scroll', 'fusion-core' ),
			'desc' => 'Choose how the background image scrolls',
			'options' => array(
				'scroll' => 'Scroll: background scrolls along with the element',
				'fixed' => 'Fixed: background is fixed giving a parallax effect',
				'local' => 'Local: background scrolls along with the element\'s contents'
			)
		),
		'bordersize' => array(
			'std' => '0px',
			'type' => 'text',
			'label' => __( 'Border Size', 'fusion-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'fusion-core' ),
			'desc' => __( 'Controls the border color.  Leave blank for theme option selection.', 'fusion-core')
		),
		'borderstyle' => array(
			'type' => 'select',
			'label' => __( 'Border Style', 'fusion-core' ),
			'desc' => __( 'Controls the border style.', 'fusion-core' ),
			'options' => array(
				'solid' => 'Solid',
				'dashed' => 'Dashed',
				'dotted' => 'Dotted'
			)			
		),		
		'paddingtop' => array(
			'std' => 20,
			'type' => 'select',
			'label' => __( 'Padding Top', 'fusion-core' ),
			'desc' => __( 'In pixels', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 100, false )
		),
		'paddingbottom' => array(
			'std' => 20,
			'type' => 'select',
			'label' => __( 'Padding Bottom', 'fusion-core' ),
			'desc' => __( 'In pixels', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 100, false )
		),
		'menuanchor' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Menu Anchor', 'fusion-core' ),
			'desc' => 'This name will be the id you will have to use in your one page menu.',
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'fusion-core' ),
			'desc' => __( 'Add content', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),			
	),
	'shortcode' => '[fullwidth menu_anchor="{{menuanchor}}" backgroundcolor="{{backgroundcolor}}" backgroundimage="{{backgroundimage}}" backgroundrepeat="{{backgroundrepeat}}" backgroundposition="{{backgroundposition}}" backgroundattachment="{{backgroundattachment}}" bordersize="{{bordersize}}" bordercolor="{{bordercolor}}" borderstyle="{{borderstyle}}" paddingtop="{{paddingtop}}px" paddingbottom="{{paddingbottom}}px" class="{{class}}" id="{{id}}"]{{content}}[/fullwidth]',
	'popup_title' => __( 'Fullwidth Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Google Map Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['googlemap'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __( 'Map Type', 'fusion-core' ),
			'desc' => __( 'Select the type of google map to display.', 'fusion-core' ),
			'options' => array(
				'roadmap' => 'Roadmap',
				'satellite' => 'Satellite',
				'hybrid' => 'Hybrid',
				'terrain' => 'Terrain'
			)
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Map Width', 'fusion-core' ),
			'desc' => __( 'Map width in percentage or pixels. ex: 100%, or 940px', 'fusion-core')
		),
		'height' => array(
			'std' => '300px',
			'type' => 'text',
			'label' => __( 'Map Height', 'fusion-core' ),
			'desc' => __( 'Map height in percentage or pixels. ex: 100%, or 300px', 'fusion-core')
		),
		'zoom' => array(
			'std' => 14,
			'type' => 'select',
			'label' => __( 'Zoom Level', 'fusion-core' ),
			'desc' => __( 'Higher number will be more zoomed in.', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 25, false )
		),
		'scrollwheel' => array(
			'type' => 'select',
			'label' => __( 'Scrollwheel on Map', 'fusion-core' ),
			'desc' => __( 'Enable zooming using a mouse\'s scroll wheel.', 'fusion-core' ),
			'options' => $choices
		),
		'scale' => array(
			'type' => 'select',
			'label' => __( 'Show Scale Control on Map', 'fusion-core' ),
			'desc' => __( 'Display the map scale.', 'fusion-core' ),
			'options' => $choices
		),
		'zoom_pancontrol' => array(
			'type' => 'select',
			'label' => __( 'Show Pan Control on Map', 'fusion-core' ),
			'desc' => __( 'Displays pan control button.', 'fusion-core' ),
			'options' => $choices
		),
		'popup' => array(
			'type' => 'select',
			'label' => __( 'Show tooltip by default?', 'fusion-core' ),
			'desc' => __( 'Display or hide the tooltip when the map first loads.', 'fusion-core' ),
			'options' => $choices
		),
		'mapstyle' => array(
			'type' => 'select',
			'label' => __( 'Select the Map Styling', 'fusion-core' ),
			'desc' => __( 'Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.', 'fusion-core' ),
			'options' => array(
				'default' => 'Default Styling',
				'theme' => 'Theme Styling',
				'custom' => 'Custom Styling',
			)
		),	
		'overlaycolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Map Overlay Color', 'fusion-core' ),
			'desc' => __( 'Custom styling setting only. Pick an overlaying color for the map. Works best with "roadmap" type.', 'fusion-core')
		),
		'infobox' => array(
			'type' => 'select',
			'label' => __( 'Infobox Styling', 'fusion-core' ),
			'desc' => __( 'Custom styling setting only. Choose between default or custom info box.', 'fusion-core' ),
			'options' => array(
				'default' => 'Default Infobox',
				'custom' => 'Custom Infobox',
			)
		),
		'infoboxcontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Infobox Content', 'fusion-core' ),
			'desc' => __( 'Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3', 'fusion-core' ),
		),		
		'infoboxtextcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Text Color', 'fusion-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box text.', 'fusion-core')
		),
		'infoboxbackgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Background Color', 'fusion-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box background.', 'fusion-core')
		),
		'icon' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Custom Marker Icon', 'fusion-core' ),
			'desc' => __( 'Custom styling setting only. Use full image urls for custom marker icons or input "theme" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3', 'fusion-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Address', 'fusion-core' ),
			'desc' => __( 'Add address to the location which will show up on map. For multiple addresses, separate addresses by using the | symbol. <br />ex: Address 1|Address 2|Address 3', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' ),
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' ),
		)
	),
	'shortcode' => '[map address="{{content}}" type="{{type}}" map_style="{{mapstyle}}" overlay_color="{{overlaycolor}}" infobox="{{infobox}}" infobox_background_color="{{infoboxbackgroundcolor}}" infobox_text_color="{{infoboxtextcolor}}" infobox_content="{{infoboxcontent}}" icon="{{icon}}" width="{{width}}" height="{{height}}" zoom="{{zoom}}" scrollwheel="{{scrollwheel}}" scale="{{scale}}" zoom_pancontrol="{{zoom_pancontrol}}" popup="{{popup}}" class="{{class}}" id="{{id}}"][/map]',
	'popup_title' => __( 'Google Map Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Highlight Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' => array(

		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Highlight Color', 'fusion-core' ),
			'desc' => __( 'Pick a highlight color', 'fusion-core')
		),
		'rounded' => array(
			'type' => 'select',
			'label' => __( 'Highlight With Round Edges', 'fusion-core' ),
			'desc' => __( 'Choose to have rounded edges.', 'fusion-core' ),
			'options' => $reverse_choices
		),		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content to Higlight', 'fusion-core' ),
			'desc' => __( 'Add your content to be highlighted', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),			

	),
	'shortcode' => '[highlight color="{{color}}" rounded="{{rounded}}" class="{{class}}" id="{{id}}"]{{content}}[/highlight]',
	'popup_title' => __( 'Highlight Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Image Carousel Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['imagecarousel'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'fusion-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'fusion-core' ),
			'options' => array(
				'fixed' => 'Fixed',
				'auto' => 'Auto'
			)
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'fusion-core' ),
			'desc' => __( 'Show image in lightbox.', 'fusion-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[images picture_size="{{picture_size}}" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/images]', // as there is no wrapper shortcode
	'popup_title' => __( 'Image Carousel Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Website Link', 'fusion-core' ),
				'desc' => __( 'Add the url to image\'s website. If lightbox option is enabled, you have to add the full image link to show it in the lightbox.', 'fusion-core' )
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'fusion-core' ),
				'desc' => __( '_self = open in same window <br />_blank = open in new window', 'fusion-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'fusion-core' ),
				'desc' => __( 'Upload an image to display.', 'fusion-core' ),
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Alt Text', 'fusion-core' ),
				'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'fusion-core' ),
			)
		),
		'shortcode' => '[image link="{{url}}" linktarget="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' => __( 'Add New Image', 'fusion-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Image Frame Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['imageframe'] = array(
	'no_preview' => true,
	'params' => array(
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Frame Style Type', 'fusion-core' ),
			'desc' => __( 'Select the frame style type.', 'fusion-core' ),
			'options' => array(
				'none' => 'None',
				'border' => 'Border',
				'glow' => 'Glow',
				'dropshadow' => 'Drop Shadow',
				'bottomshadow' => 'Bottom Shadow'
			)
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'fusion-core' ),
			'desc' => __( 'For border style only. Controls the border color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'bordersize' => array(
			'std' => '0px',
			'type' => 'text',
			'label' => __( 'Border Size', 'fusion-core' ),
			'desc' => __( 'For border style only. In pixels (px), ex: 1px. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'stylecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Style Color', 'fusion-core' ),
			'desc' => __( 'For all style types except border. Controls the style color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'align' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Align', 'fusion-core' ),
			'desc' => 'Choose how to align the image',
			'options' => array(
				'none' => 'None',
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center'
			)
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'fusion-core' ),
			'desc' => __( 'Show image in Lightbox', 'fusion-core' ),
			'options' => $reverse_choices
		),
		'image' => array(
			'type' => 'uploader',
			'label' => __( 'Image', 'fusion-core' ),
			'desc' => 'Upload an image to display in the frame'
		),
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Image Alt Text', 'fusion-core' ),
			'desc' => 'The alt attribute provides alternative information if an image cannot be viewed'
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'fusion-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'fusion-core' ),
			'options' => array(
				'0' => 'None',
				'bounce' => 'Bounce',
				'fade' => 'Fade',
				'flash' => 'Flash',
				'shake' => 'Shake',
				'slide' => 'Slide',
			)
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'fusion-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'fusion-core' ),
			'options' => array(
				'down' => 'Down',
				'left' => 'Left',
				'right' => 'Right',
				'up' => 'Up',
			)
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'fusion-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'fusion-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),			
	),
	'shortcode' => '[imageframe lightbox="{{lightbox}}" style_type="{{style_type}}" bordercolor="{{bordercolor}}" bordersize="{{bordersize}}" stylecolor="{{stylecolor}}" align="{{align}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]&lt;img alt="{{alt}}" src="{{image}}" /&gt;[/imageframe]',
	'popup_title' => __( 'Image Frame Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['lightbox'] = array(
	'no_preview' => true,
	'params' => array(

		'full_image' => array(
			'type' => 'uploader',
			'label' => __( 'Full Image', 'fusion-core' ),
			'desc' => __( 'Upload an image that will show up in the lightbox.', 'fusion-core' ),
		),
		'thumb_image' => array(
			'type' => 'uploader',
			'label' => __( 'Thumbnail Image', 'fusion-core' ),
			'desc' => __( 'Clicking this image will show lightbox.', 'fusion-core' ),
		),
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Alt Text', 'fusion-core' ),
			'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'fusion-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Lightbox Description', 'fusion-core' ),
			'desc' => __( 'This will show up in the lightbox as a description below the image.', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),				
	),
	'shortcode' => '&lt;a title="{{title}}" class="{{class}} id="{{id}} href="{{full_image}}" rel="prettyPhoto"&gt;&lt;img alt="{{alt}}" src="{{thumb_image}}" /&gt;&lt;/a&gt;',
	'popup_title' => __( 'Lightbox Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Menu Anchor Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['menuanchor'] = array(
	'no_preview' => true,
	'params' => array(

		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Menu Anchor', 'fusion-core' ),
			'desc' => 'This name will be the id you will have to use in your one page menu.',

		)
	),
	'shortcode' => '[menu_anchor name="{{name}}"]',
	'popup_title' => __( 'Menu Anchor Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Modal Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['modal'] = array(
	'no_preview' => true,
	'params' => array(

		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Modal', 'fusion-core' ),
			'desc' => __( 'Needs to be a unique identifier (lowercase), used for button or modal_text_link shortcode to open the modal. ex: mymodal', 'fusion-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Heading', 'fusion-core' ),
			'desc' => __( 'Heading text for the modal.', 'fusion-core' ),
		),		
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size Of Modal', 'fusion-core' ),
			'desc' => __( 'Select the modal window size.', 'fusion-core' ),
			'options' => array(
				'small' => 'Small',
				'large' => 'Large'
			)
		),
		'background' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the modal background color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'fusion-core' ),
			'desc' => __( 'Controls the modal border color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'showfooter' => array(
			'type' => 'select',
			'label' => __( 'Show footer', 'fusion-core' ),
			'desc' => __( 'Choose to show the modal footer with close button.', 'fusion-core' ),
			'options' => $choices
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Contents of Modal', 'fusion-core' ),
			'desc' => __( 'Add your content to be displayed in modal.', 'fusion-core' ),
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[modal name="{{name}}" title="{{title}}" size="{{size}}" background="{{background}}" border_color="{{bordercolor}}" show_footer="{{showfooter}}" class="{{class}}" id="{{id}}"]{{content}}[/modal]',
	'popup_title' => __( 'Modal Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Modal Text Link Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['modaltextlink'] = array(
	'no_preview' => true,
	'params' => array(
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Modal', 'fusion-core' ),
			'desc' => 'Unique identifier of the modal to open on click.',
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'fusion-core' ),
			'desc' => __( 'Insert text or HTML code here (e.g: HTML for image). This content will be used to trigger the modal popup.', 'fusion-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),		
	),
	'shortcode' => '[modal_text_link name="{{modal}}" class="{{class}}" id="{{id}}"]{{content}}[/modal_text_link]',
	'popup_title' => __( 'Modal Text Link Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Person Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['person'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name', 'fusion-core' ),
			'desc' => __( 'Insert the name of the person.', 'fusion-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'fusion-core' ),
			'desc' => __( 'Insert the title of the person', 'fusion-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Profile Description', 'fusion-core' ),
			'desc' => __( 'Enter the content to be displayed', 'fusion-core' )
		),
		'picture' => array(
			'type' => 'uploader',
			'label' => __( 'Picture', 'fusion-core' ),
			'desc' => __( 'Upload an image to display.', 'fusion-core' ),
		),
		'piclink' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Picture Link URL', 'fusion-core' ),
			'desc' => __( 'Add the URL the picture will link to, ex: http://example.com.', 'fusion-core' ),
		),
		'picstyle' => array(
			'type' => 'select',
			'label' => __( 'Picture Style Type', 'fusion-core' ),
			'desc' => __( 'Selected the style type for the picture,', 'fusion-core' ),
			'options' => array(
				'none' => 'None',
				'border' => 'Border',
				'glow' => 'Glow',
				'dropshadow' => 'Drop Shadow',
				'bottomshadow' => 'Bottom Shadow'
			)
		),
		'pic_style_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Picture Style color', 'fusion-core' ),
			'desc' => __( 'For all style types except border. Controls the style color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'picborder' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __( 'Picture Border Size', 'fusion-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'picbordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Picture Border Color', 'fusion-core' ),
			'desc' => __( 'Controls the picture\'s border color. Leave blank for theme option selection.', 'fusion-core' ),
		),		
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'fusion-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'fusion-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'fusion-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'fusion-core' ),
		),		
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'fusion-core' ),
			'desc' => __( 'Specify the color of social icons. Use one for all or separate by | symbol. 
ex: #AA0000|#00AA00|#0000AA.  Leave blank for theme option selection.', 'fusion-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'fusion-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one for all or separate by | symbol. 
ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'fusion-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'top' => 'Top',
				'bottom' => 'Bottom',
				'left' => 'Left',
				'Right' => 'Right',
			)
		),			
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'fusion-core' ),
			'desc' => __( 'Insert an email address to display the email icon', 'fusion-core' ),
		),
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'fusion-core' ),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'fusion-core' ),
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'fusion-core' ),
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'fusion-core' ),
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'LinkedIn Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom LinkedIn link', 'fusion-core' ),
		),
		'blogger' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Blogger Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Blogger link', 'fusion-core' ),
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'fusion-core' ),
		),
		'reddit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Reddit Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Reddit link', 'fusion-core' ),
		),
		'yahoo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Yahoo Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Yahoo link', 'fusion-core' ),
		),
		'deviantart' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Deviantart Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Deviantart link', 'fusion-core' ),
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'fusion-core' ),
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'fusion-core' ),
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Pinterst Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Pinterest link', 'fusion-core' ),
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'RSS Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom RSS link', 'fusion-core' ),
		),		
		'digg' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Digg Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Digg link', 'fusion-core' ),
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'fusion-core' ),
		),
		'forrst' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Forrst Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Forrst link', 'fusion-core' ),
		),
		'myspace' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Myspace Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Myspace link', 'fusion-core' ),
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Skype link', 'fusion-core' ),
		),
		'paypal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'PayPal Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom paypal link', 'fusion-core' ),
		),
		'dropbox' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dropbox Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom dropbox link', 'fusion-core' ),
		),
		'soundcloud' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom soundcloud link', 'fusion-core' ),
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'VK Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom vk link', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),
	),
	'shortcode' => '[person name="{{name}}" title="{{title}}" picture="{{picture}}" pic_link="{{piclink}}" pic_style="{{picstyle}}" pic_style_color="{{pic_style_color}}" pic_bordersize="{{picborder}}" pic_bordercolor="{{picbordercolor}}"  social_icon_boxed="{{iconboxed}}" social_icon_boxed_radius="{{iconboxedradius}}" social_icon_colors="{{iconcolor}}"  social_icon_boxed_colors="{{boxcolor}}" social_icon_tooltip="{{icontooltip}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" dribbble="{{dribbble}}" google="{{google}}" linkedin="{{linkedin}}" blogger="{{blogger}}" tumblr="{{tumblr}}" reddit="{{reddit}}" yahoo="{{yahoo}}" deviantart="{{deviantart}}" vimeo="{{vimeo}}" youtube="{{youtube}}" rss="{{rss}}" pinterest="{{pinterest}}" digg="{{digg}}" flickr="{{flickr}}" forrst="{{forrst}}" myspace="{{myspace}}" skype="{{skype}}" paypal="{{paypal}}" dropbox="{{dropbox}}" soundcloud="{{soundcloud}}" vk="{{vk}}" class="{{class}} id="{{id}}"]{{content}}[/person]',
	'popup_title' => __( 'Person Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Popover Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['popover'] = array(
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Popover Heading', 'fusion-core' ),
			'desc' => __( 'Heading text of the popover.', 'fusion-core' ),
		),
		'titlebgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Heading Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the background color of the popover heading. Leave blank for theme option selection.', 'fusion-core')
		),			
		'popovercontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Contents Inside Popover', 'fusion-core' ),
			'desc' => __( 'Text to be displayed inside the popover.', 'fusion-core' ),
		),
		'contentbgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Content Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the background color of the popover content area. Leave blank for theme option selection.', 'fusion-core')
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Border Color', 'fusion-core' ),
			'desc' => __( 'Controls the border color of the of the popover box. Leave blank for theme option selection.', 'fusion-core')
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Text Color', 'fusion-core' ),
			'desc' => __( 'Controls all the text color inside the popover box. Leave blank for theme option selection.', 'fusion-core')
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Popover Trigger Method', 'fusion-core' ),
			'desc' => __( 'Choose mouse action to trigger popover.', 'fusion-core' ),
			'options' => array(
				'click' => 'Click',
				'hover' => 'Hover',
			)
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Popover Position', 'fusion-core' ),
			'desc' => __( 'Choose the display position of the popover. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'top' => 'Top',
				'bottom' => 'Bottom',
				'left' => 'Left',
				'Right' => 'Right',
			)
		),
		'content' => array(
			'std' => 'Text',
			'type' => 'text',
			'label' => __( 'Triggering Content', 'fusion-core' ),
			'desc' => __( 'Content that will trigger the popover.', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[popover title="{{title}}" title_bg_color="{{titlebgcolor}}" content="{{popovercontent}}" content_bg_color="{{contentbgcolor}}" bordercolor="{{bordercolor}}" textcolor="{{textcolor}}" trigger="{{trigger}}" placement="{{placement}}" class="{{class}}" id="{{id}}"]{{content}}[/popover]', // as there is no wrapper shortcode
	'popup_title' => __( 'Popover Shortcode', 'fusion-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['pricingtable'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'fusion-core' ),
			'desc' => __( 'Select the type of pricing table', 'fusion-core' ),
			'options' => array(
				'1' => 'Style 1 (Supports 5 Columns)',
				'2' => 'Style 2 (Supports 4 Columns)',
			)
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => 'Controls the background color. Leave blank for theme option selection.'
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'fusion-core' ),
			'desc' => 'Controls the border color. Leave blank for theme option selection.'
		),
		'dividercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Divider Color', 'fusion-core' ),
			'desc' => 'Controls the divider color. Leave blank for theme option selection.'
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'fusion-core' ),
			'desc' => 'Select how many columns to display',
			'options' => array(
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '1 Column',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '2 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '3 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '4 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '5 Columns'
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[pricing_table type="{{type}}" backgroundcolor="{{backgroundcolor}}" bordercolor="{{bordercolor}}" dividercolor="{{dividercolor}}" class="{{class}}" id="{{id}}"]{{columns}}[/pricing_table]',
	'popup_title' => __( 'Pricing Table Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['progressbar'] = array(
	'params' => array(

		'percentage' => array(
			'type' => 'select',
			'label' => __( 'Filled Area Percentage', 'fusion-core' ),
			'desc' => __( 'From 1% to 100%', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 100, false )
		),
		'unit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Progress Bar Unit', 'fusion-core' ),
			'desc' => __( 'Insert a unit for the progress bar. ex %', 'fusion-core' ),
		),
		'filledcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Filled Color', 'fusion-core' ),
			'desc' => __( 'Controls the color of the filled in area. Leave blank for theme option selection.', 'fusion-core' )
		),
		'unfilledcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Unfilled Color', 'fusion-core' ),
			'desc' => __( 'Controls the color of the unfilled in area. Leave blank for theme option selection.', 'fusion-core' )
		),
		'striped' => array(
			'type' => 'select',
			'label' => __( 'Striped Filling', 'fusion-core' ),
			'desc' => __( 'Choose to get the filled area striped.', 'fusion-core' ),
			'options' => $reverse_choices
		),
		'animatedstripes' => array(
			'type' => 'select',
			'label' => __( 'Animated Stripes', 'fusion-core' ),
			'desc' => __( 'Choose to get the the stripes animated.', 'fusion-core' ),
			'options' => $reverse_choices
		),			
		'textcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Text Color', 'fusion-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'fusion-core ')
		),
		'content' => array(
			'std' => 'Text',
			'type' => 'text',
			'label' => __( 'Progess Bar Text', 'fusion-core' ),
			'desc' => __( 'Text will show up on progess bar', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),		
	),
	'shortcode' => '[progress percentage="{{percentage}}" unit="{{unit}}" filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}" striped="{{striped}}" animated_stripes="{{animatedstripes}}" textcolor="{{textcolor}}" class="{{class}}" id="{{id}}"]{{content}}[/progress]',
	'popup_title' => __( 'Progress Bar Shortcode', 'fusion-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Posts Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['recentposts'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'fusion-core' ),
			'desc' => 'Select the layout for the shortcode',
			'options' => array(
				'default' => 'Default',
				'thumbnails-on-side' => 'Thumbnails on Side',
				'date-on-side' => 'Date on Side',
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Columns', 'fusion-core' ),
			'desc' => __( 'Select the number of columns to display', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 4, false )
		),
		'number_posts' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Posts', 'fusion-core' ),
			'desc' => 'Select the number of posts to display',
			'options' => fusion_shortcodes_range( 12, false )
		),
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'fusion-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'fusion-core' ),
			'desc' => __( 'Select a category to exclude', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'category' )
		),
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Show Thumbnail', 'fusion-core' ),
			'desc' => 'Display the post featured image',
			'options' => $choices
		),
		'title' => array(
			'type' => 'select',
			'label' => __( 'Show Title', 'fusion-core' ),
			'desc' => 'Display the post title below the featured image',
			'options' => $choices
		),
		'meta' => array(
			'type' => 'select',
			'label' => __( 'Show Meta', 'fusion-core' ),
			'desc' => 'Choose to show all meta data',
			'options' => $choices
		),
		'excerpt' => array(
			'type' => 'select',
			'label' => __( 'Show Excerpt', 'fusion-core' ),
			'desc' => 'Choose to display the post excerpt',
			'options' => $choices
		),
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Excerpt Length', 'fusion-core' ),
			'desc' => 'Insert the number of words/characters you want to show in the excerpt',
			'options' => fusion_shortcodes_range( 60, false )
		),
		'strip_html' => array(
			'type' => 'select',
			'label' => __( 'Strip HTML', 'fusion-core' ),
			'desc' => 'Strip HTML from the post excerpt',
			'options' => $choices
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'fusion-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'fusion-core' ),
			'options' => array(
				'0' => 'None',
				'bounce' => 'Bounce',
				'fade' => 'Fade',
				'flash' => 'Flash',
				'shake' => 'Shake',
				'slide' => 'Slide',
			)
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'fusion-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'fusion-core' ),
			'options' => array(
				'down' => 'Down',
				'left' => 'Left',
				'right' => 'Right',
				'up' => 'Up',
			)
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'fusion-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'fusion-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[recent_posts layout="{{layout}}" columns="{{columns}}" number_posts="{{number_posts}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" thumbnail="{{thumbnail}}" title="{{title}}" meta="{{meta}}" excerpt="{{excerpt}}" excerpt_length="{{excerpt_length}}" strip_html="{{strip_html}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"][/recent_posts]',
	'popup_title' => __( 'Recent Posts Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Works Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['recentworks'] = array(
	'no_preview' => true,
	'params' => array(
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'fusion-core' ),
			'desc' => 'Choose the layout for the shortcode',
			'options' => array(
				'carousel' => 'Carousel',
				'grid' => 'Grid',
				'grid-with-excerpts' => 'Grid with Excerpts',
			)
		),
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size For Carousel Layout', 'fusion-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.<br />only works with carousel layout.', 'fusion-core' ),
			'options' => array(
				'fixed' => 'Fixed',
				'auto' => 'Auto'
			)
		),
		'filters' => array(
			'type' => 'select',
			'label' => __( 'Show Filters', 'fusion-core' ),
			'desc' => 'Choose to show or hide the category filters',
			'options' => $choices
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Columns', 'fusion-core' ),
			'desc' => __( 'Select the number of columns to display', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 4, false )
		),
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'fusion-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'portfolio_category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'fusion-core' ),
			'desc' => __( 'Select a category to exclude', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'category' )
		),		
		'number_posts' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Posts', 'fusion-core' ),
			'desc' => 'Select the number of posts to display',
			'options' => fusion_shortcodes_range( 12, false )
		),
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Excerpt Length', 'fusion-core' ),
			'desc' => 'Insert the number of words/characters you want to show in the excerpt',
			'options' => fusion_shortcodes_range( 60, false )
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'fusion-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'fusion-core' ),
			'options' => array(
				'0' => 'None',
				'bounce' => 'Bounce',
				'fade' => 'Fade',
				'flash' => 'Flash',
				'shake' => 'Shake',
				'slide' => 'Slide',
			)
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'fusion-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'fusion-core' ),
			'options' => array(
				'down' => 'Down',
				'left' => 'Left',
				'right' => 'Right',
				'up' => 'Up',
			)
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'fusion-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'fusion-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[recent_works picture_size="{{picture_size}}" layout="{{layout}}" filters="{{filters}}" columns="{{columns}}" cat_slug="{{cat_slug}}" number_posts="{{number_posts}}" excerpt_length="{{excerpt_length}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"][/recent_works]',
	'popup_title' => __( 'Recent Works Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Section Separator Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['sectionseparator'] = array(
	'no_preview' => true,
	'params' => array(
		'divider_candy' => array(
			'type' => 'select',
			'label' => __( 'Position of the Divider Candy', 'fusion-core' ),
			'desc' => __( 'Select the position of the triangle candy', 'fusion-core' ),
			'options' => array(
				'top' => 'Top',
				'bottom' => 'Bottom',
				'bottom,top' => 'Top and Bottom',
			)
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'fusion-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'fusion-core' ),
			'options' => $icons
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'fusion-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'fusion-core' )
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'fusion-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'fusion-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color of Divider Candy', 'fusion-core' ),
			'desc' => __( 'Controls the background color of the triangle. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[section_separator divider_candy="{{divider_candy}}" icon="{{icon}}" icon_color="{{iconcolor}}" bordersize="{{border}}" bordercolor="{{bordercolor}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Section Separator Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(

		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Style', 'fusion-core' ),
			'desc' => __( 'Choose the separator line style', 'fusion-core' ),
			'options' => array(
				'none' => 'No Style',
				'single' => 'Single Border Solid',
				'double' => 'Double Border Solid',
				'single|dashed' => 'Single Border Dashed',
				'double|dashed' => 'Double Border Dashed',
				'single|dotted' => 'Single Border Dotted',
				'double|dotted' => 'Double Border Dotted',
				'shadow' => 'Shadow'
			)
		),
		'topmargin' => array(
			'std' => 40,
			'type' => 'select',
			'label' => __( 'Margin Top', 'fusion-core' ),
			'desc' => __( 'Spacing above the separator', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 100, false, false, 0 )
		),
		'bottommargin' => array(
			'std' => 40,
			'type' => 'select',
			'label' => __( 'Margin Bottom', 'fusion-core' ),
			'desc' => __( 'Spacing below the separator', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 100, false, false, 0 )
		),
		'sepcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Separator Color', 'fusion-core' ),
			'desc' => __( 'Controls the separator color. Leave blank for theme option selection.', 'fusion-core' )
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'fusion-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'fusion-core' ),
			'options' => $icons
		),			
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Separator Width', 'fusion-core' ),
			'desc' => __( 'In pixels (px or %), ex: 1px, ex: 50%. Leave blank for full width.', 'fusion-core' ),
		),		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[separator style_type="{{style_type}}" top_margin="{{topmargin}}" bottom_margin="{{bottommargin}}"  sep_color="{{sepcolor}}" icon="{{icon}}" width="{{width}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Separator Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Sharing Box Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['sharingbox'] = array(
	'no_preview' => true,
	'params' => array(
		'tagline' => array(
			'std' => 'Share This Story, Choose Your Platform!',
			'type' => 'text',
			'label' => __( 'Tagline', 'fusion-core' ),
			'desc' => 'The title tagline that will display'
		),
		'taglinecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Tagline Color', 'fusion-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'fusion-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'fusion-core')
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'fusion-core' ),
			'desc' => 'The post title that will be shared'
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'fusion-core' ),
			'desc' => 'The link that will be shared'
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Description', 'fusion-core' ),
			'desc' => 'The description that will be shared'
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link to Share', 'fusion-core' ),
			'desc' => ''
		),
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'fusion-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'fusion-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'fusion-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'fusion-core' ),
		),	
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'fusion-core' ),
			'desc' => __( 'Specify the color of social icons. Use one for all or separate by | symbol. 
ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'fusion-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one for all or separate by | symbol. 
ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'fusion-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'top' => 'Top',
				'bottom' => 'Bottom',
				'left' => 'Left',
				'Right' => 'Right',
			)
		),		
		'pinterest_image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Choose Image to Share on Pinterest', 'fusion-core' ),
			'desc' => ''
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[sharing tagline="{{tagline}}" tagline_color="{{taglinecolor}}" title="{{title}}" link="{{link}}" description="{{description}}" pinterest_image="{{pinterest_image}}" icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" box_colors="{{boxcolor}}" icon_colors="{{iconcolor}}" tooltip_placement="{{icontooltip}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"][/sharing]',
	'popup_title' => __( 'Sharing Box Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Slider Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['slider'] = array(
	'params' => array(
		'size' => array(
			'std' => '100%',
			'type' => 'size',
			'label' => __( 'Image Size (Width/Height)', 'fusion-core' ),
			'desc' => __( 'Width and Height in percentage (%) or pixels (px)', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[slider width="{{size_width}}" height="{{size_height}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/slider]', // as there is no wrapper shortcode
	'popup_title' => __( 'Slider Shortcode', 'fusion-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'slider_type' => array(
				'type' => 'select',
				'label' => __( 'Slide Type', 'fusion-core' ),
				'desc' => 'Choose a video or image slide',
				'options' => array(
					'image' => 'Image',
					'video' => 'Video'
				)
			),
			'video_content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Video Shortcode or Video Embed Code', 'fusion-core' ),
				'desc' => 'Click the Youtube or Vimeo Shortcode button below then enter your unique video ID, or copy and paste your video embed code.<a href=\'[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]\' class="fusion-shortcodes-button fusion-add-video-shortcode">Insert Youtube Shortcode</a><a href=\'[vimeo id="Enter video ID (eg. 10145153)" width="600" height="350"]\' class="fusion-shortcodes-button fusion-add-video-shortcode">Insert Vimeo Shortcode</a>'
			),
			'image_content' => array(
				'std' => '',
				'type' => 'uploader',
				'label' => __( 'Slide Image', 'fusion-core' ),
				'desc' => 'Upload an image to display in the slide'
			),
			'image_url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Full Image Link or External Link', 'fusion-core' ),
				'desc' => 'Add the url of where the image will link to. If lightbox option is enabled,and you don\'t add the full image link, lightbox will open slide image'
			),
			'image_target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'fusion-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'fusion-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image_lightbox' => array(
				'type' => 'select',
				'label' => __( 'Lighbox', 'fusion-core' ),
				'desc' => __( 'Show image in Lightbox', 'fusion-core' ),
				'options' => $choices
			),
		),
		'shortcode' => '[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]',
		'clone_button' => __( 'Add New Slide', 'fusion-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Social Links Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['sociallinks'] = array(
	'no_preview' => true,
	'params' => array(
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'fusion-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'fusion-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'fusion-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'fusion-core' ),
		),
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'fusion-core' ),
			'desc' => __( 'Specify the color of social icons. Use one for all or separate by | symbol. 
ex: #AA0000|#00AA00|#0000AA.  Leave blank for theme option selection.', 'fusion-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'fusion-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one for all or separate by | symbol. 
ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'fusion-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'top' => 'Top',
				'bottom' => 'Bottom',
				'left' => 'Left',
				'Right' => 'Right',
			)
		),			
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'fusion-core' ),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'fusion-core' ),
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'fusion-core' ),
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'fusion-core' ),
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'LinkedIn Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom LinkedIn link', 'fusion-core' ),
		),
		'blogger' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Blogger Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Blogger link', 'fusion-core' ),
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'fusion-core' ),
		),
		'reddit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Reddit Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Reddit link', 'fusion-core' ),
		),
		'yahoo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Yahoo Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Yahoo link', 'fusion-core' ),
		),
		'deviantart' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Deviantart Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Deviantart link', 'fusion-core' ),
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'fusion-core' ),
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'fusion-core' ),
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Pinterst Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Pinterest link', 'fusion-core' ),
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'RSS Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom RSS link', 'fusion-core' ),
		),		
		'digg' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Digg Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Digg link', 'fusion-core' ),
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'fusion-core' ),
		),
		'forrst' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Forrst Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Forrst link', 'fusion-core' ),
		),
		'myspace' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Myspace Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Myspace link', 'fusion-core' ),
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom Skype link', 'fusion-core' ),
		),
		'paypal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'PayPal Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom paypal link', 'fusion-core' ),
		),
		'dropbox' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dropbox Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom dropbox link', 'fusion-core' ),
		),
		'soundcloud' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom soundcloud link', 'fusion-core' ),
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'VK Link', 'fusion-core' ),
			'desc' => __( 'Insert your custom vk link', 'fusion-core' ),
		),
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'fusion-core' ),
			'desc' => __( 'Insert an email address to display the email icon', 'fusion-core' ),
		),
		'show_custom' => array(
			'type' => 'select',
			'label' => __( 'Show Custom Social Icon', 'fusion-core' ),
			'desc' => __( 'Show the custom social icon specified in Theme Options', 'fusion-core' ),
			'options' => $reverse_choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[social_links icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" icon_colors="{{iconcolor}}" box_colors="{{boxcolor}}" tooltip_placement="{{icontooltip}}" rss="{{rss}}" facebook="{{facebook}}" twitter="{{twitter}}" dribbble="{{dribbble}}" google="{{google}}" linkedin="{{linkedin}}" blogger="{{blogger}}" tumblr="{{tumblr}}" reddit="{{reddit}}" yahoo="{{yahoo}}" deviantart="{{deviantart}}" vimeo="{{vimeo}}" youtube="{{youtube}}" pinterest="{{pinterest}}" digg="{{digg}}" flickr="{{flickr}}" forrst="{{forrst}}" myspace="{{myspace}}" skype="{{skype}}" paypal="{{paypal}}" dropbox="{{dropbox}}" soundcloud="{{soundcloud}}" vk="{{vk}}" email="{{email}}" show_custom="{{show_custom}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Social Links Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	SoundCloud Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['soundcloud'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Url', 'fusion-core' ),
			'desc' => 'The SoundCloud url, ex: http://api.soundcloud.com/tracks/110813479'
		),
		'comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comments', 'fusion-core' ),
			'desc' => 'Choose to display comments',
			'options' => $choices
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'fusion-core' ),
			'desc' => 'Choose to autoplay the track',
			'options' => $reverse_choices
		),
		'color' => array(
			'type' => 'colorpicker',
			'std' => '#ff7700',
			'label' => __( 'Color', 'fusion-core' ),
			'desc' => 'Select the color of the shortcode'
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Width', 'fusion-core' ),
			'desc' => 'In pixels (px) or percentage (%)'
		),
		'height' => array(
			'std' => '81px',
			'type' => 'text',
			'label' => __( 'Height', 'fusion-core' ),
			'desc' => 'In pixels (px)'
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[soundcloud url="{{url}}" comments="{{comments}}" auto_play="{{autoplay}}" color="{{color}}" width="{{width}}" height="{{height}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Sharing Box Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Table Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['table'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'fusion-core' ),
			'desc' => __( 'Select the table style', 'fusion-core' ),
			'options' => array(
				'1' => 'Style 1',
				'2' => 'Style 2',
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'fusion-core' ),
			'desc' => 'Select how many columns to display',
			'options' => array(
				'1' => '1 Column',
				'2' => '2 Columns',
				'3' => '3 Columns',
				'4' => '4 Columns',
				'5' => '5 Columns'				
			)
		)
	),
	'shortcode' => '',
	'popup_title' => __( 'Table Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['tabs'] = array(
	'no_preview' => true,
	'params' => array(
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'fusion-core' ),
			'desc' => __( 'Choose the layout of the shortcode', 'fusion-core' ),
			'options' => array(
				'horizontal' => 'Horizontal',
				'vertical' => 'Vertical'
			)
		),
		'justified' => array(
			'type' => 'select',
			'label' => __( 'Justify Tabs', 'fusion-core' ),
			'desc' => __( 'Choose to get tabs stretched over full shortcode width.', 'fusion-core' ),
			'options' => $choices
		),		
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the background tab color.  Leave blank for theme option selection.', 'fusion-core' ),
		),
		'inactivecolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Inactive Color', 'fusion-core' ),
			'desc' => __( 'Controls the inactive tab color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),

	'shortcode' => '[fusion_tabs layout="{{layout}}" justified="{{justified}}" backgroundcolor="{{backgroundcolor}}" inactivecolor="{{inactivecolor}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/fusion_tabs]',
	'popup_title' => __( 'Insert Tab Shortcode', 'fusion-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => 'Title',
				'type' => 'text',
				'label' => __( 'Tab Title', 'fusion-core' ),
				'desc' => __( 'Title of the tab', 'fusion-core' ),
			),
			'content' => array(
				'std' => 'Tab Content',
				'type' => 'textarea',
				'label' => __( 'Tab Content', 'fusion-core' ),
				'desc' => __( 'Add the tabs content', 'fusion-core' )
			)
		),
		'shortcode' => '[fusion_tab title="{{title}}"]{{content}}[/fusion_tab]',
		'clone_button' => __( 'Add Tab', 'fusion-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Tagline Box Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['taglinebox'] = array(
	'no_preview' => true,
	'params' => array(
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'shadow' => array(
			'type' => 'select',
			'label' => __( 'Shadow', 'fusion-core' ),
			'desc' => __( 'Show the shadow below the box', 'fusion-core' ),
			'options' => $reverse_choices
		),
		'shadowopacity' => array(
			'type' => 'select',
			'label' => __( 'Shadow Opacity', 'fusion-core' ),
			'desc' => __( 'Choose the opacity of the shadow', 'fusion-core' ),
			'options' => $dec_numbers
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'fusion-core' ),
			'desc' => __( 'In pixels (px), ex: 1px', 'fusion-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'fusion-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'highlightposition' => array(
			'type' => 'select',
			'label' => __( 'Highlight Border Position', 'fusion-core' ),
			'desc' => __( 'Choose the position of the highlight. This border highlight is from theme options primary color and does not take the color from border color above', 'fusion-core' ),
			'options' => array(
				'top' => 'Top',
				'bottom' => 'Bottom',
				'left' => 'Left',
				'right' => 'Right',
				'none' => 'None',
			)
		),
		'contentalignment' => array(
			'type' => 'select',
			'label' => __( 'Content Alignment', 'fusion-core' ),
			'desc' => __( 'Choose how the content should be displayed.', 'fusion-core' ),
			'options' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			)
		),		
		'button' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Text', 'fusion-core' ),
			'desc' => __( 'Insert the text that will display in the button', 'fusion-core' ),
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'fusion-core' ),
			'desc' => __( 'The url the button will link to', 'fusion-core')
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'fusion-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'fusion-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'buttonsize' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'fusion-core' ),
			'desc' => __( 'Select the button\'s size.', 'fusion-core' ),
			'options' => array(
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
				'xlarge' => 'XLarge',
			)
		),
		'buttontype' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'fusion-core' ),
			'desc' => __( 'Select the button\'s type.', 'fusion-core' ),
			'options' => array(
				'flat' => 'Flat',
				'3d' => '3D',
			)
		),
		'buttonshape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'fusion-core' ),
			'desc' => __( 'Select the button\'s shape.', 'fusion-core' ),
			'options' => array(
				'square' => 'Square',
				'pill' => 'Pill',
				'round' => 'Round',
			)
		),		
		'buttoncolor' => array(
			'type' => 'select',
			'label' => __( 'Button Color', 'fusion-core' ),
			'desc' => __( 'Choose the button color <br />Default uses theme option selection', 'fusion-core' ),
			'options' => array(
				'' => 'Default',
				'green' => 'Green',
				'darkgreen' => 'Dark Green',
				'orange' => 'Orange',
				'blue' => 'Blue',
				'red' => 'Red',
				'pink' => 'Pink',
				'darkgray' => 'Dark Gray',
				'lightgray' => 'Light Gray',
			)
		),
		'title' => array(
			'type' => 'textarea',
			'label' => __( 'Tagline Title', 'fusion-core' ),
			'desc' => __( 'Insert the title text', 'fusion-core' ),
			'std' => 'Title'
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Tagline Description', 'fusion-core' ),
			'desc' => __( 'Insert the description text', 'fusion-core' ),
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'fusion-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'fusion-core' ),
			'options' => array(
				'0' => 'None',
				'bounce' => 'Bounce',
				'fade' => 'Fade',
				'flash' => 'Flash',
				'shake' => 'Shake',
				'slide' => 'Slide',
			)
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'fusion-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'fusion-core' ),
			'options' => array(
				'down' => 'Down',
				'left' => 'Left',
				'right' => 'Right',
				'up' => 'Up',
			)
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'fusion-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'fusion-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[tagline_box backgroundcolor="{{backgroundcolor}}" shadow="{{shadow}}" shadowopacity="{{shadowopacity}}" border="{{border}}" bordercolor="{{bordercolor}}" highlightposition="{{highlightposition}}" content_alignment="{{contentalignment}}" link="{{url}}" linktarget="{{target}}" button_size="{{buttonsize}}" button_shape="{{buttonshape}}" button_type="{{buttontype}}" buttoncolor="{{buttoncolor}}" button="{{button}}" title="{{title}}" description="{{description}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"][/tagline_box]',
	'popup_title' => __( 'Insert Tagline Box Shortcode', 'fusion-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['testimonials'] = array(
	'no_preview' => true,
	'params' => array(
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'fusion-core' ),
			'desc' => __( 'Controls the background color.  Leave blank for theme option selection.', 'fusion-core' ),
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Color', 'fusion-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),		
	),
	'shortcode' => '[testimonials backgroundcolor="{{backgroundcolor}}" textcolor="{{textcolor}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/testimonials]',
	'popup_title' => __( 'Insert Testimonials Shortcode', 'fusion-core' ),

	'child_shortcode' => array(
		'params' => array(
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Name', 'fusion-core' ),
				'desc' => __( 'Insert the name of the person.', 'fusion-core' ),
			),
			'avatar' => array(
				'type' => 'select',
				'label' => __( 'Avatar', 'fusion-core' ),
				'desc' => __( 'Choose which kind of Avatar to be displayed.', 'fusion-core' ),
				'options' => array(
					'male' => 'Male',
					'female' => 'Female',
					'image' => 'Image',
					'none' => 'None'
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Custom Avatar', 'fusion-core' ),
				'desc' => __( 'Upload a custom avatar image.', 'fusion-core' ),
			),			
			'company' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Company', 'fusion-core' ),
				'desc' => __( 'Insert the name of the company.', 'fusion-core' ),
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link', 'fusion-core' ),
				'desc' => __( 'Add the url the company name will link to.', 'fusion-core' ),
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Target', 'fusion-core' ),
				'desc' => __( '_self = open in same window <br />_blank = open in new window.', 'fusion-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Testimonial Content', 'fusion-core' ),
				'desc' => __( 'Add the testimonial content', 'fusion-core' ),
			)
		),
		'shortcode' => '[testimonial name="{{name}}" avatar="{{avatar}}" image="{{image}}" company="{{company}}" link="{{link}}" target="{{target}}"]{{content}}[/testimonial]',
		'clone_button' => __( 'Add Testimonial', 'fusion-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Title Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['title'] = array(
	'no_preview' => true,
	'params' => array(
		'size' => array(
			'type' => 'select',
			'label' => __( 'Title Size', 'fusion-core' ),
			'desc' => __( 'Choose the title size, H1-H6', 'fusion-core' ),
			'options' => fusion_shortcodes_range( 6, false )
		),
		'contentalign' => array(
			'type' => 'select',
			'label' => __( 'Title Alignment', 'fusion-core' ),
			'desc' => __( 'Choose to align the heading left or right.', 'fusion-core' ),
			'options' => array(
				'left' => 'Left',
				'right' => 'Right'
			)
		),
		'separator' => array(
			'type' => 'select',
			'label' => __( 'Separator', 'fusion-core' ),
			'desc' => __( 'Choose the kind of the title separator you want to use.', 'fusion-core' ),
			'options' => array(
				'single' => 'Single',
				'double' => 'Double',
				'underline' => 'Underline',			
			)
		),			
		'sepstyle' => array(
			'type' => 'select',
			'label' => __( 'Separator Style', 'fusion-core' ),
			'desc' => __( 'Choose the style of the title separator.', 'fusion-core' ),
			'options' => array(
				'solid' => 'Solid',
				'dashed' => 'Dashed',
				'dotted' => 'Dotted',			
			)
		),		
		'sepcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Separator Color', 'fusion-core' ),
			'desc' => __( 'Controls the separator color.  Leave blank for theme option selection.', 'fusion-core')
		),		
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Title', 'fusion-core' ),
			'desc' => __( 'Insert the title text', 'fusion-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[title size="{{size}}" content_align="{{contentalign}}" style_type="{{separator}} {{sepstyle}}" sep_color="{{sepcolor}}" class="{{class}}" id="{{id}}"]{{content}}[/title]',
	'popup_title' => __( 'Sharing Box Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Toggles Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['toggles'] = array(
	'no_preview' => true,
	'params' => array(
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),	
	),
	'shortcode' => '[accordian class="{{class}}" id="{{id}}"]{{child_shortcode}}[/accordian]',
	'popup_title' => __( 'Insert Toggles Shortcode', 'fusion-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'fusion-core' ),
				'desc' => __( 'Insert the toggle title', 'fusion-core' ),
			),
			'open' => array(
				'type' => 'select',
				'label' => __( 'Open by Default', 'fusion-core' ),
				'desc' => __( 'Choose to have the toggle open when page loads', 'fusion-core' ),
				'options' => $reverse_choices
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Toggle Content', 'fusion-core' ),
				'desc' => __( 'Insert the toggle content', 'fusion-core' ),
			)
		),
		'shortcode' => '[toggle title="{{title}}" open="{{open}}"]{{content}}[/toggle]',
		'clone_button' => __( 'Add Toggle', 'fusion-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Tooltip Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tooltip Text', 'fusion-core' ),
			'desc' => __( 'Insert the text that displays in the tooltip', 'fusion-core' )
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Position', 'fusion-core' ),
			'desc' => __( 'Choose the display position.', 'fusion-core' ),
			'options' => array(
				'top' => 'Top',
				'bottom' => 'Bottom',
				'left' => 'Left',
				'Right' => 'Right',
			)
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Trigger', 'fusion-core' ),
			'desc' => __( 'Choose action to trigger the tooltip.', 'fusion-core' ),
			'options' => array(
				'hover' => 'Hover',
				'click' => 'Click',
			)
		),			
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Content', 'fusion-core' ),
			'desc' => __( 'Insert the text that will activate the tooltip hover', 'fusion-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[tooltip title="{{title}}" placement="{{placement}}" trigger="{{trigger}}" class="{{class}}" id="{{id}}"]{{content}}[/tooltip]',
	'popup_title' => __( 'Tooltip Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'fusion-core' ),
			'desc' => __( 'For example the Video ID for <br />https://vimeo.com/75230326 is 75230326', 'fusion-core' )
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'fusion-core' ),
			'desc' => __( 'In pixels but only enter a number, ex: 600', 'fusion-core' )
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'fusion-core' ),
			'desc' => __( 'In pixels but enter a number, ex: 350', 'fusion-core' )
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'fusion-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'fusion-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'fusion-core' ),
			'desc' => __( 'Use additional API parameter, for example &title=0 to disable title on video. VimeoPlus account may be required.', 'fusion-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),		
	),
	'shortcode' => '[vimeo id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Vimeo Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Featured Slider Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['woofeatured'] = array(
	'no_preview' => true,
	'params' => array(

		'info' => array(
			'std' => 'No settings required. Insert the shortcode and your featured products will be pulled. Featured products are products that you have "Starred" in the WooCommerce settings. To set featured products, please see this post,<br /><a href="http://theme-fusion.com/knowledgebase/how-to-use-woocommerce-featured-products-slider/" target="_blank">Knowledge Base Article for Featured Products</a>',
			'type' => 'info'
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),		
	),
	'shortcode' => '[featured_products_slider class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Featured Products Slider Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Products Slider Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['wooproducts'] = array(
	'params' => array(

		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'fusion-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'fusion-core' ),
			'options' => array(
				'fixed' => 'Fixed',
				'auto' => 'Auto'
			)
		),
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'fusion-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'product_cat' )
		),
		'number_posts' => array(
			'std' => 5,
			'type' => 'select',
			'label' => __( 'Number of Products', 'fusion-core' ),
			'desc' => 'Select the number of products to display',
			'options' => fusion_shortcodes_range( 20, false )
		),
		'show_cats' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'fusion-core' ),
			'desc' => 'Choose to show or hide the categories',
			'options' => $reverse_choices
		),
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'fusion-core' ),
			'desc' => 'Choose to show or hide the price',
			'options' => $reverse_choices
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'fusion-core' ),
			'desc' => 'Choose to show or hide the icon buttons',
			'options' => $reverse_choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),			
	),
	'shortcode' => '[products_slider picture_size="{{picture_size}}" cat_slug="{{cat_slug}}" number_posts="{{number_posts}}" show_cats="{{show_cats}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Products Slider Shortcode', 'fusion-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'fusion-core' ),
			'desc' => 'For example the Video ID for <br />http://www.youtube.com/LOfeCR7KqUs is LOfeCR7KqUs'
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'fusion-core' ),
			'desc' => 'In pixels but only enter a number, ex: 600'
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'fusion-core' ),
			'desc' => 'In pixels but only enter a number, ex: 350'
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'fusion-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'fusion-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'fusion-core' ),
			'desc' => 'Use additional API parameter, for example &rel=0 to disable related videos'
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),		
	),
	'shortcode' => '[youtube id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Youtube Shortcode', 'fusion-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Fusion Slider Config
/*-----------------------------------------------------------------------------------*/

$fusion_shortcodes['fusionslider'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'type' => 'select',
			'label' => __( 'Slider Name', 'fusion-core' ),
			'desc' => __( 'This is the shortcode name that can be used in the post content area. It is usually all lowercase and contains only letters, numbers, and hyphens. ex: "fusionslider_slidernamehere"', 'fusion-core' ),
			'options' => fusion_shortcodes_categories( 'slide-page' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core' )
		),
	),
	'shortcode' => '[fusionslider id="{{id}}" class="{{class}}" name="{{name}}"][/fusionslider]',
	'popup_title' => __( 'Fusion Slider Shortcode', 'fusion-core' )
);