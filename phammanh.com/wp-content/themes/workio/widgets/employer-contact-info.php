<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
if ( empty($post->post_type) || $post->post_type != 'employer' ) {
    return;
}
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

$address = WP_Job_Board_Employer::get_post_meta($post->ID, 'address');
$phone = WP_Job_Board_Employer::get_display_phone($post);
$email = WP_Job_Board_Employer::get_display_email($post);
$website = WP_Job_Board_Employer::get_post_meta($post->ID, 'website');

$latitude = WP_Job_Board_Employer::get_post_meta( $post->ID, 'map_location_latitude', true );
$longitude = WP_Job_Board_Employer::get_post_meta( $post->ID, 'map_location_longitude', true );
?>
<?php if ( !empty($latitude) && !empty($longitude) ) { ?>
    <div class="job_maps_sidebar">
        <div id="jobs-google-maps" class="single-job-map"></div>
    </div>
<?php } ?>
<div class="employer-detail-location info-member-widget">
	<?php 
        if ( $title ) {
            echo trim($before_title)  . trim( $title ) . $after_title;
        }
    ?>
	<ul class="list list-info-member">
        
		<?php if ( $phone ) { ?>
            <li>
                <div class="text"><?php esc_html_e('SĐT: ', 'workio'); ?></div>
                <div class="value"><?php echo esc_html($phone); ?></div>
            </li>
        <?php } ?>

        <?php if ( $email ) { ?>
            <li>
                <div class="text"><?php esc_html_e('Email: ', 'workio'); ?></div>
                <div class="value"><?php echo esc_html($email); ?></div>
            </li>
        <?php } ?>

        <?php if ( $website ) { ?>
            <li>
                <div class="text"><?php esc_html_e('Website: ', 'workio'); ?></div>
                <div class="value"><?php echo esc_html($website); ?></div>
            </li>
        <?php } ?>

        <?php if ( $address ) { ?>
            <li>
                <div class="text"><?php esc_html_e('Địa điểm: ', 'workio'); ?></div>
                <div class="value"><?php echo esc_html($address); ?></div>
            </li>
        <?php } ?>
    </ul>
</div>
