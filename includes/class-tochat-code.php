<?php
/**
 * Code.
 *
 * @package TOCHAT\Classes
 * @version 1.0.0
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * TOCHAT_Code class.
 *
 * @since 1.0.0
 */
class TOCHAT_Code {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'add_widget' ), 1 );
	}

	/**
	 * Add Widget.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function add_widget() {
		global $wp;

		$widget_key   = get_option( 'tochat_key' );
		$exclude_ids  = (array) get_option( 'tochat_exclude_ids' );
		$include_ids  = tochat_get_add_widget_by_posts();
		$include_urls = tochat_get_add_widget_by_urls();

		// Include widget on specific pages or posts.
		if ( $include_ids ) {
			foreach ( $include_ids as $include_id ) {
				if ( get_the_ID() !== $include_id['post_id'] ) {
					continue;
				}

				$widget_key = $include_id['widget_key'];
				break;
			}
		}

		// Include widget on specific URLs.
		if ( $include_urls ) {
			foreach ( $include_urls as $include_url ) {
				if ( ! $include_url['url'] ) {
					continue;
				}

				$allowed_url = trailingslashit( $include_url['url'] );
				$current_url = trailingslashit( home_url( add_query_arg( array(), $wp->request ) ) );
				if ( $allowed_url !== $current_url && ! fnmatch( $allowed_url, $current_url ) ) {
					continue;
				}

				$widget_key = $include_url['widget_key'];
				break;
			}
		}

		// Do noting if widget key is not set.
		if ( ! $widget_key ) {
			return;
		}

		// Exclude widget on specific pages or posts.
		if ( in_array( get_the_ID(), $exclude_ids, true ) ) {
			return;
		}
		?>
		<script defer src="https://widget.tochat.be/bundle.js?key=<?php echo esc_js( $widget_key ); ?>"></script>
		<?php
	}
}

return new TOCHAT_Code();
