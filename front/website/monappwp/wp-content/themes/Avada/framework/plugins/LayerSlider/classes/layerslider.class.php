<?php

// Get class files
include LS_ROOT_PATH.'/classes/class.ls.posts.php';
include LS_ROOT_PATH.'/classes/class.ls.sliders.php';

class LayerSlider {

	public $sources, $sliders, $posts, $autoupdate;

	function __construct() {

		// Get instances
		$this->posts   = new LS_Posts();

		// Do other stuff later
	}
}

?>
