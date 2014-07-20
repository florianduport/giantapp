<?php

// Help menu
add_filter('contextual_help', 'layerslider_help', 10, 3);
function layerslider_help($contextual_help, $screen_id, $screen) {

	// Exit early if file_get_contens() is not available
	if(!function_exists('file_get_contents')) {
		$screen->add_help_tab(array(
			'id' => 'error',
			'title' => 'Error',
			'content' => 'This help section couldn\'t show you the documentation because your server don\'t support the "file_get_contents" function'
		));

	// Skin Editor
	} elseif(strpos($screen->base, 'ls-skin-editor') !== false) {

		$screen->add_help_tab(array(
			'id' => 'skin_overview',
			'title' => 'Overview',
			'content' => file_get_contents(LS_ROOT_PATH.'/docs/skin_overview.html')
		));

	// Style Editor
	} elseif(strpos($screen->base, 'ls-style-editor') !== false) {

		$screen->add_help_tab(array(
			'id' => 'styles_overview',
			'title' => 'Overview',
			'content' => file_get_contents(LS_ROOT_PATH.'/docs/styles_overview.html')
		));

	// Transition builder
	} elseif(strpos($screen->base, 'ls-transition-builder') !== false) {

		$screen->add_help_tab(array(
			'id' => 'transition_overview',
			'title' => 'Overview',
			'content' => file_get_contents(LS_ROOT_PATH.'/docs/transition_overview.html')
		));

		$screen->add_help_tab(array(
			'id' => 'transition_start',
			'title' => 'Getting started',
			'content' => file_get_contents(LS_ROOT_PATH.'/docs/transition_start.html')
		));

		$screen->add_help_tab(array(
			'id' => 'transition_3d',
			'title' => '3D transitions',
			'content' => file_get_contents(LS_ROOT_PATH.'/docs/transition_3d.html')
		));

		$screen->add_help_tab(array(
			'id' => 'transition_easings',
			'title' => 'Easings',
			'content' => file_get_contents(LS_ROOT_PATH.'/docs/transition_easings.html')
		));

	} elseif(strpos($screen->base, 'layerslider') !== false) {

		if(!isset($_GET['action']) || $_GET['action'] != 'edit') {

			$screen->add_help_tab(array(
				'id' => 'home_overview',
				'title' => 'Overview',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/home_overview.html')
			));

			$screen->add_help_tab(array(
				'id' => 'home_screen',
				'title' => 'Managing sliders',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/home_managing_sliders.html')
			));

			$screen->add_help_tab(array(
				'id' => 'inserting_slider',
				'title' => 'Inserting sliders into pages',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/inserting_slider.html')
			));

			$screen->add_help_tab(array(
				'id' => 'exportimport',
				'title' => 'Export / Import',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/home_exportimport.html')
			));

			$screen->add_help_tab(array(
				'id' => 'sample_slider',
				'title' => 'Sample sliders',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/home_sample_slider.html')
			));

			$screen->add_help_tab(array(
				'id' => 'ls_google_fonts',
				'title' => 'Using Google Fonts',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/home_google_fonts.html')
			));

			$screen->add_help_tab(array(
				'id' => 'ls_advanced_settings',
				'title' => 'Advanced settings',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/home_advanced_settings.html')
			));

			$screen->add_help_tab(array(
				'id' => 'ls_faq',
				'title' => 'Need more help?',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/faq.html')
			));

		// Editor
		} else {

			$screen->add_help_tab(array(
				'id' => 'overview',
				'title' => 'Overview',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_overview.html')
			));

			$screen->add_help_tab(array(
				'id' => 'interface',
				'title' => 'Interface tips',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_interface.html')
			));

			$screen->add_help_tab(array(
				'id' => 'inserting_slider',
				'title' => 'Inserting sliders into pages',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/inserting_slider.html')
			));


			$screen->add_help_tab(array(
				'id' => 'compatibility',
				'title' => 'Backwards compatibility',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_compatibility.html')
			));

			$screen->add_help_tab(array(
				'id' => 'slider_types',
				'title' => 'Layout & Responsive mode',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_layout.html')
			));

			$screen->add_help_tab(array(
				'id' => 'sublayer_options',
				'title' => 'Layer options',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_layer_options.html')
			));

			$screen->add_help_tab(array(
				'id' => 'post_contents',
				'title' => 'Dynamic sliders from posts',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_post_content.html')
			));

			$screen->add_help_tab(array(
				'id' => 'embedding_videos',
				'title' => 'Embedding videos',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_multimedia.html')
			));

			$screen->add_help_tab(array(
				'id' => 'language_support',
				'title' => 'Translation & Language support',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_language_support.html')
			));

			$screen->add_help_tab(array(
				'id' => 'other_features',
				'title' => 'Other features',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_other_features.html')
			));

			$screen->add_help_tab(array(
				'id' => 'event_callbacks',
				'title' => 'Event callbacks',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_event_callbacks.html')
			));

			$screen->add_help_tab(array(
				'id' => 'layerslider_api',
				'title' => 'LayerSlider API',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/editor_api.html')
			));

			$screen->add_help_tab(array(
				'id' => 'ls_faq',
				'title' => 'Need more help?',
				'content' => file_get_contents(LS_ROOT_PATH.'/docs/faq.html')
			));
		}
	}
}

?>
