<?php
/**
* Ultra Seven repeater customizer
*
* @package Ultra Seven
*/



/**
* Load scripts for repeater 
*/
  function ultra_seven_enqueue_repeater_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'ultra_seven-repeater-script', ULTRA_URI . '/inc/repeater-controller/repeater-script.js',array( 'jquery','jquery-ui-sortable','customize-controls'),'2230',true);
    wp_enqueue_script( 'color-repeater-scriptsfa', ULTRA_URI . '/inc/repeater-controller/spectrum/spectrum.js');
    wp_enqueue_style('color-repeater-style', ULTRA_URI . '/inc/repeater-controller/spectrum/spectrum.css');
    wp_enqueue_style('ultra_seven-repeater-style',ULTRA_URI . '/inc/repeater-controller/repeater-style.css');
} add_action( 'admin_enqueue_scripts', 'ultra_seven_enqueue_repeater_scripts');

/**
* Repeater customizer
*/
add_action( 'customize_register', 'ultra_seven_repeaters_customize_register' );
function ultra_seven_repeaters_customize_register( $wp_customize ) {
    
    require get_template_directory().'/inc/repeater-controller/repeater-class.php';
    
    
    $wp_customize->add_section( 'ultra_seven_homepage_section', array(
                  'priority'     => 4,
                  'panel'        => 'ultra_seven_homepage_settings_panel',
                  'title'        => esc_html__('Homepage Section', 'ultra-seven')
                ));

    $wp_customize->add_setting( 'ultra_seven_homepage', array(
	    'sanitize_callback' => 'ultra_seven_sanitize_repeater',
	    'default' => json_encode(
	     	array(
	         	array(
                    'ultra_seven_enable_section'=>'on',
                    'ultra_seven_sidebar_layout' => 'nosidebar',
                    'ultra_seven_sidebar_area' => '',
                    'ultra_seven_section_area' => '',
                    'ultra_seven_section_txt_color'=>''
                    
                    
	            )
	     	)
	    )
	));

	$wp_customize->add_control(  new Ultra_seven_Repeater_Controler( $wp_customize, 'ultra_seven_homepage', 
        array(
            'label'   => esc_html__('Homepage Options','ultra-seven'),
            'section' => 'ultra_seven_homepage_section',
            'ultra_seven_box_label' => esc_html__('Section : ','ultra-seven'),
            'ultra_seven_box_add_control' => esc_html__('Add Section','ultra-seven'),
        ),
        	array(

            'ultra_seven_enable_section' => array(
                'type'        => 'switch',
                'label'       => esc_html__( 'Enable Section', 'ultra-seven' ),
                'switch' => array(
                    'on' => esc_html__('Yes','ultra-seven' ),
                    'off' => esc_html__('No','ultra-seven' )
                    ),
                'default'     => 'on'
            ), 
            'ultra_seven_sidebar_layout' => array(
                'type'        => 'selector',
                'label'       => esc_html__( 'Choose Sidebar Layouts', 'ultra-seven' ),
                'options' => array(
                    'leftsidebar' => ULTRA_IMAGES.'home-sidebar-left.png',
                    'rightsidebar' => ULTRA_IMAGES.'home-sidebar-right.png',
                    'nosidebar' => ULTRA_IMAGES.'home-sidebar-no.png',
                    ),
                'default'     => 'nosidebar',
                'class'       => 'vl-bottom-block-layout'
            ),
 
            'ultra_seven_sidebar_area' => array(
                'type'        => 'layouts',
                'label'       => esc_html__( 'Widget Area for Sidebar', 'ultra-seven' ),
                'default'     => '',
                'class'       => 'un-bottom-block-layout sidebar-choose'
            ),

            'ultra_seven_section_area' => array(
                'type'        => 'layouts',
                'label'       => esc_html__( 'Widget Area for Main Block', 'ultra-seven' ),
                'default'     => '',
                'class'       => 'un-bottom-block-layout'
            ), 

            'ultra_seven_section_txt_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Font Color', 'ultra-seven' ),
                'default'     => '',
                'class'       => 'txt-type color'
            ),
        )
	));
    
    
    
/**
* Repeater Sanitize
*/
        function ultra_seven_sanitize_repeater($input){      
            $input_decoded = json_decode( $input, true );
            $allowed_html = array(
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'a' => array(
                    'href' => array(),
                    'class' => array(),
                    'id' => array(),
                    'target' => array()
                ),
                'button' => array(
                    'class' => array(),
                    'id' => array()
                )
            );    

            if(!empty($input_decoded)) {
                foreach ($input_decoded as $boxes => $box ){
                    foreach ($box as $key => $value){
                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );
                    }
                }
                return json_encode($input_decoded);
            }    
            return $input;
        }
    
}