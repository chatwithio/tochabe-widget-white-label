<?php
/**
 * TOCHAT functions.
 *
 * @package TOCHAT\Functions
 * @version 1.0.0
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get all posts.
 *
 * @since 1.0.0
 *
 * @return WP_Post[]|int[] Array of post objects or post IDs.
 */
function tochat_get_all_posts() {
	$posts = get_posts(
		array(
			'post_type'      => array( 'page', 'post' ),
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	return $posts;
}

/**
 * Get widget row HTML.
 *
 * @since 1.0.0
 *
 * @param array $args Arguments. Default empty array.
 * @return string Widget row HTML.
 */
function tochat_add_widget_by_posts_row_html( $args = array() ) {
	$a = wp_parse_args(
		$args,
		array(
			'post_id'    => 0,
			'widget_key' => '',
		) 
	);
	ob_start();
	?>
	<tr>
		<td>
			<input type="text" name="tochat_add_widget_post_ids[widget_key][]" class="regular-text" value="<?php echo esc_attr( $a['widget_key'] ); ?>" required>
		</td>
		<td>
			<select name="tochat_add_widget_post_ids[post_id][]" class="tochat-select" required>
				<option value=""><?php esc_html_e( 'Select', 'tochat' ); ?></option>
				<?php foreach ( tochat_get_all_posts() as $post ) : ?>
					<option value="<?php echo esc_attr( $post->ID ); ?>" <?php selected( $a['post_id'], $post->ID ); ?>><?php echo esc_html( $post->post_title . ' (#' . $post->ID . ')' ); ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		<td>
			<button type="button" class="js-tochat-remove-row tochat-button-danger button"><?php esc_html_e( 'Remove', 'tochat' ); ?></button>
		</td>
	</tr>
	<?php
	return ob_get_clean();
}

/**
 * Get widget row HTML.
 *
 * @since 1.0.0
 *
 * @param array $args Arguments. Default empty array.
 * @return string Widget row HTML.
 */
function tochat_add_widget_by_urls_row_html( $args = array() ) {
	$a = wp_parse_args(
		$args,
		array(
			'url'        => '',
			'widget_key' => '',
		) 
	);
	ob_start();
	?>
	<tr>
		<td>
			<input type="text" name="tochat_add_widget_urls[widget_key][]" class="regular-text" value="<?php echo esc_attr( $a['widget_key'] ); ?>" required>
		</td>
		<td>
			<input type="text" name="tochat_add_widget_urls[url][]" class="regular-text" value="<?php echo esc_attr( $a['url'] ); ?>" required>
			<p class="description"><?php esc_html_e( 'Use * for wildcard. Like, https://domain.com/en/*', 'tochat' ); ?></p>
		</td>
		<td>
			<button type="button" class="js-tochat-remove-row tochat-button-danger button"><?php esc_html_e( 'Remove', 'tochat' ); ?></button>
		</td>
	</tr>
	<?php
	return ob_get_clean();
}

/**
 * Get add widget by posts.
 *
 * @since 1.0.0
 *
 * @return array|false Add widget by posts.
 */
function tochat_get_add_widget_by_posts() {
	$add_widget_by_posts  = array();
	$_add_widget_by_posts = (array) get_option( 'tochat_add_widget_post_ids' );

	if ( ! $_add_widget_by_posts || ! isset( $_add_widget_by_posts['widget_key'] ) || ! is_array( $_add_widget_by_posts['widget_key'] ) ) {
		return false;
	}

	$i = 0;
	foreach ( $_add_widget_by_posts['widget_key'] as $widget_key ) {
		$add_widget_by_posts[] = array(
			'widget_key' => esc_html( $widget_key ),
			'post_id'    => $_add_widget_by_posts['post_id'][ $i ],
		);

		++$i;
	}

	return $add_widget_by_posts;
}

/**
 * Get add widget by URLs.
 *
 * @since 1.0.0
 *
 * @return array|false Add widget by urls.
 */
function tochat_get_add_widget_by_urls() {
	$add_widget_by_urls  = array();
	$_add_widget_by_urls = (array) get_option( 'tochat_add_widget_urls' );

	if ( ! $_add_widget_by_urls || ! isset( $_add_widget_by_urls['widget_key'] ) || ! is_array( $_add_widget_by_urls['widget_key'] ) ) {
		return false;
	}

	$i = 0;
	foreach ( $_add_widget_by_urls['widget_key'] as $widget_key ) {
		$add_widget_by_urls[] = array(
			'widget_key' => esc_html( $widget_key ),
			'url'        => esc_url( $_add_widget_by_urls['url'][ $i ] ),
		);

		++$i;
	}

	return $add_widget_by_urls;
}
