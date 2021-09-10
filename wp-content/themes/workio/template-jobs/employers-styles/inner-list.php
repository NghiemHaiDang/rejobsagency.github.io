<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

?>

<?php do_action( 'wp_job_board_before_employer_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="featured-urgent-label">
        <?php workio_employer_display_featured_icon($post); ?>
    </div>
    <div class="employer-list employer-style-inner">        
        <div class="flex-middle-sm employers-listing-box">
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="left-inner">
                    <?php workio_employer_display_logo($post); ?>
                </div>
            <?php } ?>
            <div class="right-content">
                <div class="employer-information">
                    <div class="employer-job-information">                        
                        <div class="title-wrapper">
                            <?php the_title( sprintf( '<h2 class="employer-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        </div>                              
                        <?php workio_employer_display_category($post->ID, 'no-icon'); ?>              
                    </div>
                    <div class="employer-metas job-metas employer-job-location">
                        <?php workio_employer_display_full_location($post,'icon'); ?>                        
                    </div>
                    <div class="employer-metas job-metas employer-job-open">
                        <?php workio_employer_display_open_position($post); ?>    
                    </div>

                    <?php if ( !empty($unfollow) ) { ?>
                        <div class="unfollow-wrapper">
                            <a href="javascript:void(0)" class="btn button btn-danger btn-unfollow-employer" data-employer_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-unfollow-employer-nonce' )); ?>"><?php esc_html_e('Unfollow', 'workio'); ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</article>

<?php do_action( 'wp_job_board_after_employer_content', $post->ID ); ?>