<?php

/**
 * Fired when the plugin is uninstalled.
 * Make sure to exit if uninstall not called form WordPress.
 * 
 * @since   1.0.0
 * @package gwp
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

$plugin_prefix = 'gwp_';
if ( get_option("{$plugin_prefix}version") ) {
  global $wpdb;

  // delete the plugin table(s).
  $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}{$plugin_prefix}settings");

  // delete the plugin option(s).
  $wpdb->query("DELETE FROM {$wpdb->options} WHERE `option_name` LIKE '{$plugin_prefix}%'");
}
