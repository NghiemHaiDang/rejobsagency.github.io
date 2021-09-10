<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

?>

<?php do_action( 'wp_job_board_before_employer_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="employer-grid employer-style-inner">

        <div class="featured-urgent-label">            
            <?php workio_employer_display_featured_icon($post); ?>
        </div>
        
        <?php workio_employer_display_follow_btn($post->ID, false); ?>
        <?php workio_employer_display_logo($post); ?>

        <div class="employer-information">

            <div class="title-wrapper">
                <?php the_title( sprintf( '<h2 class="employer-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>                
            </div>

            <?php workio_employer_display_category($post->ID, 'no-icon'); ?>
            
            <div class="employer-metas">
                <?php workio_employer_display_open_position($post); ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_employer_content', $post->ID ); ?>