<?php

namespace GWP_Starter;

if (!defined('ABSPATH')) {
  exit;
}

class Activator {
  public function __construct() {
    $this->create_plugin_tables();
    $this->create_plugin_options();
  }

  /**
   * Activation handler.
   *
   * @since  1.0.0
   * @return void
   */
  public static function activate() {
    return new Activator();
  }

  /**
   * Maybe create plugin table(s).
   *
   * @since  1.0.0
   * @return void
   */
  private function create_plugin_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . GWP_PLUGIN_PREFIX . 'settings';
    $sql = "CREATE TABLE $table_name (
      id INT(11) NOT NULL AUTO_INCREMENT,
      last_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
      message VARCHAR(255) NOT NULL DEFAULT '',
      PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once ABSPATH .'wp-admin/includes/upgrade.php';
    maybe_create_table($table_name, $sql);
  }

  /**
   * Maybe create plugin option(s).
   *
   * @since  1.0.0
   * @return void
   */
  private function create_plugin_options() {
    update_option(GWP_PLUGIN_PREFIX.'version', GWP_PLUGIN_VERSION);
  }
}
