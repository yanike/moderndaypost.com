<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Engage Mag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php engage_mag_do_microdata('article'); ?>>
    <?php
    $engage_mag_thumbnail = (has_post_thumbnail()) ? 'engage-mag-has-thumbnail' : 'engage-mag-no-thumbnail';
    ?>
    <div class="engage-mag-content-container <?php echo $engage_mag_thumbnail; ?>">
        <?php
        if (has_post_thumbnail()):
            the_post_thumbnail();
        endif;
        ?>
        <div class="engage-mag-content-area">
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title" '.engage_mag_get_microdata("heading").'>', '</h1>'); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'engage-mag'),
                    'after' => '</div>',
                ));
                ?>
            </div><!-- .entry-content -->

            <?php if (get_edit_post_link()) : ?>
                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Edit <span class="screen-reader-text">%s</span>', 'engage-mag'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->
            <?php endif; ?>
            <?php
            /**
             * engage_mag_social_sharing hook
             * @since 1.0.0
             *
             * @hooked engage_mag_constuct_social_sharing -  10
             */
            do_action( 'engage_mag_social_sharing' ,get_the_ID() );
            ?>
        </div> <!-- .engage-mag-content-area -->
    </div> <!-- .engage-mag-content-container -->
</article><!-- #post-<?php the_ID(); ?> -->
