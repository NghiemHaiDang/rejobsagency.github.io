<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_candidate = workio_get_config('register_form_enable_candidate', true);
$show_employer = workio_get_config('register_form_enable_employer', true);
if ( !$show_candidate && !$show_employer ) {
	return;
}

wp_enqueue_script('select2');
wp_enqueue_style('select2');
?>
<div class="box-employer box-account">
  	<div class="register-form-wrapper">
	  	<div class="container-form">
          	<form name="registerForm" method="post" class="register-form">
          		<h3 class="title"><?php echo esc_html__('Tạo tài khoản','workio'); ?></h3>
          		<div class="text-center <?php echo esc_attr((!$show_candidate || !$show_employer) ? 'hidden' : ''); ?>">
					<ul class="role-tabs flex-middle">
						<?php
						$checked = 'checked="checked"';
						$active_class = 'active';
						if ( $show_candidate ) {
						?>
							<li class="<?php echo esc_attr($active_class); ?>"><input id="cadidate" type="radio" name="role" value="wp_job_board_candidate" <?php echo trim($checked); ?>><label for="cadidate"><?php esc_html_e('Ứng viên', 'workio'); ?></label></li>
						<?php
							$checked = '';
							$active_class = '';
						} ?>
						<?php if ( $show_employer ) { ?>
							<li class="<?php echo esc_attr($active_class); ?>"><input type="radio" id="employer" name="role" value="wp_job_board_employer" <?php echo trim($checked); ?>><label for="employer"><?php esc_html_e('Nhà tuyển dụng', 'workio'); ?></label></li>
						<?php } ?>
					</ul>
				</div>
				<div class="inner-register">
					
					<div class="form-group">
						<label class="hidden"><?php esc_attr_e('Tên đăng nhập *','workio'); ?></label>
						<input type="text" class="form-control" name="username" id="register-username" placeholder="<?php esc_attr_e('Tên đăng nhập *','workio'); ?>">
					</div>
					<div class="form-group">
						<label class="hidden"><?php esc_attr_e('Email *','workio'); ?></label>
						<input type="text" class="form-control" name="email" id="register-email" placeholder="<?php esc_attr_e('Email *','workio'); ?>">
					</div>
					<div class="form-group">
						<label class="hidden"><?php esc_attr_e('Password *','workio'); ?></label>
						<input type="password" class="form-control" name="password" id="password" placeholder="<?php esc_attr_e('Mật khẩu *','workio'); ?>">
					</div>
					<div class="form-group">
						<label class="hidden"><?php esc_attr_e('Confirm Password *','workio'); ?></label>
						<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="<?php esc_attr_e('Xác nhận mật khẩu *','workio'); ?>">
					</div>

					<?php if ( workio_get_config('register_form_enable_employer_company', true) ) { ?>
						<div class="form-group wp_job_board_employer_show">
							<label class="hidden"><?php esc_attr_e('Tên công ty','workio'); ?></label>
							<input type="text" class="form-control" name="company_name" id="register-company-name" placeholder="<?php esc_attr_e('Tên công ty','workio'); ?>">
						</div>
					<?php } ?>
					<?php if ( workio_get_config('register_form_enable_phone', true) ) { ?>
						<div class="form-group">
							<label class="hidden"><?php esc_attr_e('Số điện thoại','workio'); ?></label>
							<input type="text" class="form-control" name="phone" id="register-phone" placeholder="<?php esc_attr_e('Số điện thoại','workio'); ?>">
						</div>
					<?php } ?>
					<?php
						if ( workio_get_config('register_form_enable_candidate_category', true) ) {
							$candidate_args = array(
					            'taxonomy' => 'candidate_category',
					            'orderby' => 'name',
					            'order' => 'ASC',
					            'hide_empty' => false,
					            'number' => false,
						    );
						    $terms = get_terms($candidate_args);

						    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						    	?>
						    	<div class="form-group space-25 wp_job_board_candidate_show select2-wrapper">
						    		
										<select id="register-candidate-category" class="register-category" name="candidate_category">
											<option value=""><?php esc_html_e('Lĩnh vực', 'workio'); ?></option>
											<?php foreach ($terms as $term) { ?>
												<option class="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
											<?php } ?>
										</select>
								</div>
						    	<?php
						    }
					    }
					?>
					<?php
						if ( workio_get_config('register_form_enable_employer_category', true) ) {
							$employer_args = array(
					            'taxonomy' => 'employer_category',
					            'orderby' => 'name',
					            'order' => 'ASC',
					            'hide_empty' => false,
					            'number' => false,
						    );
						    $terms = get_terms($employer_args);

						    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						    	?>
						    	<div class="form-group space-25 wp_job_board_employer_show select2-wrapper ">
						    		
										<select id="register-employer-category" class="register-category" name="employer_category">
											<option value=""><?php esc_html_e('Lĩnh vực kinh doanh', 'workio'); ?></option>
											<?php foreach ($terms as $term) { ?>
												<option class="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
											<?php } ?>
										</select>
								</div>
						    	<?php
						    }
					    }
					?>
					<?php wp_nonce_field('ajax-register-nonce', 'security_register'); ?>

					<?php if ( WP_Job_Board_Recaptcha::is_recaptcha_enabled() ) { ?>
			            <div id="recaptcha-contact-form" class="ga-recaptcha" data-sitekey="<?php echo esc_attr(wp_job_board_get_option( 'recaptcha_site_key' )); ?>"></div>
			      	<?php } ?>
			      	
			      	<?php
					$page_id = wp_job_board_get_option('terms_conditions_page_id');
					if ( !empty($page_id) ) {
						$page_url = $page_id ? get_permalink($page_id) : home_url('/');
					?>
						<div class="form-group">
							<label for="register-terms-and-conditions">
								<input type="checkbox" name="terms_and_conditions" value="on" id="register-terms-and-conditions">
								<?php
									echo sprintf(wp_kses(__('Bạn đồng ý<a href="%s">điều khoản của ReJobs</a>', 'workio'), array('a' => array('href' => array()))), esc_url($page_url));
								?>
							</label>
						</div>
					<?php } ?>

					<div class="form-group space-20">
						<button type="submit" class="btn btn-theme btn-block" name="submitRegister">
							<?php echo esc_html__('Đăng ký ngay', 'workio'); ?>
						</button>
					</div>
					<div class="create-account text-center">
						<?php
							$login_register_page_id = wp_job_board_get_option('login_register_page_id');
							$allowed_html_array = array( 'a' => array('href' => array() , 'class' => array() ) );
							echo wp_kses(sprintf(__('Bạn đã có tài khoản? <a href="%s" class="create">Đăng nhập</a>', 'workio'), esc_url( get_permalink( $login_register_page_id ) )), $allowed_html_array);
						?>
					</div>
					<?php do_action('register_form'); ?>
				</div>
          	</form>
	    </div>
  	</div>
</div>