<?php
/*
Plugin Name: Consent Manager Pro
Description: Full GDPR/CPRA Compliance Suite (No License Required)
Version: 1.0
Author: Monster IT
*/

defined('ABSPATH') || exit;

// Core Includes
require_once plugin_dir_path(__FILE__) . 'includes/class-consent-db.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-consent-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-consent-frontend.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-consent-api.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings-api.php';

// Initialize components
add_action('plugins_loaded', function() {
    Consent_DB::init();
    Consent_Settings::init();
    Consent_Frontend::init();
    Consent_API::init();
});
