<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'All-in-One',
	'singular_name'         => 'All-in-One',
	'add_new'               => 'All-in-One',
	'add_new_item'          => 'New All-in-One Post',
	'edit_item'             => 'Edit All-in-One',
	'new_item'              => 'New All-in-One',
	'view_item'             => 'View All-in-One',
	'search_items'          => 'Search All-in-One',
	'not_found'             => 'No All-in-One Found',
	'not_found_in_trash'    => 'No All-in-One Found in Trash',
	'menu_name'             => 'All-in-One'
);

$args = array(
	'has_archive'           => false,
	'labels'                => $labels,
	'description'           => '',
	'public'                => true,
	'exclude_from_search'   => false,
	'publicly_queryable'    => true,
	"show_in_graphql"       => true,
	'graphql_single_name' => 'all_in_one',    // singular Type in GraphQL schema
    'graphql_plural_name' => 'all_in_ones',  // plural
	'show_ui'               => true,
	'show_in_nav_menus'     => true,
	'show_in_menu'          => true,
	'show_in_admin_bar'     => true,
	'menu_position'         => 10,
	'menu_icon'             => 'dashicons-index-card', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
	'supports'              => array( 'title', 'thumbnail' ),
	'taxonomies'            => array('all_in_one_brand'),
	'rewrite' 				=> array(
									 'slug' => 'sell/all-in-one/%all_in_one_brand%', 
									 'with_front' => false
									)
);

register_post_type('all_in_one', $args );

// Add category slug to url
add_filter('post_type_link', function($post_link, $post) {
    if ($post->post_type !== 'all_in_one') return $post_link;

    $terms = get_the_terms($post->ID, 'all_in_one_brand');
    if (!empty($terms) && !is_wp_error($terms)) {
        return str_replace('%all_in_one_brand%', $terms[0]->slug, $post_link);
    }

    return str_replace('%all_in_one_brand%', 'uncategorized', $post_link);
}, 10, 2);