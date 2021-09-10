<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
$views = WP_Job_Board_Employer::get_post_meta($post->ID, 'views_count', true );
$user_id = WP_Job_Board_User::get_user_by_employer_id($post->ID);
$jobs = WP_Job_Board_Query::get_posts(array(
    'post_type' => 'job_listing',
    'post_status' => 'publish',
    'author' => $user_id,
    'fields' => 'ids'
));
$count_jobs = $jobs->post_count;

$address = WP_Job_Board_Employer::get_post_meta($post->ID, 'address', true );
$categories = get_the_terms( $post->ID, 'employer_category' );
$founded_date = WP_Job_Board_Employer::get_post_meta($post->ID, 'founded_date', true );

$custom_fields = WP_Job_Board_Post_Type_Job_Custom_Fields::get_custom_fields('employer_cfield');
?>
<div class="employer-detail-detail">
    <h4 class="title-detail-employer"><?php esc_html_e('Company Information', 'workio'); ?></h4>
    <ul class="list">
        <?php if ( $custom_fields ) { ?>
            <?php foreach ($custom_fields as $cpost) {
                $value = WP_Job_Board_Employer::get_post_meta( $post->ID, 'custom_'. $cpost->post_name, true );
                $icon_class = get_post_meta( $cpost->ID, WP_JOB_BOARD_EMPLOYER_CUSTOM_FIELD_PREFIX .'icon_class', true );
                
                if ( !empty($value) ) {
                    ?>
                    <li>
                        <div class="icon">
                            <?php if ( !empty($icon_class) ) { ?>
                                <i class="<?php echo esc_attr($icon_class); ?>"></i>
                            <?php } ?>
                        </div>
                        <div class="details">
                            <div class="text"><?php echo trim($cpost->post_title); ?></div>
                            <div class="value"><?php echo WP_Job_Board_Post_Type_Job_Custom_Fields::display_field($cpost, $value); ?></div>
                        </div>
                    </li>
                    <?php
                }
            ?>
                
            <?php } ?>
        <?php } ?>

        <?php if ( $views ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-visibility"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Views', 'workio'); ?></div>
                    <div class="value"><?php echo esc_html($views); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $count_jobs ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-profiles"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Post jobs', 'workio'); ?></div>
                    <div class="value"><?php echo esc_html($count_jobs); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $address ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-pin"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Location', 'workio'); ?></div>
                    <div class="value"><?php echo esc_html($address); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $categories ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-reaction"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Categories', 'workio'); ?></div>
                    <div class="value">
                        <?php foreach ($categories as $term) { ?>
                            <a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $founded_date ) { ?>
            <li>
                <div class="icon">
                    <i class="flaticon-birthday"></i>
                </div>
                <div class="details">
                    <div class="text"><?php esc_html_e('Since', 'workio'); ?></div>
                    <div class="value"><?php echo trim($founded_date); ?></div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>