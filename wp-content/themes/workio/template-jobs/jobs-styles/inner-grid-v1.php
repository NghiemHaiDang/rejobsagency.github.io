<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

?>

<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>

<article <?php post_class('job-grid job-grid-v1 map-item job-style-inner'); ?> <?php workio_job_item_map_meta($post); ?>>
    <?php workio_job_display_featured_urgent_label($post); ?>
    <?php workio_job_display_job_type($post); ?>

    <?php workio_job_display_employer_logo($post); ?>

    <div class="job-information">
        
        <div class="job-title-wrapper">
            <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <?php workio_job_display_employer_title($post); ?>
        </div>
        <?php workio_job_display_tags_v2($post, 'no-title'); ?>

        <?php workio_job_display_full_location($post, 'icon'); ?>
        <div class="more">
            <a class="view-detail text-theme" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Browse Job', 'workio'); ?><i class="fa fa-angle-double-right"></i></a>
        </div>
	</div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>