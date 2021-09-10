<?php
/**
 *
 * If no content, include the "No posts found" template.
 * @since 1.0
 * @version 1.0.0
 *
 */
 
 $keynone = $_GET['s'];
 header ('Location: https://www.google.com/search?q=site:phammanh.com '.$keynone);
?>
<article id="post-0" class="post no-results not-found">
	<div class="entry-content e-entry-content">
		<h2 class="title-no-results">
			<?php esc_html_e( 'Nothing Found', 'workio' ) ?>
		</h2>
		<div><?php esc_html_e( 'Try again please, use the search form below.', 'workio' ); ?></div>
		<?php //get_search_form(); ?>
		<?php echo do_shortcode('[khung_tim_kiem]'); ?>
	</div>
	<!-- entry-content -->
</article><!-- /article -->