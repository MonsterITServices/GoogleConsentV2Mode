<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;

// Drop custom tables
$tables = [
  $wpdb->prefix . 'consent_manager_consents',
  $wpdb->prefix . 'consent_manager_cookies'
];

foreach ($tables as $table) {
  $wpdb->query("DROP TABLE IF EXISTS $table");
}

// Delete options
delete_option('consent_manager_options');
delete_option('consent_manager_version');
