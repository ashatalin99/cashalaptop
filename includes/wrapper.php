<?php
/**
 * Theme wrapper
 *
 * @link http://roots.io/an-introduction-to-the-roots-theme-wrapper/
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function get_main_template() {
	global $post;
	@include Theme_Wrapper::$main_template;
}

function get_main_header() {
	global $post;
	@include new Theme_Wrapper('partials/header.php');
}

function get_main_footer() {
	global $post;
	@include new Theme_Wrapper('partials/footer.php');
}

function get_custom_main_header($header_path) {
	global $post;
	@include new Theme_Wrapper($header_path);
}

function get_custom_main_footer($footer_path) {
	global $post;
	@include new Theme_Wrapper($footer_path);
}

class Theme_Wrapper {
	// Stores the full path to the main template file
	static $main_template;

	// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	static $base;

	// Declare the property explicitly
	public $slug; 
	public $templates;

	public function __construct($template = 'wrapper.php') {
		$this->slug = basename($template, '.php');
		$this->templates = array($template);

		if (self::$base) {
			$str = substr($template, 0, -4);
			array_unshift($this->templates, sprintf($str . '-%s.php', self::$base));
		}
	}

	public function __toString() {
		$this->templates = apply_filters('wrap_' . $this->slug, $this->templates);
		return locate_template($this->templates);
	}

	static function wrap($main) {
		self::$main_template = $main;
		self::$base = basename(self::$main_template, '.php');

		if (self::$base === 'index') {
			self::$base = false;
		}

		return new Theme_Wrapper();
	}
}
add_filter('template_include', array('Theme_Wrapper', 'wrap'), 99);