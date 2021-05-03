<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ultra-seven
 */

if ( ! function_exists( 'ultra_seven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ultra_seven_posted_on() {

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_date() . '</a>';

	$byline = sprintf(
		/*translators: author link */
		esc_html( '%s'),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="post-author">'. $byline .'</span><span class="posted-on">'. $posted_on .'</span>';// WPCS: XSS OK.


}
endif;

if ( ! function_exists( 'ultra_seven_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ultra_seven_entry_footer() {
		if ( get_edit_post_link() ) :
        
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ultra-seven' ),
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
	    endif;
	}
endif;

if ( ! function_exists( 'ultra_seven_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function ultra_seven_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		?>
	</a>

	<?php endif; // End is_singular().
}
endif;

/*===========================================================================================================*/
/**
 * Function for entry footer
 */
if ( ! function_exists( 'ultra_seven_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ultra_seven_entry_footer() {

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'ultra-seven' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;
/*===========================================================================================================*/
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ultra_seven_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ultra_seven_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ultra_seven_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ultra_seven_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ultra_seven_categorized_blog should return false.
		return false;
	}
}
/*===========================================================================================================*/
/**
 * Flush out the transients used in ultra_seven_categorized_blog.
 */
function ultra_seven_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ultra_seven_categories' );
}
add_action( 'edit_category', 'ultra_seven_category_transient_flusher' );
add_action( 'save_post',     'ultra_seven_category_transient_flusher' );