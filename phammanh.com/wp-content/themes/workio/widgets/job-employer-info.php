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

$author_id = $post->post_author;
$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);
if ( empty($employer_id) ) {
    return;
}

$address = WP_Job_Board_Employer::get_post_meta($employer_id, 'address');
$phone = WP_Job_Board_Employer::get_display_phone($employer_id);
$email = WP_Job_Board_Employer::get_display_email($employer_id);
$website = WP_Job_Board_Employer::get_post_meta($employer_id, 'website');

?>
<div class="job-detail-employer-info">
    
    <?php if ( !empty($employer_id) && has_post_thumbnail($employer_id) ) { ?>
        <div class="inner-image">
            <a href="<?php echo esc_url( get_permalink($employer_id) ); ?>">
                <?php echo get_the_post_thumbnail( $employer_id, 'workio-logo-size' ); ?>
            </a>
        </div>
    <?php } ?>
    <?php if ( !empty($employer_id) ) { ?>
        <h3 class="job-detail-title-employer"><a href="<?php echo esc_url( get_permalink($employer_id) ); ?>"><?php echo get_the_title($employer_id); ?></a></h3>
    <?php } ?>
    <?php if ( empty($address) || !empty($phone) || !empty($email) || !empty($website) ) { ?>
        <ul class="list">
        
            <?php if ( $phone ) { ?>
                <li>
                    <div class="icon">
                        <i class="flaticon-call"></i>
                    </div>
                    <div class="details">
                        <div class="text"><?php esc_html_e('Phone', 'workio'); ?></div>
                        <div class="value"><?php echo esc_html($phone); ?></div>
                    </div>
                </li>
            <?php } ?>

            <?php if ( $email ) { ?>
                <li>
                    <div class="icon">
                        <i class="flaticon-email"></i>
                    </div>
                    <div class="details">
                        <div class="text"><?php esc_html_e('Email', 'workio'); ?></div>
                        <div class="value"><?php echo esc_html($email); ?></div>
                    </div>
                </li>
            <?php } ?>

            <?php if ( $website ) { ?>
                <li>
                    <div class="icon">
                        <i class="flaticon-www"></i>
                    </div>
                    <div class="details">
                        <div class="text"><?php esc_html_e('Website', 'workio'); ?></div>
                        <div class="value"><?php echo esc_html($website); ?></div>
                    </div>
                </li>
            <?php } ?>

            <?php if ( $address ) { ?>
                <li>
                    <div class="icon">
                        <i class="flaticon-pin"></i>
                    </div>
                    <div class="details">
                        <div class="text"><?php esc_html_e('Địa điểm', 'workio'); ?></div>
                        <div class="value"><?php echo esc_html($address); ?></div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>