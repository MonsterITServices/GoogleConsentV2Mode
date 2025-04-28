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
// Match your Django API endpoints
public static function init() {
  add_action('rest_api_init', function() {
    register_rest_route('consent-manager/v1', '/purposes/', [
      'methods' => 'GET',
      'callback' => [__CLASS__, 'get_purposes'],
      'permission_callback' => '__return_true'
    ]);
  });
}

public static function get_purposes() {
  global $wpdb;
  $table = $wpdb->prefix . 'consent_manager_purposes';
  return $wpdb->get_results("SELECT * FROM $table");
}
