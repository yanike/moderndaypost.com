<?php
/**
 * Template part for displaying archive posts in layout-grid.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wpoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="ultra-archive-img">
		<?php 
        ultra_seven_home_image( 'ultra-medium-image' );
		do_action( 'ultra_seven_post_format_icon' );
		?>
	</div><!-- .ultra-archive-img -->

	<div class="ultra-archive-content">
		<div class="entry-header layout1-header">
			<?php do_action( 'ultra_seven_post_cat_or_tag_lists' ); ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php if( 'post' === get_post_type() ) { ?>
				<div class="post-meta clearfix">
					<?php 
						ultra_seven_posted_on();
						ultra_seven_post_views();
						ultra_seven_post_comments();
					?>
				</div><!-- .entry-meta -->
			<?php } ?>
		</div><!-- .ultra-archive-content -->
		<p>
		<?php
		$ultra_seven_excerpt_length = get_theme_mod( 'ultra_seven_archive_page_excerpts', '200' );
		$ultra_seven_read_more_txt = get_theme_mod( 'ultra_seven_archive_read_more', esc_html__( 'Read More', 'ultra-seven' ) );	
		$ultra_seven_post_content = get_the_content();
		echo ultra_seven_get_excerpt_content( $ultra_seven_post_content, $ultra_seven_excerpt_length );// WPCS: XSS OK.
		?>
		</p>	
		<?php if($ultra_seven_read_more_txt){?>	
		<a class="ultra-archive-more" href="<?php the_permalink(); ?>"><?php echo esc_html( $ultra_seven_read_more_txt ); ?></a>
		<?php }?>
	</div><!-- .ultra-archive-content -->
</article><!-- #post-## -->
