<?php
/*

Template Name:Home

*/

get_header(); 


/* Slider Section */
$slider_enable = get_theme_mod('ultra_seven_slider_show','show');
if($slider_enable == 'show'){
	get_template_part('layouts/home-layouts/ultra-main','slider');
}

/*============================================================================
*For Homepage Blocks
*=============================================================================
*/
$ultra_seven_homepage = get_theme_mod('ultra_seven_homepage');
$values = json_decode($ultra_seven_homepage);
if(!empty($values)):
$block = 0;
foreach( $values as $value){
	$block ++;
	$section_enable = $value->ultra_seven_enable_section;
	$sidebar_layout = $value->ultra_seven_sidebar_layout;
	$sidebar_area = $value->ultra_seven_sidebar_area;
	$section_area = $value->ultra_seven_section_area;
	if($section_enable == 'on'):
        ?>
		<section id="<?php echo 'ultra-block-'.esc_attr($block);?>" class="ultra-block <?php echo esc_attr($sidebar_layout);?> clear" >
			<?php 
			if($sidebar_layout != 'nosidebar' ){
				echo '<div class="ultra-container">';
				echo '<div class="primary">';
		    }

		    if(is_active_sidebar( $section_area )){
		    	dynamic_sidebar( $section_area );
		    }

		    if( $sidebar_layout != 'nosidebar' ){
		    	echo '</div>'; //Primary
		    	if(is_active_sidebar( $sidebar_area )){ 
		        ?>
				<div class="secondary widget-area" role="complementary">
					<?php dynamic_sidebar( $sidebar_area ); ?>
				</div><!-- .secondary -->
				<?php
		        }
			    echo '</div>'; //container
	        }
		    ?>
		</section>
		<?php
    endif;
	
}
endif;

get_footer();?>