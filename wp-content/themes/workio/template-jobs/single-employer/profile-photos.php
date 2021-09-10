<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$profile_photos = WP_Job_Board_Employer::get_post_meta($post->ID, 'profile_photos', true );

if ( !empty($profile_photos) ) {
?>
    <div id="job-employer-portfolio" class="employer-detail-portfolio candidate-detail-portfolio">
    	<h4 class="title"><?php esc_html_e('Office Photos', 'workio'); ?></h4>
        <div class="row drop-top">
            <?php foreach ($profile_photos as $attach_id => $img_url) { ?>
                <div class="col-xs-4">
                    <div class="photo-item">
                    	<a href="<?php echo esc_url($img_url); ?>" class="item" data-elementor-lightbox-slideshow="gallery-profile-photos">
                        	<?php echo wp_get_attachment_image( $attach_id, 'medium' );  ?>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php }