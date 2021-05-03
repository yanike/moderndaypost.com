<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ultra-seven
 */

get_header(); 
$sidebar = get_theme_mod('archive_page_sidebars_layout','rightsidebar');
if($sidebar != 'nosidebar'){
	$class='with-sidebar';
}else{
	$class='';
}
?>
    <div class="ultra-container <?php echo esc_attr($class).' '.esc_attr($sidebar);?>">
    	<?php do_action( 'ultra_seven_before_body_content' ); ?>
        <?php ultra_seven_breadcrumbs();?>
		<div class="content-area ultra-content primary">
			<main id="main" class="site-main" role="main">
				<?php
				if ( have_posts() ) : ?>
					<header class="page-header">
						<?php
						/* translators: */
                        printf( esc_html__( 'Search Results for: %s', 'ultra-seven' ), '<span>' . get_search_query() . '</span>' );
						?>
					</header><!-- .page-header -->
					<?php do_action( 'ultra_seven_before_content' ); ?>
					<?php 
					  $ultra_seven_search_layout = get_theme_mod( 'ultra_archive_layout', 'full' );
					  $layout = get_theme_mod('layout1');
					  if($ultra_seven_search_layout=='grid'){
					  	$layout = 'layout1';
					  }else{
					  	$layout = '';
					  }
					?>
					<div class="ultra-archive clear <?php echo esc_attr($ultra_seven_search_layout).' '.esc_attr($layout);?>">
						<?php
						/* Start the Loop */
						
						$archive_count = 0;
						while ( have_posts() ) : the_post();
	                        $archive_count++;
	                        echo '<div class="ultra-archive-'.esc_attr($ultra_seven_search_layout).'">';
								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/archive/layout', $ultra_seven_search_layout  );
							echo '</div>';
						endwhile;
					echo '</div>';
                    the_posts_pagination( array(
                        'prev_text' => '<i class="fa fa-chevron-left"></i>',
                        'next_text'  => '<i class="fa fa-chevron-right"></i>',
                    ) );
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
			</main><!-- #main -->
			<?php do_action( 'ultra_seven_after_content' ); ?>
		</div><!-- #primary -->
	    <?php get_sidebar(); ?>
	    <?php do_action( 'ultra_seven_after_body_content' ); ?>
    </div>	

<?php
get_footer();
