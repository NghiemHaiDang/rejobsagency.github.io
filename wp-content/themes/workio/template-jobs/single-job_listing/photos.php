<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$photos = WP_Job_Board_Job_Listing::get_post_meta($post->ID, 'photos', true );

if ( !empty($photos) ) {
?>
    <div id="job-job-portfolio" class="job-detail-portfolio">
    	<h4 class="title"><?php esc_html_e('Photos', 'workio'); ?></h4>
    	<div class="row drop-top">
	        <?php foreach ($photos as $attach_id => $img_url) { ?>
	            <div class="col-xs-4">
            		<a class="item" href="<?php echo esc_url($img_url); ?>" data-elementor-lightbox-slideshow="gallery-photos">
                		<?php echo wp_get_attachment_image( $attach_id, 'medium' );  ?>
                	</a>
            	</div>
	        <?php } ?>
        </div>
    </div>
<?php }