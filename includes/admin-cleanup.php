<?php

/**
 * Remove unnecesary dashboard meta boxes
 */
function remove_dashboard_widgets() {
    // remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side'); // Other WordPress News
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

/**
 * Unregisters unnecesary default widgets
 */
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Categories');
	// unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('GFWidget');
	
}
add_action('widgets_init', 'unregister_default_wp_widgets');

/**
 * Hide admin pages that are not used
 */
function remove_menu_pages() {
	remove_menu_page( 'edit-comments.php' ); // Comments
	//remove_menu_page( 'edit.php' );	// Posts
}
add_action('admin_menu', 'remove_menu_pages');

/**
 * Change admin menu order
 */
function change_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'gf_edit_forms', // Gravity Forms
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}
//add_filter('custom_menu_order', '__return_true');
//add_filter('menu_order', 'mg_change_menu_order');

/**
 * Removes admin bar items
 */
function remove_admin_bar_items() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_items');

/**
 * Remove post_tags and categories from admin
 */
function unregister_default_taxonomies() {
	register_taxonomy('category', array() );
	register_taxonomy('post_tag', array() );
}
//add_action('init', 'mg_unregister_default_taxonomies');

// Disable support for comments and trackbacks in post types
add_action('admin_init', function() {
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in admin menu
add_action('admin_menu', function() {
    remove_menu_page('edit-comments.php');
});

// Redirect any user trying to access comments page
add_action('admin_init', function() {
    if (is_admin() && $_SERVER['REQUEST_URI'] === '/wp-admin/edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
});

add_action('admin_menu', function() {
    remove_submenu_page('options-general.php', 'options-discussion.php');
});

// Do not load comment template if comments are disabled
if (!comments_open() && !pings_open()) {
    return;
}


