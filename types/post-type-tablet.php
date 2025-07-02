<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'Tablets',
	'singular_name'         => 'Tablet',
	'add_new'               => 'New Tablet',
	'add_new_item'          => 'New Tablet Post',
	'edit_item'             => 'Edit Tablet',
	'new_item'              => 'New Tablet',
	'view_item'             => 'View Tablet',
	'search_items'          => 'Search Tablets',
	'not_found'             => 'No Tablets Found',
	'not_found_in_trash'    => 'No Tablets Found in Trash',
	'menu_name'             => 'Tablets'
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
	'menu_icon'             => 'dashicons-tablet', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
	'supports'              => array( 'title', 'thumbnail' ),
	'taxonomies'            => array('tablet_brand'),
	'rewrite' 				=> array(
									 'slug' => 'sell/tablet/%tablet_brand%', 
									 'with_front' => false
									)
);

register_post_type('tablet', $args );

// Add category slug to url
add_filter('post_type_link', function($post_link, $post) {
    if ($post->post_type !== 'tablet') return $post_link;

    $terms = get_the_terms($post->ID, 'tablet_brand');
    if (!empty($terms) && !is_wp_error($terms)) {
        return str_replace('%tablet_brand%', $terms[0]->slug, $post_link);
    }

    return str_replace('%tablet_brand%', 'uncategorized', $post_link);
}, 10, 2);