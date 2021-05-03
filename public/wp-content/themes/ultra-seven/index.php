<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ultra Seven
 */

get_header(); 
$sidebar = get_theme_mod('archive_page_sidebars_layout','rightsidebar');
$class = '';
if($sidebar != 'nosidebar'){
	$class .= 'with-sidebar ';
}else{
	$class .= ' ';
}
$class .= get_theme_mod( 'ultra_archive_layout', 'full' );
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
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
					<?php do_action( 'ultra_seven_before_content' ); ?>
					<?php 
					  $ultra_seven_archive_layout = get_theme_mod( 'ultra_archive_layout', 'full' );
					  if($ultra_seven_archive_layout=='grid'){
					  	$layout = 'layout1';
					  }else{
					  	$layout = '';
					  }
					?>
					<div class="posts-wrap-standard">
					<div class="ultra-archive clearfix standard <?php echo esc_attr($ultra_seven_archive_layout).' '.esc_attr($layout);?>">
					<?php
					/* Start the Loop */
					
					$archive_count = 0;
					while ( have_posts() ) : the_post();
                        $archive_count++;
                        echo '<div class="ultra-archive-'.esc_attr($ultra_seven_archive_layout).'">';
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/archive/layout', $ultra_seven_archive_layout  );
						echo '</div>';
					endwhile;
 
					echo '</div></div>';
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;

				the_posts_pagination( array(
                  'prev_text' => '<i class="fa fa-chevron-left"></i>',
                  'next_text'  => '<i class="fa fa-chevron-right"></i>',
				) );
				?>
			</main><!-- #main -->
			<?php do_action( 'ultra_seven_after_content' ); ?>
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
		<?php do_action( 'ultra_seven_after_body_content' ); ?>
	</div><!-- .ultra-container -->
<?php
get_footer();
