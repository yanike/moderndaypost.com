<?php

/*=============================================================================================*/
/**
 * Function to display post categories or tags lists
 *
 * @since 1.0.0
 */
add_action( 'ultra_seven_post_cat_or_tag_lists', 'ultra_seven_post_cat_or_tag_lists_cb' );
if( ! function_exists( 'ultra_seven_post_cat_or_tag_lists_cb' ) ) :
    function ultra_seven_post_cat_or_tag_lists_cb() {
        global $post;

        if ( 'post' === get_post_type() ) {
            global $post;
            $categories = get_the_category();
            $separator = ' ';
            $output = '';
            if( $categories ) {
                $output .= '<span class="cat-wrap">';
                foreach( $categories as $category ) {
                    $cat_color = get_theme_mod('ultra_seven_cat_color_'.$category->term_id, '#e54e54');
                    $output .= '<span class="cat-links" style="background-color:'.$cat_color.'">';
                    $output .= '<a href="'.get_category_link( $category->term_id ).'" class="cat-' . $category->term_id . '" rel="category tag">'.$category->cat_name.'</a>';                   
                    $output .= '</span>';
                }
                $output .='</span>';
                echo trim( $output, $separator );// WPCS: XSS OK.
            }

        }
    }
endif;

/*==============================================================================================*/
/**
 * Post format icon for homepage blocks
 *
 * @since 1.0.0
 */
add_action( 'ultra_seven_post_format_icon', 'ultra_seven_post_format_icon_cb' );

if( ! function_exists( 'ultra_seven_post_format_icon_cb' ) ) {
    function ultra_seven_post_format_icon_cb() {
        global $post;
        $post_id = $post->ID;
        $post_format = get_post_format( $post_id );
        if( $post_format == 'video' ) {
            echo '<span class="post-format-icon video">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g>
                <g>
                    <g>
                        <path d="M256,0C114.833,0,0,114.844,0,256s114.833,256,256,256s256-114.844,256-256S397.167,0,256,0z M256,490.667     C126.604,490.667,21.333,385.396,21.333,256S126.604,21.333,256,21.333S490.667,126.604,490.667,256S385.396,490.667,256,490.667     z" data-original="#fff" class="active-path"/>
                        <path d="M357.771,247.031l-149.333-96c-3.271-2.135-7.5-2.25-10.875-0.396C194.125,152.51,192,156.094,192,160v192     c0,3.906,2.125,7.49,5.563,9.365c1.583,0.865,3.354,1.302,5.104,1.302c2,0,4.021-0.563,5.771-1.698l149.333-96     c3.042-1.958,4.896-5.344,4.896-8.969S360.813,248.99,357.771,247.031z M213.333,332.458V179.542L332.271,256L213.333,332.458z" data-original="#fff" class="active-path" />
                    </g>
                </g>
            </g></g> </svg>
            </span>';
        } elseif( $post_format == 'audio' ) {
            echo '<span class="post-format-icon audio">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 469.333 469.333" style="enable-background:new 0 0 469.333 469.333;" xml:space="preserve"><g><g>
                <g>
                    <g>
                        <path d="M206.885,43.544c-3.875-1.698-8.448-0.896-11.542,2.042L85.49,149.336H10.667C4.771,149.336,0,154.107,0,160.002v149.333     c0,5.896,4.771,10.667,10.667,10.667H85.49l109.854,103.75c2.021,1.917,4.656,2.917,7.323,2.917c1.427,0,2.865-0.281,4.219-0.875     c3.917-1.677,6.448-5.531,6.448-9.792V53.336C213.333,49.075,210.802,45.221,206.885,43.544z M192,391.252l-94.948-89.667     c-1.979-1.875-4.604-2.917-7.323-2.917H21.333v-128h68.396c2.719,0,5.344-1.042,7.323-2.917L192,78.086V391.252z" data-original="#000000" class="active-path"/>
                        <path d="M372.063,44.7c-4.813-3.469-11.469-2.385-14.896,2.375c-3.458,4.771-2.396,11.438,2.375,14.896     C414.938,102.096,448,166.659,448,234.669c0,68.01-33.063,132.573-88.458,172.698c-4.771,3.458-5.833,10.125-2.375,14.896     c2.083,2.875,5.344,4.406,8.646,4.406c2.167,0,4.354-0.656,6.25-2.031c60.906-44.125,97.271-115.146,97.271-189.969     C469.333,159.846,432.969,88.825,372.063,44.7z" data-original="#000000" class="active-path"/>
                        <path d="M314.01,108.304c-4.948-3.125-11.563-1.635-14.708,3.354c-3.135,4.979-1.635,11.563,3.354,14.708     c37.573,23.646,60.01,64.135,60.01,108.302c0,44.167-22.438,84.656-60.01,108.302c-4.99,3.146-6.49,9.729-3.354,14.708     c2.031,3.229,5.5,4.99,9.042,4.99c1.938,0,3.906-0.531,5.667-1.635C357.833,333.45,384,286.221,384,234.669     C384,183.117,357.833,135.888,314.01,108.304z" data-original="#000000" class="active-path"/>
                        <path d="M272.75,183.45c-4.729-3.531-11.406-2.531-14.927,2.177c-3.521,4.729-2.542,11.417,2.177,14.927     c11.021,8.208,17.333,20.635,17.333,34.115c0,13.479-6.313,25.906-17.333,34.115c-4.719,3.51-5.698,10.198-2.177,14.927     c2.094,2.813,5.302,4.292,8.563,4.292c2.208,0,4.448-0.688,6.365-2.115c16.469-12.26,25.917-30.937,25.917-51.219     S289.219,195.711,272.75,183.45z" data-original="#000000" class="active-path"/>
                    </g>
                </g>
            </g></g> </svg>
            </span>';
        } elseif( $post_format == 'gallery' ) {
            echo '<span class="post-format-icon gallery">
            <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 488.455 488.455" viewBox="0 0 488.455 488.455"><g><path d="m244.236 137.374c-67.335 0-122.118 54.783-122.118 122.118s54.784 122.118 122.118 122.118 122.118-54.783 122.118-122.118-54.783-122.118-122.118-122.118zm0 213.706c-50.505 0-91.588-41.083-91.588-91.588s41.083-91.588 91.588-91.588 91.588 41.083 91.588 91.588-41.083 91.588-91.588 91.588z" data-original="#000000" class="active-path"/><path d="m488.292 137.292c-.015-25.214-20.572-45.733-45.794-45.733h-66.888l-26.326-52.603c-2.594-5.171-7.871-8.434-13.655-8.434h-183.176c-5.784 0-11.076 3.263-13.655 8.434l-26.296 52.618-66.782.089c-25.208.045-45.72 20.58-45.72 45.779v274.714c0 25.244 20.542 45.778 45.794 45.778h396.867c25.252 0 45.794-20.55 45.794-45.808zm-45.63 290.122h-396.867c-8.422 0-15.265-6.84-15.265-15.259v-274.714c0-8.405 6.842-15.244 15.235-15.259l76.204-.104c5.784-.015 11.061-3.278 13.64-8.434l26.281-52.604h164.304l26.326 52.603c2.594 5.171 7.871 8.434 13.655 8.434h76.324c8.408 0 15.444 6.84 15.444 15.244v274.819c-.001 8.419-6.859 15.274-15.281 15.274z" data-original="#000000" class="active-path"/></g> </svg>
            </span>';
        } else { }
    }    
}

/*==============================================================================================*/
/**
 * Homepage Image Overlay
 *
 * @since 1.0.0
 */
add_action('ultra_image_overlay','ultra_seven_image_overlay');

if( !function_exists( 'ultra_seven_image_overlay' ) ){
    function ultra_seven_image_overlay(){
        $overlay = true;
        if($overlay == true){
            echo '<div class="image-overlay"></div>';
        }else{

        }
    }
}


/*===========================================================================================================*/
/**
 * Get list of tags for individual posts
 */
add_action( 'ultra_seven_post_tag_lists', 'ultra_seven_post_tag_lists_hook' );
if( ! function_exists( 'ultra_seven_post_tag_lists_hook' ) ) {
	function ultra_seven_post_tag_lists_hook() {
		$post_tags_list = get_the_tag_list( '', '' );
		if ( $post_tags_list) {
            /* translators: tag */
			printf( '<span class="post-tags-links">' . esc_html( '%1$s') . '</span>', $post_tags_list ); // WPCS: XSS OK.
		}
	}
}



/*===========================================================================================================*/
/**
 * Related posts section
 *
 * @since 1.0.0
 */
add_action( 'ultra_seven_related_posts', 'ultra_seven_related_posts_hook' );

if( !function_exists( 'ultra_seven_related_posts_hook' ) ):
    function ultra_seven_related_posts_hook() {
        $ultra_seven_related_posts_option = get_theme_mod('ultra_seven_post_relatedposts','show');
        $ultra_seven_related_post_title = get_theme_mod( 'ultra_seven_related_title', esc_html__( 'Related Articles', 'ultra-seven' ) );

        if( $ultra_seven_related_posts_option == 'show' ) {
            wp_enqueue_style('lightslider');
            wp_enqueue_script('lightslider');
            ?>          
            <div class="ultra-related-wrapper slide">
                <div class="related-header clearfix">
                <h4 class="related-title"><?php echo esc_html( $ultra_seven_related_post_title ); ?></h4>
                <div class="slide-action">
                   <div class="ultra-lSPrev"></div>
                   <div class="ultra-lSNext"></div>
                </div>
                </div>
        <?php
                wp_reset_postdata();
                global $post;
                if( empty( $post ) ) {
                    $post_id = '';
                } else {
                    $post_id = $post->ID;
                }
                // Define related post arguments
                $related_args = array(
                    'no_found_rows'            => true,
                    'update_post_meta_cache'   => false,
                    'update_post_term_cache'   => false,
                    'ignore_sticky_posts'      => 1,
                    'orderby'                  => 'rand',
                    'post__not_in'             => array( $post_id ),
                    'posts_per_page'           => 5
                );

                $categories = get_the_category( $post_id );
                if ( $categories ) {
                    $category_ids = array();
                    foreach( $categories as $individual_category ) {
                        $category_ids[] = $individual_category->term_id;
                    }
                    $related_args['category__in'] = $category_ids;
                }

                $related_query = new WP_Query( $related_args );
  
                if( $related_query->have_posts() ) {
                    echo '<div class="related-posts-wrapper cS-hidden clearfix">';
                    while( $related_query->have_posts() ) {
                        $related_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $image_path = wp_get_attachment_image_src( $image_id, 'ultra-medium-image', true );
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                ?>
                        <div class="single-post">
                            <div class="post-thumb">
                                <?php if( has_post_thumbnail() ) { ?>
                                    <a class="thumb-zoom" href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    </a>
                                <?php } ?>
                                <?php do_action( 'ultra_seven_post_cat_or_tag_lists' ); ?>
                            </div>
                            <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div><!--. single-post -->
                <?php
                    }
                    echo '</div>';
                }
                wp_reset_postdata();
        ?>
            </div><!-- .ultra-related-wrapper -->
<?php
        }
    }
endif;



/*===========================================================================================================*/
/**
 * Posted on function for blocks
 */
if ( ! function_exists( 'ultra_seven_posts_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ultra_seven_posts_posted_on() {


	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_date() . '</a>';
	$byline = sprintf(
        /* translators: author link */
		esc_html( '%s'),
		'<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
		echo '<span class="post-author">'. wp_kses_post($byline) .'</span>';

		echo '<span class="posted-on">'. wp_kses_post($posted_on) .'</span>';

}
endif;

add_action( 'ultra_seven_post_meta', 'ultra_seven_posts_posted_on' );


/*===========================================================================================================*/
/**
 * Ultra Footer hooks
 */

if( !function_exists('ultra_seven_top_footer') ){
    /**
     * Display the theme footer widgets
     * @since  1.0.0
     * @return void
     */
    function ultra_seven_top_footer(){
        $top_footer_enable = get_theme_mod('ultra_seven_topfooter_show','show');
        if($top_footer_enable=='show'){
            $widget_columns = get_theme_mod('ultra_seven_topfooter_col',4);
            if ( $widget_columns > 0 ) : ?>
                <div class="footer-widgets-wrap col-<?php echo intval( $widget_columns ); ?> clearfix">              
                    <div class="ultra-container clearfix">
                        <?php $i = 0; while ( $i < 4 ) : $i++; ?>     
                            <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>       
                                <div class="block footer-widget wow fadeInRight">
                                    <?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
                                </div>      
                            <?php endif; ?>     
                        <?php endwhile; ?>
                    </div>
                </div><!-- .footer-widgets  -->
            <?php endif;
        }
    }
}
add_action('ultra_seven_footer','ultra_seven_top_footer',0);


if ( ! function_exists( 'ultra_seven_bottom_footer' ) ) {
    /**
     * Display the theme credit/button footer
     * @since  1.0.0
     * @return void
     */
    function ultra_seven_bottom_footer() {
       $footer_copyright = get_theme_mod('ultra_seven_footer_text');
       $footer_menu = get_theme_mod('ultra_seven_footer_menu','show');
       if($footer_menu=='show'){
        $class = '';
       }else{
        $class = 'text-center';
       }
        ?>
            <div class="ultra-bottom-footer <?php echo esc_attr($class);?>"> 
                <div class="ultra-container clearfix">
                    <div class="footer-left wow fadeInUp">
                        <?php if( !empty( $footer_copyright ) ) { ?>
                            <?php echo wp_kses_post($footer_copyright); ?>   
                        <?php }else{
                            printf(wp_kses_post('&copy; %1$s %2$s'), esc_html(date("Y")), esc_html(get_bloginfo('name')));
                        }
                        $theme_ob = wp_get_theme();
                        /* translators: */
                            printf( esc_html__( '%1$s | WordPress Theme  %2$s', 'ultra-seven' ), ' ','<a href=" ' . esc_url('https://wpoperation.com/themes/ultra-seven/') . ' " target="_blank">'.$theme_ob->get( 'Name' ).'</a>' );
                        ?>
                    </div><!-- .footer-left --> 
                    <?php if($footer_menu=='show'){ ?>
                        <div class="footer-right wow fadeInRight">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'footer-menu',
                                    'container' =>'',
                                    'menu_class' => 'ultra-footer-menu',
                                    'fallback_cb' => 'wp_page_menu',
                                    'depth'       => -1  
                                ) );
                            ?>
                        </div><!-- .footer-right -->
                    <?php }?>
                </div>
            </div>          
        <?php
    }
}
add_action('ultra_seven_footer','ultra_seven_bottom_footer',20);


/**
* Mobile Navigation Menu
*
* @since 1.2.1
*/
add_action('ultra_seven_mobile_menu','ultra_seven_mobile_menu');
if( ! function_exists('ultra_seven_mobile_menu')){
    function ultra_seven_mobile_menu(){
        ?>
        <div class="mob-outer-wrapp">
            <div class="container clearfix">
                <?php ultra_seven_site_brandings(); ?>
                <button class="toggle toggle-wrapp">
                <span class="toggle-wrapp-inner">
                    <span class="toggle-box">
                    <span class="menu-toggle"></span>
                    </span>
                </span>
                </button>
                
            </div>
            <div class="mob-nav-wrapp">
                <button class="toggle close-wrapp toggle-wrapp">
                    <span class="text"><?php esc_html_e('Close Menu','ultra-seven'); ?></span>
                    <span class="icon-wrapp"><i class="fa fa-times" aria-hidden="true"></i></span>
                </button>
                <nav  class="avl-mobile-wrapp clear clearfix" arial-label="Mobile" role="navigation" tabindex="1">
                    <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'main-menu',
                            'menu_id'        => 'primary-menu',
                            'container'      => 'ul',
                            'show_toggles'   => true,
                            'menu_class'     => 'mob-primary-menu clear'
                        )
                    );
                    ?>
                </nav>
            <div class="menu-last"></div>
            </div>
        </div>

        <?php 
    }
}


/**
 * Add a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args An array of arguments.
 * @param string   $item Menu item.
 * @param int      $depth Depth of the current menu item.
 *
 * @return stdClass $args An object of wp_nav_menu() arguments.
 * 
 * @since 1.2.1
 */
function ultra_seven_add_sub_toggles_to_main_menu( $args, $item, $depth ) {


    // Add sub menu toggles to the Expanded Menu with toggles.
    if ( isset( $args->show_toggles ) && $args->show_toggles ) {

        
        $args->after  = '';

        // Add a toggle to items with children.
        if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

            $toggle_target_string = '.menu-modal .menu-item-' . $item->ID . ' > .sub-menu';
            $toggle_duration      = 50;

            // Add the sub menu toggle.
            $args->after .= '<button class="toggle sub-toggle sub-menu-toggle"><span class="screen-reader-text">' . __( 'Show sub menu', 'ultra-seven' ) . '</span><i class="fa fa-angle-down" aria-hidden="true"></i></button>';

        }

    } 

    return $args;

}

add_filter( 'nav_menu_item_args', 'ultra_seven_add_sub_toggles_to_main_menu', 10, 3 );


/* Ads placements */
if(!function_exists('ultra_seven_before_ad_placement')){
    function ultra_seven_before_ad_placement(){
        $post_before = get_theme_mod('ultra_seven_post_before_ad');
        $archive_before = get_theme_mod('ultra_seven_archive_before_ad');

        if(is_single() && is_active_sidebar($post_before)){
            echo '<div class="content-before-ad">';
            dynamic_sidebar( $post_before );
            echo '</div>';
        }

        if((is_archive()||is_home()||is_search()||is_author()) && is_active_sidebar($archive_before)){
            echo '<div class="content-before-ad">';
            dynamic_sidebar( $archive_before );
            echo '</div>';
        }
        
    }
}
add_action('ultra_seven_before_content','ultra_seven_before_ad_placement',10);

if(!function_exists('ultra_seven_after_ad_placement')){
    function ultra_seven_after_ad_placement(){
        $post_after = get_theme_mod('ultra_seven_post_after_ad');
        $archive_after = get_theme_mod('ultra_seven_archive_after_ad');

        if(is_single() && is_active_sidebar($post_after)){
            echo '<div class="content-after-ad">';
            dynamic_sidebar( $post_after );
            echo '</div>';
        }

        if((is_archive()||is_home()||is_search()||is_author()) && is_active_sidebar($archive_after)){
            echo '<div class="content-after-ad">';
            dynamic_sidebar( $archive_after );
            echo '</div>';
        }
        
    }
}
add_action('ultra_seven_after_content','ultra_seven_after_ad_placement',10);