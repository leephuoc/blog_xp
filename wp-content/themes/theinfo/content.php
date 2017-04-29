<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail">
		<?php leephuoc_thumbnail('thumbnail'); ?>
	</div>
	<div class="entry-header">
		<?php leephuoc_entry_header();?>
		<?php leephuoc_entry_meta(); ?>
	</div>
	<div class="entry-content"></div>
</article>