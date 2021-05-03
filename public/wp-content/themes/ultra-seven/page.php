<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ultra-seven
 */

get_header();
global $post;

$post_sidebarOld = get_post_meta($post->ID, 'ultra_seven_page_sidebar', true);

$post_sidebar = get_post_meta($post->ID, 'ultra_sidebar_layout', true);
$post_sidebar = !empty( $post_sidebar ) ? $post_sidebar : $post_sidebarOld;
if($post_sidebar =='defaultsidebar' || $post_sidebar == ''){
	$post_sidebar = get_theme_mod('post_page_sidebars_layout','rightsidebar');
}

if( class_exists( 'woocommerce' ) ){
	if(is_woocommerce() || is_cart() || is_checkout()){
		$post_sidebar = get_theme_mod('ultra_shop_sidebar_layout','rightsidebar');
	}
}

if($post_sidebar != 'nosidebar'){
	$class='is-sidebar';
}else{
	$class='';
}
?>
<div class="sidebar <?php echo esc_attr($post_sidebar).' '.esc_attr($class)?>">
	<div class="ultra-container">
		<?php ultra_seven_breadcrumbs();?>
		<div class="primary content-area">
			<main id="main" class="site-main">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
