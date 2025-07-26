<?php
// Create category brands for laptop
add_action('init', function() {
    register_taxonomy('laptop_brand', ['laptop'], [
        'label' => 'Brands',
        'hierarchical' => true,
        'public' => true,
        'show_admin_column' => true,
        'show_in_graphql'       => true,
        'graphql_single_name'   => 'LaptopBrand',
        'graphql_plural_name'   => 'LaptopBrands',
    ]);

    // $brands = [
    //     "Acer", "Alienware", "Aorus", "Apple", "ASUS", "Averatec", "Compaq",
    //     "Dell", "Eluktronics", "eMachines", "Framework", "Fujitsu", "Gateway",
    //     "Google", "HP", "Huawei", "Lenovo", "LG", "Microsoft", "MSI", "Panasonic",
    //     "Razer", "Samsung",  "Sony", "Toshiba", "Xiaomi"
    // ];

    // foreach ($brands as $brand) {
    //     if (!term_exists($brand, 'laptop_brand')) {
    //         wp_insert_term($brand, 'laptop_brand');
    //     }
    // }
});

// Populate category slug in post url when saving post
add_action('save_post_laptop', function($post_id) {
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
        add_action('save_post_laptop', __FUNCTION__);
    }
});

add_action('init', function($post_id) {
    // $terms = get_the_terms( $post_id, 'laptop_brand' );
    // if ( $terms && ! is_wp_error( $terms ) ) {
    //     foreach ( $terms as $term ) {
    //         echo $term->name;
    //     }
    // }

    // Get all terms from a custom taxonomy
    // $all_terms = get_terms( array(
    //     'taxonomy' => 'laptop_brand',
    //     'hide_empty' => false, // Set to true to hide terms with no posts
    // ) );
    // if ( ! empty( $all_terms ) && ! is_wp_error( $all_terms ) ) {
    //     foreach ( $all_terms as $term ) {
    //         echo $term->name;
    //     }
    // } 
    // $term = get_term_by('slug', 'acer', 'laptop_brand');
    // var_dump($term);
    // if ($term) {
    //     echo $term->name;
    // } else {
    //     echo "Term not found.";
    // }
});

function update_laptop_brand_from_csv($csv_path) {
    if (!file_exists($csv_path)) {
        echo "CSV file not found: $csv_path\n";
        return;
    }

    $taxonomy = 'laptop_brand';

    $file = fopen($csv_path, 'r');
    $header = fgetcsv($file);
    $columns = array_flip($header);

    while (($row = fgetcsv($file)) !== false) {
        $title = trim($row[$columns['title']]);
        $brand_name = trim($row[$columns['brand']]);
        $slug = sanitize_title(strtolower($brand_name));

        if (empty($title) || empty($brand_name)) {
            continue;
        }

        // Get the post by title
        $post = get_page_by_title($title, OBJECT, 'laptop'); // Change 'laptop' to your CPT if needed

        if (!$post) {
            echo "Post not found for title: $title\n";
            continue;
        }

        $post_id = $post->ID;

        // Ensure the term exists or create it
        $term = get_term_by('slug', $slug, $taxonomy);
        if (!$term) {
            $inserted = wp_insert_term($brand_name, $taxonomy);
            if (is_wp_error($inserted)) {
                echo "Failed to insert term '$brand_name': " . $inserted->get_error_message() . "\n";
                continue;
            }
            $term_id = $inserted['term_id'];
        } else {
            $term_id = $term->term_id;
        }

        // Assign the term (overwrite all previous terms in this taxonomy)
        $result = wp_set_post_terms($post_id, [$term_id], $taxonomy, false);

        if (is_wp_error($result)) {
            echo "Error assigning brand '$brand_name' to '$title': " . $result->get_error_message() . "\n";
        } else {
            echo "Set '$brand_name' as brand for '$title'\n";
        }
    }

    fclose($file);
    echo "Brand update complete.\n";
}


add_action('init', function() {
    // Uncomment to run the function once
    //insert_laptop_posts_from_csv(ABSPATH . 'wp-content/uploads/laptops_only.csv');
    //update_post_permalinks_from_csv(ABSPATH . 'wp-content/themes/main/python/output.csv');
});

function insert_laptop_posts_from_csv($csv_path) {
    if (!file_exists($csv_path)) {
        echo "CSV file not found: $csv_path\n";
        return;
    }

    require_once ABSPATH . 'wp-admin/includes/post.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $taxonomy = 'laptop_brand';
    $post_type = 'laptop';

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
