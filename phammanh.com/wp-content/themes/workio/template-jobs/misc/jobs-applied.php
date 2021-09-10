<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script('select2');
wp_enqueue_style('select2');
?>
<div class="box-dashboard-wrapper">
	<div class="inner-list">
		<div class="search-orderby-wrapper flex-middle-sm">
			<div class="search-jobs-applied-form widget-search">
				<form action="" method="get">
					<div class="input-group">
						<input type="text" placeholder="<?php esc_attr_e( 'Search ...', 'workio' ); ?>" class="form-control" name="search" value="<?php echo esc_attr(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
						<span class="input-group-btn">
							<button class="search-submit btn btn-sm btn-search" name="submit">
								<i class="flaticon-search"></i>
							</button>
						</span>
					</div>
					<input type="hidden" name="paged" value="1" />
				</form>
			</div>
			<div class="sort-jobs-applied-form sortby-form">
				<?php
					$orderby_options = apply_filters( 'wp_job_board_my_jobs_orderby', array(
						'menu_order'	=> esc_html__( 'Default', 'workio' ),
						'newest' 		=> esc_html__( 'Newest', 'workio' ),
						'oldest'     	=> esc_html__( 'Oldest', 'workio' ),
					) );

					$orderby = isset( $_GET['orderby'] ) ? wp_unslash( $_GET['orderby'] ) : 'newest'; 
				?>

				<div class="orderby-wrapper flex-middle">
					<span class="text-sort">
						<?php echo esc_html__('Sort by: ','workio'); ?>
					</span>
					<form class="my-jobs-ordering" method="get">
						<select name="orderby" class="orderby">
							<?php foreach ( $orderby_options as $id => $name ) : ?>
								<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="paged" value="1" />
						<?php WP_Job_Board_Mixes::query_string_form_fields( null, array( 'orderby', 'submit', 'paged' ) ); ?>
					</form>
				</div>
			</div>
		</div>
		<?php if ( !empty($applicants) && !empty($applicants->posts) ) { ?>
			<div class="jobs-wrapper">
			<?php foreach ($applicants->posts as $applicant_id) {
				$job_id = get_post_meta($applicant_id, WP_JOB_BOARD_APPLICANT_PREFIX.'job_id', true);
				$post = get_post($job_id);


				$author_id = $post->post_author;
				$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);
				$types = get_the_terms( $post->ID, 'job_listing_type' );
				$category = get_the_terms( $post->ID, 'job_listing_category' );
				$address = get_post_meta( $post->ID, WP_JOB_BOARD_JOB_LISTING_PREFIX . 'address', true );
				$salary = WP_Job_Board_Job_Listing::get_salary_html($post->ID);

				?>

				<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>
				<div class="style-list-jobs">
					<article <?php post_class('job-list job-list-v1 apply-job map-item job-style-inner job-applied-wrapper'); ?>>
						<div class="featured-urgent-label">
							<?php workio_job_display_urgent_icon($post); ?>
						</div>
						<div class="flex-middle-sm job-list-container">
							<?php if ( has_post_thumbnail($employer_id) ) { ?>
						        <div class="job-employer-logo">
						            <?php echo get_the_post_thumbnail( $employer_id, 'thumbnail' ); ?>
						        </div>
						    <?php } ?>
						    <div class="info-center">
						    	<div class="inner">
						    		<?php workio_job_display_job_type($post); ?>
						    		<div class="title-wrapper">
								        <h2 class="job-title">
								        	<a href="<?php echo esc_url(get_permalink($job_id)); ?>" rel="bookmark"><?php echo get_the_title($job_id); ?></a>
								        </h2>
								        <?php workio_job_display_featured_icon($post); ?>
							        </div>

							        <div class="job-employer-info-wrapper">
						                <?php workio_job_display_employer_title($post); ?> - 
						                <?php echo sprintf(esc_html__(' posted %s ago', 'workio'), human_time_diff(get_the_time('U', $job_id), current_time('timestamp')) ); ?>
						            </div>

							        <div class="job-metas">
										<?php workio_job_display_full_location($post, 'title'); ?>
						                <?php workio_job_display_job_categories($post, 'title'); ?>
						                <?php workio_job_display_salary($post, 'title'); ?>
							        </div>
						    	</div>
							</div>
							<div class="ali-right">
					    		<a href="javascript:void(0)" class="btn-loading btn-remove-job-applied btn-action-icon deleted" data-applicant_id="<?php echo esc_attr($applicant_id); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-applied-nonce' )); ?>"><i class="ti-trash"></i><span><?php echo esc_html__('Remove','workio') ?></span></a>
					    	</div>
						</div>
					</article><!-- #post-## -->
				</div>
				<?php do_action( 'wp_job_board_after_job_content', $post->ID );
			} ?>
			</div>
			<?php WP_Job_Board_Mixes::custom_pagination( array(
				'wp_query' => $applicants,
				'max_num_pages' => $applicants->max_num_pages,
				'prev_text'     => esc_html__( 'Previous page', 'workio' ),
				'next_text'     => esc_html__( 'Next page', 'workio' ),
			));
		?>

		<?php } else { ?>
			<div class="not-found"><?php esc_html_e('No apply found.', 'workio'); ?></div>
		<?php } ?>
	</div>
</div>