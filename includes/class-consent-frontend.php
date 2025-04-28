<?php
class Consent_Frontend {
    public static function init() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_public_assets']);
        add_action('wp_footer', [__CLASS__, 'render_consent_banner']);
    }

    public static function enqueue_public_assets() {
        wp_enqueue_style(
            'consent-banner-css',
            plugins_url('public/css/consent-banner.css', __FILE__)
        );

        wp_enqueue_script(
            'consent-banner-js',
            plugins_url('public/js/consent-banner.js', __FILE__),
            ['jquery'],
            '1.0',
            true
        );

        wp_localize_script('consent-banner-js', 'consentData', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('consent_nonce')
        ]);
    }

    public static function render_consent_banner() {
        ?>
        <div id="consent-banner" class="consent-hidden">
            <div class="consent-content">
                <?php echo wp_kses_post(get_option('consent_manager_options')['banner_text']); ?>
            </div>
            <div class="consent-actions">
                <button id="consent-accept-all" class="consent-btn">Accept All</button>
                <button id="consent-settings" class="consent-btn">Preferences</button>
            </div>
        </div>
        <?php
    }
}
// Add nonce generation
public static function enqueue_public_assets() {
  // Existing code...
  wp_localize_script('consent-banner-js', 'consentData', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('consent_log_nonce') // Changed nonce name
  ]);
}
// Add to enqueue_public_assets()
wp_add_inline_script('consent-banner-js', '
  document.addEventListener("DOMContentLoaded", function() {
    if (!localStorage.getItem("consent_preferences")) {
      document.documentElement.style.pointerEvents = "none"; // Block interactions
    }
  });
');
public static function frontend_vars() {
  return [
    'consentRequired' => true,
    'cookiePurposes' => get_option('consent_manager_purposes', []),
    'debugMode' => defined('WP_DEBUG') && WP_DEBUG
  ];
}

// Add to enqueue_public_assets()
wp_localize_script('consent-banner-js', 'djangoContext', self::frontend_vars());
