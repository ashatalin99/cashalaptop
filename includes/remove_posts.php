<?php
/**
 * If you want to remove all posts from specific post type 
 * uncomment function set post_type variable to post type you need
 * and run it once 
 *
 */
add_action('init', function() {
    // Uncomment to run the function once
    //remove_posts_by_type('tablet');
});

function remove_posts_by_type($post_type) {
    if (!current_user_can('administrator')) {
        return;
    }
    $posts = get_posts([
        'post_type'      => $post_type,
        'post_status'    => 'any',
        'posts_per_page' => -1, // Get all
        'fields'         => 'ids' // Only get IDs
    ]);

    foreach ($posts as $post_id) {
        wp_delete_post($post_id, true); // true = force delete without trash
    }

    echo '✅ All posts of type ' . esc_html($post_type) . ' have been deleted.';
}