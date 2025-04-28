<?php
class Consent_DB {
    public static function init() {
        register_activation_hook(__FILE__, [__CLASS__, 'create_tables']);
    }

    public static function create_tables() {
        global $wpdb;
        $charset = $wpdb->get_charset_collate();
        
        // Consent Logs Table
        $table_consent = $wpdb->prefix . 'consent_manager_consents';
        $sql_consent = "CREATE TABLE $table_consent (
            consent_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_uuid VARCHAR(36) NOT NULL,
            consent_type VARCHAR(50) NOT NULL,
            consent_status TINYINT(1) NOT NULL,
            ip_address VARCHAR(45) NOT NULL,
            user_agent TEXT NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (consent_id),
            INDEX user_uuid (user_uuid)
        ) $charset;";

        // Cookie Settings Table
        $table_cookies = $wpdb->prefix . 'consent_manager_cookies';
        $sql_cookies = "CREATE TABLE $table_cookies (
            cookie_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            cookie_name VARCHAR(255) NOT NULL,
            cookie_category ENUM('necessary', 'analytics', 'marketing') NOT NULL,
            description TEXT NOT NULL,
            expiration_days INT NOT NULL,
            is_active TINYINT(1) NOT NULL DEFAULT 1,
            PRIMARY KEY (cookie_id)
        ) $charset;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql_consent);
        dbDelta($sql_cookies);
    }
}
// Add index for faster consent lookups
$sql_consent = "CREATE TABLE $table_consent (
  ...
  INDEX user_uuid_index (user_uuid),
  INDEX consent_type_index (consent_type)
) $charset;";
// Add consent purposes (matching your Django model)
$table_purposes = $wpdb->prefix . 'consent_manager_purposes';
$sql_purposes = "CREATE TABLE $table_purposes (
  purpose_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (purpose_id)
) $charset;";
dbDelta($sql_purposes);
// Add consent purposes table (matches your Django model)
$sql_purposes = "CREATE TABLE {$wpdb->prefix}consent_manager_purposes (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    required BOOLEAN NOT NULL DEFAULT FALSE,
    cookies TEXT,  // JSON-encoded list like ["_ga", "_gid"]
    PRIMARY KEY (id)
) $charset;";
dbDelta($sql_purposes);
