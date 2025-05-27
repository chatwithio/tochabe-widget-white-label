<?php
/**
 * Chat Widget.
 *
 * @wordpress-plugin
 * Plugin Name:       Chat Widget
 * Plugin URI:        #
 * Description:       Customer service and sales via WhatsApp
 * Version:           1.2.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Text Domain:       tochat
 * License:           GPL v2 or later
 * Domain Path:       /languages/
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package TOCHAT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'TOCHAT_PLUGIN_FILE', __FILE__ );
define( 'TOCHAT_PLUGIN_PATH', plugin_dir_path( TOCHAT_PLUGIN_FILE ) );
define( 'TOCHAT_PLUGIN_URL', plugin_dir_url( TOCHAT_PLUGIN_FILE ) );
define( 'TOCHAT_PLUGIN_VERSION', '1.2.0' );

// White label.
define( 'TOCHAT_PLUGIN_NAME', 'Chat Widget' );
define( 'TOCHAT_PLUGIN_DOCUMENTATION_URL', 'https://tochat.be/' );

// Load the main class.
if ( ! class_exists( 'TOCHAT' ) ) {
	include_once TOCHAT_PLUGIN_PATH . 'includes/class-tochat.php';
}

/**
 * Get the TOCHAT instance.
 *
 * @since 1.0.0
 *
 * @return TOCHAT class instance.
 */
function tochat() {
	return TOCHAT::get_instance();
}

// Global for backwards compatibility.
$GLOBALS['tochat'] = tochat();
