<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

?>
<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('job-list map-item job-style-inner'); ?> <?php workio_job_item_map_meta($post); ?>>

    <div class="featured-urgent-label">
        <?php workio_job_display_featured_icon($post); ?>  
        <?php workio_job_display_urgent_icon($post); ?>              
    </div>
    
    <div class="flex-middle-sm job-list-container">
        <div class="job-employer-logo">
            <?php workio_job_display_employer_logo($post); ?>
        </div>
        
        <div class="job-tit-x">
            <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <?php workio_job_display_job_type($post); ?> 
            <div class="job-information">
                <div class="job-employer-info-wrapper">
                    <?php workio_job_display_employer_title($post); ?>
                    <div class="job-mtx">
                        <?php workio_job_display_full_location($post, 'icon'); ?>
                        <?php workio_job_display_salary($post, 'icon'); ?>
                    </div>
                    
                </div>            
            </div>
        </div>

    </div>
    
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>