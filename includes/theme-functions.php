<?php

/**
 * Generate pagination links
 */
function pagination() {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	return paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 1,
		'prev_text' => 'Previous',
		'next_text' => 'Next',
	) );
}

// Remove comment support
function remove_comment_support() {
	remove_post_type_support( 'page', 'comments' );
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'faq', 'comments' );
}

add_action('init', 'remove_comment_support', 100);

// Remove editor from pages
function remove_content_editor() { 
    remove_post_type_support('page', 'editor'); 
	remove_post_type_support('post', 'editor'); 
}

add_action('admin_head', 'remove_content_editor');

// Remove tags from posts
function remove_tag_box() { 
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' );       
}

add_action('admin_menu', 'remove_tag_box');


