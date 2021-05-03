<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ultra Seven
 * @copyright Copyright (C) 2018 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

get_header(); ?>
<div class="ultra-container nosidebar">
	<?php ultra_seven_breadcrumbs(); ?>
	<div class="primary content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found text-center">
				<figure class="error-img"><img src="<?php echo esc_url(get_template_directory_uri()) ;?>/assets/images/404.jpg" alt="<?php echo esc_attr__('error-image','ultra-seven');?>"></figure>

				<div class="page-content">
					<h2><?php esc_html_e( 'Oops. The page you were looking for does not exist.', 'ultra-seven' ); ?></h2>

					<?php
						get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
get_footer();
