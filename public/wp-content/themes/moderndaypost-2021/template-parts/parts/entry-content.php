<div class="entry-content magazinenp-parts-item" style="position: relative;">
	<?php if (is_singular()) {
	    ?>
	    <div style="position: absolute; font-size: 10em; font-weight: bold; top: -71px; left: -1px; color: rgba(0,0,0,0.1); text-transform: uppercase;"><?php echo wp_strip_all_tags($post->post_content)[0]; ?></div>
	    <?php
		the_content();
		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages: ', 'magazinenp'),
			'separator' => '',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'after' => '</div>'
		));
	} else {
		?>
		<p><?php echo magazinenp_get_excerpt($post); ?></p>
		<?php
	} ?>
</div>
