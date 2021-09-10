<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
if ( empty($post->post_type) || $post->post_type != 'candidate' ) {
    return;
}
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}
$views = get_post_meta(get_the_ID(), WP_JOB_BOARD_CANDIDATE_PREFIX.'views_count', true );

$address = WP_Job_Board_Candidate::get_post_meta(get_the_ID(), 'address', true );
$categories = get_the_terms( get_the_ID(), 'candidate_category' );

$salary = WP_Job_Board_Candidate::get_salary_html($post->ID);
$custom_fields = WP_Job_Board_Post_Type_Job_Custom_Fields::get_custom_fields('candidate_cfield');
?>
<div class="employer-detail-detail">

    <div class="candidate_profile">
        
        <ul class="list">
            <?php if ( $categories ) { ?>
                <li>
                    <div class="icon">                        
                        <i class="flaticon-reaction"></i>
                    </div>
                    <div class="details">
                        <div class="text"><?php esc_html_e('Chuyên môn: ', 'workio'); ?></div>
                        <div class="value">
                            <?php foreach ($categories as $term) { ?>
                                <a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php if ( $salary ) { ?>
                <li>
                    <div class="icon">                        
                        <i class="flaticon-save-money"></i>
                    </div>
                    <div class="details">
                        <div class="text"><?php esc_html_e('Mức lương: ', 'workio'); ?></div>
                        <div class="value"><?php echo wp_kses_post($salary); ?></div>
                    </div>
                </li>
            <?php } ?>
            <?php if ( $custom_fields ) { ?>
                <?php foreach ($custom_fields as $cpost) {
                    $value = get_post_meta( $post->ID, WP_JOB_BOARD_CANDIDATE_PREFIX .'custom_'. $cpost->post_name, true );
                    $icon_class = get_post_meta( $cpost->ID, WP_JOB_BOARD_CANDIDATE_CUSTOM_FIELD_PREFIX .'icon_class', true );
                    
                    if ( !empty($value) ) {
                        ?>
                        <li>
                            <div class="icon">
                                <?php if ( !empty($icon_class) ) { ?>
                                    <i class="<?php echo esc_attr($icon_class); ?>"></i>
                                <?php } ?>
                            </div>
                            <div class="details">
                                <div class="text"><?php echo wp_kses_post($cpost->post_title); ?>: </div>
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
                        <div class="text"><?php esc_html_e('Lượt xem: ', 'workio'); ?></div>
                        <div class="value"><?php echo wp_kses_post($views); ?></div>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <?php if ( WP_Job_Board_Candidate::check_restrict_view_contact_info($post) && workio_is_wp_private_message() ) { ?>
            <div class="space-10">  
                <a class="btn btn-theme btn-block btn-candidate-private-message btn-loading" href="javascript:void(0);" data-candidate_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-private-message-send-message-form-nonce' )); ?>"><?php esc_html_e('Contact Me', 'workio'); ?></a>
            </div> 
        <?php } ?>

        <div class="action">
            <?php WP_Job_Board_Candidate::display_shortlist_btn($post->ID); ?>
            <?php WP_Job_Board_Candidate::display_download_cv_btn($post->ID); ?>
        </div>
    </div>
</div>