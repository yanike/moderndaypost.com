/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	// Top Header bg color.
	wp.customize( 'ultra_seven_top_bg', function( value ) {
		value.bind( function( to ) {

			$( '.ultra-top-header, .top-header-three.ultra-top-header' ).css( {
				'background': to
			} );

		} );
	} );
	// Top Header text color.
	wp.customize( 'ultra_seven_top_text', function( value ) {
		value.bind( function( to ) {

			$( '.ultra-top-header .top-left ul li a, .ultra-top-header .top-right ul li a' ).css( {
				'color': to
			} );

		} );
	} );
	// Bottom Header bg color.
	wp.customize( 'ultra_seven_bottom_bg', function( value ) {
		value.bind( function( to ) {

			$( '.site-header.layout-two .nav-search-wrap, .site-header.layout-three .ultra-menu' ).css( {
				'background': to
			} );

		} );
	} );
	// bottom Header text color.
	wp.customize( 'ultra_seven_bottom_text', function( value ) {
		value.bind( function( to ) {

			$( '.site-header.layout-two .main-navigation > ul > li > a, .side-menu-wrap i, .index-icon a, .main-navigation ul li.menu-item-has-children > a:before, .main-navigation ul > li.menu-item-has-children > a:before, .ultra-search i, .site-header.layout-three .main-navigation > ul > li > a' ).css( {
				'color': to
			} );

		} );
	} );
	// Top Header text hover color.
	wp.customize( 'ultra_seven_bottom_text_active', function( value ) {
		value.bind( function( to ) {

			$( '.site-header.layout-two .main-navigation ul li.current-menu-item > a, .site-header.layout-two .main-navigation ul li > a:hover, .site-header.layout-three .main-navigation > ul > li.current-menu-item > a, .site-header.layout-three .main-navigation > ul > li > a:hover' ).css( {
				'color': to
			} );

		} );
	} );

} )( jQuery );
