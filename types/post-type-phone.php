<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'Phones',
	'singular_name'         => 'Phone',
	'add_new'               => 'New Phone',
	'add_new_item'          => 'New Phone Post',
	'edit_item'             => 'Edit Phone',
	'new_item'              => 'New Phone',
	'view_item'             => 'View Phone',
	'search_items'          => 'Search Phones',
	'not_found'             => 'No Phones Found',
	'not_found_in_trash'    => 'No Phones Found in Trash',
	'menu_name'             => 'Phones'
);

$args = array(
	'has_archive'           => false,
	'labels'                => $labels,
	'description'           => '',
	'public'                => true,
	'exclude_from_search'   => false,
	'publicly_queryable'    => true,
	"show_in_graphql"       => true,
	'graphql_single_name' => 'phone',    // singular Type in GraphQL schema
    'graphql_plural_name' => 'phones',  // plural
	'show_ui'               => true,
	'show_in_nav_menus'     => true,
	'show_in_menu'          => true,
	'show_in_rest' 			=> true,
	'show_in_admin_bar'     => true,
	'menu_position'         => 10,
	'menu_icon'             => 'dashicons-phone', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
	'supports'              => array( 'title', 'thumbnail' ),
	'taxonomies'            => array('phone_brand'),
	'rewrite' 				=> array(
									 'slug' => 'sell/phone/%phone_brand%', 
									 'with_front' => false
									)
);

register_post_type('phone', $args );

// Add category slug to url
add_filter('post_type_link', function($post_link, $post) {
    if ($post->post_type !== 'phone') return $post_link;

    $terms = get_the_terms($post->ID, 'phone_brand');
    if (!empty($terms) && !is_wp_error($terms)) {
        return str_replace('%phone_brand%', $terms[0]->slug, $post_link);
    }

    return str_replace('%phone_brand%', 'uncategorized', $post_link);
}, 10, 2);