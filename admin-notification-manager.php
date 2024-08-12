<?php
/*
Plugin Name: Admin Notification Manager
Description: Manage and schedule custom notifications in the WordPress admin dashboard.
Version: 1.0
Author: Ngawang Tenzin
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('ADN_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ADN_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
include_once ADN_PLUGIN_DIR . 'includes/notifications.php';
include_once ADN_PLUGIN_DIR . 'includes/settings.php';

// Register the settings page in the WordPress admin menu
function adn_add_admin_menu() {
    add_menu_page(
        'Admin Notifications', // Page title
        'Admin Notifications', // Menu title
        'manage_options',      // Capability required to see this menu
        'admin-notifications', // Menu slug
        'adn_settings_page',   // Function to display the settings page
        'dashicons-bell',      // Icon for the menu
        65                     // Position in the menu
    );
}
add_action('admin_menu', 'adn_add_admin_menu');
?>
