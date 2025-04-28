// tests/test-consent-db.php
class ConsentDBTest extends WP_UnitTestCase {
  public function test_table_creation() {
    $this->assertTrue($this->table_exists('consent_manager_consents'));
  }
  
  private function table_exists($table) {
    global $wpdb;
    return $wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}{$table}'") === $wpdb->prefix . $table;
  }
}
