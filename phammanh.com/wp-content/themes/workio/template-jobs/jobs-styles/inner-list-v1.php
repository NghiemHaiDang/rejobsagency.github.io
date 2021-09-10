<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

?>
<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('job-list job-list-v1 map-item job-style-inner'); ?> <?php workio_job_item_map_meta($post); ?>>

    <div class="featured-urgent-label">
        <?php workio_job_display_featured_icon($post); ?>
        <?php workio_job_display_urgent_icon($post); ?>        
    </div>

    <div class="flex-middle-sm job-list-container">
        <div class="job-employer-logo">
            <?php workio_job_display_employer_logo($post); ?>
        </div>
        <div class="job-information">
            <div class="title-wrapper">
                <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>                
            </div>
            <div class="job-employer-info-wrapper">                
                <?php workio_job_display_salary($post, 'no-icon-title'); ?>
                <?php workio_job_display_job_type($post); ?>
            </div>
            <?php workio_job_display_full_location($post, 'icon'); ?>
        </div>        
        
        <?php WP_Job_Board_Job_Listing::display_apply_job_btn($post->ID); ?>

    </div>
    
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>