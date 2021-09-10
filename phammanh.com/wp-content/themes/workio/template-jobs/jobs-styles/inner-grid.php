<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>

<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>

<article <?php post_class('job-grid job-grid-default map-item job-style-inner'); ?> <?php workio_job_item_map_meta($post); ?>>
    <?php workio_job_display_featured_urgent_label($post); ?>
    <?php workio_job_display_job_type($post); ?>
    <?php workio_job_display_employer_logo($post); ?>

    <div class="job-information">
        <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <?php workio_job_display_full_location($post, 'icon'); ?>
        <?php workio_job_display_tags($post, 'no-title'); ?>
	</div>
    <div class="job-metas">
        <?php workio_job_display_salary($post, 'no-icon-title'); ?>
        <?php workio_job_display_add_shortlist_btn($post); ?>           
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>