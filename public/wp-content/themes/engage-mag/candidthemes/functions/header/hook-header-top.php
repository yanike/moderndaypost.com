<?php
/**
 * Header Hook Element.
 *
 * @package Engage Mag
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!function_exists('engage_mag_before_top_bar')) {
    /**
     * Add divs to wrap top bar
     *
     * @since 1.0.0
     */
    function engage_mag_before_top_bar()
    {
        ?>
        <div class="top-bar">
        <a href="#" class="ct-show-hide-top"> <i class="fa fa-chevron-down"></i> </a>
        <div class="container-inner clearfix">

        <?php
    }
}
add_action('engage_mag_top_bar', 'engage_mag_before_top_bar', 5);

if (!function_exists('engage_mag_top_left_start')) {
    /**
     * Add divs to wrap top left bar
     *
     * @since 1.0.0
     */
    function engage_mag_top_left_start()
    {
        ?>
    <div class="top-left-col clearfix">

        <?php
    }
}
add_action('engage_mag_top_bar', 'engage_mag_top_left_start', 10);

if (!function_exists('engage_mag_top_social_menu')) {
    /**
     * Add social menu on top bar
     *
     * @since 1.0.0
     */
    function engage_mag_top_social_menu()
    {
        global $engage_mag_theme_options;

        //Check if social menu is enabled from customizer
        if (has_nav_menu('social-menu') && ($engage_mag_theme_options['engage-mag-enable-top-header-social'] == 1)) :
            ?>
            <div class="engage-mag-social-top">
                <div class="menu-social-container">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'social-menu',
                        'menu_id' => 'menu-social-1',
                        'container' => 'ul',
                        'menu_class' => 'engage-mag-menu-social'
                    ));
                    ?>
                </div>
            </div> <!-- .engage-mag-social-top -->

        <?php
        endif; //$engage_mag_theme_options['engage-mag-enable-top-header-social']
    }
}
add_action('engage_mag_top_bar', 'engage_mag_top_social_menu', 40);


if (!function_exists('engage_mag_top_date')) {
    /**
     * Add date on top bar
     *
     * @since 1.0.0
     */
    function engage_mag_top_date()
    {
        global $engage_mag_theme_options;

        //Check if secondary menu is enabled from customizer and has menu
        if ($engage_mag_theme_options['engage-mag-enable-top-header-date'] == 1) :
            $engage_date_format = $engage_mag_theme_options['engage-mag-top-header-date-format'];

            ?>

            <div class="ct-clock float-left">
                <div id="ct-date">
                    <?php
                    if($engage_date_format == 'default-date'){
                        echo date_i18n(__('l, F d, Y','engage-mag'));
                    }else{
                        echo date(get_option('date_format'));
                    }
                    ?>
                </div>
            </div>

        <?php
        endif; // has_nav_menu && $grip_theme_options['grip-enable-top-header-menu']
    }
}
add_action('engage_mag_top_bar', 'engage_mag_top_date', 20);


if (!function_exists('engage_mag_after_top_bar')) {
    /**
     * Add ending divs on top bar
     *
     * @since 1.0.0
     */
    function engage_mag_after_top_bar()
    {
        ?>
        </div> <!-- .container-inner -->
        </div> <!-- .top-bar -->

        <?php
    }
}
add_action('engage_mag_top_bar', 'engage_mag_after_top_bar', 50);

if (!function_exists('engage_mag_top_header_right_start')) {
    /**
     * Add container start for top bar right section
     *
     * @since 1.0.0
     */
    function engage_mag_top_header_right_start()
    {
        ?>
        <div class="top-right-col clearfix">
        <?php
    }
}
add_action('engage_mag_top_bar', 'engage_mag_top_header_right_start', 35);

if (!function_exists('engage_mag_top_header_right_end')) {
    /**
     * Add container end for top bar right section
     *
     * @since 1.0.0
     */
    function engage_mag_top_header_right_end()
    {
        ?>
        </div> <!-- .top-right-col -->
        <?php
    }
}
add_action('engage_mag_top_bar', 'engage_mag_top_header_right_end', 45);

if (!function_exists('engage_mag_trending_news')) {
    /**
     * Add trending news section
     *
     * @since 1.0.0
     */
    function engage_mag_trending_news()
    {
        global $engage_mag_theme_options;

        //Check if secondary menu is enabled from customizer and has menu
        if (has_nav_menu('top-menu') && ($engage_mag_theme_options['engage-mag-enable-top-header-menu'] == 1)) :
            ?>

                <nav class="float-left">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'top-menu',
                        'menu_id' => 'secondary-menu',
                        'container' => 'ul',
                        'menu_class' => 'top-menu',
                        'depth' => 1
                    ));
                    ?>
                </nav>
        <?php
        endif;
    }
}
add_action('engage_mag_top_bar', 'engage_mag_trending_news', 25);

if (!function_exists('engage_mag_top_left_end')) {
    /**
     * Add closing divs to wrap top left bar
     *
     * @since 1.0.0
     */
    function engage_mag_top_left_end()
    {
        ?>

        </div>

        <?php
    }
}
add_action('engage_mag_top_bar', 'engage_mag_top_left_end', 30);