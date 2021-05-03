<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 *@package Ultra News
 * @copyright Copyright (C) 2019 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  
<?php 
if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
}
?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ultra-news' ); ?></a>
<?php 

$preloader = get_theme_mod('ultra_news_preloader_option','show');
$meta = get_post_meta(get_the_ID(),'ultra_page_header',true);
$header_layout = get_post_meta(get_the_ID(),'ultra_page_header',true);
$template_id = get_post_meta(get_the_ID(),'ultra_page_custom_header',true);

if($header_layout == 'default' || $header_layout == ''){
    $header_layout = get_theme_mod( 'ultra_seven_header_layouts','ultra-header-1' );
    $template_id = get_theme_mod('ultra_news_custom_header');
}
?>
<?php if( $preloader == 'show'): ?>
    <div id="loading13" class="ultra-seven-loader">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div id="page" class="site">
    <?php 

      echo '<div class="header-section">';
      if($header_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){
          echo '<div class="ultra-custom-header">';
          echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
          echo '</div>';
      }else{
          switch ($header_layout) {
          	case 'ultra-header-1':
          		get_template_part('layouts/header-layouts/layout','one');
          	break;

          	case 'ultra-header-2':
          		get_template_part('layouts/header-layouts/layout','two');
          	break; 
                    
          	default:
          		get_template_part('layouts/header-layouts/layout','one');
          	break;
          }
      }
      echo '</div>';
    ?>

	<div id="content" class="site-content">
