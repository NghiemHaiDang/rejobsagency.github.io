<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

?>

<?php do_action( 'wp_job_board_before_candidate_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('map-item'); ?> <?php workio_candidate_item_map_meta($post); ?>>
    <div class="candidate-grid candidate-archive-layout">
        
        <?php workio_candidate_display_featured_urgent_label($post); ?>
        <?php workio_candidate_display_shortlist_btn($post, false, false); ?>

        <?php echo workio_candidate_display_logo( $post, 'workio-logo-size' ); ?>
        <div class="inner-bottom">
            <div class="candidate-information">
                
                <div class="title-wrapper">
                    <?php the_title( sprintf( '<h2 class="candidate-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </div>
                
                <div class="info job-metas clearfix">
                    <?php workio_candidate_display_job_title($post); ?>
                    <?php workio_candidate_display_nb_reviews($post); ?>
                </div>

                <?php workio_candidate_display_tags($post, 'no-title', 3); ?>
                
            </div>
            <div class="candidate-btns">
                <a class="view-detail text-theme" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e('View Profile', 'workio'); ?><i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
</article><!-- #post# -->
<?php do_action( 'wp_job_board_after_candidate_content', $post->ID ); ?>