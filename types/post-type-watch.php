<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'Watches',
	'singular_name'         => 'Watch',
	'add_new'               => 'New Watch',
	'add_new_item'          => 'New Watch Post',
	'edit_item'             => 'Edit Watch',
	'new_item'              => 'New Watch',
	'view_item'             => 'View Watch',
	'search_items'          => 'Search Watches',
	'not_found'             => 'No Watches Found',
	'not_found_in_trash'    => 'No Watches Found in Trash',
	'menu_name'             => 'Watches'
);

$args = array(
	'has_archive'           => false,
	'labels'                => $labels,
	'description'           => '',
	'public'                => true,
	'exclude_from_search'   => false,
	'publicly_queryable'    => true,
	'show_ui'               => true,
	'show_in_nav_menus'     => true,
	'show_in_menu'          => true,
	'show_in_admin_bar'     => true,
	'menu_position'         => 10,
	'menu_icon'             => 'dashicons-clock', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
	'supports'              => array( 'title', 'thumbnail' ),
	'rewrite' 				=> array(
									 'slug' => 'sell/watch/%watch_brand%', 
									 'with_front' => false
									)
);

register_post_type('watch', $args );

// Add category slug to url
add_filter('post_type_link', function($post_link, $post) {
    if ($post->post_type !== 'watch') return $post_link;

    $terms = get_the_terms($post->ID, 'watch_brand');
    if (!empty($terms) && !is_wp_error($terms)) {
        return str_replace('%watch_brand%', $terms[0]->slug, $post_link);
    }

    return str_replace('%watch_brand%', 'uncategorized', $post_link);
}, 10, 2);
