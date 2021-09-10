<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>

<?php do_action( 'wp_job_board_before_job_detail', $post->ID ); ?>

<article id="post-<?php echo esc_attr($post->ID); ?>" <?php post_class('employer-single-v1'); ?>>
	<!-- heading -->
	<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-employer/header' ); ?>

	<div class="employer-single-inner <?php echo apply_filters('workio_employer_content_class', 'container');?>">

		<?php if ( is_active_sidebar( 'employer-single-sidebar' ) ): ?>
			<a href="javascript:void(0)" class="mobile-sidebar-btn hidden-lg hidden-md space-20"> <i class="fa fa-bars"></i> </a>
			<div class="mobile-sidebar-panel-overlay"></div>
		<?php endif; ?>
		
		<!-- Main content -->
		<div class="row">
			<div class="col-xs-12 col-md-<?php echo esc_attr( is_active_sidebar( 'employer-single-sidebar' ) ? 8 : 12); ?>">
				<div class="employer-detail-description">
					<?php do_action( 'wp_job_board_before_employer_content', $post->ID ); ?>

					<!-- employer description -->
					<?php if ( $post->post_content ) { ?>

						<h3 class="title">
							<?php esc_html_e('About Company', 'workio'); ?>														
						</h3>						

						<?php the_content(); ?>
					<?php } ?>
					
					<!-- profile photos -->
					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-employer/profile-photos' ); ?>

					<!-- team member -->
					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-employer/members' ); ?>

					<div class="social-share-bookmak flex-middle-sm">
						<?php if( workio_get_config('show_candidate_social_share', false) ) {
	        				get_template_part( 'template-parts/sharebox' );
	        			} ?>
	        			<div class="ali-right">
							<?php workio_employer_display_follow_btn($post->ID, true); ?>
						</div>
					</div>
				
					<?php do_action( 'wp_job_board_after_employer_content', $post->ID ); ?>

					<?php if ( workio_check_employer_candidate_review($post) ) : ?>
						<!-- Review -->
						<?php comments_template(); ?>
					<?php endif; ?>

					<!-- employer releated -->
					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-employer/open-jobs' ); ?>
				</div>

			</div>
			<?php if ( is_active_sidebar( 'employer-single-sidebar' ) ): ?>
				<div class="sidebar-wrapper">
					<div class="col-md-4 col-xs-12 sidebar sidebar-right">
				   		<?php dynamic_sidebar( 'employer-single-sidebar' ); ?>
				   	</div>
			   	</div>
		   	<?php endif; ?>
		</div>
	</div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_job_detail', $post->ID ); ?>