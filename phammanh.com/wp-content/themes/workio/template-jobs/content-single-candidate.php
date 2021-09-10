<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
?>

<?php do_action( 'wp_job_board_before_job_detail', get_the_ID() ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('candidate-single-v1'); ?>>
	
	<!-- heading -->
	<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/header' ); ?>

	<!-- Main content -->
	<div class="candidate-single-inner <?php echo apply_filters('workio_candidate_content_class', 'container');?>">
		
		<?php if ( is_active_sidebar( 'candidate-single-sidebar' ) ): ?>
			<a href="javascript:void(0)" class="mobile-sidebar-btn hidden-lg hidden-md space-20"> <i class="fa fa-bars"></i> </a>
			<div class="mobile-sidebar-panel-overlay"></div>
		<?php endif; ?>

		<div class="row">
			<div class="col-xs-12 list-content-candidate col-md-<?php echo esc_attr( is_active_sidebar( 'candidate-single-sidebar' ) ? 8 : 12); ?>">

				<?php do_action( 'wp_job_board_before_job_content', get_the_ID() ); ?>
				
				<!-- job description -->
				<div id="job-candidate-description" class="job-detail-description">
					<h3 class="title"><?php esc_html_e('About Me', 'workio'); ?></h3>

					<?php the_content(); ?>
					
					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/education' ); ?>

					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/experience' ); ?>

					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/video' ); ?>
					
					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/portfolios' ); ?>

					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/skill' ); ?>

					<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/award' ); ?>

					<div class="social-share-bookmak flex-middle-sm">
						<?php if( workio_get_config('show_candidate_social_share', false) ) {
	        				get_template_part( 'template-parts/sharebox' );
	        			} ?>
	        			<div class="ali-right">
							<?php workio_candidate_display_shortlist_btn($post, true); ?>
						</div>
					</div>

					<?php if ( workio_check_employer_candidate_review($post) ) : ?>
						<!-- Review -->
						<?php comments_template(); ?>
					<?php endif; ?>

					<?php do_action( 'wp_job_board_after_job_content', get_the_ID() ); ?>

					<?php
						if ( workio_get_config('candidate_releated_show') ) {
							echo WP_Job_Board_Template_Loader::get_template_part( 'single-candidate/releated' );
						}
					?>
				</div>
			</div>

			<?php if ( is_active_sidebar( 'candidate-single-sidebar' ) ): ?>
				<div class="sidebar-wrapper">
					<div class="col-xs-12 col-md-4 sidebar sidebar-right">
				   		<?php dynamic_sidebar( 'candidate-single-sidebar' ); ?>
				   	</div>
			   	</div>
		   	<?php endif; ?>

		</div>
	</div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_after_job_detail', get_the_ID() ); ?>