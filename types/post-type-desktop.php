<?php

/**
 * Post Type Declaration
 */

$labels = array(
	'name'                  => 'Desktops',
	'singular_name'         => 'Desktop',
	'add_new'               => 'New Desktop',
	'add_new_item'          => 'New Desktop Post',
	'edit_item'             => 'Edit Desktop',
	'new_item'              => 'New Desktop',
	'view_item'             => 'View Desktop',
	'search_items'          => 'Search Desktops',
	'not_found'             => 'No Desktops Found',
	'not_found_in_trash'    => 'No Desktops Found in Trash',
	'menu_name'             => 'Desktops'
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
	'menu_icon'             => 'dashicons-desktop', // https://developer.wordpress.org/resource/dashicons/
	'capability_type'       => 'post',
	'hierarchical'          => false,
	'supports'              => array( 'title', 'thumbnail' ),
	'taxonomies'            => array('desktop_brand'),
	'rewrite' 				=> array(
									 'slug' => 'sell/desktop/%desktop_brand%', 
									 'with_front' => false
									)
);

register_post_type('desktop', $args );

// Add category slug to url
add_filter('post_type_link', function($post_link, $post) {
    if ($post->post_type !== 'desktop') return $post_link;

    $terms = get_the_terms($post->ID, 'desktop_brand');
    if (!empty($terms) && !is_wp_error($terms)) {
        return str_replace('%desktop_brand%', $terms[0]->slug, $post_link);
    }

    return str_replace('%desktop_brand%', 'uncategorized', $post_link);
}, 10, 2);
