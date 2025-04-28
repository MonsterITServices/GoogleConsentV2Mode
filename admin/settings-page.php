<?php
// Add settings menu
add_action('admin_menu', 'consent_manager_admin_menu');
function consent_manager_admin_menu() {
  add_menu_page(
    'Consent Manager',
    'Consent Settings',
    'manage_options',
    'consent-manager',
    'consent_manager_settings_page'
  );
}

// Settings page HTML
function consent_manager_settings_page() {
  ?>
  <div class="wrap">
    <h1>Consent Banner Settings</h1>
    <form method="post" action="options.php">
      <?php
      settings_fields('consent_manager_settings');
      do_settings_sections('consent-manager');
      submit_button();
      ?>
    </form>
  </div>
  <?php
}

// Register settings
add_action('admin_init', 'consent_manager_register_settings');
function consent_manager_register_settings() {
  register_setting('consent_manager_settings', 'consent_banner_text');
  register_setting('consent_manager_settings', 'consent_expiry_days');

  add_settings_section(
    'consent_manager_main',
    'Banner Configuration',
    '',
    'consent-manager'
  );

  add_settings_field(
    'consent_banner_text',
    'Banner Text',
    'consent_banner_text_callback',
    'consent-manager',
    'consent_manager_main'
  );

  add_settings_field(
    'consent_expiry_days',
    'Cookie Expiry (Days)',
    'consent_expiry_days_callback',
    'consent-manager',
    'consent_manager_main'
  );
}

// Settings field callbacks
function consent_banner_text_callback() {
  $text = get_option('consent_banner_text', 'We use cookies to enhance your experience.');
  echo '<textarea name="consent_banner_text" rows="3" style="width:100%">' . esc_textarea($text) . '</textarea>';
}

function consent_expiry_days_callback() {
  $days = get_option('consent_expiry_days', 30);
  echo '<input type="number" name="consent_expiry_days" value="' . esc_attr($days) . '" min="1">';
}
