<?php
/**
 * Ultra Seven Constants definition file
 *
 * @package  Ultra Seven
 */
// get theme data
$theme = wp_get_theme();

// theme core directory path & uri
$dir = get_template_directory();
$uri = get_template_directory_uri();

/**
 * Theme constants
 */
define( 'ULTRA_THEME', $theme->get( 'Name' ) );
define( 'ULTRA_VERSION', $theme->get( 'Version' ) );

/**
 * Template directory & uri
 */
define( 'ULTRA_DIR', wp_normalize_path( $dir ) );
define( 'ULTRA_URI', trailingslashit( $uri ) );

/**
 * Theme assets URI & DIR
 */
define( 'ULTRA_ASSETS', ULTRA_DIR . '/assets/' );
define( 'ULTRA_ASSETS_URI', ULTRA_URI . 'assets/' );
define( 'ULTRA_CSS', ULTRA_ASSETS_URI . 'css/' );
define( 'ULTRA_JS', ULTRA_ASSETS_URI . 'js/' );
define( 'ULTRA_IMAGES', ULTRA_ASSETS_URI . 'images/' );
define( 'ULTRA_LIB', ULTRA_ASSETS_URI . 'library/' );

/**
 * CS_OPTION fallback
 */
if( !defined( 'CS_OPTION' ) ) {
	define( 'CS_OPTION', '_cs_options' );
}

/* PHP Closing tag is omitted */