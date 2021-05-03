<?php


/*-----------------------------------------------------------------------------------*/
# Ultra Custom query args
/*-----------------------------------------------------------------------------------*/

if( ! function_exists( 'ultra_seven_query_args' ) ) :
	function ultra_seven_query_args( $ultra_seven_query_type, $ultra_seven_post_count, $ultra_seven_cat_id = null, $ultra_seven_post_offset = null ) {
		if( $ultra_seven_query_type == 'category' && !empty( $ultra_seven_query_type ) ) {
			$ultra_seven_args = array(
				'post_type' 	=> 'post',
                'post_status'   => 'publish',
				'category__in'	=> $ultra_seven_cat_id,
				'posts_per_page'=> $ultra_seven_post_count,
                'offset'        => $ultra_seven_post_offset,				
			);
            if (!empty($ultra_seven_cat_id)) {
                $ultra_seven_args['category__in'] = $ultra_seven_cat_id;
            }
            
		} elseif( $ultra_seven_query_type == 'latest' ) {
			$ultra_seven_args = array(
				'post_type'		=> 'post',	
                'post_status'   => 'publish',					
				'posts_per_page'=> $ultra_seven_post_count,
                'offset'        => $ultra_seven_post_offset,
				'ignore_sticky_posts' => 1,
		    );
		}
		return $ultra_seven_args;
	}
endif;



/*-----------------------------------------------------------------------------------*/
# Ultra post excerpt limit
/*-----------------------------------------------------------------------------------*/

if( ! function_exists( 'ultra_seven_get_excerpt_content' ) ):
    function ultra_seven_get_excerpt_content( $content, $limit ) {
        $striped_content = strip_tags( $content );
        $striped_content = strip_shortcodes( $striped_content );
        $limit_content = mb_substr( $striped_content, 0 , $limit );
        if( $limit_content < $content ){
            $limit_content .= "..."; 
        }
        return $limit_content;
    }
endif;

/*-----------------------------------------------------------------------------------*/
# Ultra Menu home icon
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'ultra_seven_home_icon' ) ):
    function ultra_seven_home_icon() {
        $home_icon_option = get_theme_mod( 'ultra_seven_home_icon', 'show' );
        $fa_home = 'fa fa-home';
        global $wp;
        $current = esc_url(home_url( $wp->request ));
        $home_url = esc_url(home_url());
        if($current == $home_url){
            $class = 'active';
        }else{
            $class = '';
        }
        if( $home_icon_option == 'show') {
    ?>
        <div class="index-icon <?php echo esc_attr($class);?>">
            <a href="<?php echo esc_url( $home_url ); ?>"><i class="<?php echo esc_attr($fa_home);?>"></i></a>
        </div>
    <?php
        }
    }
endif;



/*-----------------------------------------------------------------------------------*/
# Ultra Get post views
/*-----------------------------------------------------------------------------------*/

if( ! function_exists( 'ultra_seven_post_views' ) ):
    function ultra_seven_post_views() {
        if(class_exists('Ultra_Companion')){
            $post_view_count = getPostViews( get_the_ID() );
            echo '<span class="post-view"><i class="view-icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 469.333 469.333" style="enable-background:new 0 0 469.333 469.333;" xml:space="preserve">
    <g>
        <path d="M426.667,0h-384C19.146,0,0,19.135,0,42.667v384c0,23.531,19.146,42.667,42.667,42.667h384
            c23.521,0,42.667-19.135,42.667-42.667v-384C469.333,19.135,450.188,0,426.667,0z M149.333,394.667
            c0,5.896-4.771,10.667-10.667,10.667h-64c-5.896,0-10.667-4.771-10.667-10.667V160c0-5.896,4.771-10.667,10.667-10.667h64
            c5.896,0,10.667,4.771,10.667,10.667V394.667z M277.333,394.667c0,5.896-4.771,10.667-10.667,10.667h-64
            c-5.896,0-10.667-4.771-10.667-10.667v-320C192,68.771,196.771,64,202.667,64h64c5.896,0,10.667,4.771,10.667,10.667V394.667z
             M405.333,394.667c0,5.896-4.771,10.667-10.667,10.667h-64c-5.896,0-10.667-4.771-10.667-10.667V245.333
            c0-5.896,4.771-10.667,10.667-10.667h64c5.896,0,10.667,4.771,10.667,10.667V394.667z"/>
    </g>
</svg></i>'. absint($post_view_count). esc_html__(' Views','ultra-seven').'</span>';
        }  
    }

endif;

/*-----------------------------------------------------------------------------------*/
# Get post comment number
/*-----------------------------------------------------------------------------------*/ 

if( ! function_exists( 'ultra_seven_post_comments' ) ):
    function ultra_seven_post_comments() {

        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-count">';
                comments_popup_link( 0, 1, '%' );
            echo '</span>';
        }      
    }
endif;

/*-----------------------------------------------------------------------------------*/
#  For single post tag lists
/*-----------------------------------------------------------------------------------*/ 
if( ! function_exists( 'ultra_seven_single_post_tags_list' ) ) :
    function ultra_seven_single_post_tags_list() {

        // Hide tag text for pages.
        if ( 'post' === get_post_type() ) {

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', '' );
            if ( $tags_list ) {
                /* translators: tag */
                printf( '<span class="tags-links clearfix">' . esc_html( '%1$s' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }
    }
endif;

/*-----------------------------------------------------------------------------------*/
#  For single post category lists
/*-----------------------------------------------------------------------------------*/ 

if( ! function_exists( 'ultra_seven_post_cat_lists' ) ) :
    function ultra_seven_post_cat_lists() {

        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            global $post;
            $categories = get_the_category();
            $separator = ' ';
            $output = '';
            if( $categories ) {
                $output .= '<span class="cat-wrap">';
                foreach( $categories as $category ) {
                    $output .= '<span class="cat-links"><a href="'.get_category_link( $category->term_id ).'" class="cat-' . $category->term_id . '" rel="category tag">'.$category->cat_name.'</a></span>';                   
                }
                $output .='</span>';
                echo wp_kses_post(trim( $output, $separator ));
            }
        }
    }
endif;

/*-----------------------------------------------------------------------------------*/
#  Get single post featured image with fallback image
/*-----------------------------------------------------------------------------------*/ 

if( !function_exists( 'ultra_seven_single_post_featured_image' ) ) :
    function ultra_seven_single_post_featured_image() {
        global $post;
        $post_id = $post->ID;
        $show_fimage = get_theme_mod('ultra_seven_post_fimage','show');
        if( has_post_thumbnail() && $show_fimage=='show' ) {
            echo '<div class="entry-thumb">';
            the_post_thumbnail( 'ultra-xlarge-image' );
            echo '</div>';
        }else {

        }
    }
endif;

/*-----------------------------------------------------------------------------------*/
#  Get Homepage image with fallback image
/*-----------------------------------------------------------------------------------*/   

if( !function_exists( 'ultra_seven_home_image' ) ) :
    function ultra_seven_home_image( $image_size ) {
        $image_id = get_post_thumbnail_id();
        $image_path = wp_get_attachment_image_src( $image_id, $image_size, true );
        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        if( has_post_thumbnail() ) { ?>
            <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                <?php do_action('ultra_image_overlay');?>
            </a>
        <?php    
        }else {

        }
    }
endif;


/*-----------------------------------------------------------------------------------*/
#  Post Pagination for single Posts
/*-----------------------------------------------------------------------------------*/
if(!function_exists('ultra_seven_single_post_pagination')){
function ultra_seven_single_post_pagination(){ 
    $show_pagi = get_theme_mod('ultra_seven_post_pagination','show');
    if($show_pagi == 'show'):
    ?>   
    <div class="single_post_pagination_wrapper clearfix">
        <div class="prev-link"> 
            <div class="prev-link-wrapper clearfix">
                <?php
                $prevPost = get_previous_post();
                if ( is_a( $prevPost , 'WP_Post' ) ) :
                    $prevthumbnail = get_the_post_thumbnail($prevPost->ID,'thumbnail'); 
                    $prevtitle = get_the_title($prevPost->ID); ?>
                    
                    <div class="prev-text">
                        <h4><?php previous_post_link('%link', 'Previous Post'); ?></h4>
                        <h2><?php previous_post_link('%link', $prevtitle) ;?></h2>
                    </div>
                
                    <?php
                    if($prevthumbnail){ ?>
                        <span class="prev-image">
                            <?php previous_post_link('%link', $prevthumbnail); ?>
                        </span>
                    <?php } 
                endif; ?>
            </div>
        </div>

        <?php // Display the thumbnail of the next post ?>
        <div class="next-link"> 
            <div class="next-link-wrapper clearfix">
                <?php
                $nextPost = get_next_post();
                if ( is_a( $nextPost , 'WP_Post' ) ) :
                    $nextthumbnail = get_the_post_thumbnail($nextPost->ID,'thumbnail');
                    $nextitle = get_the_title($nextPost->ID); ?>
                    <div class="next-text">
                        <h4><?php next_post_link('%link', 'Next Post'); ?></h4>
                        <h2><?php next_post_link('%link',$nextitle); ?></h2>
                    </div>

                    <?php
                    if($nextthumbnail){ ?>
                        <span class="next-image">
                            <?php next_post_link('%link', $nextthumbnail); ?>
                        </span>
                    <?php } 
                endif; ?>
            </div>
        </div>
    </div> <!-- .single_post_pagination_wrapper -->
    <?php 
    endif;
} 
}

/*-----------------------------------------------------------------------------------*/
#  Post Formats For single Posts
/*-----------------------------------------------------------------------------------*/

if( !function_exists('ultra_seven_post_formats') ){
    function ultra_seven_post_formats(){
        global $post;
        $format = get_post_format();
        $post_audio_url = get_post_meta( $post->ID, 'post_embed_audio_url', true );
        $post_video_url = get_post_meta( $post->ID, 'post_embed_video_url', true );
        $post_images_url = get_post_meta( $post->ID, 'post_images', true );
        if($format == 'video' && !empty($post_video_url) ){
            wp_enqueue_script('fitvids-js');
            ?>
            <div class="ultra_video_wrap">
                <?php echo wp_oembed_get( esc_url($post_video_url) ); // WPCS: XSS OK. ?>
            </div>
        <?php 
        }else if($format == 'audio' && !empty($post_audio_url)){
            wp_enqueue_script('fitvids-js');
            ?>
            <div class="ultra_audio_wrap">
                <?php echo wp_oembed_get( esc_url($post_audio_url) ); // WPCS: XSS OK. ?>
            </div>
        <?php 
        }else if($format == 'gallery' && !empty($post_images_url)){ 
            wp_enqueue_style('lightslider');
            wp_enqueue_script('lightslider');
            ?>
            <div class="post-gallery-wrapper">
                <ul class="ultra-gallery-items cS-hidden">
                    <?php 
                        foreach ( $post_images_url as $image_url) {
                    ?>
                        <li><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr__('gallery-images','ultra-seven');?>"/></li>
                    <?php
                        }
                    ?>
                </ul>
            </div><!-- .post-gallery-wrapper -->
            <?php 
        } else{ ultra_seven_single_post_featured_image(); } 
    }
}

/*========Get all registered sidebars=====*/
if(!function_exists('ultra_seven_get_sidebars')){
    function ultra_seven_get_sidebars(){
        global $wp_registered_sidebars;
        $ultra_sidebars = array();
        foreach ( $wp_registered_sidebars as $sidebars ) {
            $ultra_sidebars[$sidebars['id']] = $sidebars['name'];
        }
        return $ultra_sidebars;
    }
}

/**
* Retrieve post meta and default value of metabox
*/
function ultra_seven_get_post_meta( $key, $defaults = '' ){
  global $post;

  if(! $post )
    return;
    
    $default = $defaults;
    $meta_val =  get_post_meta( $post->ID, $key , true ); 

    if( empty($meta_val) && ($defaults != '') ){
        $meta_val = $default;
    }

    return $meta_val;

}
