<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Ultra Seven
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ultra_seven_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	$ultra_site_layout = get_theme_mod('ultra_seven_webpage_layout','ultra-fullwidth');
	$classes[] = $ultra_site_layout;
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if(!is_front_page()){
		$classes[] = 'inner';
	}
	$ticker = get_theme_mod('ultra_seven_ticker_show','show');
	if($ticker == 'show'){
		$classes[] = 'has-ticker';
	}else{
		$classes[] = 'no-ticker';
	}

	return $classes;
}
add_filter( 'body_class', 'ultra_seven_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ultra_seven_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ultra_seven_pingback_header' );

/*===========================================================================================
* Ultra template Functions
**===========================================================================================
*/

/*--------------------------
* Ultra Site Brandings
*---------------------------
*/

if( !function_exists('ultra_seven_site_brandings') ){
	function ultra_seven_site_brandings(){
      ?>
		<div class="site-branding middle">
	        <?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->
      <?php
	}
}

/*--------------------------
* Ultra Social Icons
*---------------------------
*/

/*Social Icons */
if(!function_exists('ultra_seven_social_icons')){
	function ultra_seven_social_icons(){
		$fb = get_theme_mod('ultra_seven_Facebook');
		$twet = get_theme_mod('ultra_seven_Twitter');
		$linkedin = get_theme_mod('ultra_seven_Linkedin');
		$insta = get_theme_mod('ultra_seven_Instagram');
		$pin = get_theme_mod('ultra_seven_Pinterest');
		?>
		<div class="header-icons">
			<ul>
				<?php if($fb){?>
				<li><a href="<?php echo esc_url($fb)?>" title="<?php echo esc_attr__('Facebook','ultra-seven');?>"><i class="fa fa-facebook"></i></a></li>
				<?php }?>
				<?php if($twet){?>
				<li><a href="<?php echo esc_url($twet)?>" title="<?php echo esc_attr__('Twitter','ultra-seven');?>"><i class="fa fa-twitter"></i></a></li>
				<?php }?>
				<?php if($linkedin){?>
				<li><a href="<?php echo esc_url($linkedin)?>" title="<?php echo esc_attr__('LinkedIn','ultra-seven');?>"><i class="fa fa-linkedin"></i></a></li>
				<?php }?>
				<?php if($insta){?>
				<li><a href="<?php echo esc_url($insta)?>" title="<?php echo esc_attr__('Instagram','ultra-seven');?>"><i class="fa fa-instagram"></i></a></li>
				<?php }?>
				<?php if($pin){?>
				<li><a href="<?php echo esc_url($pin)?>" title="<?php echo esc_attr__('Pinterest','ultra-seven');?>"><i class="fa fa-pinterest"></i></a></li>
				<?php }?>														
			</ul>
		</div>
		<?php
	}
}



/*--------------------------
* Ultra Share Block
*---------------------------
*/
if( !function_exists('ultra_seven_share_block') ){
	function ultra_seven_share_block(){
		if(class_exists('Ultra_Companion')){
		?>
	        <div class="ultra-meta-share clearfix">
	            <div class="share">
	            	<i class="fa fa-share"></i>
		            <div class="ultra-share-icons">
		                <?php ultra_companion_social_share();?>
		            </div>
	            </div>
	        </div>		
		<?php
	    }
	}
}		

/*--------------------------
* Ultra header ticker
*---------------------------
*/

if( !function_exists('ultra_seven_header_ticker') ){
	function ultra_seven_header_ticker(){
		$ticker_enable = get_theme_mod('ultra_seven_ticker_show','show');
		$ticker_title = get_theme_mod('ultra_seven_ticker_title',esc_html__('Trending Now','ultra-seven'));
		if($ticker_enable == 'show'){
			wp_enqueue_style('lightslider');
			wp_enqueue_script('lightslider');
			echo '<div class="ticker-title">';
			echo '<i class="fa fa-bolt" aria-hidden="true"></i>';
			echo esc_html($ticker_title);
			echo '</div>';
			$ticker_type = get_theme_mod('ultra_seven_ticker_type','latest');
			$cat_ticker = get_theme_mod('ultra_seven_ticker_cat',0);
			$ticker_count = get_theme_mod('ultra_seven_ticker_count',6);

			$ultra_ticker_args = ultra_seven_query_args( $ticker_type, $ticker_count, $cat_ticker );
			$ultra_ticker_query = new WP_Query( $ultra_ticker_args );
			if( $ultra_ticker_query->have_posts() ) {
				echo '<ul class="ultra-ticker cS-hidden">';
				while( $ultra_ticker_query->have_posts() ) {
					$ultra_ticker_query->the_post();
					echo '<li><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></li>';
				}
				echo '</ul>';
			}
			wp_reset_postdata();		
		}   
	}
}

/*--------------------------
* Ultra Search
*---------------------------
*/

if( !function_exists('ultra_seven_search') ){
	function ultra_seven_search(){
		$search_enable = get_theme_mod('ultra_seven_search_enable','show');
		if($search_enable == 'show'){
			echo '<div class="search-icon" tabindex="0"><i class="fa fa-search"></i></div>';
        	echo '<div class="search-container">';
            echo get_search_form();
		    echo '</div>';
	    }
	}
}


