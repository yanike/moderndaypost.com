<?php
/**
 * ultra-seven Theme Customizer
 *
 * @package ultra-seven
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ultra_seven_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ultra_seven_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ultra_seven_customize_partial_blogdescription',
		) );
	}



/*------------------------------------------------------------------------------------*/
	/**
	 * Upgrade to Ultra Eleven(Pro version of Ultra Seven)
	*/
	// Register custom section types.
	$wp_customize->register_section_type( 'Ultra_Seven_Customize_Section_Pro' );

	// Register sections.
	$wp_customize->add_section(
	    new Ultra_Seven_Customize_Section_Pro(
	        $wp_customize,
	        'ultra-eleven',
	        array(
	            'title'    => esc_html__( 'Upgrade To Premium', 'ultra-seven' ),
	            'pro_text' => esc_html__( 'Buy Now','ultra-seven' ),
	            'pro_text1' => esc_html__( 'Compare','ultra-seven' ),
	            'pro_url'  => 'https://wpoperation.com/themes/ultra-eleven/',
	            'priority' => 0,
	        )
	    )
	);
	$wp_customize->add_setting(
		'construction_pro_upbuton',
		array(
			'section' => 'ultra-eleven',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control(
		'construction_pro_upbuton',
		array(
			'section' => 'ultra-eleven'
		)
	);



}
add_action( 'customize_register', 'ultra_seven_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ultra_seven_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ultra_seven_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ultra_seven_customize_preview_js() {
	wp_enqueue_script( 'ultra_seven-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ultra_seven_customize_preview_js' );
