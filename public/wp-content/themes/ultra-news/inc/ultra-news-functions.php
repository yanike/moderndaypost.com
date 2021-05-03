<?php

/* Get Elementor Templates */
function ultra_news_get_elementor_templates( $type = '' ) {
  $args = [
      'post_type'         => 'elementor_library',
      'posts_per_page'    => -1,
  ];
  
  if ( $type ) {
      $args['tax_query'] = [
          [
              'taxonomy' => 'elementor_library_type',
              'field'    => 'slug',
              'terms' => $type,
          ]
      ];
  }
  
  $page_templates = get_posts( $args );

  $options = array();
  if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
         $options[ '' ] = esc_html__('Choose Template','ultra-news');
      foreach ( $page_templates as $post ) {
          $options[ $post->ID ] = $post->post_title;
      }
  }
  wp_reset_postdata();
  return $options;
}


function ultra_seven_posts_posted_on() {


  $posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html(get_the_date()) . '</a>';
  $byline = sprintf(
        /* translators: author link */
    esc_html( '%s'),
    '<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><div class="author-img">'.get_avatar( get_the_author_meta('ID'), 50 ).'</div><div class="author-name">' . esc_html( get_the_author() ) . '</div></a></span>'
  );
    echo '<span class="post-author">'. wp_kses_post($byline) .'</span>';

    echo '<span class="posted-on">'. wp_kses_post($posted_on) .'</span>';

}

function ultra_seven_posted_on() {

  $posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html(get_the_date()) . '</a>';

  $byline = sprintf(
    /*translators: author link */
    esc_html( '%s'),
    '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><div class="author-img">'.get_avatar( get_the_author_meta('ID'), 50 ).'</div><div class="author-name">' . esc_html( get_the_author() ) . '</div></a></span>'
  );
  echo '<span class="post-author">'. $byline .'</span><span class="posted-on">'. $posted_on .'</span>';// WPCS: XSS OK.


}

add_action( 'wp_enqueue_scripts', 'ultra_news_metabox_styles' );
function ultra_news_metabox_styles(){
    //custom style from metabox
    ob_start();
  $theme_color = get_theme_mod('ultra_seven_theme_color','#e54e54'); 
  ?>
  #loading18 .object {
    background: <?php echo sanitize_hex_color($theme_color); ?>
  }

  <?php
    $custom_css = ob_get_contents();
    ob_get_clean();
    
    wp_add_inline_style( 'ultra_parent_style', $custom_css );
    
}