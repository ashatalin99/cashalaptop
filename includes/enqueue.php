<?php

 // Get a nicename version of the page-template name. IE products-falcon-x
function get_template_name () {
	global $post;
	$templateName = basename(get_page_template_slug(get_the_ID($post->ID)));
	$templateName = str_ireplace('template-', '', basename(get_page_template_slug(get_the_ID($post->ID)), '.php'));
	return $templateName;
}

// Add the page- prefix so that the page template name matches the style or script names in dist/
function get_page_template_name () {
	return "page-" . get_template_name();
}

function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );