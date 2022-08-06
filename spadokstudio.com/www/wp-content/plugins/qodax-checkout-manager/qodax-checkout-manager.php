<?php
/**
 * Plugin Name: Qodax Checkout Manager
 * Plugin URI: https://kirillbdev.pro/qodax-checkout-manager?utm_source=plugin&utm_medium=referal
 * Description: Customize and manage checkout fields in your WooCommerce store with a simple and user-friendly interface.
 * Version: 1.1.0
 * Author: kirillbdev
 * License URI: license.txt
 * Requires PHP: 7.1
 * Tested up to: 5.8
 * WC tested up to: 5.9
*/

if ( ! defined('ABSPATH')) {
  exit;
}

define('QODAX_CHECKOUT_MANAGER_PLUGIN_NAME', plugin_basename(__FILE__));
define('QODAX_CHECKOUT_MANAGER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('QODAX_CHECKOUT_MANAGER_PLUGIN_ENTRY', __FILE__);
define('QODAX_CHECKOUT_MANAGER_PLUGIN_DIR', plugin_dir_path(__FILE__));

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/helpers.php';

Qodax\CheckoutManager\Kernel::instance();