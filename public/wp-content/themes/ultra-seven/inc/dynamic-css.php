<?php

function ultra_seven_custom_stylesheet(){

    $defaults = ultra_seven_get_default_theme_options();
	$custom_css = '';
    //theme color
	$theme_color = esc_html(get_theme_mod('ultra_seven_theme_color',$defaults['ultra_seven_theme_color']));
	$custom_css .= "
	a:hover, .ultra-top-header .top-left ul li a:hover,
    .ultra-top-header .top-right ul li a:hover, .top-header-three.ultra-top-header .top-left ul li a:hover, 
    .top-header-three.ultra-top-header .top-right ul li a:hover, .ultra-block-wrapper .block-header .multi-cat-tabs2 ul li.active a,
    .ultra-block-wrapper .block-header .multi-cat-tabs1 ul li.active a, .ultra-block-wrapper .single-post .post-content-wrapper .post-content a.block-list-more:hover,
    a.ultra-archive-more:hover, .ultra-block-wrapper.grid-post-list.layout-3 .post-content-wrapper h3 a:hover, .site-footer .ultra-bottom-footer .footer-right ul.menu li a:hover, .site-footer .ultra-middle-footer .footer-social ul li a:hover,
    .ultra-block-wrapper.latest-posts .single-post-large .post-content-wrapper h3 a:hover, .ultra-block-wrapper.woo-tab-slider .ultra-tabs ul li.active a,
    .ultra-block-wrapper.video-cat-tab .single-post .post-content-wrapper h3 a:hover, .ultra-block-wrapper.video-cat-tab .single-post .post-caption-wrapper .post-meta span > a:hover,
    .ultra-block-wrapper.video-cat-tab .single-post .post-content-wrapper .post-meta span > a:hover, .widget_ultra_seven_posts_list .post-list-wraper.layout-1 .single-post .post-caption h3 a:hover,
	.widget_ultra_seven_posts_list .post-list-wraper.layout-1 .single-post .post-caption .post-meta span a:hover, .widget_ultra_seven_posts_list .ul-posts a:hover,
	a.loadmore:hover, .ultra-block-wrapper.post-slider .post-caption h3 a:hover, .widget_ultra_seven_post_timeline li:hover .ultra-article-wrapper .post-meta a, .star-review-wrapper .star-value, .woocommerce-MyAccount-content p a,
	.site-header.layout-three .main-navigation > ul > li.current-menu-item > a,
	.site-header.layout-two .main-navigation > ul > li.current-menu-item > a, .site-header.layout-one .main-navigation > ul > li.current-menu-item > a,
	.site-header.layout-one .main-navigation > ul > li:hover > a,
	.site-header.layout-two .main-navigation > ul > li:hover > a, .ultra-bread-home,.related.products h2, .comments-area .submit:hover,
	.comments-area .comment-reply-link:hover, .post-tag span.tags-links a:hover, .single_post_pagination_wrapper .next-link .next-text h4 a:hover,
	.single_post_pagination_wrapper .prev-link .prev-text h4 a:hover, .post-review-wrapper .section-title, .post-review-wrapper .total-reivew-wrapper .stars-count, 
	.post-review-wrapper .stars-review-wrapper .review-featured-wrap .stars-count, .single_post_pagination_wrapper .prev-link .prev-text h4 a:hover:before,
	.single_post_pagination_wrapper .next-link .next-text h4 a:hover:after,
    .site-footer .ultra-bottom-footer .footer-left a:hover {
		color: ".sanitize_hex_color($theme_color).";
	}
	.site-header .nav-search-wrap .search-container, .side-menu-wrapper, .ultra-block-wrapper .block-header, .ultra-block-wrapper .single-post .post-content-wrapper .post-content a.block-list-more,
	a.ultra-archive-more, .ultra-block-wrapper .ultra-num-pag .page-numbers.current, .post-review-wrapper .points-review-wrapper, .post-review-wrapper .percent-review-wrapper, .post-review-wrapper .stars-review-wrapper,
	.post-review-wrapper .summary-wrapper .total-reivew-wrapper, .ultra-block-wrapper .ultra-num-pag .page-numbers:hover, .widget_ultra_seven_posts_list .ul-posts a, .widget_tag_cloud a:hover,
	a.loadmore, .ultra-about.layout1 .about-img, .ultra-about.layout2 .about-img, .widget_ultra_seven_authors_list .user-image, .widget_ultra_seven_post_timeline li:hover .ultra-article-wrapper .post-meta:before, blockquote,
	.widget_ultra_seven_contact_info .ultra-contact-info > div:hover span i, .ultra-bread-home, .ultra-related-wrapper.slide .related-title, .related.products h2, #check-also-box, .comments-area .submit,
	.comments-area .comment-reply-link, .woocommerce-MyAccount-navigation ul li a, .woocommerce-MyAccount-content, .ultra-block-wrapper .ultra-num-pag .page-numbers.current, .ultra-block-wrapper .ultra-num-pag .page-numbers:hover, .nav-links span.current, .nav-links a:hover,
	.ultra_tagline_box.ultra-left-border-box, .ultra_tagline_box.ultra-top-border-box, .ultra_tagline_box.ultra-all-border-box, .ultra_toggle {
		border-color: ".sanitize_hex_color($theme_color).";
	}
	.site-header .nav-search-wrap .search-container .search-form .search-submit, .site-header.layout-two .ticker-block .ticker-title, h2.widget-title.style1:before,
	.ultra-main-slider .slider-caption .cat-wrap .cat-links, .ultra-top-header .ultra-date,
	.ultra-block-wrapper .block-header .header, .ultra-block-wrapper .single-post .post-content-wrapper .post-content a.block-list-more,
	a.ultra-archive-more, .ultra-block-wrapper.grid-post-list.layout-3 .single-post .post-thumb .cat-links, .ultra-block-wrapper .ultra-num-pag .page-numbers.current,
	.ultra-block-wrapper .ultra-num-pag .page-numbers:hover, .ultra-block-wrapper.youtube-video .video-list-wrapper .video-controls, .ultra-block-wrapper.youtube-video .video-list-wrapper .single-list-wrapper .list-thumb.now-playing:before,
	h2.widget-title:before, .widget_ultra_social_counters .ultra-social-followers.theme1 li a i,
	.widget_ultra_social_counters .ultra-social-followers.theme2 li, .widget_tag_cloud a:hover,
	.widget_ultra_social_counters .ultra-social-followers.theme3 li, .widget_calendar caption, .cat-links, .widget_ultra_seven_posts_list .ul-posts a,
	a.loadmore, .widget_ultra_seven_post_timeline li:hover .ultra-article-wrapper .post-meta:before, .widget_ultra_social_icons .ultra-social-icons li,
	.content-area .single-share ul li, .widget_ultra_seven_widget_tabs .widget-tabs-title-container ul li.active, .ultra-block-wrapper .ultra-num-pag .page-numbers.current, .ultra-block-wrapper .ultra-num-pag .page-numbers:hover, .nav-links span.current, .nav-links a:hover,
	.widget_ultra_seven_widget_tabs .widget-tabs-title-container ul li:hover, .form_drop_down .form_wrapper_body .button, .archive .page-title:before,
	.widget_ultra_seven_category_tabbed ul.ultra-cat-tabs li.active, #ultra-go-top,
	.widget_ultra_seven_category_tabbed ul.ultra-cat-tabs li:hover, .widget_search .search-form .search-submit, .widget_ultra_seven_contact_info .ultra-contact-info > div:hover span i,
	#check-also-box #check-also-close, .comments-area .submit, .post-tag span.tag-title, .post-review-wrapper .percent-review-wrapper .percent-rating-bar-wrap div, .post-review-wrapper .points-review-wrapper .percent-rating-bar-wrap div,
	.comments-area .comment-reply-link, .woocommerce-mini-cart__buttons a, .ultra-main-slider .custom .slider-caption:before, .ultra-main-slider .custom .slider-btn:hover, .cart-count, .error-404 .search-submit, .woocommerce.widget_price_filter button[type=\"submit\"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .widget_search .search-form .search-submit, .woocommerce-product-search button[type=\"submit\"], .error-404 .search-submit, .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-MyAccount-navigation ul li:hover a, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, h2.widget-title.style1 span.title, .block-header.style3 .header:after, .social-shortcode a, .ultra_tagline_box.ultra-bg-box, .ultra-team .member-social-group a, .horizontal .ultra_tab_group .tab-title.active, .horizontal .ultra_tab_group .tab-title.hover, .vertical .ultra_tab_group .tab-title.active, .vertical .ultra_tab_group .tab-title.hover, .ultra_toggle .ultra_toggle_title, #loading1 .object {
		background: ".sanitize_hex_color($theme_color).";
	}
	@media (max-width: 768px) {
		.ultra-block-wrapper .block-header.style2 .header,
		.ultra-block-wrapper .block-header.style3 .header {	
			background: ".sanitize_hex_color($theme_color).";
		}
    }
	.ultra-block-wrapper .block-header .header:before, h2.widget-title.style1 span.title:before{
		border-color: transparent transparent transparent ".sanitize_hex_color($theme_color).";
	}
	";

	/* Header Colors */
	$theader_bg = get_theme_mod('ultra_seven_top_bg',$defaults['ultra_seven_top_bg']);
	$theader_text = get_theme_mod('ultra_seven_top_text',$defaults['ultra_seven_top_text']);
	$bheader_bg = get_theme_mod('ultra_seven_bottom_bg',$defaults['ultra_seven_bottom_bg']);
	$bheader_text = get_theme_mod('ultra_seven_bottom_text',$defaults['ultra_seven_bottom_text']);
	$bheader_atext = get_theme_mod('ultra_seven_bottom_text_active',$defaults['ultra_seven_bottom_text_active']);

	$custom_css .= "
	.ultra-top-header, .top-header-three.ultra-top-header{
		background: $theader_bg;
	}
	.ultra-top-header .top-left ul li a, .ultra-top-header .top-right ul li a{
		color: $theader_text;
	}
	.site-header.layout-two .nav-search-wrap, .site-header.layout-three .ultra-menu{
		background: $bheader_bg;
	}
	.site-header.layout-two .main-navigation > ul > li > a, .side-menu-wrap i, .index-icon a, .main-navigation ul li.menu-item-has-children > a:before, .main-navigation ul > li.menu-item-has-children > a:before, .ultra-search i, .site-header.layout-three .main-navigation > ul > li > a{
		color: $bheader_text;
	}
	.site-header.layout-two .main-navigation ul li.current-menu-item > a, .site-header.layout-two .main-navigation ul li > a:hover, .site-header.layout-three .main-navigation > ul > li.current-menu-item > a, .site-header.layout-three .main-navigation > ul > li > a:hover{
		color: $bheader_atext;
	}
	";

	if(is_front_page()){
		$ultra_seven_homepage = get_theme_mod('ultra_seven_homepage');
		$values = json_decode($ultra_seven_homepage);
		if(!empty($values)):
		$block = 0;
		foreach( $values as $value){
			$block ++;
			$block_color = $value->ultra_seven_section_txt_color;
            if($block_color!=''):
				$custom_css .= "#ultra-block-".absint($block)." .ultra-block-wrapper .block-header{
					border-color: ".esc_attr($block_color).";
				}
				#ultra-block-".absint($block)." .ultra-block-wrapper .block-header .header{
	                background-color: ".esc_attr($block_color).";
			    }
				#ultra-block-".absint($block)." .ultra-block-wrapper .block-header .header:before{
	                border-color: transparent transparent transparent ".esc_attr($block_color).";
			    }
				#ultra-block-".absint($block)." .ultra-block-wrapper a:hover{
	                color: ".esc_attr($block_color).";
			    }
				";
		    endif;
		}
		endif;	
	}

	/* Container */
	$container_width = get_theme_mod('ultra_seven_container_width','1170');
	if($container_width){
		$custom_css .= ".ultra-container{ max-width: ".absint($container_width)."px; }";
	}
	
	$ultra_page_custom_css = ultra_seven_get_post_meta('ultra_page_custom_css');

	if( $ultra_page_custom_css ){
		$custom_css.= esc_html($ultra_page_custom_css); 
	}

	wp_add_inline_style('ultra_seven-style', apply_filters('ultra_seven_dynamic_css',$custom_css));
}
add_action('wp_enqueue_scripts', 'ultra_seven_custom_stylesheet',1000);