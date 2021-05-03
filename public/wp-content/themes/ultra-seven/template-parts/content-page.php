<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ultra-seven
 */

$post_id = get_the_ID();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-header">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php ultra_seven_single_post_featured_image(); ?>
		</header><!-- .entry-header -->
    </div>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ultra-seven' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ultra-seven' ),
				'after'  => '</div>',
			) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php ultra_seven_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

