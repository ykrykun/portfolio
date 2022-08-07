<?php
/*
Plugin Name: Mailster for WooCommerce
Plugin URI: https://mailster.co/?utm_campaign=wporg&utm_source=Mailster+for+WooCommerce
Description: add your WooCommerce customers to your Mailster lists
Version: 1.6
Author: EverPress
Author URI: https://mailster.co
Text Domain: mailster-woocommerce
License: GPLv2 or later
*/

define( 'MAILSTER_WOOCOMMERCE_VERSION', '1.6' );
define( 'MAILSTER_WOOCOMMERCE_REQUIRED_VERSION', '2.2.9' );
define( 'MAILSTER_WOOCOMMERCE_FILE', __FILE__ );

require_once dirname( __FILE__ ) . '/classes/woocommerce.class.php';
new MailsterWooCommerce();
