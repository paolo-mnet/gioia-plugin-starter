<?php

namespace GWP_Starter;

if (!defined('ABSPATH')) {
  exit;
}

class Main {
  protected static $instance;

  public function __construct() {
    // prepare & load plugin deps
    $this->load_dependencies();

    // handle plugin core hooks.
    add_action('plugins_loaded', array($this, 'load_textdomain'));
    add_action('admin_notices', array($this, 'admin_notices'), 110);
    add_action('display_post_states', array($this, 'post_states'), 10, 2);
    add_filter('plugin_action_links_'. plugin_basename(GWP_PLUGIN_FILE), array($this, 'action_links'));

    // handle plugin content hooks.
    add_filter('wp_robots', array($this, 'page_robots_noindex'));
    add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 110);
    
    // handle plugin AJAX requests.
    add_action('wp_ajax_gwp_plugin', array($this, 'get_async_plugin_data'));
    add_action('wp_ajax_nopriv_gwp_plugin', array($this, 'get_async_plugin_data'));
  }

  /**
   * Handle singleton instance.
   *
   * @since  1.0.0
   * @return object
   */
  public static function get_instance() {
    if ( is_null(self::$instance) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Load plugin dependencies.
   *
   * @since  1.0.0
   * @return void
   */
  private function load_dependencies() {
    require_once GWP_PLUGIN_PATH . '/includes/class-shortcodes.php';
    require_once GWP_PLUGIN_PATH . '/includes/class-settings.php';
    require_once GWP_PLUGIN_PATH . '/includes/functions.php';
    
    Shortcodes::instance();
    Settings::instance();
  }

  /**
   * Load plugin textdomain (i18n).
   * 
   * @since  1.0.0
   * @return void
   */
  public function load_textdomain() {
    load_plugin_textdomain( 'gwp', false, dirname( plugin_basename(GWP_PLUGIN_FILE) ) .'/languages' );
  }

  /**
   * Handle admin notices.
   *
   * @since  1.0.0
   * @return void
   */
  public function admin_notices() {
    $screen = get_current_screen();
    $allowed_screen_ids = ['dashboard', 'plugins'];
    if ( in_array($screen->id, $allowed_screen_ids) ): ?>
      <div class="notice notice-info">
        <p>
          <?php echo sprintf( 
          /* translators: %s: will be replaced with external link */ 
          __('👋 Benvenuti in "<strong>Gioia Starter Plugin</strong>": inizia a sviluppare senza problemi e con zero configurazioni. Segui <a href="%s" target="_blank">questa guida</a> per scoprire come.', 'gwp'), 
          'https://www.marcosh.net/' // TODO: to replace
          ); ?>
        </p>
      </div>
    <?php endif;
  }

  /**
   * Handle plugin action links
   * 
   * @since  1.0.0
   * @param  array $actions [default links].
   * @return array [merged links].
   */
  public function action_links($actions) {
    return array_merge($actions, [
      '<a href="https://www.marcosh.net/" target="_blank"><b>Copyright</b></a>',
      '<a href="'. esc_url( admin_url('themes.php?page=gwp_settings') ) .'">'. _x('Impostazioni GWP', 'Admin', 'gwp') .'</a>'
    ]);
  }

  /**
   * Enqueue front-end assets (styles & scripts).
   *
   * @since  1.0.0
   * @return void
   */
  public function enqueue_scripts() {
    $min = (!defined('SCRIPT_DEBUG') || !constant('SCRIPT_DEBUG')) ? '.min' : '';
    wp_enqueue_style( 'gwp-css', GWP_PLUGIN_URL ."/assets/css/styles{$min}.css", [], GWP_PLUGIN_VERSION, 'screen' );
    wp_enqueue_script( 'gwp-js', GWP_PLUGIN_URL ."/assets/js/scripts{$min}.js", ['jquery'], GWP_PLUGIN_VERSION, true );
  }

  /**
   * Handle post states for the plugin-related page(s).
   * 
   * @since  1.0.0
   * @param  array   $post_states [default post states].
   * @param  WP_Post $post [current post object].
   * @return array   $post_states [modified post states].
   */
  public function post_states($post_states, $post) {
    if ( $post->ID === 3 && !isset($post_states['gwp_starter']) ) {
      $post_states['gwp_starter'] = 'GWP Starter';
    }
    return $post_states;
  }

  /**
   * Handle robots noindex for the plugin-related page(s).
   * 
   * @since  1.0.0
   * @param  array $robots [default list of directives].
   * @return array $robots [modified list of directives].
   */
  public function page_robots_noindex($robots) {
    if ( is_page(3) ) {
      $robots['noindex'] = true;
      $robots['nofollow'] = true;
    }
    return $robots;
  }

  /**
   * Handle AJAX request for 'gwp_plugin' action.
   * 
   * @link   https://developer.wordpress.org/reference/hooks/wp_ajax_action/
   * 
   * @since  1.0.0
   * @return void
   */
  public function get_async_plugin_data() {
    die('Hello world ✨');
  }
}
