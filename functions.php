<?php

function theme_setup() {
	// Enable support for post thumbnails on posts and pages
	add_theme_support('post-thumbnails');

	// Enable support for automated page titles
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Register commonly used menus
	register_nav_menus( array(
		 'header_nav' => __( 'Header Nav - Header' ),
	));

	// Cleanup Head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_print_styles', 'print_emoji_styles');

	// Include custom post types, custom taxonomies, and general includes
	$includes = array_merge(
		glob( get_theme_root() . '/' . get_template() . '/taxonomies/*.php'), // All taxonomies
		glob( get_theme_root() . '/' . get_template() . '/types/*.php'), // All custom post types
		glob( get_theme_root() . '/' . get_template() . '/includes/*.php') // All includes
	);

	// Ignore files starting with an underscore
	if( $includes ) {
		foreach( $includes as $include ) {
			$exploded_path = explode('/', $include );
			$filename = end( $exploded_path );
			if ( strpos( $filename, '_') !== 0 ) {
				require_once( $include );
			}
		}
	}
}
add_action('after_setup_theme', 'theme_setup');
