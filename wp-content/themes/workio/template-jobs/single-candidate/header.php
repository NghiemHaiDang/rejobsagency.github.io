<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$location_html = workio_candidate_display_full_location($post, 'icon', false);
$phone_html = workio_candidate_display_phone($post, false);
$email_html = workio_candidate_display_email($post, false);
$salary_html = workio_candidate_display_salary($post, 'icon', false);

$cover_photo = WP_Job_Board_Candidate::get_post_meta($post->ID, 'cover_photo');
$style = '';
if ( !empty($cover_photo) ) {
    $style = 'style="background-image:url('.$cover_photo.');"';
}
?>
<div class="candidate-detail-header" <?php echo trim($style); ?>>
    <div class="container">
        <div class="row candidate-detail-header-row">
            <div class="col-md-8 col-sm-7 col-xs-12"> 
                <div class="candidate-detail-header-meta">                    
                    <?php if ( has_post_thumbnail() ) { ?>
                        <div class="candidate-thumbnail">
                            <?php workio_candidate_display_urgent_icon($post, 'icon'); ?>
                            <div class="inner-image">
                                <?php if ( has_post_thumbnail($post->ID) ) { ?>
                                    <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
                                <?php } else { ?>
                                    <img src="<?php echo esc_url(workio_placeholder_img_src()); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="candidate-information">
                        <div class="title-wrapper">
                            <?php the_title( '<h1 class="candidate-title">', '</h1>' ); ?>
                            <?php workio_candidate_display_featured_icon($post, 'icon'); ?>
                        </div>

                        <?php workio_candidate_display_job_title($post); ?>

                        <ul class="list-detail-candidate clearfix">
                            <?php if ( $location_html ) { ?>
                                <li>
                                    <?php echo wp_kses_post($location_html); ?>
                                </li>
                            <?php } ?>
                            <?php if ( $email_html ) { ?>
                                <li>
                                    <?php echo wp_kses_post($email_html); ?>
                                </li>
                            <?php } ?>
                            <?php if ( $phone_html ) { ?>
                                <li>
                                    <?php echo wp_kses_post($phone_html); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4">
                <div class="candidate-detail-buttons">
                    <div class="wrapper-shortlist">
                        <?php WP_Job_Board_Candidate::display_shortlist_btn($post->ID); ?>
                    </div>
                    <?php
                        WP_Job_Board_Candidate::display_download_cv_btn($post->ID);
                    ?>
                </div>
            </div>
        </div>       
    </div>
</div>