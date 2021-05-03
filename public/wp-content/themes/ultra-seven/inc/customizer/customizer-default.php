<?php
/**
 * Default theme options.
 *
 * @package Ultra Seven
 * @since 1.0.8
 */

if (!function_exists('ultra_seven_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function ultra_seven_get_default_theme_options() {

    $defaults = array();
    
    $defaults['enable_site_preloader'] = 1;
    $defaults['ultra_seven_theme_color'] = '#e54e54';
    $defaults['ultra_seven_top_bg'] = '#000';
    $defaults['ultra_seven_top_text'] = '#fff';
    $defaults['ultra_seven_bottom_bg'] = '#fff';
    $defaults['ultra_seven_bottom_text'] = '#000';
    $defaults['ultra_seven_bottom_text_active'] = '#1e73be';
    $defaults['ultra_seven_wow_animation_option'] = 'show';
    $defaults['ultra_seven_breadcrumb_delimiter'] = '>>';
    $defaults['ultra_seven_webpage_layout'] = 'ultra-fullwidth';
    $defaults['ultra_seven_header_layouts'] = 'ultra-header-1';
    $defaults['ultra_seven_ticker_title'] = esc_html__('Trending Now', 'ultra-seven' );
    $defaults['ultra_seven_ticker_type'] = 'latest';
    $defaults['ultra_seven_ticker_cat'] = 0;
    $defaults['ultra_seven_ticker_count'] = 6;
    $defaults['ultra_seven_sider_layout'] = 'slider-1';
    $defaults['ultra_seven_slider_count'] = 4;
    $defaults['archive_page_sidebars_layout'] = 'rightsidebar';
    $defaults['archive_page_sidebars'] = 'default-sidebar';
    $defaults['ultra_archive_layout'] = 'full';
    $defaults['ultra_seven_archive_page_excerpts'] = 200;
    $defaults['ultra_seven_archive_read_more'] = esc_html__('Read More', 'ultra-seven' );
    $defaults['ultra_seven_topfooter_col'] = 4;
    $defaults['ultra_woo_column'] = 3;
    $defaults['ultra_seven_product_perpage'] = 9;

   

    // Pass through filter.
    $defaults = apply_filters('ultra_seven_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
