<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;
$category = get_the_terms( $post->ID, 'job_listing_category' );
?>
<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('job-list-simple map-item'); ?>>
    <div class="flex">
        <?php workio_job_display_employer_logo($post); ?>
        <div class="job-information inner flex">
            <div class="flex-middle">
                <div class="inner-content">
                    <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    <div class="job-metas">
                        <?php workio_job_display_full_location($post, 'title'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>