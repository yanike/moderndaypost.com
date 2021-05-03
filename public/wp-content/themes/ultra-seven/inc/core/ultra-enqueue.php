<?php

/**
 * Enqueue scripts and styles.
 */
function ultra_seven_scripts() {
    /*Ultra Styles */
	wp_register_style('font-awesome',ULTRA_LIB. 'fontawasome/font-awesome.min.css');
    wp_enqueue_style('font-awesome');

	wp_register_style('lightslider',ULTRA_LIB. 'lightslider/lightslider.css');

    $wow_animation = get_theme_mod( 'ultra_seven_wow_animation_option','show' );
    if($wow_animation=='show'){
    wp_register_style('animate',ULTRA_LIB. 'wow/animate.css');
    wp_enqueue_style('animate');
    }
    $ultra_font_args = array('family' => 'Lato:400,400i,700|Cedarville+Cursive:400');
    wp_register_style('ultra-seven-fonts', add_query_arg($ultra_font_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style('ultra-seven-fonts');

    wp_register_style('ultra-keyboard-links',ULTRA_CSS. 'keyboard-links.css');
    wp_enqueue_style('ultra-keyboard-links');

	wp_register_style( 'ultra_seven-style', get_stylesheet_uri() );
    wp_enqueue_style( 'ultra_seven-style');

    wp_register_style('ultra-responsive-css',ULTRA_CSS. 'responsive.css');
    wp_enqueue_style('ultra-responsive-css');

    /*Ultra Scripts */
	wp_register_script( 'ultra_seven-navigation', ULTRA_JS . 'navigation.js', array(), ULTRA_VERSION, true );
    wp_enqueue_script('ultra_seven-navigation' );

	wp_enqueue_script( 'ultra_seven-skip-link-focus-fix', ULTRA_JS. 'skip-link-focus-fix.js', array(), ULTRA_VERSION, true );
    wp_register_script( 'iframe-api', ULTRA_JS. 'iframe-api.js', array( 'jquery' ), ULTRA_VERSION, true );
    wp_register_script( 'lightslider', ULTRA_LIB . 'lightslider/lightslider.js', array('jquery'), ULTRA_VERSION, true );

    $sidebar_sticky = get_theme_mod( 'ultra_seven_sticky_sidebar_option','show' );
    if($sidebar_sticky == 'show'){
    wp_register_script( 'theia-sticky-js', ULTRA_LIB . 'theia-sticky-sidebar.js', array('jquery'), ULTRA_VERSION, true );
    wp_enqueue_script( 'theia-sticky-js' );
    }

    $smoothscroll = get_theme_mod( 'ultra_seven_smooth_scroll_option','show' );
    if($smoothscroll=='show'){
    wp_register_script( 'smooth-scroll', ULTRA_LIB . 'SmoothScroll.js', array('jquery'), ULTRA_VERSION, true );
    wp_enqueue_script( 'smooth-scroll' );
    }
    if($wow_animation=='show'){
    wp_register_script( 'wow-js', ULTRA_LIB . 'wow/wow.min.js', array('jquery'), ULTRA_VERSION, true );
    wp_enqueue_script( 'wow-js' );
    }
    wp_register_script( 'fitvids-js', ULTRA_LIB . 'jquery.fitvids.js', array('jquery'), ULTRA_VERSION, true );
    wp_register_script( 'ultra-custom-js', ULTRA_JS . 'ultra-custom.js', array('jquery','iframe-api'), ULTRA_VERSION, true );
    wp_enqueue_script('ultra-custom-js');


    /* Localize Function */
    $sticky_menu = get_theme_mod( 'ultra_seven_sticky_menu','show' );
    $ultra_js_params = array(
        'ajaxurl'           => admin_url( 'admin-ajax.php' ), 
        'nonce'             => wp_create_nonce( 'ultra-ajax-nonce' ),
        'sticky_menu'       => $sticky_menu, 
        'sidebar_sticky'    => $sidebar_sticky,
        'wow'               => $wow_animation,
        'smoothscroll'      => $smoothscroll
    );
    wp_localize_script( 'ultra-custom-js', 'ultra_params', $ultra_js_params );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ultra_seven_scripts' );




//admin scripts
function ultra_seven_admin_scripts() {
    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

    wp_register_script( 'of-media-uploader', ULTRA_JS . 'media-uploader.js', array('jquery'), ULTRA_VERSION);
    wp_enqueue_script( 'of-media-uploader' );
    wp_localize_script( 'of-media-uploader', 'ultra_seven_l10n', array(
        'upload' => esc_html__( 'Upload', 'ultra-seven' ),
        'remove' => esc_html__( 'Remove', 'ultra-seven' )
        ));
    wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'ultra-seven-admin-styles', ULTRA_CSS . 'admin.css');
	wp_enqueue_script( 'ultra-seven-admin-scripts', ULTRA_JS . 'admin.js', array('jquery'), ULTRA_VERSION, true );

}
add_action( 'admin_enqueue_scripts', 'ultra_seven_admin_scripts' );

