<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="candidates-pagination-wrapper main-pagination-wrapper">
	<?php
		$pagination_type = workio_get_candidates_pagination();
		if ( $pagination_type == 'loadmore' || $pagination_type == 'infinite' ) {
			$next_link = get_next_posts_link( '&nbsp;', $candidates->max_num_pages );
			if ( $next_link ) {
		?>
				<div class="ajax-pagination <?php echo trim($pagination_type == 'loadmore' ? 'loadmore-action' : 'infinite-action'); ?>">
					<div class="apus-pagination-next-link hidden"><?php echo trim($next_link); ?></div>
					<a href="#" class="apus-loadmore-btn"><?php esc_html_e( 'Load more', 'workio' ); ?></a>
					<span href="#" class="apus-allproducts"><?php esc_html_e( 'Tất cả các công ty.', 'workio' ); ?></span>
				</div>
		<?php
			}
		} else {
			WP_Job_Board_Mixes::custom_pagination( array(
				'wp_query' => $candidates,
				'max_num_pages' => $candidates->max_num_pages,
				'prev_text'     => '<i class="ti-angle-left"></i>',
				'next_text'     => '<i class="ti-angle-right"></i>',
			));
		}
	?>
</div>
