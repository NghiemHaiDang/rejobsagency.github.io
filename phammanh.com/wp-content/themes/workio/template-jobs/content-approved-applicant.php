<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

$candidate_id = get_post_meta( $post->ID, WP_JOB_BOARD_APPLICANT_PREFIX.'candidate_id', true );
$candidate = get_post($candidate_id);

$candidate_url = get_permalink($candidate_id);
$candidate_url = add_query_arg( 'applicant_id', $post->ID, $candidate_url );
$candidate_url = add_query_arg( 'candidate_id', $candidate_id, $candidate_url );
$candidate_url = add_query_arg( 'action', 'view-profile', $candidate_url );

$admin_url = admin_url( 'admin-ajax.php' );
$download_url = add_query_arg(array('action' => 'wp_job_board_ajax_download_resume_cv', 'post_id' => $candidate_id), $admin_url);

$rating_avg = WP_Job_Board_Review::get_ratings_average($candidate_id);

$viewed = get_post_meta( $post->ID, WP_JOB_BOARD_APPLICANT_PREFIX.'viewed', true );
$classes = $viewed ? 'viewed' : '';
?>

<?php do_action( 'wp_job_board_before_applicant_content', $post->ID ); ?>

<article <?php post_class('applicants-job job-applicant-wrapper candidate-list candidate-archive-layout '.$classes); ?>>
    <div class="flex-sm">
        <?php if ( has_post_thumbnail($candidate_id) ) { ?>
            <div class="candidate-thumbnail">
                <a href="<?php echo esc_url( $candidate_url ); ?>" rel="bookmark">
                    <?php echo get_the_post_thumbnail( $candidate_id, 'thumbnail' ); ?>
                </a>
                <?php if ( !empty($rating_avg) ) { ?>
                    <div class="rating-avg"><?php echo round($rating_avg,1,PHP_ROUND_HALF_UP); ?></div>
                <?php } ?>
            </div>
        <?php } ?>
            <div class="flex-middle-sm inner-left">

                <div class="flex-middle-sm inner-left">
                    <div class="candidate-information candidate-list-info">
                        
                        <?php workio_candidate_display_categories($candidate); ?>

                        <div class="title-wrapper">
                            <?php the_title( sprintf( '<h2 class="candidate-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                            <span class="date"> - <?php the_time( get_option('date_format', 'd M, Y') ); ?></span>

                            <?php
                                $rejected = WP_Job_Board_Applicant::get_post_meta($post->ID, 'rejected', true);
                                $approved = WP_Job_Board_Applicant::get_post_meta($post->ID, 'approved', true);

                                if ( $approved ) {
                                    echo '<span class="application-status-label label label-success approved">'.esc_html__('Approved', 'workio').'</span>';
                                } elseif ( $rejected ) {
                                    echo '<span class="application-status-label label label-danger rejected">'.esc_html__('Rejected', 'workio').'</span>';
                                } else {
                                    echo '<span class="application-status-label label label-default pending">'.esc_html__('Pending', 'workio').'</span>';
                                }
                            ?>
                        </div>
                        
                        <div class="info job-metas clearfix">
                            <?php workio_candidate_display_full_location($candidate, 'icon'); ?>

                            <?php workio_candidate_display_salary($candidate, 'icon'); ?>
                        </div>

                    </div>
                    <?php workio_candidate_display_tags($candidate, 'no-title'); ?>
                </div>

                <div class="ali-right visible-lg">
                    <div class="flex-middle">
                        <div class="applicant-action-button">
                            
                            <a data-toggle="tooltip" title="<?php esc_attr_e('Undo Approved', 'workio'); ?>" href="javascript:void(0);" class="btn-undo-approve-job-applied btn-action-icon rejec approve" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-undo-approve-applied-nonce' )); ?>"><i class="fa fa-undo"></i></a>

                            <a data-toggle="tooltip" title="<?php esc_attr_e('Remove', 'workio'); ?>" href="javascript:void(0);" class="btn-action-icon btn-remove-job-applied remove" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-applied-nonce' )); ?>"><i class="ti-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="hidden-lg bottom-action-mobile">
        <div class="flex-middle">
            <div class="applicant-action-button">
                
                <a data-toggle="tooltip" title="<?php esc_attr_e('Undo Approved', 'workio'); ?>" href="javascript:void(0);" class="btn-undo-approve-job-applied btn-action-icon rejec approve" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-undo-approve-applied-nonce' )); ?>"><i class="fa fa-undo"></i></a>

                <a data-toggle="tooltip" title="<?php esc_attr_e('Remove', 'workio'); ?>" href="javascript:void(0);" class="btn-action-icon btn-remove-job-applied remove" data-applicant_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-applied-nonce' )); ?>"><i class="ti-close"></i></a>
            </div>
        </div>
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_applicant_content', $post->ID );