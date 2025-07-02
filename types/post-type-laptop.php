<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'Laptops',
	'singular_name'         => 'Laptop',
	'add_new'               => 'New Laptop',
	'add_new_item'          => 'New Laptop Post',
	'edit_item'             => 'Edit Laptop',
	'new_item'              => 'New Laptop',
	'view_item'             => 'View Laptop',
	'search_items'          => 'Search Laptops',
	'not_found'             => 'No Laptops Found',
	'not_found_in_trash'    => 'No Laptops Found in Trash',
	'menu_name'             => 'Laptops'
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
	'menu_icon'             => 'dashicons-laptop', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
	'supports'              => array( 'title', 'thumbnail' ),
	'taxonomies'            => array('laptop_brand'),
	'rewrite' 				=> array(
									 'slug' => 'sell/laptop/%laptop_brand%', 
									 'with_front' => false
									)
);

register_post_type('laptop', $args );

// Add category slug to url
add_filter('post_type_link', function($post_link, $post) {
    if ($post->post_type !== 'laptop') return $post_link;

    $terms = get_the_terms($post->ID, 'laptop_brand');
    if (!empty($terms) && !is_wp_error($terms)) {
        return str_replace('%laptop_brand%', $terms[0]->slug, $post_link);
    }

    return str_replace('%laptop_brand%', 'uncategorized', $post_link);
}, 10, 2);
