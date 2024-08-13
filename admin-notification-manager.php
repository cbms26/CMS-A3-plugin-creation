<?php
/*
Plugin Name: Admin Notification Manager
Description: Managing and scheduling custom notifications in the WordPress admin dashboard.
Version: 1.1
Author: Ngawang Tenzin
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Defining constants
define('ADN_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ADN_PLUGIN_URL', plugin_dir_url(__FILE__));

// Including necessary files
include_once ADN_PLUGIN_DIR . 'includes/notifications.php';
include_once ADN_PLUGIN_DIR . 'includes/settings.php';

// Register the settings page in the WordPress admin menu
function adn_add_admin_menu() {
    add_menu_page(
        'Admin Notifications', 
        'Admin Notifications', 
        'manage_options',      
        'admin-notifications', 
        'adn_settings_page',   
        'dashicons-bell',      
        65                     
    );
}
add_action('admin_menu', 'adn_add_admin_menu');
?>
