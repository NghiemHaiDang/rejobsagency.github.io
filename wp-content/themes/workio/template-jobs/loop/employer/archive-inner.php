<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$display_mode = workio_get_employers_display_mode();
$columns = workio_get_employers_columns();
$bcol = $columns ? 12/$columns : 4;
?>
<div class="employers-listing-wrapper main-items-wrapper layout-type-<?php echo esc_attr($display_mode); ?>" data-display_mode="<?php echo esc_attr($display_mode); ?>">
	<?php
	/**
	 * wp_job_board_before_employer_archive
	 */
	do_action( 'wp_job_board_before_employer_archive', $employers );
	?>
	<?php
	if ( !empty($employers) && !empty($employers->posts) ) {

		/**
		 * wp_job_board_before_loop_employer
		 */
		do_action( 'wp_job_board_before_loop_employer', $employers );
		?>

		<div class="employers-wrapper items-wrapper">
			<?php 
				if ( $display_mode == 'grid' ) { 
					$i = 0;
			?>
				<div class="row">
					<?php while ( $employers->have_posts() ) : $employers->the_post(); ?>
						<div class="col-sm-6 col-md-<?php echo esc_attr($bcol); ?> col-xs-12 <?php echo esc_attr($i%$columns == 0 ? 'md-clearfix':''); ?> <?php echo esc_attr($i%2 == 0 ? 'sm-clearfix':''); ?>">
							<?php echo WP_Job_Board_Template_Loader::get_template_part( 'employers-styles/inner-grid' ); ?>
						</div>
					<?php $i++; endwhile; ?>
				</div>
			<?php } elseif ( $display_mode == 'list' ) { ?>
				<?php while ( $employers->have_posts() ) : $employers->the_post(); ?>
					<div class="style-list-employers">
						<?php echo WP_Job_Board_Template_Loader::get_template_part( 'employers-styles/inner-list' ); ?>
					</div>
				<?php endwhile; ?>
			<?php } else {

				$companies_by_letter = array();
				while ( $employers->have_posts() ) : $employers->the_post();
					global $post;
					$company = $post->post_title;
					$user_id = WP_Job_Board_User::get_user_by_employer_id($post->ID);
					$jobs = WP_Job_Board_Query::get_posts(array(
					    'post_type' => 'job_listing',
					    'post_status' => 'publish',
					    'author' => $user_id,
					    'fields' => 'ids',
					    'posts_per_page' => 1,
					));
					$count_jobs = $jobs->found_posts;
					

					$companies_by_letter[strtoupper($company[0])][] = array( 'employer_id' => $post->ID, 'count_jobs' => $count_jobs);
				endwhile;
				?>

				<ul class="list-alphabet">
					<?php foreach ( range( 'A', 'Z' ) as $letter ) { ?>
						<li><a href="#<?php echo esc_attr($letter); ?>"><?php echo esc_attr($letter); ?></a></li>
					<?php } ?>
				</ul>
				
				<div class="row">
					<?php $i = 0; foreach ( range( 'A', 'Z' ) as $letter ) {
						if ( ! isset( $companies_by_letter[ $letter ] ) ) {
							continue;
						}
						?>
						<div class="company-items col-sm-6 col-md-<?php echo esc_attr($bcol); ?> <?php echo esc_attr(($i%$columns)== 0 ?'md-clearfix':''); ?> <?php echo esc_attr(($i%2)== 0 ?'sm-clearfix':''); ?>">
							<div class="company-items-inner">
								<?php
								$total_jobs = 0;
								foreach ( $companies_by_letter[$letter] as $employer_data ) {
									$total_jobs += $employer_data['count_jobs'] ? $employer_data['count_jobs'] : 0;
								}
								$number_jobs = $total_jobs ? WP_Job_Board_Mixes::format_number($total_jobs) : 0;
								?>
								<div id="<?php echo esc_attr($letter); ?>" class="letter-title flex-middle">
									<h3><?php echo esc_attr($letter); ?></h3>
									<span class="job-count">(<?php echo esc_html($number_jobs); ?>)</span>
								</div>
								<div class="content-bottom">
									<?php foreach ( $companies_by_letter[$letter] as $employer_data ) {
										$employer_id = $employer_data['employer_id'];
										$number_jobs = $employer_data['count_jobs'] ? WP_Job_Board_Mixes::format_number($employer_data['count_jobs']) : 0;
									?>
										<div class="company-item">
											<a href="<?php echo esc_url(get_permalink( $employer_id )); ?>">
												<?php echo get_the_title($employer_id); ?>
												<span>(<?php echo esc_html($number_jobs); ?>)</span>
											</a>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php $i++; } ?>
				</div>
			<?php } ?>
		</div>

		<?php
		/**
		 * wp_job_board_after_loop_employer
		 */
		do_action( 'wp_job_board_after_loop_employer', $employers );

		wp_reset_postdata();
	?>

	<?php } else { ?>
		<div class="not-found"><?php esc_html_e('Không có nhà tuyển dụng nào được tìm thấy', 'workio'); ?></div>
	<?php } ?>

	<?php
	/**
	 * wp_job_board_after_employer_archive
	 */
	do_action( 'wp_job_board_after_employer_archive', $employers );
	?>
</div>