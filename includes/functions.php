<?php 

/**
 * Global plugin functions.
 * 
 * @package GWP_Starter
 * @instance gwp_plugin_init()
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Helper to log error(s) and more into custom file.
 * 
 * @param  string  $message [message to log].
 * @param  boolean $force [try to force debugging].
 * @return void
 */
if ( !function_exists('gwp_logger') ) {
  function gwp_logger($message, $force = false) {
    if ( $force || (defined('WP_DEBUG') && WP_DEBUG) ) {
      return error_log( "[GWP ". date('Y-m-d H:i:s') ."] ". print_r($message, TRUE) ."\n", 3, GWP_PLUGIN_PATH .'/debug.log');
    }
    return false;
  }
}

/**
 * Helper to strip spaces and sanitize text.
 * 
 * @param  string $val.
 * @return void
 */
if ( !function_exists('gwp_sanitize_text_field') ) {
  function gwp_sanitize_text_field($val) {
    $val = preg_replace('/\s+/', '', $val);
    return sanitize_text_field($val);
  }
}
