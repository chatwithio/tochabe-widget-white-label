<?php
/**
 * Admin Widget Class.
 *
 * @package TOCHAT\Classes\Admin
 * @version 1.1.0
 * @since 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Admin Widget Class.
 *
 * @since 1.1.0
 */
class TOCHAT_Admin_Widget {

	/**
	 * Class constructor.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {
		add_action( 'admin_head', array( $this, 'add_admin_widget' ), 1 );
	}

	/**
	 * Add admin widget.
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	public function add_admin_widget() {
		$backend_key = get_option( 'tochat_backend_key' );
		if ( ! $backend_key ) {
			return;
		}
		?>
		<script defer src="https://widget.tochat.be/bundle.js?key=<?php echo esc_js( $backend_key ); ?>"></script>
		<?php
	}
}

return new TOCHAT_Admin_Widget();
