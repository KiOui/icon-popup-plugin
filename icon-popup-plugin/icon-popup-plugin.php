<?php
/**
 * Plugin Name: Icon Popup Plugin
 * Description: A WordPress plugin for making clickable icon popups.
 * Plugin URI: https://github.com/KiOui/icon-popup-plugin
 * Version: 1.0.0
 * Author: Lars van Rhijn
 * Author URI: https://larsvanrhijn.nl/
 * Text Domain: icon-popup-plugin
 * Domain Path: /languages/
 *
 * @package icon-popup-plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'IPP_PLUGIN_FILE' ) ) {
	define( 'IPP_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'IPP_PLUGIN_URI' ) ) {
	define( 'IPP_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

include_once dirname( __FILE__ ) . '/includes/class-ippcore.php';
$GLOBALS['IPPCore'] = IPPCore::instance();
