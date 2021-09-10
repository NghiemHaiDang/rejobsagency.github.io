<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="widget-filter-employer-top widget-filter-top">
	<div class="container">
		<?php 
		if ( ! empty( $instance['title'] ) ) {
			echo trim( $args['before_title'] );
			echo esc_attr( $instance['title'] );
			echo trim( $args['after_title'] );
		}
		?>
		<form method="get" action="<?php echo WP_Job_Board_Mixes::get_employers_page_url(); ?>" class="filter-employer-form filter-listing-form filter-employer-top">
			<?php $fields = $fields_adv = workio_employer_get_filter_fields(); ?>
			<?php if ( ! empty( $instance['sort'] ) ) : ?>
				<?php
					$keys = explode( ',', $instance['sort'] );
					$filtered_keys = array_filter( $keys );
					$fields = array_merge( array_flip( $filtered_keys ), $fields );
				?>
			<?php endif; ?>
			<div class="top-search">
				<div class="row">
					<div class="col-lg-9 col-xs-12">
						<div class="row-first-wrapper row">
							<?php $i = 1; foreach ( $fields as $key => $field ) : ?>
								<?php if ( empty( $instance['hide_'.$key] ) ) : ?>
									<div class="col-xs-12 col-sm-4 <?php echo esc_attr(($i%3==1)?'md-clearfix sm-clearfix':''); ?>">
									<?php
										if ( !empty($field['field_call_back']) && is_callable($field['field_call_back']) ) {
											call_user_func( $field['field_call_back'], $instance, $args, $key, $field );
										}
									?>
									</div>
								<?php $i++; endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="flex-middle space-bottom-15">
							<?php if ( ! empty( $instance['button_text'] ) ) : ?>
								<div class="visiable-line">
									<button class="button btn btn-theme-second"><?php echo esc_attr( $instance['button_text'] ); ?></button>
								</div><!-- /.form-group -->
							<?php endif; ?>
							<?php if ( ! empty( $instance['show_adv_fields'] ) ) : ?>
								<a href="#toggle_adv" class="toggle-adv visiable-line btn button">
									<i class="ti-settings"></i> <?php esc_html_e('Advance', 'workio'); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<?php if ( ! empty( $instance['show_adv_fields'] ) ) : ?>
				<div class="advance-fields clearfix">
					<div class="row">
						<?php if ( ! empty( $instance['sort_adv'] ) ) : ?>
							<?php
							$keys = explode( ',', $instance['sort_adv'] );
							$filtered_keys = array_filter( $keys );
							$fields_adv = array_merge( array_flip( $filtered_keys ), $fields_adv );
							?>
						<?php endif; ?>

						<?php $i = 1; foreach ( $fields_adv as $key => $field ) : ?>
							<?php if ( empty( $instance['hide_adv_'.$key] ) ) : ?>
								<?php
									if ( !empty($field['field_call_back']) && is_callable($field['field_call_back']) ) { ?>
										<div class="col-xs-12 col-md-3 col-sm-4 <?php echo esc_attr(($i%4==1)?'md-clearfix':''); ?> <?php echo esc_attr(($i%3==1)?'sm-clearfix':''); ?>">
											<?php call_user_func( $field['field_call_back'], $instance, $args, $key, $field ); ?>
										</div>
									<?php
									}
								?>
							<?php $i++; endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
				
			<?php endif; ?>
		</form>
	</div>
</div>
