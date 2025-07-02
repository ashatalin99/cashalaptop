<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'Consoles',
	'singular_name'         => 'Console',
	'add_new'               => 'New Console',
	'add_new_item'          => 'New Console Post',
	'edit_item'             => 'Edit Console',
	'new_item'              => 'New Console',
	'view_item'             => 'View Console',
	'search_items'          => 'Search Consoles',
	'not_found'             => 'No Consoles Found',
	'not_found_in_trash'    => 'No Consoles Found in Trash',
	'menu_name'             => 'Consoles'
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
	'menu_icon'             => 'dashicons-games', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
	'supports'              => array( 'title', 'thumbnail' ),
	'taxonomies'            => array('console_brand'),
	'rewrite' 				=> array(
									 'slug' => 'sell/console/%console_brand%', 
									 'with_front' => false
									)
);

register_post_type('console', $args );

// Add category slug to url
add_filter('post_type_link', function($post_link, $post) {
    if ($post->post_type !== 'console') return $post_link;

    $terms = get_the_terms($post->ID, 'console_brand');
    if (!empty($terms) && !is_wp_error($terms)) {
        return str_replace('%console_brand%', $terms[0]->slug, $post_link);
    }

    return str_replace('%console_brand%', 'uncategorized', $post_link);
}, 10, 2);