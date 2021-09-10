<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
if ( empty($post->post_type) || $post->post_type != 'job_listing' ) {
    return;
}
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$location = workio_job_display_full_location($post, 'no-icon-title', false);
$category = workio_job_display_job_category($post, 'no-icon-title', false);
$salary = WP_Job_Board_Job_Listing::get_salary_html($post->ID);
$type = workio_job_display_job_type($post, 'no-icon-title', false);
$postdate = workio_job_display_postdate($post, 'no-icon-title', 'ago', false);
$applied_nb = workio_job_display_applied_nb($post, 'no-icon-title', false);
$custom_fields = WP_Job_Board_Post_Type_Job_Custom_Fields::get_custom_fields('job_cfield');
?>
<div class="job-detail-detail">
    

    <h3 class="widget-title"><?php esc_html_e('Thông tin công việc', 'workio'); ?></h3>
    <ul class="list">
        

        <?php if ( $type ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-work"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Công việc', 'workio'); ?></div>
                    <div class="value"><?php echo trim($type); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $category ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-reaction"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Thể loại', 'workio'); ?></div>
                    <div class="value"><?php echo trim($category); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $location ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-pin"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Vị trí', 'workio'); ?></div>
                    <div class="value"><?php echo trim($location); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $salary ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-save-money"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Mức lương', 'workio'); ?></div>
                    <div class="value"><?php echo trim($salary); ?></div>
                </div>
            </li>
        <?php } ?>
        <?php if ( $postdate ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-profiles"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Bài viết', 'workio'); ?></div>
                    <div class="value"><?php echo trim($postdate); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $custom_fields ) { ?>
            <?php foreach ($custom_fields as $cpost) {
                $meta_key = WP_Job_Board_Post_Type_Job_Custom_Fields::generate_key_id(WP_JOB_BOARD_JOB_LISTING_PREFIX, $cpost->post_name);
                $value = get_post_meta( $post->ID, $meta_key, true );
                $icon_class = get_post_meta( $cpost->ID, WP_JOB_BOARD_JOB_CUSTOM_FIELD_PREFIX .'icon_class', true );

                if ( !empty($value) ) {
                    ?>
                    <li>
                        <div class="icon">
                            <?php if ( !empty($icon_class) ) { ?>
                                <i class="<?php echo esc_attr($icon_class); ?>"></i>
                            <?php } ?>
                        </div>
                        <div class="details">
                            <div class="text"><?php echo wp_kses_post($cpost->post_title); ?></div>
                            <div class="value"><?php echo WP_Job_Board_Post_Type_Job_Custom_Fields::display_field($cpost, $value); ?></div>
                        </div>
                    </li>
                    <?php
                }
            ?>
            <?php } ?>
        <?php } ?>

        <?php if ( $applied_nb ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-businessman-paper-of-the-application-for-a-job"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Đã ứng tuyển', 'workio'); ?></div>
                    <div class="value"><?php echo trim($applied_nb); ?></div>
                </div>
            </li>
        <?php } ?>

    </ul>

    <div class="action">
        <?php WP_Job_Board_Job_Listing::display_apply_job_btn($post->ID); ?>
        <?php workio_job_display_shortlist_btn($post->ID); ?>
    </div>

    <?php
    $fb = WP_Job_Board_Social_Facebook::get_instance()->is_facebook_apply_enabled();
    $gg = WP_Job_Board_Social_Google::get_instance()->is_google_apply_enabled();
    $li = WP_Job_Board_Social_Linkedin::get_instance()->is_linkedin_apply_enabled();
    $tw = WP_Job_Board_Social_Twitter::get_instance()->is_twitter_apply_enabled();

    if ( WP_Job_Board_Job_Listing::check_can_apply_social($post->ID) && ($fb || $gg || $li || $tw) ) { ?>
        <div class="socials-apply">
            <div class="title"><?php esc_html_e('hoặc ứng tuyển với', 'workio'); ?></div>
            <div class="inner">
                <?php do_action('wp_job_board_social_apply_btn', $post); ?>
            </div>
        </div>
    <?php } ?>
</div>