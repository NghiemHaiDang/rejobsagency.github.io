<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

?>

<?php do_action( 'wp_job_board_before_candidate_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('map-item'); ?> <?php workio_candidate_item_map_meta($post); ?>>

    <div class="featured-urgent-label">
        <?php workio_candidate_display_featured_icon($post); ?>
        <?php workio_candidate_display_urgent_icon($post); ?>    
    </div>    

    <div class="candidate-list candidate-archive-layout">
        <div class="flex-middle-sm">
            <?php workio_candidate_display_logo($post, 'workio-logo-size'); ?>

            <div class="flex-middle-sm inner-left">
                <div class="candidate-list-info candidate-information">                    
                    <div class="title-wrapper">
                        <?php the_title( sprintf( '<h2 class="candidate-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>                        
                    </div>
                    <?php workio_candidate_display_categories($post); ?>
                    
                    <div class="info job-metas">
                        <?php workio_candidate_display_full_location($post, 'icon'); ?>
                        <?php workio_candidate_display_salary($post, 'icon'); ?>                        
                    </div>                                       
                </div>
                <?php workio_candidate_display_tags($post, 'no-title'); ?>
                <div class="candidate-list-shortlist">
                    <?php workio_candidate_display_shortlist_btn($post); ?>
                </div>
            </div>
        </div>
    </div>
</article><!-- #post# -->
<?php do_action( 'wp_job_board_after_candidate_content', $post->ID ); ?>