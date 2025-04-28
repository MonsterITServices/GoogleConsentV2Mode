<?php
/*
Plugin Name: Consent Manager
Description: GDPR/CPRA Compliance Tool (No License Required)
Version: 1.0
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) exit;

// Include plugin files
require_once plugin_dir_path(__FILE__) . 'includes/create-db-table.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings-api.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'public/consent-logger.php';

// Create DB table on activation
register_activation_hook(__FILE__, 'consent_manager_create_db_table');

// Enqueue frontend assets
add_action('wp_enqueue_scripts', 'consent_manager_enqueue_scripts');
function consent_manager_enqueue_scripts() {
  wp_enqueue_style('consent-banner-css', plugins_url('public/css/consent-banner.css', __FILE__));
  wp_enqueue_script('consent-banner-js', plugins_url('public/js/consent-banner.js', __FILE__), array('jquery'), '1.0', true);
}
