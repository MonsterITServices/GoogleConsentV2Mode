<?php
add_action('wp_ajax_log_consent', 'consent_manager_log_consent');
add_action('wp_ajax_nopriv_log_consent', 'consent_manager_log_consent');

function consent_manager_log_consent() {
  global $wpdb;
  
  // Security nonce check
  check_ajax_referer('consent_nonce', 'security');

  $table_name = $wpdb->prefix . 'consent_manager_consents';
  $consent_data = [
    'user_uuid' => sanitize_text_field($_POST['user_uuid']),
    'consent_type' => sanitize_text_field($_POST['consent_type']),
    'ip_address' => sanitize_text_field($_SERVER['REMOTE_ADDR']),
    'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT']),
    'created_at' => current_time('mysql')
  ];

  $wpdb->insert($table_name, $consent_data);
  wp_send_json_success();
}
