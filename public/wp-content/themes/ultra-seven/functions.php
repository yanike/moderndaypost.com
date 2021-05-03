<?php
/**
 * ultra-seven functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
  *@package Ultra Seven
 * @copyright Copyright (C) 2018 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

if ( ! function_exists( 'ultra_seven_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ultra_seven_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ultra-seven, use a find and replace
		 * to change 'ultra-seven' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ultra-seven', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable theme support for Gutenberg wide images.
		add_theme_support( 'gutenberg', array(
			'wide-images' => true,
		) );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Primary Menu', 'ultra-seven' ),
			'top-menu' => esc_html__( 'Top Menu', 'ultra-seven' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'ultra-seven' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'script',
			'style',
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'audio',
			'video',
			'gallery',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ultra_seven_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/* Add ultra_seven Image size */
		add_image_size( 'ultra-image-1400x840', 1900, 840, true );
		add_image_size( 'ultra-slider1-left', 850, 650, true );
		add_image_size( 'ultra-slider1-right', 425, 325, true );
		add_image_size( 'ultra-slider2-left', 705, 448, true );
		add_image_size( 'ultra-slider2-right-top', 470, 225, true );
		add_image_size( 'ultra-slider2-right-buttom', 235, 225, true );
		add_image_size( 'ultra-xlarge-image', 1400, 850, true );
		add_image_size( 'ultra-medium-image', 580, 360, true );
		add_image_size( 'ultra-small-image', 195, 130, true );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );


	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'footer-1' => array(
				'archives'
			),

			// Add the core-defined business info widget to the footer 1 area.
			'footer-2' => array(
				'search'
			),

			// Put two core-defined widgets in the footer 2 area.
			'footer-3' => array(
				'categories'
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home' => array(
				'template' =>'tmpl-home.php', 
			),
			'blog',
			'contact',
			'about',
			'news'
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top-menu'    => array(
				'name'  => esc_html__( 'Top Menu', 'ultra-seven' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'main-menu'    => array(
				'name'  => esc_html__( 'Primary Menu', 'ultra-seven' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
					'page_news',
				),
			),

			'footer-menu'    => array(
				'name'  => esc_html__( 'Footer Menu', 'ultra-seven' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			
		),
	);

	/**
	 * @since 1.0.8
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'ultra_seven_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );


	}
endif;
add_action( 'after_setup_theme', 'ultra_seven_setup' );

/** Adding Editor Styles **/
function ultra_seven_add_editor_styles() {
    add_editor_style( get_template_directory_uri().'/assets/css/custom-editor-style.css' );
}
add_action( 'admin_init', 'ultra_seven_add_editor_styles' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ultra_seven_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ultra_seven_content_width', 640 );
}
add_action( 'after_setup_theme', 'ultra_seven_content_width', 0 );



/* Require theme files*/
$file_paths = array(
	'/inc/core/ultra-enqueue.php',
	'/inc/core/ultra-constants.php',
	'/inc/custom-header.php',
	'/inc/template-tags.php',
	'/inc/template-functions.php',
	'/inc/customizer/ultra-sanitize.php',
	'/inc/customizer/customizer-default.php',
	'/inc/customizer/ultra-custom-controls.php',
	'/inc/customizer/customizer.php',
	'/inc/customizer/ultra-customizer.php',
	'/inc/extras/ultra-breadcrumb.php',
	'/inc/core/ultra-functions.php',
	'/inc/core/ultra-hooks.php',
    '/inc/ultra-woocommerce.php',
    '/inc/widgets/widget-functions.php',
    '/inc/dynamic-css.php',
   
);

foreach ($file_paths as $file_path) {
	require get_parent_theme_file_path() . $file_path;
}

/**
 * Load welcome section to admin.
 */
if ( is_admin() ) {
    require get_template_directory().'/inc/welcome/welcome-config.php';
}


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}