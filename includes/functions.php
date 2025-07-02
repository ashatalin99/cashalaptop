<?php

/**
 * Debug tool - displays contents of any variable wrapped in pre tags
 *
 * @param $variable Variable you want to debug
 */
function debug( $variable ) {
	echo "<pre>";
	if( is_array( $variable ) || is_object( $variable ) ) {
		print_r( $variable );
	} else {
		var_dump( $variable );
	}
	echo "</pre>";
}



// Removes coments.js file
function disable_comment_js(){
    wp_deregister_script( 'comment-reply' );
}
add_action( 'init', 'disable_comment_js' );

// Add svg to media gallery
if( !function_exists('cc_mime_types') ) {
   	function cc_mime_types($mimes) {
	  $mimes['svg'] = 'image/svg+xml';
	  $mimes['webp'] = 'image/webp';
	  
	  return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
}

// Support for GraphQL
add_filter( 'graphql_entrypoint', function() {
  return '/graphql';            
});