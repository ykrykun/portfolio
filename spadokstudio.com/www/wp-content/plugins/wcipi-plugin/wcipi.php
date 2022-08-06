<?php
/*
 * Plugin Name: WooCommerce international phone input
 * Description: Simple plugin which makes WooCommerce phone inputs much more friendly.
 * Version: 2.1.3
 * Author: Alex Masliychuk (alex91ckua)
 * Author URI: http://themeforest.net/user/alex91ckua?ref=alex91ckua
 * Text Domain: wcipi
 */

if (!defined('WCIPI_VERSION_NUM'))
	define('WCIPI_VERSION_NUM', '2.1.3');

if (!defined('WCIPI_PLUGIN_NAME'))
	define('WCIPI_PLUGIN_NAME', 'WooCommerce international phone input');

if (!defined('WCIPI_CODECANYON_PLUGIN_URL'))
	define('WCIPI_CODECANYON_PLUGIN_URL', 'https://codecanyon.net/item/woocommerce-international-phone-input/7960098?ref=alex91ckua');

if (!defined('WCIPI_TD'))
	define('WCIPI_TD', 'wcipi'); // = text domain (used for translations)

if (!defined('WCIPI_FILE'))
	define('WCIPI_FILE', __FILE__);

if (!defined('WCIPI_PATH'))
	define('WCIPI_PATH', plugin_dir_path(__FILE__));

if (!defined('WCIPI_URL'))
	define('WCIPI_URL', plugin_dir_url(__FILE__));

if (!defined('WCIPI_DEBUG_MODE'))
	define('WCIPI_DEBUG_MODE', false);

if (!defined('WCIPI_ELEMENTS'))
	define('WCIPI_ELEMENTS', '#billing_phone, #shipping_phone');

if (!defined('WCIPI_PREFIX'))
	define('WCIPI_PREFIX', 'wcipi_');

if (!defined('WCIPI_SETTINGS_PREFIX'))
	define('WCIPI_SETTINGS_PREFIX', 'wcipi_setting_');

class Wcipi_Init {

	function __construct() {

		add_action('plugins_loaded', array($this, 'load_textdomain'));

		if (is_admin()) {
			add_action('plugins_loaded', array($this, 'admin_init'), 14);
		} else {
			add_action('plugins_loaded', array($this, 'frontend_init'), 14);
		}

		register_activation_hook(WCIPI_FILE, array($this, 'install'));
	}

	/**
	 * Set default settings
	 */
	function install() {

		if (empty(get_option(WCIPI_SETTINGS_PREFIX . 'autoset'))) {
			update_option(WCIPI_SETTINGS_PREFIX . 'autoset', 'yes');
		}

		if (empty(get_option(WCIPI_SETTINGS_PREFIX . 'validation'))) {
			update_option(WCIPI_SETTINGS_PREFIX . 'validation', 'yes');
		}

		if (empty(get_option(WCIPI_SETTINGS_PREFIX . 'only_selected_countries'))) {
			update_option(WCIPI_SETTINGS_PREFIX . 'only_selected_countries', 'no');
		}

		if (empty(get_option(WCIPI_SETTINGS_PREFIX . 'default_country'))) {
			update_option(WCIPI_SETTINGS_PREFIX . 'default_country', '');
		}
	}

	/**
	 * Load plugin textdomain.
	 */
	function load_textdomain() {
		load_plugin_textdomain(WCIPI_TD, false, dirname(plugin_basename(WCIPI_FILE)) . '/languages/');
	}

	/**
	 * Init admin side
	 */
	function admin_init() {
		require_once(WCIPI_PATH . 'admin/class-admin.php');
	}

	/**
	 * Init frontend
	 */
	function frontend_init() {
		require_once(WCIPI_PATH . 'frontend/class-frontend.php');
	}
}

new Wcipi_Init();
