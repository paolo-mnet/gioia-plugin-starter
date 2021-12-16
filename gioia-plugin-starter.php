<?php

/**
 * Plugin Name:       Gioia Starter Plugin
 * Description:       Un semplice punto di partenza per lo sviluppo di plugin WordPress.
 * Author:            Marcosh.net
 * Author URI:        https://www.marcosh.net/
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Version:           1.0.0
 * Text Domain:       gwp
 * Domain Path:       /languages
 * Requires at least: 5.8
 * Requires PHP:      7.3
 *
 * @package           GWP_Starter
 */

if (!defined('WPINC')) {
  die;
}

/**
 * Define plugin constants.
 * 
 * @since  1.0.0
 */
define('GWP_PLUGIN_FILE', __FILE__);
define('GWP_PLUGIN_VERSION', '1.0.0');
define('GWP_PLUGIN_PREFIX', 'gwp_');
define('GWP_PLUGIN_UPLOADS', GWP_PLUGIN_PREFIX.'uploads');
define('GWP_PLUGIN_URL', untrailingslashit(plugin_dir_url(__FILE__)));
define('GWP_PLUGIN_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

/**
 * Handle plugin activation.
 * 
 * @since  1.0.0
 * @return void
 */
function gwp_plugin_activator() {
  require_once GWP_PLUGIN_PATH .'/includes/class-activator.php';
  \GWP_Starter\Activator::activate();
}
register_activation_hook(GWP_PLUGIN_FILE, 'gwp_plugin_activator');

/**
 * Handle plugin deactivation.
 * 
 * @since  1.0.0
 * @return void
 */
function gwp_plugin_deactivator() {
  require_once GWP_PLUGIN_PATH .'/includes/class-deactivator.php';
  \GWP_Starter\Deactivator::deactivate();
}
register_deactivation_hook(GWP_PLUGIN_FILE, 'gwp_plugin_deactivator');

/**
 * Initialize: run just one instance of the plugin.
 *
 * @since  1.0.0
 * @return object
 */
function gwp_plugin_init() {
  require_once GWP_PLUGIN_PATH .'/includes/class-main.php';
  return \GWP_Starter\Main::get_instance();
}
gwp_plugin_init();
