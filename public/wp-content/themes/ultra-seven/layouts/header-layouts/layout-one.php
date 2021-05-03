<?php 

/* Header Layout Two */

?>
<?php
$top_header_enable = get_theme_mod('ultra_seven_top_header_show','show');
$top_menu_enable = get_theme_mod('ultra_seven_top_menu','show');
$top_social_enable = get_theme_mod('ultra_seven_top_icons','show');
$current_date_enable = get_theme_mod('ultra_seven_top_date','show');
if($top_header_enable == 'show'){
?>
<div class="ultra-top-header clear">
	<div class="ultra-container">
		<div class="top-wrap clear">
            <?php
	    	if( $current_date_enable == 'show' ){ ?>
		        <div class="ultra-date">
		            <i class="fa fa-clock-o"></i>
		            <span><?php echo date_i18n("l, F j");// WPCS: XSS OK.?></span>
		        </div><!-- /.today-date --> 
            <?php } ?>
			<div class="top-left">
            <?php
            if($top_menu_enable == 'show'):
                wp_nav_menu( array(
                    'theme_location' => 'top-menu',
                    'container' =>'',
                    'menu_class' => 'nav top-menu',
                    'fallback_cb' => 'wp_page_menu',
                    'depth'	=> -1
                ) );
            endif;
            ?>				
			</div>
		    <?php 
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
<header id="masthead" class="site-header layout-two">	
	<div class="middle-block-wrap clear">
		<div class="ultra-container clearfix">
        <?php ultra_seven_site_brandings(); ?>

        <?php 
        if(is_active_sidebar('header-banner') ):
        ?>
			<div class="ultra-header-banner">
              <?php dynamic_sidebar('header-banner');?>
			</div>
		<?php
	    endif;
		?>
	</div>
    </div><!-- .middle-block -->
    
    
    <?php do_action('ultra_seven_mobile_menu'); ?>

    

    <div class="nav-search-wrap clear no-side-menu">
    	<div class="ultra-container clearfix">
		
    		<div class="right-nav-search">
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
	</div><!-- .menu-block -->	
	<?php 
    $ticker_enable = get_theme_mod('ultra_seven_ticker_show','show');
    if($ticker_enable == 'show'){
    ?>  
    <div  class="ticker-block clear">
		<div class="ultra-container">
			<div class="ticker">
				<?php ultra_seven_header_ticker();?>
			</div>
		</div>    	
    </div>
    <?php } ?>
</header><!-- #masthead -->	

