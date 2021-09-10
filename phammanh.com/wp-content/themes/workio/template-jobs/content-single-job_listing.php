<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>

<?php do_action( 'wp_job_board_before_job_detail', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('job-single-v1'); ?>>
	<div class="<?php echo apply_filters('workio_job_content_class', 'container');?>">
		<!-- Main content -->
		<div class="content-job-detail job-single-inner">
			<div class="row">
				<div class="col-xs-12 col-md-<?php echo esc_attr( is_active_sidebar( 'job-single-sidebar' ) ? 8 : 12); ?>">

					<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>
					
					<!-- job description -->
					<div class="job-detail-description">
						<?php the_content(); ?>
						<!-- photos -->
						<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/photos' ); ?>

						<!-- video -->
						<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/video' ); ?>

						<!-- tags -->
						<div class="tag-detail">
							<?php workio_job_display_tags_v2($post, 'title', -1); ?>
						</div>
						<!-- job social -->
						<div class="social-share-bookmak flex-middle-sm">
							<?php if ( workio_get_config('show_job_social_share', false) ) { ?>
				        		<?php get_template_part( 'template-parts/sharebox-job' );  ?>
				            <?php } ?>
				            <div class="ali-right">
								<?php workio_job_display_add_shortlist_btn($post, true); ?>
							</div>
				        </div>
						<?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>

						<!-- job releated -->
						<?php
							if ( workio_get_config('job_releated_show') ) {
								echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/releated' );
							}
						?>
						
					</div>
					
				</div>
				
				<?php if ( is_active_sidebar( 'job-single-sidebar' ) ): ?>
					<div class="col-xs-12 col-md-4 sidebar sidebar-job">
				   		<?php dynamic_sidebar( 'job-single-sidebar' ); ?>
				   	</div>
			   	<?php endif; ?>
			</div>
		</div>
	</div>
	
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_job_detail', $post->ID ); ?>