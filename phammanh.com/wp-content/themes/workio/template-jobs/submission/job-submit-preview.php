<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post, $job_preview;
$job_preview = $post;

?>
<div class="job-submission-preview-form-wrapper">
	<?php if ( sizeof($form_obj->errors) ) : ?>
		<?php foreach ( $form_obj->errors as $message ) { ?>
			<div class="alert alert-danger margin-bottom-15">
				<?php echo trim( $message ); ?>
			</div>
		<?php
		}
		?>
	<?php endif; ?>
	<form action="<?php echo esc_url($form_obj->get_form_action());?>" class="cmb-form" method="post" enctype="multipart/form-data" encoding="multipart/form-data">
		<input type="hidden" name="<?php echo esc_attr($form_obj->get_form_name()); ?>" value="<?php echo esc_attr($form_obj->get_form_name()); ?>">
		<input type="hidden" name="job_id" value="<?php echo esc_attr($job_id); ?>">
		<input type="hidden" name="submit_step" value="<?php echo esc_attr($step); ?>">
		<input type="hidden" name="object_id" value="<?php echo esc_attr($job_id); ?>">
		<?php wp_nonce_field('wp-job-board-job-submit-preview-nonce', 'security-job-submit-preview'); ?>
		<div class="action-preview">
			<button class="button btn btn-success" name="continue-submit-job"><?php esc_html_e('Submit Job', 'workio'); ?></button>
			<button class="button btn btn-danger" name="continue-edit-job"><?php esc_html_e('Edit Job', 'workio'); ?></button>
		</div>
		<?php
			
				echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/header' ); 
				echo WP_Job_Board_Template_Loader::get_template_part( 'content-single-job_listing' );
			
		?>
	</form>
</div>