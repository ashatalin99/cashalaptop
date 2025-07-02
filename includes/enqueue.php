<?php
/**
 * Front End CSS
 */

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

// Trim the filename of any suffix
function file_ext_strip($filename){
	return preg_replace('/(.min.css)|(.min.js)/i', '', $filename);
}

function load_styles() {
	wp_enqueue_style('theme-styles', get_bloginfo('template_url') . '/dist/theme-styles.min.css', array(), null);
}
add_action('wp_enqueue_scripts', 'load_styles');

/**
 * Front End JS
 */
function load_scripts() {

	// Theme Script
	wp_enqueue_script('theme-scripts', get_bloginfo('template_url').'/dist/theme-scripts.min.js', array(), null, true );

	// Dynamic URLs for use in scripts
	// wp_localize_script( 'theme-scripts', 'urls', array(
	// 	'base' => get_bloginfo('url'),
	// 	'theme' => get_bloginfo('template_url'),
	// 	'ajax' => admin_url('admin-ajax.php')
	// ));

	// // Initialize vars for JS
	// wp_localize_script( 'theme-scripts', 'info', array( /* IDs, etc. */ ));
}
add_action('wp_enqueue_scripts', 'load_scripts');

/**
 * Appends a version number to each JS and CSS asset containing the time the file was last updated to automatically bust caching
 */
function bust_asset_cache( $target_url ) {
    $url = parse_url( $target_url );

    if ( isset( $url['query'] ) && strpos( $url['query'], 'ver=' ) !== false && substr( $url['path'], 0, 19 ) === '/wp-content/themes/' ) {
        // Wrap in a try/catch block in case for stat failure
        try {
            // Replace the "ver" variable with the modification time of the file
            $target_url = add_query_arg('ver', filemtime( ABSPATH . $url['path'] ), $target_url );
        } catch ( \Exception $e ) {
            // Remove the "ver" variable in case of failure
            $target_url = remove_query_arg('ver', $target_url );
        }
    }
    return $target_url;
}
//add_filter('style_loader_src', 'bust_asset_cache', 9999 );
//add_filter('script_loader_src', 'bust_asset_cache', 9999 );

function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );