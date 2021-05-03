<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ultra Seven
 * @copyright Copyright (C) 2018 WPoperation
 * @license  http://www.gnu.org/licenses/gpl-2.0.html
 * @author WPoperation <https://wpoperation.com/>
 */

?>

	</div><!-- #content -->
    <?php do_action('ultra_seven_before_footer');?>
    <?php 
    if(is_active_sidebar('footer-insta')){

    ?>
    <div class="footer-insta">
    <?php dynamic_sidebar('footer-insta');?>
    </div>
    <?php }?>
	<footer id="colophon" class="site-footer">

	   <?php do_action('ultra_seven_footer');?>

	</footer><!-- #colophon -->
    <?php 
    $back_top = get_theme_mod('ultra_seven_back_top_option','show');
    if($back_top == 'show'){
    ?>
    <div id="ultra-go-top">
        <a href="javascript:void(0)">
            <i class="fa fa-angle-up"></i>  
        </a>
    </div>
    <?php }?>
    <?php do_action('ultra_seven_after_footer');?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
