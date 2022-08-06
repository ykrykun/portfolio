<?php
/*
Plugin Name: Mailster - Email Newsletter Plugin for WordPress
Plugin URI: https://mailster.co
Description: Send Beautiful Email Newsletters in WordPress.
Version: 3.1
Author: EverPress
Author URI: https://everpress.co
Text Domain: mailster
*/
update_option('mailster_license', '************');
update_option('mailster_username', 'username');
update_option('mailster_email', 'email@email.com');
set_transient('mailster_verified', true, 900);
if ( defined( 'MAILSTER_VERSION' ) || ! defined( 'ABSPATH' ) ) {
	return;
}

define( 'MAILSTER_VERSION', '3.1' );
define( 'MAILSTER_BUILT', 1641991189 );
define( 'MAILSTER_DBVERSION', 20210901 );
define( 'MAILSTER_DIR', plugin_dir_path( __FILE__ ) );
define( 'MAILSTER_URI', plugin_dir_url( __FILE__ ) );
define( 'MAILSTER_FILE', __FILE__ );
define( 'MAILSTER_SLUG', basename( MAILSTER_DIR ) . '/' . basename( __FILE__ ) );

$upload_folder = wp_upload_dir();

if ( ! defined( 'MAILSTER_UPLOAD_DIR' ) ) {
	define( 'MAILSTER_UPLOAD_DIR', trailingslashit( $upload_folder['basedir'] ) . 'mailster' );
}
if ( ! defined( 'MAILSTER_UPLOAD_URI' ) ) {
	define( 'MAILSTER_UPLOAD_URI', trailingslashit( $upload_folder['baseurl'] ) . 'mailster' );
}

require_once MAILSTER_DIR . 'includes/check.php';
require_once MAILSTER_DIR . 'includes/functions.php';
require_once MAILSTER_DIR . 'includes/deprecated.php';
require_once MAILSTER_DIR . 'includes/3rdparty.php';
require_once MAILSTER_DIR . 'classes/mailster.class.php';

global $mailster;

$mailster = new mailster();

if ( ! $mailster->wp_mail && mailster_option( 'system_mail' ) == 1 ) {

	function wp_mail( $to, $subject, $message, $headers = '', $attachments = array(), $file = null, $template = null ) {
		return mailster()->wp_mail( $to, $subject, $message, $headers, $attachments, $file, $template );
	}
}
