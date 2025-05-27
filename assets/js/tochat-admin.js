;( function( $ ) {
	'use strict';

	$( document ).ready( function() {

		// Init select2.
		$( '.tochat-select' ).select2();

		// Add row.
		$( document ).on( 'click', '.js-tochat-add-widget-by-posts-row', function( e ) {
			e.preventDefault();

			$( '.tochat-add-widget-by-posts-table' ).append( tochat_admin.add_widget_by_posts_row_html );
			$( '.tochat-select' ).select2();
		} );

		// Add row.
		$( document ).on( 'click', '.js-tochat-add-widget-by-urls-row', function( e ) {
			e.preventDefault();

			$( '.tochat-add-widget-by-urls-table' ).append( tochat_admin.add_widget_by_urls_row_html );
		} );

		// Remove row.
		$( document ).on( 'click', '.js-tochat-remove-row', function( e ) {
			e.preventDefault();

			$( this ).closest( 'tr' ).remove();
		} );

	} ); // Doc ready end.
} )( jQuery );
