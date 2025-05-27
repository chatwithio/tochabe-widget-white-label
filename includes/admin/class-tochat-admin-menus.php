<?php
/**
 * Admin Menus class.
 *
 * @package TOCHAT\Classes\Admin
 * @version 1.0.0
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Admin Menus class.
 *
 * @since 1.0.0
 */
class TOCHAT_Admin_Menus {

	/**
	 * Menus constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
	}

	/**
	 * Admin Menus.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function admin_menus() {
		add_menu_page(
			esc_html( TOCHAT_PLUGIN_NAME ),
			esc_html( TOCHAT_PLUGIN_NAME ),
			'manage_options',
			'tochat',
			array( $this, 'admin_settings_page' ),
			'dashicons-admin-comments'
		);
	}

	/**
	 * Widget Settings Page.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function admin_settings_page() {
		include_once TOCHAT_PLUGIN_PATH . 'includes/admin/views/html-settings-page.php';
	}
}

return new TOCHAT_Admin_Menus();
