<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MagazineNP
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Ads: 982505710 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-982505710"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-982505710'); </script>
	<!-- Event snippet for Website traffic conversion page --> <script> gtag('event', 'conversion', {'send_to': 'AW-982505710/2EHcCMGlhP4BEO6xv9QD'}); </script>
</head>

<body <?php body_class('theme-body'); ?>>

<?php do_action('wp_body_open'); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'magazinenp'); ?></a>
	<header id="masthead" class="site-header">
		<?php
		$header_ordering = magazinenp_header_ordering('header_ordering');

		foreach ($header_ordering as $header_index => $header_args) {
			$is_disabled = isset($header_args['disable']) ? (boolean)$header_args['disable'] : false;
			if (!$is_disabled) {
				switch ($header_index) {
					case "header_media":
						get_template_part('template-parts/header/media');
						break;
					case "top_header":
						get_template_part('template-parts/header/top');
						break;
					case "mid_header":
						get_template_part('template-parts/header/mid');
						break;
					case "bottom_header":
						get_template_part('template-parts/header/bottom');
						break;
					case "news_ticker":
						if (magazinenp_news_ticker_display()) {
							get_template_part('template-parts/header/ticker');
						}
						break;
					case "popular_tags":
						if (magazinenp_popular_tags_display()) {
							get_template_part('template-parts/header/popular-tags');
						}
						break;
				}
			}

		}


		if (magazinenp_post_block_display() || magazinenp_banner_display()) {
			get_template_part('template-parts/header/featured');
		}
		get_template_part('template-parts/header/breadcrumb');

		?>

	</header>

