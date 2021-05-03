<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ultra_seven_widgets_init() {
  $widget_title_layout = 'style2';
  $before_widget = '<div id="%1$s" class="widget %2$s">';
  $after_widget = '</div>';
  $before_title = '<h2 class="widget-title '.esc_attr($widget_title_layout).'"><span class="title">';
  $after_title = '</span></h2>';

	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'ultra-seven' ),
		'id'            => 'default-sidebar',
		'description'   => esc_html__( 'Add widgets here for Default Sidebar.', 'ultra-seven' ),
		'before_widget' => $before_widget,
		'after_widget'  => $after_widget,
		'before_title'  => $before_title,
		'after_title'   => $after_title,
	) );

  register_sidebar( array(
    'name'          => esc_html__( 'Header Banner', 'ultra-seven' ),
    'id'            => 'header-banner',
    'description'   => esc_html__( 'Add widgets here for Header Banner.', 'ultra-seven' ),
    'before_widget' => $before_widget,
    'after_widget'  => $after_widget,
    'before_title'  => $before_title,
    'after_title'   => $after_title,
  ) );

	register_sidebar( array(
	    'name'          => esc_html__( 'Footer Instagram', 'ultra-seven' ),
	    'id'            => 'footer-insta',
	    'description'   => esc_html__( 'Add widgets here for Instagram.', 'ultra-seven' ),
	    'before_widget' => $before_widget,
	    'after_widget'  => $after_widget,
	    'before_title'  => $before_title,
	    'after_title'   => $after_title,
	) );
  
	//Footer Widget Area

	for ( $i = 1; $i <= 4; $i++ ) {
		
		register_sidebar( array(
      /* translators: */
			'name' 				=> sprintf( __( 'Footer Widget Area %d', 'ultra-seven' ), $i ),
      /* translators: */
			'id' 				=> sprintf( 'footer-%d', $i ),
      /* translators: */
			'description' 		=> sprintf( __( ' Add Widgetized Footer Region %d.', 'ultra-seven' ), $i ),
      /* translators: */
			'before_widget' 	=> $before_widget,
			'after_widget' 		=> $after_widget,
			'before_title' 		=> $before_title,
			'after_title' 		=> $after_title,
		));
	}

  //Homepage Blocks

  for ( $i = 1; $i <= 3; $i++ ) {
    
    register_sidebar( array(
      /* translators: */
      'name'        => sprintf( __( 'Home Block %d', 'ultra-seven' ), $i ),
      /* translators: */
      'id'        => sprintf( 'home_block_%d', $i ),
      /* translators: */
      'description'     => sprintf( __( ' Add Widgetized Home Block %d.', 'ultra-seven' ), $i ),
      /* translators: */
      'before_widget'   => $before_widget,
      'after_widget'    => $after_widget,
      'before_title'    => $before_title,
      'after_title'     => $after_title,
    ));
  }

  //Homepage Sidebar

  for ( $i = 1; $i <= 3; $i++ ) {
    
    register_sidebar( array(
      /* translators: */
      'name'        => sprintf( __( 'Home Sidebar %d', 'ultra-seven' ), $i ),
      /* translators: */
      'id'        => sprintf( 'home_sidebar_%d', $i ),
      /* translators: */
      'description'     => sprintf( __( ' Add Widgetized Home Sidebar %d.', 'ultra-seven' ), $i ),
      /* translators: */
      'before_widget'   => $before_widget,
      'after_widget'    => $after_widget,
      'before_title'    => $before_title,
      'after_title'     => $after_title,
    ));
  }

}
add_action( 'widgets_init', 'ultra_seven_widgets_init' );
/*===========================================================================================================*/
/**
 * Define categories lists in array
 */
$ultra_seven_categories = get_categories( array( 'hide_empty' => 0 ) );
foreach ( $ultra_seven_categories as $ultra_seven_category ) {
    $ultra_seven_cat_array[$ultra_seven_category->term_id] = $ultra_seven_category->cat_name;
}

//categories in dropdown
$ultra_seven_cat_dropdown['0'] = esc_html__( 'Select Category', 'ultra-seven' );
foreach ( $ultra_seven_categories as $ultra_seven_category ) {
    $ultra_seven_cat_dropdown[$ultra_seven_category->term_id] = $ultra_seven_category->cat_name .'  ('.$ultra_seven_category->count.')';
}

/**
 * radio option for types
 */
$ultra_seven_posts_type = array(
    'latest'   => esc_html__( 'Latest Posts', 'ultra-seven' ),
    'category' => esc_html__( 'Selected Category', 'ultra-seven' ),
);


/**
 * Block layout
 */
$ultra_seven_block_layout = array(
    'layout-1' =>  esc_html__( 'Layout 1', 'ultra-seven' ),
    'layout-2' =>  esc_html__( 'Layout 2', 'ultra-seven' ),
    'layout-3' =>  esc_html__( 'Layout 3', 'ultra-seven' ),
);

/**
 * Select options for column
 */
$ultra_seven_column_choice = array(
  ''    => esc_html__( 'Select No.of Column', 'ultra-seven' ),
  '1' => esc_html__( '1 Column', 'ultra-seven' ),
  '2' => esc_html__( '2 Columns', 'ultra-seven' ),
  '3' => esc_html__( '3 Columns', 'ultra-seven' )
  );


/*
 * Get media attachment id from url
 */ 
if ( ! function_exists( 'ultra_seven_get_attachment_id_from_url' ) ):
    function ultra_seven_get_attachment_id_from_url( $attachment_url ) {     
        global $wpdb;
        $attachment_id = false;

        // If there is no url, return.
        if ( '' == $attachment_url )
            return;

        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();

        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

        }     
        return $attachment_id;
    }
endif;
/*-----------------------------------------------------------------------------------*/
#  Convert YouTube time duration
/*-----------------------------------------------------------------------------------*/ 

function ultra_seven_covtime( $duration ) {
    preg_match_all( '/(\d+)/', $duration ,$parts );

     //Put in zeros if we have less than 3 numbers.
    if ( count( $parts[0] ) == 1 ) {
        array_unshift( $parts[0], "0", "0" );
    } elseif ( count( $parts[0] ) == 2 ) {
        array_unshift( $parts[0], "0" );
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init%60;
    $seconds = str_pad( $seconds, 2, "0", STR_PAD_LEFT );
    $seconds_overflow = floor( $sec_init/60 );

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ( $min_init )%60;
    $minutes = str_pad( $minutes, 2, "0", STR_PAD_LEFT );
    $minutes_overflow = floor( ( $min_init )/60 );

    $hours = $parts[0][0] + $minutes_overflow;    

    if( $hours != 0 ) {
        return $hours.':'.$minutes.':'.$seconds;
    } else {
        return $minutes.':'.$seconds;
    }        
}

/*--------------------------------------------------------------------------------------------------------*/
/**
 * Load individual widgets file and required related files too.
 */

$ultra_widgets_path = array(
  '/inc/widgets/ultra-widget-fields.php',
  '/inc/widgets/ultra-grid-block.php',
  '/inc/widgets/ultra-list-block.php',
  '/inc/widgets/ultra-single-cat-block.php',
  '/inc/widgets/ultra-social-icons.php',
  '/inc/widgets/ultra-social-counter.php',
  '/inc/widgets/ultra-tab.php',
  '/inc/widgets/ultra-post-list.php',
  '/inc/widgets/ultra-youtube-block.php',
	);
foreach( $ultra_widgets_path as $ultra_widget_path ){
	require get_parent_theme_file_path() . $ultra_widget_path;
}

if(class_exists('woocommerce')){
  require get_parent_theme_file_path(). '/inc/widgets/ultra-woo-block.php';
}


