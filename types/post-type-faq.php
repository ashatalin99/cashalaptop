<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'FAQs',
	'singular_name'         => 'FAQ',
	'add_new'               => 'New FAQ',
	'add_new_item'          => 'New FAQ Post',
	'edit_item'             => 'Edit FAQ',
	'new_item'              => 'New FAQ',
	'view_item'             => 'View FAQ',
	'search_items'          => 'Search FAQs',
	'not_found'             => 'No FAQs Found',
	'not_found_in_trash'    => 'No FAQs Found in Trash',
	'menu_name'             => 'FAQs'
);

$args = array(
	'has_archive'           => false,
	'labels'                => $labels,
	'description'           => '',
	'public'                => false,
	'exclude_from_search'   => false,
	'publicly_queryable'    => true,
	"show_in_graphql"       => true,
	'graphql_single_name' => 'faq',    // singular Type in GraphQL schema
    'graphql_plural_name' => 'faqs',  // plural
	'show_ui'               => true,
	'show_in_nav_menus'     => true,
	'show_in_menu'          => true,
	'show_in_admin_bar'     => true,
	'menu_position'         => 10,
	'menu_icon'             => 'dashicons-admin-comments', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
);

register_post_type('faq', $args );

// Add category slug to url
// add_filter('post_type_faq', function($post_link, $post) {
//     if ($post->post_type !== 'faq') return $post_link;

//     $terms = get_the_terms($post->ID, 'faq_section');
//     if (!empty($terms) && !is_wp_error($terms)) {
//         return str_replace('%faq_section%', $terms[0]->slug, $post_link);
//     }

//     return str_replace('%faq_section%', 'uncategorized', $post_link);
// }, 10, 2);
