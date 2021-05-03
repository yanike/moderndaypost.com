<?php 

/* Header Layout Three */

?>
<?php
$top_header_enable = get_theme_mod('ultra_seven_top_header_show','show');
$top_menu_enable = get_theme_mod('ultra_seven_top_menu','show');
$top_social_enable = get_theme_mod('ultra_seven_top_icons','show');
$current_date_enable = get_theme_mod('ultra_seven_top_date','show');
if($top_header_enable=='show'){
?>
	<div class="ultra-top-header top-header-three">
		<div class="ultra-container">
			<div class="top-wrap clear">
			    <?php 
		    	if( $current_date_enable == 'show' ){ ?>
			        <div class="ultra-date">
			            <i class="fa fa-clock-o"></i>
			            <span><?php echo date_i18n("l, F j");// WPCS: XSS OK.?></span>
			        </div><!-- /.today-date --> 
	            <?php } 
				if($top_menu_enable=='show'):?>
				<div class="top-left">
	                <?php
	                    wp_nav_menu( array(
	                        'theme_location' => 'top-menu',
	                        'container' =>'',
	                        'menu_class' => 'nav top-menu',
	                        'fallback_cb' => 'wp_page_menu',
	                        'depth'	=> -1
	                    ) );
	                ?>				
				</div>
			    <?php 
			      endif;
			      if($top_social_enable == 'show'):
	            ?>
				<div class="top-right">
					<?php ultra_seven_social_icons(); ?>
				</div>
			    <?php endif;?>
			</div>
		</div>
	</div>
<?php }?>
<header id="masthead" class="site-header layout-three">
	
	<div class="middle-block-wrap">
        <div class="ultra-logo clear">
        	<div class="ultra-container">	
        		<?php ultra_seven_site_brandings(); ?>
        	</div>
        </div>
        <div class="ultra-menu clear">
        	<div class="ultra-container clearfix">
	        	<div class="nav-search-wrap no-side-menu">
	        		<div class="sticky-cont clearfix">
			        	<div class="sticky-logo">
                            <?php the_custom_logo(); ?>
			        	</div>
						
						<nav id="site-navigation" class="main-navigation middle">
							<?php
							    ultra_seven_home_icon();
								wp_nav_menu( array(
									'theme_location' => 'main-menu',
				                    'container' =>'',
				                    'menu_class' => 'nav main-menu',
				                    'fallback_cb' => 'wp_page_menu'
								) );
							?>
						</nav><!-- #site-navigation -->

						<div class="ultra-search middle">
			               <?php 
			               $cart_enable = get_theme_mod('ultra_seven_cart_enable','show');
			               if ( class_exists('woocommerce') && $cart_enable == 'show' ) { ?>
			               	<div class="ultra-shopping-cart">
							<?php
			                    ultra_seven_header_cart();
					            the_widget( 'WC_Widget_Cart', 'title='.__("Cart Items","ultra-seven") ); 
							?>
						    </div>
						    <?php } ?>
						    <?php ultra_seven_search(); ?>
						</div>
				    </div>
				</div>
			</div>
	    </div>
    </div><!-- .middle-block -->
   
   <?php do_action('ultra_seven_mobile_menu'); ?>
   
</header><!-- #masthead -->