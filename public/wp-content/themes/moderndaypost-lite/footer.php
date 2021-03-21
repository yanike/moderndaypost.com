<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 * @package Hive Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
</div><!-- .container -->

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
		<div class="grid">
			<div class="grid__item  site-info">
				&copy;<?php echo date("Y"); ?> <a href="<?php echo esc_url( __( 'https://www.morderndaypost.com/' ) ); ?>">Modern-Day Post</a>
			</div>
		</div>
	</div><!-- .site-footer .container -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
