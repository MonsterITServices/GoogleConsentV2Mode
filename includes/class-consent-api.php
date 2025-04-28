// Add nonce verification
public static function save_consent() {
  if (!check_ajax_referer('consent_nonce', 'security', false)) {
    wp_send_json_error('Invalid nonce', 403);
  }

  // Rest of your existing code...
}
// Add CSRF-like validation
public static function save_consent() {
  if (!isset($_SERVER['HTTP_X_CSRFTOKEN']) || $_SERVER['HTTP_X_CSRFTOKEN'] !== $_COOKIE['csrftoken']) {
    wp_send_json_error('CSRF validation failed', 403);
  }
  // ... rest of your code
}
