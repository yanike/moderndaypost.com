<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wpoperation
 * @subpackage ultra Seven
 * @since 1.0.0
 */

get_header(); 
?>
	
<div class="ultra-single-content">
	<?php 
		do_action( 'ultra_seven_before_body_content' );

		while ( have_posts() ) : 
			the_post();
			$post_id = get_the_ID();

			$sidebar_layoutOld = get_post_meta($post->ID, 'ultra_seven_page_sidebar', true);

			$sidebar_layout = get_post_meta($post->ID, 'ultra_sidebar_layout', true);
			$sidebar_layout = !empty( $sidebar_layout ) ? $sidebar_layout : $sidebar_layoutOld;
			if($sidebar_layout =='defaultsidebar' || $sidebar_layout == ''){
				$sidebar_layout = get_theme_mod('post_page_sidebars_layout','rightsidebar');
			}
			
			if($sidebar_layout != 'nosidebar'){
				$class='is-sidebar';
			}else{
				$class='';
			}
			echo '<div class="layout2 '.esc_attr($sidebar_layout).' '.esc_attr($class).'">';
		    get_template_part( 'template-parts/single/single', 'layout1' );
            echo '</div>';
			/**
			 * Set post view
			 */
			if(class_exists('Ultra_Companion')){
				setPostViews( get_the_ID() );
            }
		endwhile; // End of the loop.

		do_action( 'ultra_seven_after_body_content' );
	?>
</div><!-- .ultra-single-content -->	

<?php
get_footer();
