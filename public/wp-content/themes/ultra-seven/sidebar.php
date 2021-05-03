<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPoperation
 * 
 * @subpackage Ultra Seven
 */

if(is_single() || ( is_page() && !is_front_page() )){

	$post_sidebarOld = get_post_meta($post->ID, 'ultra_seven_page_sidebar', true);

	$post_sidebar = get_post_meta($post->ID, 'ultra_sidebar_layout', true);
	$post_sidebar = !empty( $post_sidebar ) ? $post_sidebar : $post_sidebarOld;


	if($post_sidebar == 'default' || $post_sidebar == ''){
		$post_sidebar = get_theme_mod('post_page_sidebars_layout','rightsidebar');
	}

	
	$page_sidebar_old = get_post_meta(get_the_ID(),'ultra_seven_page_sidebar',true);
	$page_sidebar = get_post_meta(get_the_ID(),'ultra_sidebar',true);
	$page_sidebar = !empty($page_sidebar) ? $page_sidebar : $page_sidebar_old;

	if($page_sidebar == 0 || $page_sidebar == ''){
		$sidebar = get_theme_mod('post_page_sidebars','default-sidebar');
    }else{
    	$sidebar = $page_sidebar;
    }
}

if ( is_archive() || is_404() || is_search() || is_home() || is_author() ) {
    $post_sidebar = get_theme_mod('archive_page_sidebars_layout','rightsidebar');
    $sidebar = get_theme_mod('archive_page_sidebars','default-sidebar');
}


if ( class_exists('woocommerce') ) { 
	if(is_woocommerce() || is_shop() || is_cart() || is_checkout()){
		$post_sidebar = get_theme_mod('ultra_shop_sidebar_layout','rightsidebar');
		$sidebar = get_theme_mod('ultra_shop_sidebar','default-sidebar');
	}
}

          
if(empty($post_sidebar)){
	$post_sidebar = 'rightsidebar';
}

if ( $post_sidebar ==  'nosidebar' ) {
	return;
}

if(empty($sidebar)){
	$sidebar = 'default-sidebar';
}

if( ($post_sidebar == 'rightsidebar' || $post_sidebar == 'leftsidebar')  && is_active_sidebar($sidebar)){
	?>
		<aside class="widget-area secondary <?php echo esc_attr($post_sidebar);?>" role="complementary">
			<?php dynamic_sidebar( $sidebar ); ?>
		</aside><!-- #secondary -->
	<?php
}


