<?php

/**
 * Remove default link option for images
 */
function image_link_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}
add_action('admin_init', 'image_link_setup', 10 );

/**
 * Add ability to upload SVGs
 */
function upload_types( $existing_mimes = array() ) {
    $existing_mimes['svg'] = 'image/svg+xml';
    return $existing_mimes;
}
add_filter('upload_mimes', 'upload_types');


// Make Category column sortable in admin
add_filter('manage_edit-post_sortable_columns', function($columns) {
    $columns['brands'] = 'desktop_brand';
    return $columns;
});

// Handle sorting query
add_action('pre_get_posts', function($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->get('orderby') === 'desktop_brand') {
        $query->set('orderby', 'desktop_brand');
    }
});


