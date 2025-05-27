<?php
/**
 * Settings.
 *
 * @package TOCHAT\Classes\Admin
 * @version 1.0.0
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * TOCHAT_Admin_Settings class.
 *
 * @since 1.0.0
 */
class TOCHAT_Admin_Settings {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Register settings.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_settings() {
		register_setting( 'tochat_settings', 'tochat_key', 'sanitize_text_field' );
		register_setting(
			'tochat_settings',
			'tochat_exclude_ids',
			function ( $input ) {
				if ( null === $input ) {
					return array();
				}

				return array_map( 'absint', $input );
			}
		);
		register_setting(
			'tochat_settings',
			'tochat_add_widget_post_ids',
			function ( $input ) {
				$widget_key = array_map( 'sanitize_text_field', (array) $input['widget_key'] );
				$post_id    = array_map( 'absint', (array) $input['post_id'] );

				return array(
					'widget_key' => $widget_key,
					'post_id'    => $post_id,
				);
			}
		);
		register_setting(
			'tochat_settings',
			'tochat_add_widget_urls',
			function ( $input ) {
				$widget_key = array_map( 'sanitize_text_field', (array) $input['widget_key'] );
				$url        = array_map( 'esc_url_raw', (array) $input['url'] );

				return array(
					'widget_key' => $widget_key,
					'url'        => $url,
				);
			}
		);
		register_setting( 'tochat_settings', 'tochat_backend_key', 'sanitize_text_field' );
	}
}

return new TOCHAT_Admin_Settings();
