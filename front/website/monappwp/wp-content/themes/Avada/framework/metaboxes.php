<?php
class PyreThemeFrameworkMetaboxes {

	public function __construct()
	{
		global $smof_data;
		$this->data = $smof_data;

		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('save_post', array($this, 'save_meta_boxes'));
		add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
	}

	// Load backend scripts
	function admin_script_loader() {
		global $pagenow;
		if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php')) {
	    	wp_register_script('avada_upload', get_bloginfo('template_directory').'/js/upload.js');
	    	wp_enqueue_script('avada_upload');
	    	wp_enqueue_script('media-upload');
	    	wp_enqueue_script('thickbox');
	   		wp_enqueue_style('thickbox');
		}
	}

	public function add_meta_boxes()
	{
		$post_types = get_post_types( array( 'public' => true ) );

		$disallowed = array( 'page', 'post', 'attachment', 'avada_portfolio', 'themefusion_elastic', 'product', 'wpsc-product', 'slide' );

		foreach ( $post_types as $post_type ) {
			if ( in_array( $post_type, $disallowed ) )
				continue;

			$this->add_meta_box('post_options', 'Avada Options', $post_type);
		}

		$this->add_meta_box('post_options', 'Post Options', 'post');

		$this->add_meta_box('page_options', 'Page Options', 'page');

		$this->add_meta_box('portfolio_options', 'Portfolio Options', 'avada_portfolio');

		$this->add_meta_box('es_options', 'Elastic Slide Options', 'themefusion_elastic');

		$this->add_meta_box('woocommerce_options', 'Product Options', 'product');

		$this->add_meta_box('slide_options', 'Slide Options', 'slide');
	}

	public function add_meta_box($id, $label, $post_type)
	{
	    add_meta_box(
	        'pyre_' . $id,
	        $label,
	        array($this, $id),
	        $post_type
	    );
	}

	public function save_meta_boxes($post_id)
	{
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		foreach($_POST as $key => $value) {
			if(strstr($key, 'pyre_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}

	public function post_options()
	{
		$smof_data = $this->data;
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/post_options.php';
	}

	public function page_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/page_options.php';
	}

	public function portfolio_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/portfolio_options.php';
	}

	public function es_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/es_options.php';
	}

	public function woocommerce_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/woocommerce_options.php';
	}

	public function slide_options()
	{
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/slide_options.php';
	}

	public function text($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<input type="text" id="pyre_' . $id . '" name="pyre_' . $id . '" value="' . get_post_meta($post->ID, 'pyre_' . $id, true) . '" />';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public function select($id, $label, $options, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<select id="pyre_' . $id . '" name="pyre_' . $id . '">';
				foreach($options as $key => $option) {
					if(get_post_meta($post->ID, 'pyre_' . $id, true) == $key) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}

					$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
				}
				$html .= '</select>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public function multiple($id, $label, $options, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<select multiple="multiple" id="pyre_' . $id . '" name="pyre_' . $id . '[]">';
				foreach($options as $key => $option) {
					if(is_array(get_post_meta($post->ID, 'pyre_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'pyre_' . $id, true))) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}

					$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
				}
				$html .= '</select>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public function textarea($id, $label, $desc = '', $default = '' )
	{
		global $post;

		$db_value = get_post_meta($post->ID, 'pyre_' . $id, true);

		if( $db_value ) {
			$value = $db_value;
		} else {
			$value = $default;
		}

		$html = '';
		$html = '';
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<textarea cols="120" rows="10" id="pyre_' . $id . '" name="pyre_' . $id . '">' . $value . '</textarea>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public function upload($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html = '';
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
			    $html .= '<input name="pyre_' . $id . '" class="upload_field" id="pyre_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'pyre_' . $id, true) . '" />';
			    $html .= '<input class="avada_upload_button" type="button" value="Browse" />';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

}

$metaboxes = new PyreThemeFrameworkMetaboxes;