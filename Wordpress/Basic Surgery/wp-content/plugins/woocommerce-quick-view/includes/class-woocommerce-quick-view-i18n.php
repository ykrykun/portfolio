<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://woocommerce.db-dzine.com
 * @since      1.0.0
 *
 * @package    WooCommerce_Quick_View
 * @subpackage WooCommerce_Quick_View/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WooCommerce_Quick_View
 * @subpackage WooCommerce_Quick_View/includes
 * @author     Daniel Barenkamp <support@db-dzine.com>
 */
class WooCommerce_Quick_View_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$loaded = load_plugin_textdomain(
			'woocommerce-quick-view',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
