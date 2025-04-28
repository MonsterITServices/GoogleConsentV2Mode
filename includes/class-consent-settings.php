<?php
class Consent_Settings {
    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_admin_assets']);
    }

    public static function add_admin_menu() {
        add_menu_page(
            'Consent Manager Pro',
            'Consent Settings',
            'manage_options',
            'consent-manager-pro',
            [__CLASS__, 'render_settings_page'],
            'dashicons-shield-alt'
        );
    }

    public static function register_settings() {
        register_setting('consent_manager_pro', 'consent_manager_options');

        // Cookie Categories Section
        add_settings_section(
            'consent_cookie_categories',
            'Cookie Categories',
            null,
            'consent-manager-pro'
        );

        // Settings Fields
        add_settings_field(
            'banner_text',
            'Consent Banner Text',
            [__CLASS__, 'render_banner_text_field'],
            'consent-manager-pro',
            'consent_cookie_categories'
        );

        // Add more fields for styling, cookie expiration, etc.
    }

    public static function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Consent Manager Pro Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('consent_manager_pro');
                do_settings_sections('consent-manager-pro');
                submit_button();
                ?>
            </form>
            <div id="consent-cookie-manager"></div> <!-- React-like UI container -->
        </div>
        <?php
    }

    public static function enqueue_admin_assets() {
        wp_enqueue_style(
            'consent-admin-css',
            plugins_url('admin/css/admin.css', __FILE__)
        );
        
        wp_enqueue_script(
            'consent-admin-js',
            plugins_url('admin/js/admin.js', __FILE__),
            ['wp-element', 'wp-api-fetch'],
            '1.0',
            true
        );
    }
}
