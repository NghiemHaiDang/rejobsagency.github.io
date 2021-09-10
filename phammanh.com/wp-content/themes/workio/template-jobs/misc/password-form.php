<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="box-dashboard-wrapper">
	<div class="inner-list">
		<h3 class="widget-title"><?php echo esc_html__('Mật khẩu & bảo mật','workio') ?></h3>
		<form method="post" action="" class="change-password-form">
			<div class="inner-box">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-4">
						<label for="change-password-form-old-password"><?php echo esc_html__( 'Mật khẩu cũ', 'workio' ); ?></label>
						<input id="change-password-form-old-password" class="form-control" type="password" name="old_password" required="required">
					</div><!-- /.form-control -->

					<div class="form-group col-xs-12 col-sm-4">
						<label for="change-password-form-new-password"><?php echo esc_html__( 'Mật khẩu mới', 'workio' ); ?></label>
						<input id="change-password-form-new-password" class="form-control" type="password" name="new_password" required="required" minlength="8">
					</div><!-- /.form-control -->

					<div class="form-group col-xs-12 col-sm-4">
						<label for="change-password-form-retype-password"><?php echo esc_html__( 'Xác nhận mật khẩu mới', 'workio' ); ?></label>
						<input id="change-password-form-retype-password" class="form-control" type="password" name="retype_password" required="required" minlength="8">
					</div><!-- /.form-control -->
				</div>
			</div>
			<button type="submit" name="change_password_form" class="button btn btn-theme"><?php echo esc_html__( 'Thay đổi', 'workio' ); ?></button>
		</form>
	</div>
</div>