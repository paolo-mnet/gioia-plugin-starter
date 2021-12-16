<?php

namespace GWP_Starter;

if (!defined('ABSPATH')) {
  exit;
}

class Deactivator {
  public function __construct() {
    $this->empty_plugin_tables();
    $this->empty_plugin_options();
  }

  /**
   * Deactivation handler.
   *
   * @since  1.0.0
   * @return void
   */
  public static function deactivate() {
    return new Deactivator();
  }

  /**
   * Empty plugin table(s).
   *
   * @since  1.0.0
   * @return void
   */
  private function empty_plugin_tables() {
    global $wpdb;
    $table_name = $wpdb->prefix . GWP_PLUGIN_PREFIX . 'settings';
    $wpdb->query("TRUNCATE TABLE $table_name");
  }

  /**
   * Empty plugin option(s).
   *
   * @since  1.0.0
   * @return void
   */
  private function empty_plugin_options() {
    update_option(GWP_PLUGIN_PREFIX.'version', '');
  }
}
