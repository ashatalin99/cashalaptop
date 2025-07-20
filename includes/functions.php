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

// add_action( 'graphql_register_types', function() {
//   // 1️⃣ Define the object type
//   register_graphql_object_type( 'FaqSection', [
//     'fields' => [
//       'faqs' => [
//         'type'    => [ 'list_of' => 'Faq' ],
//         'resolve' => fn( $root ) => $root['faqs'] ?? [],
//       ],
//     ],
//   ] );

//   // 2️⃣ Attach it to Page
//   register_graphql_field( 'Page', 'faqSection', [
//     'type'        => 'FaqSection',
//     'description' => 'ACF FAQ section',
//     'resolve'     => fn( $page ) => get_field( 'faq_section', $page->ID ),
//   ] );
// });