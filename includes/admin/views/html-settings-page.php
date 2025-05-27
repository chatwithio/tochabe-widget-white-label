<?php
/**
 * Admin View: Widget settings page.
 *
 * @package TOCHAT\Admin
 * @version 1.0.0
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?><div class="wrap">
	<?php // translators: %s: Plugin name. ?>
	<h1 class="wp-heading-inline"><?php echo wp_sprintf( esc_html__( '%s Settings', 'tochat' ), esc_html( TOCHAT_PLUGIN_NAME ) ); ?></h1>

	<?php settings_errors(); ?>

	<hr class="wp-header-end">

	<form method="post" action="options.php" class="tochat-settings-form">
		<?php settings_fields( 'tochat_settings' ); ?>

		<table class="form-table">
			<tr>
				<th>
					<label><?php esc_html_e( 'Add Your Widget Key', 'tochat' ); ?></label>
				</th>
				<td>
					<input type="text" name="tochat_key" class="regular-text" value="<?php echo esc_attr( get_option( 'tochat_key' ) ); ?>">
					<?php // translators: %s: Documentation URL. ?>
					<p class="description"><?php echo wp_kses_post( wp_sprintf( __( 'Create your account <a href="%s">here</a>.', 'tochat' ), TOCHAT_PLUGIN_DOCUMENTATION_URL ) ); ?> </p>
				</td>
			</tr>
			<tr>
				<th>
					<label><?php esc_html_e( 'Exclude By Pages or Posts', 'tochat' ); ?></label>
				</th>
				<td>
					<?php $exclude_by = ! empty( get_option( 'tochat_exclude_ids' ) ) ? get_option( 'tochat_exclude_ids' ) : array(); ?>
					<select name="tochat_exclude_ids[]" class="tochat-select regular-text" multiple>
						<?php foreach ( tochat_get_all_posts() as $post ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
							<option value="<?php echo esc_attr( $post->ID ); ?>" <?php selected( in_array( $post->ID, $exclude_by ), true ); ?>><?php echo esc_html( $post->post_title . ' (#' . $post->ID . ')' ); ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description"><?php esc_html_e( 'Select pages or posts on which you want to exclude the widget.', 'tochat' ); ?></p>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<hr>
				</td>
			</tr>
			<tr>
				<th>
					<label><?php esc_html_e( 'Add Widget on Specific Pages or Posts', 'tochat' ); ?></label>
				</th>
				<td>
					<table class="tochat-add-widget-by-posts-table">
						<thead>
							<tr>
								<th><?php esc_html_e( 'Your Widget Key', 'tochat' ); ?></th>
								<th><?php esc_html_e( 'Select Page or Post', 'tochat' ); ?></th>
								<th style="width: 70px;"><?php esc_html_e( 'Action', 'tochat' ); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$add_widget_by_posts = tochat_get_add_widget_by_posts();
						if ( ! empty( $add_widget_by_posts ) ) {
							foreach ( $add_widget_by_posts as $add_widget_by_post ) {
								echo tochat_add_widget_by_posts_row_html( // phpcs:ignore WordPress.Security.EscapeOutput
									array(
										'post_id'    => $add_widget_by_post['post_id'],
										'widget_key' => $add_widget_by_post['widget_key'],
									)
								);
							}
						}
						?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" align="right">
									<button class="js-tochat-add-widget-by-posts-row button"><?php esc_html_e( 'Add Row', 'tochat' ); ?></button>
								</td>
							</tr>
						</tfoot>
					</table>
					<p class="description"><?php esc_html_e( 'Select pages or posts on which you want to add the widget.', 'tochat' ); ?></p>
				</td>
			</tr>
			<tr>
				<th>
					<label><?php esc_html_e( 'Add Widget on Specific URLs', 'tochat' ); ?></label>
				</th>
				<td>
					<table class="tochat-add-widget-by-urls-table">
						<thead>
							<tr>
								<th><?php esc_html_e( 'Your Widget Key', 'tochat' ); ?></th>
								<th><?php esc_html_e( 'URL', 'tochat' ); ?></th>
								<th style="width: 70px;"><?php esc_html_e( 'Action', 'tochat' ); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php
							$add_widget_by_urls = tochat_get_add_widget_by_urls();
						if ( ! empty( $add_widget_by_urls ) ) {
							foreach ( $add_widget_by_urls as $add_widget_by_url ) {
								echo tochat_add_widget_by_urls_row_html( // phpcs:ignore WordPress.Security.EscapeOutput
									array(
										'url'        => $add_widget_by_url['url'],
										'widget_key' => $add_widget_by_url['widget_key'],
									)
								);
							}
						}
						?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" align="right">
									<button class="js-tochat-add-widget-by-urls-row button"><?php esc_html_e( 'Add Row', 'tochat' ); ?></button>
								</td>
							</tr>
						</tfoot>
					</table>
					<p class="description"><?php esc_html_e( 'Add URLs on which you want to add the widget.', 'tochat' ); ?></p>
				</td>
			</tr>
		</table>

		<hr>

		<table class="form-table">
			<tr>
				<th>
					<label><?php esc_html_e( 'Add Widget For Internal Use', 'tochat' ); ?></label>
				</th>
				<td>
					<input type="text" name="tochat_backend_key" class="regular-text" value="<?php echo esc_attr( get_option( 'tochat_backend_key' ) ); ?>">
					<p class="description"><?php echo wp_kses_post( 'Enter the widget API key to enable the widget in the WordPress admin.', 'tochat' ); ?> </p>
				</td>
			</tr>
		</table>

		<?php submit_button(); ?>
	</form>

</div>
