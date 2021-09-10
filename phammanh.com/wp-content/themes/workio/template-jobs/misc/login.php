<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="box-employer box-account">
	<div class="login-form-wrapper">
		<div id="login-form-wrapper" class="form-container">
			<h3 class="title"><?php echo esc_html__('Đăng nhập','workio'); ?></h3>			
			<?php if ( defined('WORKIO_DEMO_MODE') && WORKIO_DEMO_MODE ) { ?>
				<div class="sign-in-demo-notice">
					Username: <strong>candidate</strong> or <strong>employer</strong><br>
					Password: <strong>demo</strong>
				</div>
			<?php } ?>
			
			<form class="login-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
				<?php if ( isset($_SESSION['register_msg']) ) { ?>
					<div class="alert <?php echo esc_attr($_SESSION['register_msg']['error'] ? 'alert-warning' : 'alert-info'); ?>">
						<?php echo trim($_SESSION['register_msg']['msg']); ?>
					</div>
				<?php
					unset($_SESSION['register_msg']);
				}
				?>
				<div class="form-group">
					<label class="hidden"><?php esc_attr_e('Username or email','workio'); ?></label>
					<input autocomplete="off" type="text" name="username" class="form-control" id="username_or_email" placeholder="<?php esc_attr_e('Tên đăng nhập hoặc email','workio'); ?>">
				</div>
				<div class="form-group">
					<label class="hidden"><?php esc_attr_e('Password','workio'); ?></label>
					<input name="password" type="password" class="password required form-control" id="login_password" placeholder="<?php esc_attr_e('Mật khẩu','workio'); ?>">
				</div>
				<div class="row form-group info">
					<div class="col-sm-6">
						<label for="user-remember-field" class="remember">
							<input type="checkbox" name="remember" id="user-remember-field" value="true"> <?php echo esc_html__('Nhớ tài khoản','workio'); ?>
						</label>
					</div>
					<div class="col-sm-6 text-right">
						<a class="back-link" href="#forgot-password-form-wrapper" title="<?php esc_attr_e('Quên mật khẩu','workio'); ?>"><?php echo esc_html__("Quên mật khẩu?",'workio'); ?></a>
					</div>
				</div>
				<div class="form-group space-20">
					<input type="submit" class="btn btn-theme-second btn-block" name="submit" value="<?php esc_attr_e('Đăng nhập','workio'); ?>"/>
				</div>
				<div class="create-account text-center">
					<?php
						$login_register_page_id = wp_job_board_get_option('login_register_page_id');
						$allowed_html_array = array( 'a' => array('href' => array() , 'class' => array() ) );
						echo wp_kses(sprintf(__('Bạn chưa có tài khoản? <a href="%s" class="create">Tạo tài khoản</a>', 'workio'), esc_url( get_permalink( $login_register_page_id ) )), $allowed_html_array);
					?>
				</div>
				<?php
					do_action('login_form');
					wp_nonce_field('ajax-login-nonce', 'security_login');
				?>
			</form>
		</div>
		<!-- reset form -->
		<div id="forgot-password-form-wrapper" class="form-container">
			<div class="top-info-user text-center">
				<h3 class="title"><?php echo esc_html__('Thay đổi mật khẩu', 'workio'); ?></h3>
				<div class="des"><?php echo esc_html__('Vui lòng điền tên đăng nhập hoặc email','workio') ?></div>
			</div>
			<form name="forgotpasswordform" class="forgotpassword-form" action="<?php echo esc_url( site_url('wp-login.php?action=lostpassword', 'login_post') ); ?>" method="post">
				<div class="lostpassword-fields">
					<div class="form-group">
						<input type="text" name="user_login" class="user_login form-control" id="lostpassword_username" placeholder="<?php esc_attr_e('Tên đăng nhập or email','workio'); ?>">
					</div>
					<?php
						do_action('lostpassword_form');
						wp_nonce_field('ajax-lostpassword-nonce', 'security_lostpassword');
					?>

					<?php if ( version_compare(WP_JOB_BOARD_PLUGIN_VERSION, '2.1.0', '>=') && WP_Job_Board_Recaptcha::is_recaptcha_enabled() ) { ?>
			            <div id="recaptcha-contact-form" class="ga-recaptcha" data-sitekey="<?php echo esc_attr(wp_job_board_get_option( 'recaptcha_site_key' )); ?>"></div>
			      	<?php } ?>
			      	
					<div class="form-group">
						<div class="row">
							<div class="col-xs-12 form-group"><input type="submit" class="btn btn-theme-second btn-sm btn-block" name="wp-submit" value="<?php esc_attr_e('Tạo mật khẩu mới', 'workio'); ?>" tabindex="100" /></div>
							
						</div>
					</div>
				</div>
				<div class="lostpassword-link text-center"><a href="#login-form-wrapper" class="back-link"><?php echo esc_html__('Back To Login', 'workio'); ?></a></div>
			</form>
		</div>
	</div>
</div>