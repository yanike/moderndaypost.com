<?php if ('post' === get_post_type()) {
	if (!has_post_format('link')) {
		$mnp_post_from = is_archive() || is_home() ? 'archive' : 'single';
		?>
		<div class="entry-meta magazinenp-parts-item">
			<?php magazinenp_posted_on($mnp_post_from); ?>
		</div>
	<?php }
} ?>
