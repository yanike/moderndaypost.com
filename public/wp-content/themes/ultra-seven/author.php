<?php 
/**
 * The template for displaying author pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ultra Seven
 * @copyright Copyright (C) 2018 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

get_header(); 

?>

<div class="ultra-author-header">
	<div class="ultra-container">
    <?php do_action( 'ultra_seven_before_body_content' ); ?>
		<div class="author-header-wrap clearfix">
			<?php 
            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            $ultra_seven_author_website = get_the_author_meta( 'user_url' );
			?>
			<div class="author-img">
				<?php echo get_avatar( $author, '72' ); ?>
			</div>
			<div class="author-details">
				  <h3 class="author-name">
                  <?php 
                  echo esc_html( get_the_author() ); 
                  if( get_the_author_meta('author_designation') != '' ){
                  ?>
                  <span class="author-des"> (<?php echo esc_html( get_the_author_meta('author_designation') ); ?>)</span>
                  <?php }?>
                </h3>
                <p><?php echo esc_html($curauth->user_description); ?></p>

                <?php if( class_exists( 'Ultra_Companion' ) && $ultra_seven_author_website) { ?>
                <a href="<?php echo esc_url( $ultra_seven_author_website ); ?>" target="_blank" class="admin-dec"><?php echo esc_url( $ultra_seven_author_website ); ?></a>
                <?php }
                if( class_exists( 'Ultra_Companion' ) ){
                ?>
                  <div class="author-social">
                      <?php 
                      $ultra_seven_user_social_array = array(
                          'behance' => esc_html__( 'Behance', 'ultra-seven' ),
                          'delicious' => esc_html__( 'Delicious', 'ultra-seven' ),
                          'deviantart' => esc_html__( 'Deviantart', 'ultra-seven' ),
                          'digg' => esc_html__( 'Digg', 'ultra-seven' ),
                          'dribbble' => esc_html__( 'Dribbble', 'ultra-seven' ),
                          'facebook' => esc_html__( 'Facebook', 'ultra-seven' ),
                          'flickr' => esc_html__( 'Flickr', 'ultra-seven' ),
                          'github' => esc_html__( 'Github', 'ultra-seven' ),
                          'google-plus' => esc_html__( 'Google+', 'ultra-seven' ),
                          'html5' => esc_html__( 'Html5', 'ultra-seven' ),
                          'instagram' => esc_html__( 'Instagram', 'ultra-seven' ),    
                          'linkedin' => esc_html__( 'Linkedin', 'ultra-seven' ),
                          'paypal' => esc_html__( 'Paypal', 'ultra-seven' ),
                          'pinterest' => esc_html__( 'Pinterest', 'ultra-seven' ),
                          'reddit' => esc_html__( 'Reddit', 'ultra-seven' ),
                          'rss' => esc_html__( 'RSS', 'ultra-seven' ),
                          'share' => esc_html__( 'Share', 'ultra-seven' ),
                          'skype' => esc_html__( 'Skype', 'ultra-seven' ),
                          'soundcloud' => esc_html__( 'Soundcloud', 'ultra-seven' ),
                          'spotify' => esc_html__( 'Spotify', 'ultra-seven' ),
                          'stack-exchange' => esc_html__( 'Stackexchange', 'ultra-seven' ),
                          'stack-overflow' => esc_html__( 'Stackoverflow', 'ultra-seven' ),
                          'steam' => esc_html__(  'Steam', 'ultra-seven' ),
                          'stumbleupon' => esc_html__( 'StumbleUpon', 'ultra-seven' ),
                          'tumblr' => esc_html__( 'Tumblr', 'ultra-seven' ),
                          'twitter' => esc_html__( 'Twitter', 'ultra-seven' ),
                          'vimeo' => esc_html__( 'Vimeo', 'ultra-seven' ),
                          'vk' => esc_html__( 'VKontakte', 'ultra-seven' ),
                          'windows' => esc_html__( 'Windows', 'ultra-seven' ),
                          'wordpress' => esc_html__( 'WordPress', 'ultra-seven' ),
                          'yahoo' => esc_html__( 'Yahoo', 'ultra-seven' ),
                          'youtube' => esc_html__( 'Youtube', 'ultra-seven' )
                      );
                          foreach( $ultra_seven_user_social_array as $icon_id => $icon_name ) {
                              $author_social_link = get_the_author_meta( $icon_id );
                              if( !empty( $author_social_link ) ) {
                      ?>
                                  <span class="social-icon-wrap"><a href="<?php echo esc_url( $author_social_link )?>" target="_blank" title="<?php echo esc_attr( $icon_name )?>"><i class="fa fa-<?php echo esc_attr( $icon_id ); ?>"></i></a></span>
                      <?php            
                              }
                          }
                      ?>
                  </div><!-- .author-social -->
                <?php }?>
			</div>
		</div>
	</div>
</div>
<?php 
$sidebar = get_theme_mod('archive_page_sidebars_layout','rightsidebar');
if($sidebar != 'nosidebar'){
  $sidebar .= ' with-sidebar ';
}
?>
<div class="ultra-container <?php echo esc_attr($sidebar);?>">
  <?php //ultra_seven_breadcrumbs();?>
	<div class="primary content-area ultra-block-wrapper">
		<main id="main" class="site-main" role="main">

        <div class="block-header style2 clearfix">
            <div class="header"><?php echo esc_html__('Author Posts','ultra-seven'); ?></div>
        </div><!-- .block-header-->
        <?php do_action( 'ultra_seven_before_content' ); ?>
        <div class="author-content">
        <?php
        if ( have_posts() ) :
            $ultra_seven_author_layout = get_theme_mod( 'ultra_archive_layout', 'full' );
            if($ultra_seven_author_layout=='grid'){
              $layout = 'layout1';
            }else{
              $layout = '';
            }
          ?>
          <div class="ultra-archive clear <?php echo esc_attr($ultra_seven_author_layout).' '.esc_attr($layout);?>">
          <?php
          /* Start the Loop */
          
          $archive_count = 0;
          while ( have_posts() ) : the_post();
                        $archive_count++;
                        echo '<div class="ultra-archive-'.esc_attr($ultra_seven_author_layout).'">';
            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part( 'template-parts/archive/layout', $ultra_seven_author_layout  );
            echo '</div>';
          endwhile;
		    else: ?>
		        <p><?php echo esc_html__('No posts by this author.','ultra-seven'); ?></p>
		    <?php endif; ?>
          </div>
          <?php
            the_posts_pagination( array(
                        'prev_text' => '<i class="fa fa-chevron-left"></i>',
                        'next_text'  => '<i class="fa fa-chevron-right"></i>',
            ) );
           ?>
		</main>
    <?php do_action( 'ultra_seven_after_content' ); ?>
	</div>
  <?php get_sidebar(); ?>		
  <?php do_action( 'ultra_seven_after_body_content' ); ?>
</div>
<?php get_footer(); ?>