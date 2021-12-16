<?php

namespace GWP_Starter;

if (!defined('ABSPATH')) {
  exit;
}

class Shortcodes {
  private static $instance;

  public function __construct() {
    add_action('init', array($this, 'shortcodes_register'));
  }

  /**
   * Handle singleton instance.
   *
   * @since  1.0.0
   * @return object
   */
  public static function instance() {
    if ( is_null(self::$instance) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Register plugin-related shortcode(s).
   *
   * @since  1.0.0
   * @return void
   */
  public function shortcodes_register() {
    add_shortcode('gwp-starter', array($this, 'custom_shortcode_template'));
  }

  /**
   * Handle template for the custom shortcode.
   *
   * @since  1.0.0
   * @param  array $atts [shortcode attributes].
   * @return string [HTML output].
   */
  public function custom_shortcode_template($atts) {
    // get referral or current page
    if ( !($redirect_url = wp_get_referer()) ) {
      $redirect_url = get_permalink( get_the_ID() );
    }

    // prepare arguments and merge with default attributes.
    $args = shortcode_atts([
      'title'    => _x('Lorem ipsum', 'Shortcode', 'gwp'),
    ], $atts);

    // render template
    ob_start();
    load_template(GWP_PLUGIN_PATH .'/templates/public/custom-shortcode.php', true, $args);
    return ob_get_clean();
  }
}
