<?php
wp_enqueue_style('lightslider');
wp_enqueue_script('lightslider');
$ultar_home_slider_layout = get_theme_mod('ultra_seven_sider_layout','slider-1');
$ultra_cat_slider = get_theme_mod('ultra_seven_slider_cat', 0 );
$ultra_slider_count = get_theme_mod('ultra_seven_slider_count',4);
$ultra_featured_enable = get_theme_mod('ultra_seven_feature_section_enable','show');
$ultra_featured_posts_cat = get_theme_mod('ultra_seven_feature_cat',0);
$ultra_seven_feature_cat_offset = get_theme_mod('ultra_seven_feature_cat_offset',0);

if($ultra_featured_enable == 'show'){
	$slider_width = '';
}else{
	$slider_width = 'full-width';
}
?>

<div class="ultra-main-slider clearfix <?php echo esc_attr($ultar_home_slider_layout).' '.esc_attr($slider_width);?>">
	<?php 
	if($ultar_home_slider_layout=='slider-2'){
    	echo '<div class="ultra-container">';
    }	
	?>
		<div class="slider-section">
			<?php
				$ultra_seven_slider_args = ultra_seven_query_args( 'category', $ultra_slider_count, $ultra_cat_slider );
	            $ultra_seven_slider_query = new WP_Query( $ultra_seven_slider_args );
	            if( $ultra_seven_slider_query->have_posts() ) {
				    echo '<ul class="ultraSlider cS-hidden">';
		            while( $ultra_seven_slider_query->have_posts() ) {
			          $ultra_seven_slider_query->the_post();
			          $image_id = get_post_thumbnail_id();
	                  if($ultra_featured_enable == 'show' && $ultar_home_slider_layout=='slider-1') {
	                       $image_path = wp_get_attachment_image_src( $image_id, 'ultra-slider1-left', true );
	                   }elseif($ultra_featured_enable == 'show' && $ultar_home_slider_layout=='slider-2') {
	                       $image_path = wp_get_attachment_image_src( $image_id, 'ultra-slider2-left', true );
	                   }elseif($ultra_featured_enable == 'hide'){
	                   	  $image_path = wp_get_attachment_image_src( $image_id, 'ultra-image-1400x840', true );
	                   }									
			           $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			           if( has_post_thumbnail() ) { ?>
	   						<li class="slide">
								<a class="slider-img thumb-zoom" href="<?php the_permalink(); ?>">
	                                <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>">
	                            </a>
								<div class="slider-caption">
									<?php do_action( 'ultra_seven_post_cat_or_tag_lists' ); ?>
									<h3 class="featured-large-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="post-meta">
	                                    <?php 
	                                        do_action( 'ultra_seven_post_meta' );
	                                    ?>
	                                </div>
								</div>
							</li>
							<?php
						}
					}
					wp_reset_postdata();
	                echo '</ul>';
	            }       
            ?>
		</div><!-- .slider-section -->
		<?php if($ultra_featured_enable == 'show'):?>
		<div class="featured-section">
			<div class="feature-post-wrap">
				<?php
				if($ultar_home_slider_layout=='slider-1'){
					$post_perpage = 4;
					$first_class = '';
				}else{
					$post_perpage = 3;
					$first_class = 'feature-large';
				}
				$ultra_seven_featured_args = ultra_seven_query_args( 'category', $post_perpage, $ultra_featured_posts_cat,$ultra_seven_feature_cat_offset );
	            $ultra_seven_featured_query = new WP_Query( $ultra_seven_featured_args );
	            if( $ultra_seven_featured_query->have_posts() ) {
	            	$count = 0;
		            while( $ultra_seven_featured_query->have_posts() ) {
		              $count++;	
			          $ultra_seven_featured_query->the_post();
			          $image_id = get_post_thumbnail_id();
	                  if( $ultar_home_slider_layout=='slider-2' && $count==1 ) {
	                       $image_path = wp_get_attachment_image_src( $image_id, 'ultra-slider2-right-top', true );
	                   }elseif($ultar_home_slider_layout=='slider-2' && $count>1) {
	                       $image_path = wp_get_attachment_image_src( $image_id, 'ultra-slider2-right-buttom', true );
	                   }elseif($ultar_home_slider_layout=='slider-1'){
	                   	   $image_path = wp_get_attachment_image_src( $image_id, 'ultra-slider1-right', true );
	                   }									
			           $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			           if( has_post_thumbnail() ) { ?>
			           <div class="feature-post <?php if($count==1){ echo esc_attr($first_class); }?>">
							<a class="slider-img thumb-zoom" href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>">
                            </a>
							<div class="slider-caption">
								<?php do_action( 'ultra_seven_post_cat_or_tag_lists' ); ?>
								<h3 class="featured-large-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="post-meta">
                                    <?php 
                                    if($ultar_home_slider_layout == 'slider-1'){
                                        do_action( 'ultra_seven_post_meta' );
                                    }    
                                    ?>
                                </div>
							</div>	                            				           	
			           </div>
			           <?php     
			           }
			        }
			        wp_reset_postdata();
			    }                    
				?>
			</div>
		</div><!-- .featured-section -->
	    <?php endif; 
	if($ultar_home_slider_layout=='slider-2'){
    	echo '</div>';
    }	
	?>
</div>