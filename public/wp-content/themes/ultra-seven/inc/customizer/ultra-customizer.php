<?php
 get_template_part('inc/repeater-controller/wp','customizer');

function ultra_seven_custom_customize_register( $wp_customize ) {

  $default = ultra_seven_get_default_theme_options();

 /* Option list of all categories */
  $ultra_seven_args = array(
     'type'                     => 'post',
     'orderby'                  => 'name',
     'taxonomy'                 => 'category'
  );
  $ultra_seven_option_categories = array();
  $ultra_seven_category_lists = get_categories( $ultra_seven_args );
  $ultra_seven_option_categories[0] = esc_html__( '--All--', 'ultra-seven' );
  foreach( $ultra_seven_category_lists as $ultra_seven_category ){
      $ultra_seven_option_categories[$ultra_seven_category->term_id] = $ultra_seven_category->name .' ('.$ultra_seven_category->count.')';
  }

    /**
     * Add General Settings panel
     */

    $wp_customize->add_panel( 'general_settings', array(
        'priority'         =>      1,
        'capability'       =>      'edit_theme_options',
        'theme_supports'   =>      '',
        'title'            =>      esc_html__( 'General Settings', 'ultra-seven' ),
        'description'      =>      esc_html__( 'This allows to edit general theme settings', 'ultra-seven' ),
    ));

    $wp_customize->get_section('title_tagline')->panel = 'general_settings';
    $wp_customize->remove_section('header_image');
    $wp_customize->get_section('background_image')->panel = 'general_settings';
    $wp_customize->get_section('static_front_page')->panel = 'general_settings';
    $wp_customize->get_section('colors')->panel = 'general_settings'; 
    $wp_customize->get_control('background_color')->section = 'background_image';

    /* Color Option */
    $wp_customize->add_setting( 'ultra_seven_skincolor_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_skincolor_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Theme Skin Color', 'ultra-seven' ),
      'section'   => 'colors',
      'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting(
        'ultra_seven_theme_color', array(
            'default' => $default['ultra_seven_theme_color'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'ultra_seven_theme_color', 
            array(
            'label' => esc_html__('Theme Color','ultra-seven'), 
            'section' => 'colors',
            'settings' => 'ultra_seven_theme_color',
            'priority' => 2
            )
        )
    );

    //Categories Color

    $wp_customize->add_setting( 'ultra_seven_cat_color_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_cat_color_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Category Colors', 'ultra-seven' ),
      'section'   => 'colors',
      'priority'  => 3
    ) ) ); 

    global $ultra_seven_cat_array;
    foreach ( $ultra_seven_cat_array as $key => $value ) {
        $wp_customize->add_setting(
            'ultra_seven_cat_color_'.$key,
            array(
                'default'           => $default['ultra_seven_theme_color'],
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'ultra_seven_cat_color_'.$key,
                array(
                    'label'         => esc_html( $value ),
                    'section'       => 'colors',
                    'priority'      => 5
                )
            )
        ); 
    } 

    /* Additional Section */

    $wp_customize->add_section( 'ultra_seven_additional_section', array(
        'title'           =>      esc_html__('Additional Settings', 'ultra-seven'),
        'priority'        =>      45,
        'panel'           => 'general_settings'
    ));
     
    //Animation option 
    $wp_customize->add_setting( 'ultra_seven_additional_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_additional_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Homepage Animations', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
      'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_wow_animation_option', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_wow_animation_option',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Enable/Disable Animation', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 1
    ) ) );  

    $wp_customize->add_setting( 'ultra_seven_smooth_scroll_option', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_smooth_scroll_option',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Enable/Disable Smooth Scroll', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 2
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_back_top_option', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_back_top_option',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Enable/Disable Back to Top', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 3
    ) ) ); 

  /**
  *Breadcrumb Settings */
    $wp_customize->add_setting( 'ultra_seven_breadcrumb_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_breadcrumb_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Breadcrumb Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_breadcrumb_enable', array(
        'default' => $default['ultra_seven_wow_animation_option'],
        'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_customize_Switch_Control( $wp_customize, 
      'ultra_seven_breadcrumb_enable',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Enable / Disable Option', 'ultra-seven' ),
        'section'   => 'ultra_seven_additional_section',
        'choices'   => array(
              'show'  => esc_html__( 'Enable', 'ultra-seven' ),
              'hide'  => esc_html__( 'Disable', 'ultra-seven' )
            )
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_breadcrumb_delimiter', array(
      'default' => $default['ultra_seven_breadcrumb_delimiter'],
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ultra_seven_breadcrumb_delimiter',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Delimitor', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
    ) ); 

    $wp_customize->add_setting( 'ultra_seven_preloader_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    //preloader option
    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_preloader_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Preloader option', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_preloader_option', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_preloader_option',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Enable/Disable Preloader', 'ultra-seven' ),
      'section'   => 'ultra_seven_additional_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
    ) ) ); 
   
    /* Webpage Layout */
    $wp_customize->add_section( 'ultra_seven_webpage_section', array(
        'title'           =>      esc_html__('Webpage Layout', 'ultra-seven'),
        'priority'        =>      35,
        'panel'           => 'general_settings'
    ));

    $wp_customize->add_setting( 'ultra_seven_webpage_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_webpage_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Webpage Layout', 'ultra-seven' ),
      'section'   => 'ultra_seven_webpage_section',
      'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_webpage_layout', array(
              'default'           =>     $default['ultra_seven_webpage_layout'],
              'sanitize_callback' => 'ultra_seven_sanitize_radio'
          )
    );

    $wp_customize->add_control( new Ultra_Seven_Customize_Radioimage_Control(
          $wp_customize,
          'ultra_seven_webpage_layout',
          array(
              'section'       =>      'ultra_seven_webpage_section',
              'label'         =>      esc_html__('Choose Webpage Layout','ultra-seven'),
              'type'          =>      'radioimage',
              'choices'       =>  array( 
                  'ultra-boxed'       => ULTRA_IMAGES.'boxed-all.png',
                  'ultra-fullwidth'   => ULTRA_IMAGES.'full.png',
                ),
              'priority'  => 2
              )
          )
    );

  /* Container Width */

    $wp_customize->add_setting( 'ultra_seven_container_width', 
        array(
            'default'   => '1170',
            'sanitize_callback' => 'ultra_seven_sanitize_number'                   
        )
    );    
    $wp_customize->add_control(
        'ultra_seven_container_width',
        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Container Width', 'ultra-seven' ),
            'section'   => 'ultra_seven_webpage_section',
        )
    );  

    /*===========================================================================================================
     * Header Pannel
    */

    $wp_customize->add_panel(
        'ultra_seven_header_settings_panel', 
            array(
                'priority'       => 2,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => esc_html__( 'Header Settings', 'ultra-seven' ),
            ) 
    );

    /* Header Layouts */

    $wp_customize->add_section( 'ultra_seven_header_layouts_section', array(
        'title'           =>     esc_html__('Header Layouts', 'ultra-seven'),
        'priority'        =>      '1',
        'panel'           => 'ultra_seven_header_settings_panel'
    ));

    $wp_customize->add_setting( 'ultra_seven_headerl_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_headerl_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Header Layouts', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_layouts_section',
      'priority'  => 1
    ) ) );

    $wp_customize->add_setting( 'ultra_seven_header_layouts', array(
              'default'       =>      $default['ultra_seven_header_layouts'],
              'sanitize_callback' => 'ultra_seven_sanitize_radio'
          )
    );

    $wp_customize->add_control( new Ultra_Seven_Customize_Radioimage_Control(
          $wp_customize,
          'ultra_seven_header_layouts',
          array(
              'section'       =>      'ultra_seven_header_layouts_section',
              'label'         =>      esc_html__('Choose Header Layout','ultra-seven'),
              'type'          =>      'radioimage',
              'choices'       =>      array( 
                'ultra-header-1'    => ULTRA_IMAGES.'header-2.png',
                'ultra-header-2'    => ULTRA_IMAGES.'header-3.png',
                ),
              'priority'  => 2
              )
          )
    );

    //header banner

    $wp_customize->add_setting( 'ultra_seven_header_help', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Help_Control( $wp_customize, 'ultra_seven_header_help',  array( 
      'label'     => esc_html__( 'Go to your Dashboard > Appearance > Widgets > Header Banner Area to add Banners in Header.', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_layouts_section',
      'active_callback' => 'ultra_header_layout',
      'priority' => 4,
    ) ) );  

    //mobile menu bg
    $wp_customize->add_setting( 'ultra_seven_mobile_menu_bg', array(
          'sanitize_callback'=>'esc_url_raw',
          )
    );
    $wp_customize->add_control(
     new wp_customize_Image_Control(
         $wp_customize,
         'ultra_seven_mobile_menu_bg',
         array(
             'label'      => esc_html__( 'Mobile Menu Background', 'ultra-seven' ),
             'description'=> esc_html__('Upload background image for mobile navigation.','ultra-seven'),
             'section'    => 'ultra_seven_header_layouts_section',
             'settings'   => 'ultra_seven_mobile_menu_bg',
             'priority' => 5,
         )
      )
    );  

    /* Header Settings */
    $wp_customize->add_section( 'ultra_seven_header_settings_section', array(
        'title'           =>     esc_html__('Header Options', 'ultra-seven'),
        'priority'        =>      '2',
        'panel'           => 'ultra_seven_header_settings_panel'
    ));

    /* Top header */
    $wp_customize->add_setting( 'ultra_seven_theader_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_theader_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Top Header Options', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_top_header_show', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_top_header_show',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Hide / Show Top header', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 2
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_top_icons', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_top_icons',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Show/Hide Social Icons', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 3
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_top_menu', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_top_menu',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Show/Hide Top Menu', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 4
    ) ) );  

    $wp_customize->add_setting( 'ultra_seven_top_date', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option'
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_top_date',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Show/Hide Top Date', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 5
    ) ) );  

    /* Bottom header */
    $wp_customize->add_setting( 'ultra_seven_bheader_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_bheader_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Bottom Header Options', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'priority'  => 6
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_home_icon', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_home_icon',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Show/Hide Home Icon', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 7
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_sticky_menu', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_sticky_menu',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Sticky Menu', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 8
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_search_enable', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
          ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_search_enable',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Search Icon', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 9
    ) ) ); 

    if(class_exists('woocommerce')){    
    $wp_customize->add_setting( 'ultra_seven_cart_enable', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
          ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_cart_enable',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Cart Icon', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_settings_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 10
    ) ) );  
    }

    /* Header Color Settings */
    $wp_customize->add_section( 'ultra_seven_header_color_section', array(
        'title'           =>     esc_html__('Header Colors', 'ultra-seven'),
        'priority'        =>      7,
        'panel'           => 'ultra_seven_header_settings_panel'
    ));

    $wp_customize->add_setting( 'ultra_seven_tcheader_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_tcheader_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Top Header Colors', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_color_section',
    ) ) ); 

    $wp_customize->add_setting(
        'ultra_seven_top_bg', array(
            'default' => $default['ultra_seven_top_bg'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'ultra_seven_top_bg', 
            array(
            'label' => esc_html__('Background Color','ultra-seven'), 
            'section' => 'ultra_seven_header_color_section',
            )
        )
    );
    $wp_customize->add_setting(
        'ultra_seven_top_text', array(
            'default' => $default['ultra_seven_top_text'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'ultra_seven_top_text', 
            array(
            'label' => esc_html__('Text Color','ultra-seven'), 
            'section' => 'ultra_seven_header_color_section',
            )
        )
    );
    $wp_customize->add_setting( 'ultra_seven_bcheader_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_bcheader_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Bottom Header Colors', 'ultra-seven' ),
      'section'   => 'ultra_seven_header_color_section',
    ) ) ); 

    $wp_customize->add_setting(
        'ultra_seven_bottom_bg', array(
            'default' => $default['ultra_seven_bottom_bg'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'ultra_seven_bottom_bg', 
            array(
            'label' => esc_html__('Background Color','ultra-seven'), 
            'section' => 'ultra_seven_header_color_section',
            )
        )
    );
    $wp_customize->add_setting(
        'ultra_seven_bottom_text', array(
            'default' => $default['ultra_seven_bottom_text'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'ultra_seven_bottom_text', 
            array(
            'label' => esc_html__('Text Color','ultra-seven'), 
            'section' => 'ultra_seven_header_color_section',
            )
        )
    );
    $wp_customize->add_setting(
        'ultra_seven_bottom_text_active', array(
            'default' => $default['ultra_seven_bottom_text_active'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'ultra_seven_bottom_text_active', 
            array(
            'label' => esc_html__('Hover Color','ultra-seven'), 
            'section' => 'ultra_seven_header_color_section',
            )
        )
    );

    /* social Icons */
    $wp_customize->add_section( 'ultra_seven_social_section', array(
        'title'           =>     esc_html__('Social Icons', 'ultra-seven'),
        'priority'        =>      '4',
        'panel'           => 'ultra_seven_header_settings_panel'
    ));

    $wp_customize->add_setting( 'ultra_seven_social_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_social_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Social Icons Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_social_section',
      'priority'  => 5
    ) ) ); 

    $socials = array('Facebook','Twitter','Linkedin','Instagram','Pinterest');
    foreach($socials as $social){

    $wp_customize->add_setting('ultra_seven_'.$social,
            array(
              'sanitize_callback' => 'esc_url_raw',
              'transport'=>'postMessage'
              )
            );

    $wp_customize->add_control( 'ultra_seven_'.$social,
        array(
            'label'  => esc_html($social),
            'description'=>sprintf(esc_html__( 'Enter URL for %s', 'ultra-seven' ),$social),
            'section' => 'ultra_seven_social_section',
            'type' => 'url',
            'priority'=> 6
        )
    ); 

   $wp_customize->selective_refresh->add_partial( 'ultra_seven_'.$social, array(
      'selector'        => '.header-icons',
      'container_inclusive' => true,
      'render_callback' => 'ultra_seven_social_icons',
    ) ); 

    }//end foreach;

    /* Ticker Settings */

    $wp_customize->add_section( 'ultra_seven_ticker_section', array(
        'title'           =>     esc_html__('Ticker settings', 'ultra-seven'),
        'priority'        =>      5,
        'panel'           => 'ultra_seven_header_settings_panel'
    ));

    $wp_customize->add_setting( 'ultra_seven_ticker_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_ticker_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Ticker Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_ticker_section',
      'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_ticker_show', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
          ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_ticker_show',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Show/Hide Ticker', 'ultra-seven' ),
      'section'   => 'ultra_seven_ticker_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 2
    ) ) ); 

    $wp_customize->add_setting(
        'ultra_seven_ticker_title', 
        array(
            'default'   => $default['ultra_seven_ticker_title'],
            'sanitize_callback' => 'sanitize_text_field'                   
        )
    );    
    $wp_customize->add_control(
        'ultra_seven_ticker_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Ticker Title', 'ultra-seven' ),
            'section'   => 'ultra_seven_ticker_section',
            'priority'  => 3
        )
    ); 

    $wp_customize->add_setting( 'ultra_seven_ticker_type', array(
      'capability' => 'edit_theme_options',
      'default' => $default['ultra_seven_ticker_type'],
      'sanitize_callback' => 'ultra_seven_sanitize_radio',
    ) );

    $wp_customize->add_control(
        'ultra_seven_ticker_type',
        array(
            'type'      => 'radio',
            'choices'   => array(
                              'latest' => esc_html__('Latest Posts','ultra-seven'),
                              'category' => esc_html__('Category Posts','ultra-seven'),
                           ),
            'label'     => esc_html__( 'Choose Post Type', 'ultra-seven' ),
            'section'   => 'ultra_seven_ticker_section',
            'priority'  => 4
        )
    ); 

    $wp_customize->add_setting('ultra_seven_ticker_cat',array(
         'default' => $default['ultra_seven_ticker_cat'],
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'ultra_seven_sanitize_number',
         )
    );

    $wp_customize->add_control( 'ultra_seven_ticker_cat',
         array(
             'label'  => esc_html__( 'Choose Category for Ticker ', 'ultra-seven' ),
             'section' => 'ultra_seven_ticker_section',
             'type' => 'select',
             'choices' => $ultra_seven_option_categories,
             'priority'  => 5,
             'active_callback' => 'ultra_ticker_post_type'
         )
    );

    $wp_customize->add_setting( 'ultra_seven_ticker_count', 
        array(
            'default'   => $default['ultra_seven_ticker_count'],
            'sanitize_callback' => 'ultra_seven_sanitize_number'                   
        )
    );    
    $wp_customize->add_control(
        'ultra_seven_ticker_count',
        array(
            'type'      => 'number',
            'label'     => esc_html__( 'No. of Posts', 'ultra-seven' ),
            'section'   => 'ultra_seven_ticker_section',
            'priority'  => 7
        )
    ); 

    /*===========================================================================================================
     * Homepage Pannel
    */

    $wp_customize->add_panel(
        'ultra_seven_homepage_settings_panel', 
            array(
                'priority'       => 2,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => esc_html__( 'Homepage Settings', 'ultra-seven' ),
            ) 
    );

    /* Slider Section */  

    $wp_customize->add_section( 'ultra_seven_slider_section', array(
        'title'           =>      esc_html__('Slider settings', 'ultra-seven'),
        'priority'        =>      '1',
        'panel'           => 'ultra_seven_homepage_settings_panel'
    ));

    $wp_customize->add_setting( 'ultra_seven_slider_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_slider_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Slider Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_slider_section',
      'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_slider_show', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_slider_show',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Hide/Show Slider', 'ultra-seven' ),
      'section'   => 'ultra_seven_slider_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 1
    ) ) );  

    $wp_customize->add_setting( 'ultra_seven_sider_layout', array(
              'default'           => $default['ultra_seven_sider_layout'],
              'sanitize_callback' => 'ultra_seven_sanitize_radio'
          )
    );

    $wp_customize->add_control( new Ultra_Seven_Customize_Radioimage_Control(
          $wp_customize,
          'ultra_seven_sider_layout',
          array(
              'section'       =>      'ultra_seven_slider_section',
              'label'         =>      esc_html__('Choose Slider Layout','ultra-seven'),
              'type'          =>      'radioimage',
              'choices'       =>      array( 
                'slider-1'    => ULTRA_IMAGES.'slider2.png',
                'slider-2'    => ULTRA_IMAGES.'slider1.png',
                ),
              'priority'  => 2
              )
          )
    );

     $wp_customize->add_setting('ultra_seven_slider_cat',array(
         'default' => $default['ultra_seven_ticker_cat'],
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'ultra_seven_sanitize_number',
         )
      );

    $wp_customize->add_control( 'ultra_seven_slider_cat',
         array(
             'label'  => esc_html__( 'Choose Category for slider ', 'ultra-seven' ),
             'description'=> esc_html__('Choose the category of posts for homepage slider','ultra-seven'),
             'section' => 'ultra_seven_slider_section',
             'type' => 'select',
             'choices' => $ultra_seven_option_categories,
             'priority'  => 3
         )
    );

    $wp_customize->add_setting( 'ultra_seven_slider_count', 
        array(
            'default'   => $default['ultra_seven_slider_count'],
            'sanitize_callback' => 'ultra_seven_sanitize_number'                   
        )
    );    
    $wp_customize->add_control(
        'ultra_seven_slider_count',
        array(
            'type'      => 'number',
            'label'     => esc_html__( 'No. of Posts', 'ultra-seven' ),
            'section'   => 'ultra_seven_slider_section',
            'priority'  => 4
        )
    ); 

    $wp_customize->add_setting( 'ultra_seven_featured_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_featured_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Featured Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_slider_section',
      'priority'  => 4
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_feature_section_enable', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_feature_section_enable',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Hide/Show Featured Section', 'ultra-seven' ),
      'section'   => 'ultra_seven_slider_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
      'priority'  => 4
    ) ) ); 

     $wp_customize->add_setting('ultra_seven_feature_cat',array(
         'default' => $default['ultra_seven_ticker_cat'],
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'ultra_seven_sanitize_number',
         )
      );

    $wp_customize->add_control( 'ultra_seven_feature_cat',
         array(
             'label'  => esc_html__( 'Choose Category For Feature Section ', 'ultra-seven' ),
             'section' => 'ultra_seven_slider_section',
             'type' => 'select',
             'choices' => $ultra_seven_option_categories,
             'priority'  => 5
         )
    );

  $wp_customize->add_setting('ultra_seven_feature_cat_offset', array(
            'default' => $default['ultra_seven_ticker_cat'],
            'sanitize_callback' => 'ultra_seven_sanitize_number'                   
        )
    );    
    $wp_customize->add_control(
        'ultra_seven_feature_cat_offset',
        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Offset', 'ultra-seven' ),
            'section'   => 'ultra_seven_slider_section',
            'priority'  => 6
        )
    );  
       
    /*------------Sidebar settings---------------------------------*/

    $wp_customize -> add_section(
          'ultra_seven_sidebar_section',
          array(
              'title' => esc_html__('Sidebar Settings','ultra-seven'),
              'priority' => 32,
          )
    );

    //Sticky Sidebar option
    $wp_customize->add_setting( 'ultra_seven_sticky_sidebar_option', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_sticky_sidebar_option',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Enable/Disable Sticky Sidebar', 'ultra-seven' ),
      'section'   => 'ultra_seven_sidebar_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 3
    ) ) ); 

    //Archive page sidebars
    $wp_customize->add_setting( 'ultra_seven_archivesidebar_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_archivesidebar_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Archive Page Sidebar', 'ultra-seven' ),
      'section'   => 'ultra_seven_sidebar_section',
    ) ) ); 

    $wp_customize->add_setting( 'archive_page_sidebars_layout', array(
              'default'           => $default['archive_page_sidebars_layout'],
              'sanitize_callback' => 'ultra_seven_sanitize_radio'
          )
    );

    $wp_customize->add_control( new Ultra_Seven_Customize_Radioimage_Control( $wp_customize, 'archive_page_sidebars_layout',
          array(
              'section'       =>      'ultra_seven_sidebar_section',
              'label'         =>      esc_html__('Choose Archive Page Sidebar', 'ultra-seven'),
              'type'          =>      'radioimage',
              'choices'       =>      array( 
                'leftsidebar' => ULTRA_IMAGES.'sidebar-left.png',  
                'rightsidebar' => ULTRA_IMAGES.'sidebar-right.png', 
                'nosidebar' => ULTRA_IMAGES.'sidebar-no.png',
                )
              )
          )
    );

    $wp_customize->add_setting('archive_page_sidebars',array(
         'default' => $default['archive_page_sidebars'],
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'sanitize_text_field',
         )
    );
    $get_sidebars = ultra_seven_get_sidebars();
    $wp_customize->add_control( 'archive_page_sidebars',
         array(
             'label'  => esc_html__( 'Choose Widget Area ', 'ultra-seven' ),
             'section' => 'ultra_seven_sidebar_section',
             'type' => 'select',
             'choices' => $get_sidebars,
         )
    );

    $wp_customize->add_setting( 'ultra_seven_archivesidebar_help', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Help_Control( $wp_customize, 'ultra_seven_archivesidebar_help',  array( 
      'label'     => esc_html__( 'This will include all the Archive Pages like Category Page,Search Page, Author Page and Tag Page.', 'ultra-seven' ),
      'section'   => 'ultra_seven_sidebar_section',
    ) ) ); 

    //Page Post sidebars
    $wp_customize->add_setting( 'ultra_seven_postsidebar_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_postsidebar_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Page / Post Sidebar', 'ultra-seven' ),
      'section'   => 'ultra_seven_sidebar_section',
    ) ) ); 

    $wp_customize->add_setting('post_page_sidebars_layout', array(
              'default'           => $default['archive_page_sidebars_layout'],
              'sanitize_callback' => 'ultra_seven_sanitize_radio'
          )
    );

    $wp_customize->add_control( new Ultra_Seven_Customize_Radioimage_Control(
          $wp_customize,
          'post_page_sidebars_layout',
          array(
              'section'       =>      'ultra_seven_sidebar_section',
              'label'         =>      esc_html__('Choose Default Sidebar', 'ultra-seven'),
              'type'          =>      'radioimage',
              'choices'       =>      array( 
                'leftsidebar' => ULTRA_IMAGES.'sidebar-left.png',  
                'rightsidebar' => ULTRA_IMAGES.'sidebar-right.png', 
                'nosidebar' => ULTRA_IMAGES.'sidebar-no.png',
                )
              )
          )
    );

    $wp_customize->add_setting( 'ultra_seven_postsidebar_help', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Help_Control( $wp_customize, 'ultra_seven_postsidebar_help',  array(                  
      'label'     => esc_html__( 'This option will work if Default Sidebar is choosed from Pages or Posts Metabox, otherwise this option will be override by metabox option.', 'ultra-seven' ),
      'section'   => 'ultra_seven_sidebar_section',
    ) ) ); 

    //Archive Page Settings
    $wp_customize -> add_section(
          'ultra_seven_archive_section',
          array(
              'title' => esc_html__('Archive Settings','ultra-seven'),
              'priority' => 33,
          )
    );

    $wp_customize->add_setting( 'ultra_seven_archive_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_archive_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Archive Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_archive_section',
      'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'ultra_archive_layout', array(
              'default'           => $default['ultra_archive_layout'],
              'sanitize_callback' => 'ultra_seven_sanitize_radio'
          )
    );

    $wp_customize->add_control( new Ultra_Seven_Customize_Radioimage_Control(
          $wp_customize,
          'ultra_archive_layout',
          array(
              'section'       =>      'ultra_seven_archive_section',
              'label'         =>      esc_html__('Choose Archive Page Layout', 'ultra-seven'),
              'type'          =>      'radioimage',
              'choices'       =>      array( 
                'full' => ULTRA_IMAGES.'fullw.png',  
                'grid' => ULTRA_IMAGES.'grid.png', 
                ),
              'priority'  => 2
              )
          )
    );

    $wp_customize->add_setting( 'ultra_seven_archive_page_excerpts', array(
              'default'           => $default['ultra_seven_archive_page_excerpts'],
              'sanitize_callback' => 'absint'
              ));

    $wp_customize -> add_control( 'ultra_seven_archive_page_excerpts', array(
              'label' => esc_html__('Archive Post Excerpt Length', 'ultra-seven'),
              'section' => 'ultra_seven_archive_section',
              'type' => 'number',
              'priority'  => 3
          )
    ); 

    $wp_customize->add_setting( 'ultra_seven_archive_read_more', array(
              'default'           => $default['ultra_seven_archive_read_more'],
              'sanitize_callback' => 'sanitize_text_field'
              ));
    $wp_customize -> add_control(
          'ultra_seven_archive_read_more',
          array(
              'label' => esc_html__('Read More Text', 'ultra-seven'),
              'section' => 'ultra_seven_archive_section',
              'type' => 'text',
              'priority'  => 4
          )
    ); 
    $wp_customize->add_setting( 'ultra_seven_archive_ads_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_archive_ads_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Ads Placements', 'ultra-seven' ),
      'section'   => 'ultra_seven_archive_section',
      'priority'  => 6
    ) ) );

    $wp_customize->add_setting('ultra_seven_archive_before_ad',array(
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'sanitize_text_field',
         )
    );

    $wp_customize->add_control( 'ultra_seven_archive_before_ad',
         array(
             'label'  => esc_html__( 'Before Content', 'ultra-seven' ),
             'section' => 'ultra_seven_archive_section',
             'type' => 'select',
             'choices' => ultra_seven_get_sidebars(),
             'priority'  => 7
         )
    );

    $wp_customize->add_setting('ultra_seven_archive_after_ad',array(
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'sanitize_text_field',
         )
    );

    $wp_customize->add_control( 'ultra_seven_archive_after_ad',
         array(
             'label'  => esc_html__( 'After Content', 'ultra-seven' ),
             'section' => 'ultra_seven_archive_section',
             'type' => 'select',
             'choices' => ultra_seven_get_sidebars(),
             'priority'  => 8
         )
    );

    $wp_customize->add_setting( 'ultra_seven_archive_ad_help', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Help_Control( $wp_customize, 'ultra_seven_archive_ad_help',  array(                  
      'label'     => esc_html__( 'Choose widget area that contains ads from Appearance > Widegts.', 'ultra-seven' ),
      'section'   => 'ultra_seven_archive_section',
      'priority'  => 9
    ) ) ); 
    //Single Post Settings
    $wp_customize -> add_section(
          'ultra_seven_post_section',
          array(
              'title' => esc_html__('Post Settings','ultra-seven'),
              'priority' => 34,
          )
    );
    $wp_customize->add_setting( 'ultra_seven_post_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_post_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Post Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_post_section',
      'priority'  => 1
    ) ) );

    $wp_customize->add_setting( 'ultra_seven_post_fimage', array(
      'default' => 'show',
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_post_fimage',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Feature Image', 'ultra-seven' ),
      'section'   => 'ultra_seven_post_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 2
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_post_socialshare', array(
      'default' => 'show',
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_post_socialshare',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Social Share', 'ultra-seven' ),
      'section'   => 'ultra_seven_post_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 3
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_post_pagination', array(
      'default' => 'show',
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_post_pagination',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Pagination', 'ultra-seven' ),
      'section'   => 'ultra_seven_post_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 4
    ) ) ); 


    $wp_customize->add_setting( 'ultra_seven_post_relatedposts', array(
      'default' => 'show',
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_post_relatedposts',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Related Posts', 'ultra-seven' ),
      'section'   => 'ultra_seven_post_section',
      'choices'   => array(
            'show'  => esc_html__( 'Enable', 'ultra-seven' ),
            'hide'  => esc_html__( 'Disable', 'ultra-seven' )
          ),
      'priority'  => 5
    ) ) ); 
    $wp_customize->add_setting( 'ultra_seven_post_ads_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_post_ads_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Ads Placements', 'ultra-seven' ),
      'section'   => 'ultra_seven_post_section',
      'priority'  => 6
    ) ) );

    $wp_customize->add_setting('ultra_seven_post_before_ad',array(
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'sanitize_text_field',
         )
    );

    $wp_customize->add_control( 'ultra_seven_post_before_ad',
         array(
             'label'  => esc_html__( 'Before Content', 'ultra-seven' ),
             'section' => 'ultra_seven_post_section',
             'type' => 'select',
             'choices' => ultra_seven_get_sidebars(),
             'priority'  => 7
         )
    );

    $wp_customize->add_setting('ultra_seven_post_after_ad',array(
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'sanitize_text_field',
         )
    );

    $wp_customize->add_control( 'ultra_seven_post_after_ad',
         array(
             'label'  => esc_html__( 'After Content', 'ultra-seven' ),
             'section' => 'ultra_seven_post_section',
             'type' => 'select',
             'choices' => ultra_seven_get_sidebars(),
             'priority'  => 8
         )
    );

    $wp_customize->add_setting( 'ultra_seven_post_ad_help', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Help_Control( $wp_customize, 'ultra_seven_post_ad_help',  array(                  
      'label'     => esc_html__( 'Choose widget area that contains ads from Appearance > Widegts.', 'ultra-seven' ),
      'section'   => 'ultra_seven_post_section',
      'priority'  => 9
    ) ) ); 
    /*===========================================================================================================
     * Footer Pannel
    */
    $wp_customize->add_section( 'ultra_seven_footer_section', array(
        'title'           =>     esc_html__('Footer Settings', 'ultra-seven'),
        'priority'       => 40,
    ));

    $wp_customize->add_setting( 'ultra_seven_topfooter_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_topfooter_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Top Footer Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_footer_section',
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_topfooter_show', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
          ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_topfooter_show',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Hide / Show Top Footer', 'ultra-seven' ),
      'section'   => 'ultra_seven_footer_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
    ) ) );  

    $wp_customize->add_setting( 'ultra_seven_topfooter_col', array(
            'default'   => $default['ultra_seven_topfooter_col'],
            'sanitize_callback' => 'ultra_seven_sanitize_number'                   
        )
    );    
    $wp_customize->add_control( 'ultra_seven_topfooter_col', array(
            'type'      => 'number',
            'label'     => esc_html__( 'Column no.', 'ultra-seven' ),
            'section'   => 'ultra_seven_footer_section',
        )
    ); 

    $wp_customize->add_setting( 'ultra_seven_bottomfooter_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_bottomfooter_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Bottom Footer Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_footer_section',
    ) ) ); 

    $wp_customize->add_setting( 'ultra_seven_footer_menu', array(
      'default' => $default['ultra_seven_wow_animation_option'],
      'sanitize_callback' => 'ultra_seven_sanitize_switch_option',
          ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Switch_Control( $wp_customize, 'ultra_seven_footer_menu',  array(
      'type'      => 'switch',                    
      'label'     => esc_html__( 'Hide / Show Footer menu', 'ultra-seven' ),
      'section'   => 'ultra_seven_footer_section',
      'choices'   => array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
          ),
    ) ) );

    $wp_customize->add_setting( 'ultra_seven_footer_text', array(
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'            
        )
    );    
    $wp_customize->add_control( 'ultra_seven_footer_text', array(
            'type'      => 'textarea',
            'label'     => esc_html__( 'Copyright Text', 'ultra-seven' ),
            'section'   => 'ultra_seven_footer_section',
        )
    ); 
    $wp_customize->selective_refresh->add_partial( 'ultra_seven_footer_text', array(
      'selector'        => '.footer-left',
      'render_callback' => 'ultra_seven_bottom_footer',
    ) );  

    /* For Woocommerce */
    if( class_exists('woocommerce') ){

    $wp_customize->add_section( 'ultra_seven_woo_section', array(
        'title'           =>     esc_html__('Woo Page Settings', 'ultra-seven'),
        'panel'           => 'woocommerce'
    ));

    $wp_customize->add_setting( 'ultra_seven_woo_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Ultra_Seven_Customize_Seperator_Control( $wp_customize, 'ultra_seven_woo_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Woocommerce Settings', 'ultra-seven' ),
      'section'   => 'ultra_seven_woo_section',
    ) ) ); 

    $wp_customize->add_setting( 'ultra_shop_sidebar_layout', array(
              'default'           => $default['archive_page_sidebars_layout'],
              'sanitize_callback' => 'ultra_seven_sanitize_radio'
          )
    );

    $wp_customize->add_control( new Ultra_Seven_Customize_Radioimage_Control(
          $wp_customize,
          'ultra_shop_sidebar_layout',
          array(
              'section'       =>      'ultra_seven_woo_section',
              'label'         =>      esc_html__('Choose Archive Page Sidebar', 'ultra-seven'),
              'type'          =>      'radioimage',
              'choices'       =>      array( 
                'leftsidebar' => ULTRA_IMAGES.'sidebar-left.png',  
                'rightsidebar' => ULTRA_IMAGES.'sidebar-right.png', 
                'nosidebar' => ULTRA_IMAGES.'sidebar-no.png',
                )
              )
          )
    );

    $wp_customize->add_setting('ultra_shop_sidebar',array(
         'default' => $default['archive_page_sidebars'],
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'sanitize_text_field',
         )
    );
    $get_sidebars = ultra_seven_get_sidebars();
    $wp_customize->add_control( 'ultra_shop_sidebar',
         array(
             'label'  => esc_html__( 'Choose Widget Area ', 'ultra-seven' ),
             'section' => 'ultra_seven_woo_section',
             'type' => 'select',
             'choices' => $get_sidebars,
         )
    );

    $wp_customize->add_setting( 'ultra_woo_column', array(
            'default'   => $default['ultra_woo_column'],
            'sanitize_callback' => 'ultra_seven_sanitize_number'                   
        )
    );    
    $wp_customize->add_control( 'ultra_woo_column', array(
            'type'      => 'number',
            'label'     => esc_html__( 'Product Column', 'ultra-seven' ),
            'section'   => 'ultra_seven_woo_section',
        )
    ); 

    $wp_customize->add_setting( 'ultra_seven_product_perpage', array(
            'default'           => $default['ultra_seven_product_perpage'],
            'sanitize_callback' => 'ultra_seven_sanitize_number'                   
        )
    );    
    $wp_customize->add_control( 'ultra_seven_product_perpage', array(
            'type'      => 'number',
            'label'     => esc_html__( 'Product Per page', 'ultra-seven' ),
            'section'   => 'ultra_seven_woo_section',
        )
    ); 

    }   
}
add_action( 'customize_register', 'ultra_seven_custom_customize_register' );