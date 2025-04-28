// Add nonce verification
public static function save_consent() {
  if (!check_ajax_referer('consent_nonce', 'security', false)) {
    wp_send_json_error('Invalid nonce', 403);
  }

  // Rest of your existing code...
}
