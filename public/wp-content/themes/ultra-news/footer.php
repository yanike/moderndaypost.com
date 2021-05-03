<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ultra News
 * @copyright Copyright (C) 2018 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

?>

	</div><!-- #content -->
    <?php 

    if(is_active_sidebar('footer-insta')){

    ?>
    <div class="footer-insta">
    <?php dynamic_sidebar('footer-insta');?>
    </div>
    <?php }
    $meta = get_post_meta(get_the_ID(),'ultra_page_footer',true);
    $footer_layout = get_post_meta(get_the_ID(),'ultra_page_footer',true);
    $template_id = get_post_meta(get_the_ID(),'ultra_page_custom_footer',true);
    
    if($footer_layout == 'default' || $footer_layout == ''){
        $footer_layout = get_theme_mod('ultra_news_footer_layout','default');
        $template_id = get_theme_mod('ultra_news_custom_footer');
    }

    if($footer_layout!='hide'){
        if($footer_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){
            echo '<div class="ultra-custom-footer">';
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
            echo '</div>';
        }else{
            ?>
        	<footer id="colophon" class="site-footer">

        	   <?php do_action('ultra_seven_footer');?>

        	</footer><!-- #colophon -->
            <?php
        }
    }
    ?>    

    <div id="ultra-go-top">
        <a href="javascript:void(0)">
            <i class="fa fa-angle-up"></i>  
        </a>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
