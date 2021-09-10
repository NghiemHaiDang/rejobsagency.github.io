<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$author_id = $post->post_author;
$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);
?>
<?php 
    if(has_post_thumbnail()){
        $img_bg_src = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'full' );
        $style = 'style="background-image:url('.esc_url($img_bg_src).')"';
    }else{
        $style = '';
    }
?>
<div class="job-detail-header v1" <?php echo trim($style); ?>>
    <div class="inner-v1">
        <div class="container">
            <div class="row flex-bottom-sm">
                <div class="col-md-8 col-sm-7 col-xs-12">
                    <div class="flex-middle employer-logo-wrapper">
                        <?php if ( has_post_thumbnail($employer_id) ) { ?>
                            <div class="job-detail-thumbnail">
                                <?php workio_job_display_employer_logo($post); ?>
                                <?php workio_job_display_urgent_icon($post, 'icon'); ?>
                            </div>
                        <?php } ?>


                        <div class="inner-info">
                            <div class="title-wrapper">
                                <?php the_title( '<h1 class="job-title">', '</h1>' ); ?>
                                <?php workio_job_display_featured_icon($post, 'icon'); ?>
                            </div>
                            <?php workio_job_display_job_categories($post); ?>
                            <div class="job-detail-header-meta">
                                <?php workio_employer_display_phone($employer_id); ?>
                                <?php workio_job_display_full_location($post, 'icon'); ?>  
                            </div>                                    
                        </div>
                    </div>
                </div>

                <div class="job-detail-buttons col-md-4 col-sm-5 col-xs-12">
                    <div class="job-detail-header-container">
                        <div class="action">
                            <?php WP_Job_Board_Job_Listing::display_apply_job_btn($post->ID); ?>
                            <?php WP_Job_Board_Job_Listing::display_shortlist_btn($post->ID); ?>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>