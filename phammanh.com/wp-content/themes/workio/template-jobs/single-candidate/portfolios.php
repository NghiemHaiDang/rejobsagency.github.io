<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$portfolio_photos = WP_Job_Board_Candidate::get_post_meta($post->ID, 'portfolio_photos', true );

if ( !empty($portfolio_photos) ) {
?>
    <div id="job-candidate-portfolio" class="candidate-detail-portfolio">
    	<h4 class="title"><?php esc_html_e('Portfolio', 'workio'); ?></h4>
    	<div class="row drop-top">
	        <?php foreach ($portfolio_photos as $attach_id => $img_url) { ?>
	            <div class="col-xs-4">
            		<a class="item" href="<?php echo esc_url($img_url); ?>" data-elementor-lightbox-slideshow="gallery-portfolio-photos">
                		<?php echo wp_get_attachment_image( $attach_id, 'medium' );  ?>
                	</a>
	            </div>
	        <?php } ?>
        </div>
    </div>
<?php }