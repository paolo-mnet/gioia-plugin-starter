<?php

namespace GWP_Starter;

if (!defined('ABSPATH')) {
  exit;
}

class Settings {
  private $prefix;

  private $settings_page;

  private static $instance;

  public function __construct() {
    $this->prefix = GWP_PLUGIN_PREFIX;
    $this->settings_page = "{$this->prefix}settings";
    add_action('admin_menu', array($this, 'register_settings_page'));
    add_action('admin_init', array($this, 'register_settings_sections'));
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
   * Register the settings page as a sub-item under "Users". 
   * 
   * @since  1.0.0
   * @return void
   */
  public function register_settings_page() {
    add_submenu_page(
      'themes.php', 
      _x('GWP Impostazioni', 'gwp'),
      _x('GWP', 'Admin', 'gwp'), 
      'manage_options', 
      $this->settings_page,
      array($this, 'render_settings_page'), 
      10
    );
  }

  /**
   * Register all the settings sections and its field(s). 
   * 
   * @link   https://developer.wordpress.org/reference/functions/add_settings_section/
   * @link   https://developer.wordpress.org/reference/functions/add_settings_field/
   * @link   https://developer.wordpress.org/reference/functions/register_setting/
   * 
   * @since  1.0.0
   * @return void
   */
  public function register_settings_sections() {
    $section_name = "{$this->prefix}settings_general";
    add_settings_section(
      $section_name,
      _x('Generale', 'Admin', 'gwp'),
      array($this, 'render_section_general'),
      $this->settings_page
    );
    add_settings_field(
      "{$this->prefix}hellow",
      _x('Modalità di sincronizzazione', 'Admin', 'gwp'),
      array($this, 'render_input_field'),
      $this->settings_page,
      $section_name,
      [
        'type'        => 'text',
        'name'        => "{$this->prefix}hellow",
        'label'       => _x('Opzione', 'Admin', 'gwp'),
        'description' => _x('Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus illum sequi similique qui quam porro, voluptatem unde minima aut impedit.', 'Admin', 'gwp')
      ]
    );
    register_setting(
      "{$this->prefix}options",
      "{$this->prefix}hellow",
      [
        'type'              => 'string',
        'sanitize_callback' => 'gwp_sanitize_text_field'
      ]
    );
  }

  /**
   * Render the settings page as callback.
   * 
   * @see    register_settings_page
   * 
   * @since  1.0.0
   * @return void 
   */
  public function render_settings_page() {
    $submit_label = _x('Salva', 'Admin', 'gwp');
    $form_action = add_query_arg( 'param', 'hellow', admin_url('options.php') );
  ?>
    <div class="wrap gwp-settings">
      <?php settings_errors(); ?>
      <h1><?php _ex('Impostazioni per Gioia Starter Plugin', 'Admin', 'gwp'); ?></h1>
      <form method="post" action="<?= esc_url($form_action); ?>" novalidate>
        <?php
          /**
           * NOTE
           * gwp_settings -> setting page ID
           * gwp_options  -> options group ID
           */
          settings_fields("{$this->prefix}options");
          do_settings_sections($this->settings_page);
          submit_button($submit_label);
        ?>
      </form>
    </div>
  <?php 
  }
   
  /**
   * Render 'general' section as callback.
   * 
   * @since  1.0.0
   * @param  array $args [callback arguments].
   * @return string 
   */
  public function render_section_general($args) {
    echo '<p>Sezione generale</p>';
  }

  /**
   * Render classic input field.
   * 
   * @since  1.0.0
   * @param  array $args [callback arguments].
   * @return void
   */
  public function render_input_field($args) {
    load_template(GWP_PLUGIN_PATH .'/templates/admin/input-field.php', false, $args);
  }
}
