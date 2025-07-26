<?php
// Create category brands for phone
add_action('init', function() {
    register_taxonomy('phone_brand', ['phone'], [
        'label' => 'Brands',
        'hierarchical' => true,
        'public' => true,
        'show_admin_column' => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'PhoneBrand',
        'graphql_plural_name'   => 'PhoneBrands',
    ]);

    // $brands = [
    //     "Apple", "ASUS", "Blackberry", "Google", "HTC", 
    //     "Lenovo", "LG", "Motorola", "Nokia", "Samsung"
    // ];

    // foreach ($brands as $brand) {
    //     if (!term_exists($brand, 'phone_brand')) {
    //         wp_insert_term($brand, 'phone_brand');
    //     }
    // }
});

// Populate category slug in post url when saving post
add_action('save_post_phone', function($post_id) {
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
        add_action('save_post_phone', __FUNCTION__);
    }
});
