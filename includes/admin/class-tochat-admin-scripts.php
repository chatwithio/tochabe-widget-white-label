<?php
/**
 * Enqueue scripts and styles for admin.
 *
 * @package TOCHAT\Classes\Admin
 * @version 1.0.0
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Admin scripts class.
 *
 * @since 1.0.0
 */
class TOCHAT_Admin_Scripts {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Admin enqueue scripts.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		/**
		 * Select2.
		 *
		 * @link https://select2.org/
		 * @version 4.1.0-rc.0
		 */
		wp_enqueue_style( 'tochat-select2', TOCHAT_PLUGIN_URL . 'assets/libraries/select2/select2.min.css', array(), '4.1.0-rc.0', 'all' );
		wp_enqueue_script( 'tochat-select2', TOCHAT_PLUGIN_URL . 'assets/libraries/select2/select2.min.js', array( 'jquery' ), '4.1.0-rc.0', true );

		// Admin styles and scripts.
		wp_enqueue_style( 'tochat-admin', TOCHAT_PLUGIN_URL . 'assets/css/tochat-admin.css', array(), TOCHAT_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'tochat-admin', TOCHAT_PLUGIN_URL . 'assets/js/tochat-admin.js', array( 'jquery' ), TOCHAT_PLUGIN_VERSION, true );
		wp_localize_script(
			'tochat-admin',
			'tochat_admin',
			array(
				'site_url'                     => site_url(),
				'ajax_url'                     => admin_url( 'admin-ajax.php' ),
				'add_widget_by_posts_row_html' => tochat_add_widget_by_posts_row_html(),
				'add_widget_by_urls_row_html'  => tochat_add_widget_by_urls_row_html(),
				'i18n'                         => array(
					'confirm_delete' => __( 'Are you sure you want to delete?', 'tochat' ),
				),
			)
		);
	}
}

return new TOCHAT_Admin_Scripts();
