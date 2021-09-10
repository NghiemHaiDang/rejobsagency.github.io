<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$cover_photo = WP_Job_Board_Employer::get_post_meta($post->ID, 'cover_photo');
$style = '';
if ( !empty($cover_photo) ) {
    $style = 'style="background-image:url('.$cover_photo.');"';
}
?>
<div class="employer-detail-header" <?php echo trim($style); ?>>
    <div class="container">
        <div class="flex-bottom-sm employer-detail-header-row row">
            <div class="col-xs-12 col-sm-8">  
                <div class="flex-middle employer-detail-header-container">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <div class="inner-image">
                            <div class="employer-thumbnail">
                                <?php if ( has_post_thumbnail($post->ID) ) { ?>
                                    <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
                                <?php } else { ?>
                                    <img src="<?php echo esc_url(workio_placeholder_img_src()); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="employer-information">
                        <div class="title-wrapper">
                            <?php the_title( '<h1 class="employer-title">', '</h1>' ); ?>
                            <?php workio_employer_display_featured_icon($post, 'icon'); ?>
                        </div>
                        <div class="employer-detail-header-meta">
                            <?php workio_employer_display_category($post->ID); ?>
                            <?php workio_employer_display_full_location($post); ?>                            
                        </div>
                        <div class="employer-detail-buttons hidden-xs">
                            <?php workio_employer_display_follow_btn($post->ID); ?>
                            <a href="#review_form_wrapper" class="btn button btn-theme btn-outline add-a-review"><i class="ti-email pre"></i><?php esc_html_e('Add review', 'workio'); ?></a>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="col-xs-12 visible-xs">
                <div class="employer-detail-buttons">
                    <?php workio_employer_display_follow_btn($post->ID); ?>
                    <?php if ( workio_check_employer_candidate_review($post) ) { ?>
                        <a href="#review_form_wrapper" class="btn button btn-theme btn-outline add-a-review"><i class="ti-email pre"></i><?php esc_html_e('Add review', 'workio'); ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 employer-detail-header-end">  
                <div class="employer-detail-header-right justify-content-end-sm flex-middle">
                    <?php workio_employer_display_nb_jobs($post); ?>
                    <?php workio_employer_display_nb_reviews($post); ?>
                    <?php workio_employer_display_nb_views($post); ?>
                </div>
            </div>
        </div>
    </div>
</div>