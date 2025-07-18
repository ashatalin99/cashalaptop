<?php
// Create category sections for faq
add_action('init', function() {
    register_taxonomy('faq_section', ['faq'], [
        'label' => 'Categories',
        'hierarchical' => true,
        'public' => true,
        'show_admin_column' => true,
    ]);

    $categories = [
        "Shipping", "About online buyback quote process and steps",
        "About Payment", "About Your Laptop (or other device and gadgets)",
        
    ];

    foreach ($categories as $category) {
        if (!term_exists($category, 'faq_category')) {
            wp_insert_term($category, 'faq_category');
        }
    }
});

// Populate category slug in post url when saving post
add_action('save_post_faq', function($post_id) {
    // Avoid infinite loops and autosaves
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;

    $post = get_post($post_id);
    if ($post->post_type !== 'post') return;

    // Get assigned categories
    $categories = get_the_category($post_id);
    if (empty($categories)) return;

    // Use the first category or primary category
    $category_slug = sanitize_title($categories[0]->slug);
    $title_slug = sanitize_title($post->post_title);
    $new_slug = $category_slug . '-' . $title_slug;

    // Only update if it's different
    if ($post->post_name !== $new_slug) {
        // Temporarily unhook to avoid infinite loop
        remove_action('save_post', __FUNCTION__);
        wp_update_post([
            'ID' => $post_id,
            'post_name' => $new_slug
        ]);
        add_action('save_post_faq', __FUNCTION__);
    }
});
