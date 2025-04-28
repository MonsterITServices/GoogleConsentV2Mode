<?php
// Handles settings registration/validation
class Consent_Settings_API {
  public static function init() {
    add_filter('pre_update_option_consent_manager_options', 
      [__CLASS__, 'validate_settings'], 10, 2);
  }

  public static function validate_settings($new_value, $old_value) {
    // Validate banner text
    if (isset($new_value['banner_text'])) {
      $new_value['banner_text'] = wp_kses_post($new_value['banner_text']);
    }

    // Validate cookie expiration (1-365 days)
    if (isset($new_value['cookie_expiry'])) {
      $new_value['cookie_expiry'] = absint($new_value['cookie_expiry']);
      if ($new_value['cookie_expiry'] < 1 || $new_value['cookie_expiry'] > 365) {
        $new_value['cookie_expiry'] = 30; // Default
      }
    }

    return $new_value;
  }
}
