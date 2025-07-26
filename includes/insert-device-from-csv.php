<?php

add_action('init', function() {
    // Uncomment to run the function once
    //insert_laptop_posts_from_csv(get_template_directory() . '/python/watches.csv', 'watch_brand', 'watch');
    //update_post_permalinks_from_csv(ABSPATH . 'wp-content/themes/main/python/output.csv');
});

function insert_laptop_posts_from_csv($csv_path, $taxonomy, $post_type) {
    if (!file_exists($csv_path)) {
        echo "CSV file not found: $csv_path\n";
        return;
    }

    require_once ABSPATH . 'wp-admin/includes/post.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // $taxonomy = 'laptop_brand';
    // $post_type = 'laptop';

    $file = fopen($csv_path, 'r');
    $header = fgetcsv($file);
    $columns = array_flip($header);

    while (($row = fgetcsv($file)) !== false) {
        $title  = trim($row[$columns['title']]);
        $slug   = sanitize_title(trim($row[$columns['url']]));
        $image  = trim($row[$columns['images']]);
        $brand  = trim($row[$columns['brand']]);
        $price  = trim($row[$columns['price']]);

        if (empty($title)) continue;

        // Insert post
        $post_id = wp_insert_post([
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => $post_type,
        ]);

        if (is_wp_error($post_id)) {
            echo "Error inserting post: " . $post_id->get_error_message() . "\n";
            continue;
        }

        // Handle laptop_brand taxonomy
        $brand_slug = sanitize_title($brand);
        $term = get_term_by('slug', $brand_slug, $taxonomy);
        if (!$term) {
            $term_result = wp_insert_term($brand, $taxonomy);
            if (is_wp_error($term_result)) {
                echo "Error creating brand '$brand': " . $term_result->get_error_message() . "\n";
                continue;
            }
            $term_id = $term_result['term_id'];
        } else {
            $term_id = $term->term_id;
        }
        wp_set_post_terms($post_id, [$term_id], $taxonomy);

        // Set custom field: price
        update_post_meta($post_id, 'price', $price);

        // Set featured image from uploads path
        $upload_dir = wp_upload_dir();
        $image_path = $upload_dir['basedir'] . '/2025/04/' . $image;
        $image_url  = $upload_dir['baseurl'] . '/2025/04/' . $image;

        if (file_exists($image_path)) {
            $attachment = [
                'post_mime_type' => mime_content_type($image_path),
                'post_title'     => sanitize_file_name($image),
                'post_content'   => '',
                'post_status'    => 'inherit',
                'guid'           => $image_url,
            ];

            $attach_id = wp_insert_attachment($attachment, $image_path, $post_id);
            $attach_data = wp_generate_attachment_metadata($attach_id, $image_path);
            wp_update_attachment_metadata($attach_id, $attach_data);
            set_post_thumbnail($post_id, $attach_id);
        } else {
            echo "Image not found: $image_path\n";
        }

        echo "Inserted post: $title\n";
    }

    fclose($file);
    echo "Import complete.\n";
}

function update_post_permalinks_from_csv($csv_path) {
    if (!file_exists($csv_path)) {
        echo "CSV file not found: $csv_path\n";
        return;
    }

    $post_type = 'laptop'; // Change to your CPT if needed

    $file = fopen($csv_path, 'r');
    $header = fgetcsv($file);
    $columns = array_flip($header);

    while (($row = fgetcsv($file)) !== false) {
        $title = trim($row[$columns['title']]);
        $new_slug = sanitize_title(trim($row[$columns['url']]));

        if (empty($title) || empty($new_slug)) {
            continue;
        }

        // Get post by title
        $post = get_page_by_title($title, OBJECT, $post_type);
        if (!$post) {
            echo "Post not found for title: $title\n";
            continue;
        }

        // Update post slug
        $post->post_name = $new_slug;
        $updated_id = wp_update_post($post, true);

        if (is_wp_error($updated_id)) {
            echo "Failed to update permalink for '$title': " . $updated_id->get_error_message() . "\n";
        } else {
            echo "Updated permalink for '$title' → $new_slug\n";
        }
    }

    fclose($file);
    echo "Permalink update complete.\n";
} 