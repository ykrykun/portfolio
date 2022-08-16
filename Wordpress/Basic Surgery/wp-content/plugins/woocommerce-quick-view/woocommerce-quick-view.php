<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://welaunch.io
 * @since             1.0.0
 * @package           WooCommerce_Quick_View
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Quick View
 * Plugin URI:        https://welaunch.io/plugins/woocommerce-quick-view/
 * Description:       Let your Users Quick View products with ease
 * Version:           1.2.8
 * Author:            weLaunch
 * Author URI:        https://welaunch.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-quick-view
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-quick-view-activator.php
 */
function activate_WooCommerce_Quick_View() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-quick-view-activator.php';
	WooCommerce_Quick_View_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-quick-view-deactivator.php
 */
function deactivate_WooCommerce_Quick_View() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-quick-view-deactivator.php';
	WooCommerce_Quick_View_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_WooCommerce_Quick_View' );
register_deactivation_hook( __FILE__, 'deactivate_WooCommerce_Quick_View' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-quick-view.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_WooCommerce_Quick_View() {

	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];

	$plugin = new WooCommerce_Quick_View($version);
	$plugin->run();

	return $plugin;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php') && (is_plugin_active('redux-dev-master/redux-framework.php') || is_plugin_active('redux-framework/redux-framework.php') ||  is_plugin_active('welaunch-framework/welaunch-framework.php') ) ){
	$WooCommerce_Quick_View = run_WooCommerce_Quick_View();
} else {
	add_action( 'admin_notices', 'woocommerce_quick_view_installed_notice' );
}

function woocommerce_quick_view_installed_notice()
{
	?>
    <div class="error">
      <p><?php _e( 'WooCommerce Quick View requires the WooCommerce & weLaunch Framework plugin. Please install or activate them:https://www.welaunch.io/updates/welaunch-framework.zip', 'woocommerce-quick-view'); ?></p>
    </div>
    <?php
}