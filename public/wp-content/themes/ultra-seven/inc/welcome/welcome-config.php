<?php
	/**
	 * Welcome Page Initiation
	*/

	include get_template_directory() . '/inc/welcome/welcome.php';

	/** Plugins **/
	$plugins = array(
		// *** Companion Plugins
		'companion_plugins' => array(),

		// *** Required Plugins
		'required_plugins' => array(
			'operation-demo-importer' => array(
				'slug' => 'operation-demo-importer',
				'name' => esc_html__('Operation Demo Importer', 'ultra-seven'),
				'filename' =>'operation-demo-importer.php',
				'host_type' => 'wordpress', // Use either bundled, remote, wordpress
				'class' => 'WOPDI',
				'info' => esc_html__('Adds ability to theme with one click demo import feature, which will help to publish your websies within few minutes.', 'ultra-seven'),
			),
		
		),

		// *** Recommended Plugins
		'recommended_plugins' => array(
			// Free Plugins
			'free_plugins' => array(

				'ultra-companion' => array(
					'slug' 		=> 'ultra-companion',
					'filename' 	=> 'ultra-companion.php',
					'class' 	=> 'Ultra_Companion'
				),

				
			),

			// Pro Plugins
			'pro_plugins' => array(
			)
		),
	);

	$strings = array(
		// Welcome Page General Texts
		'welcome_menu_text' 		=> esc_html__( 'Ultra Seven Setup', 'ultra-seven' ),
		'theme_short_description' 	=> esc_html__( 'Fast &nbsp; | &nbsp; Light  &nbsp; | &nbsp; Powerful', 'ultra-seven' ),

		// Plugin Action Texts
		'install_n_activate' 	=> esc_html__('Install and Activate', 'ultra-seven'),
		'deactivate' 			=> esc_html__('Deactivate', 'ultra-seven'),
		'activate' 				=> esc_html__('Activate', 'ultra-seven'),

		// Recommended Plugins Section
		'pro_plugin_title' 			=> esc_html__( 'Pro Plugins', 'ultra-seven' ),
		'pro_plugin_description' 	=> esc_html__( 'Take Advantage of some of our Premium Plugins.', 'ultra-seven' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'ultra-seven' ),
		'free_plugin_description' 	=> esc_html__( 'These Free Plugins might be handy for you.', 'ultra-seven' ),

		// Demo Actions
		'activate_btn' 		=> esc_html__('Activate', 'ultra-seven'),
		'installed_btn' 	=> esc_html__('Activated', 'ultra-seven'),
		'demo_installing' 	=> esc_html__('Installing Demo', 'ultra-seven'),
		'demo_installed' 	=> esc_html__('Demo Installed', 'ultra-seven'),
		'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'ultra-seven'),
		'doc_link'			=> 'https://wpoperation.com/wp-documentation/ultra-seven/',

		//free vs pro
		'free_vs_pro' => array(

            'features' => array(
                    'Preloader Options' => array('Simple','18+ Customizable'),
                    'Beautiful Mega Menu' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Post Review System' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Live AJAX search' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Powerful AJAX elements'=> array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Weather Information Options'=> array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Theme Option Panel'=> array('Customizer Based','Powerful Theme Panel'),
                    'Infinite Scroll Posts'=> array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'One Click Demo' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Typography Style & Colors' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Multiple Header Options' => array('2','3'),
                    'Lazy Load Images' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Logo and title customization' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'WooCommerce Compatibility' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Category Color Options' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Advertisements' => array('Simple','Advanced'),
                    'Author Biography' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'YouTube Video Playlist' => array('Simple','Powerful'),
                    'Multiple Home Layout' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Social Sharings' => array('yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Display Related Posts' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Footer Widgets Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Hide Theme Credit Link' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Responsive Layout' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Translations Ready' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'RTL Language Ready' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'SEO' => array('Optimized', 'Optimized'),
                    'Support' => array('Yes', 'High Priority Dedicated Support')
                ),
        ),


	);

	/**
	 * Initiating Welcome Page
	*/
	$my_theme_wc_page = new Ultra_Seven_Welcome( $plugins, $strings );
