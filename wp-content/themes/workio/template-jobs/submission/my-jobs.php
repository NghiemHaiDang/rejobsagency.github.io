<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script('select2');
wp_enqueue_style('select2');

$my_jobs_page_id = wp_job_board_get_option('my_jobs_page_id');
$my_jobs_url = get_permalink( $my_jobs_page_id );

?>

<div class="box-dashboard-wrapper my-job-employer">
	<div class="inner-list">
	<div class="search-orderby-wrapper flex-middle-sm">
		<div class="search-my-jobs-form widget-search">
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
		<div class="sort-my-jobs-form sortby-form">
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

	<?php
		$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
		$query_vars = array(
			'post_type'     => 'job_listing',
			'post_status'   => apply_filters('wp-job-board-my-jobs-post-statuses', array( 'publish', 'expired', 'pending', 'draft', 'preview' )),
			'paged'         => $paged,
			'author'        => get_current_user_id(),
			'orderby'		=> 'date',
			'order'			=> 'DESC',
		);
		if ( isset($_GET['search']) ) {
			$query_vars['s'] = $_GET['search'];
		}
		if ( isset($_GET['orderby']) ) {
			switch ($_GET['orderby']) {
				case 'menu_order':
					$query_vars['orderby'] = array(
						'menu_order' => 'ASC',
						'date'       => 'DESC',
						'ID'         => 'DESC',
					);
					break;
				case 'newest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'DESC';
					break;
				case 'oldest':
					$query_vars['orderby'] = 'date';
					$query_vars['order'] = 'ASC';
					break;
			}
		}
		$jobs = new WP_Query($query_vars);
		
		if ( $jobs->have_posts() ) :
		?>
		<div class="jobs-wrapper">
			<?php while ( $jobs->have_posts() ) : $jobs->the_post(); global $post;
				$filled = WP_Job_Board_Job_Listing::get_post_meta($post->ID, 'filled');
			?>
				<div class="style-list-jobs">
				<div class="job-list my-jobs job-style-inner">

				    <div class="featured-urgent-label">
				        <?php workio_job_display_featured_icon($post); ?>  
				        <?php workio_job_display_urgent_icon($post); ?>              
				    </div>

					<div class="flex-middle-sm job-list-container">
						<div class="job-employer-logo">
				            <?php workio_job_display_employer_logo($post); ?>
				        </div>
						<div class="job-information">
				            <?php workio_job_display_job_type($post); ?>
				            <div class="title-wrapper job-title-wrapper">
				                <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<div class="job-table-actions-inner <?php echo esc_attr($post->post_status); ?>">
									<?php
										$post_status = get_post_status_object( $post->post_status );
										if ( !empty($post_status->label) ) {
											echo esc_html($post_status->label);
										} else {
											echo esc_html($post_status->post_status);
										}
									?>
								</div>

								<?php if ( $filled ) { ?>
									<span class="application-status-label label label-success"><?php esc_html_e('Filled', 'workio'); ?></span>
								<?php } ?>
				            </div>

				            <div class="job-table-applicants-inner">
								<?php
									$count_applicants = WP_Job_Board_Job_Listing::count_applicants($post->ID);
									echo sprintf(wp_kses(__('Applicant(s) <span class="number">%d</span>', 'workio'), array( 'span' => array('class' => array()) ) ), $count_applicants);
								?>
							</div>

				            <div class="job-metas">
		            			<div class="job-table-info-content-date">
									<strong class="sub-date"><?php esc_html_e('Created: ', 'workio'); ?></strong>
									<?php the_time( get_option('date_format') ); ?>
								</div>
								<div class="job-table-info-content-expiry">
									<strong class="sub-date"><?php esc_html_e('Expiry: ', 'workio'); ?></strong>
									<?php
										$expires = get_post_meta( $post->ID, WP_JOB_BOARD_JOB_LISTING_PREFIX.'expiry_date', true);
										if ( $expires ) {
											echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $expires ) ) );
										} else {
											echo '--';
										}
									?>
								</div>
				            </div>
				        </div>
				        <div class="ali-right applicant-action-button">
			        		<?php
							$my_jobs_url = add_query_arg( 'job_id', $post->ID, remove_query_arg( 'job_id', $my_jobs_url ) );
							switch ( $post->post_status ) {
								case 'publish' :
									$edit_url = add_query_arg( 'action', 'edit', remove_query_arg( 'action', $my_jobs_url ) );
									
									if ( $filled ) {
										$classes = 'mark_not_filled';
										$title = esc_html__('Mark not filled', 'workio');
										$nonce = wp_create_nonce( 'wp-job-board-mark-not-filled-nonce' );
										$icon_class = 'fa fa-lock';
									} else {
										$classes = 'mark_filled';
										$title = esc_html__('Mark filled', 'workio');
										$nonce = wp_create_nonce( 'wp-job-board-mark-filled-nonce' );
										$icon_class = 'fa fa-unlock';
									}
									?>
									<a data-toggle="tooltip" class="fill-btn btn-action-icon job-table-action <?php echo esc_attr($classes); ?>" href="javascript:void(0);" title="<?php echo esc_attr($title); ?>" data-job_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr($nonce); ?>"><i class="<?php echo esc_attr($icon_class); ?>"></i></a>

									<a data-toggle="tooltip" class="edit-btn btn-action-icon edit job-table-action" href="<?php echo esc_url($edit_url); ?>" title="<?php esc_attr_e('Edit', 'workio'); ?>">
										<i class="ti-pencil-alt"></i>
									</a>
									<?php
									break;
								case 'expired' :
									$relist_url = add_query_arg( 'action', 'relist', remove_query_arg( 'action', $my_jobs_url ) );
									?>
									<a data-toggle="tooltip" href="<?php echo esc_url($relist_url); ?>" class="btn-action-icon edit job-table-action" title="<?php esc_attr_e('Relist', 'workio'); ?>">
										<i class="fa fa-registered"></i>
									</a>
									<?php
									break;
								case 'pending_payment' :
								case 'pending' :
									$edit_url = add_query_arg( 'action', 'edit', remove_query_arg( 'action', $my_jobs_url ) );
									?>
									<a data-toggle="tooltip" class="edit-btn btn-action-icon edit job-table-action" href="<?php echo esc_url($edit_url); ?>" title="<?php esc_attr_e('Edit', 'workio'); ?>">
										<i class="ti-pencil-alt"></i>
									</a>
									<?php
								break;
								case 'draft' :
								case 'preview' :
									$continue_url = add_query_arg( 'action', 'continue', remove_query_arg( 'action', $my_jobs_url ) );
									?>
									<a data-toggle="tooltip" href="<?php echo esc_url($continue_url); ?>" class="edit-btn btn-action-icon edit job-table-action" title="<?php esc_attr_e('Continue', 'workio'); ?>">
										<i class="ti-angle-right"></i>
									</a>
									<?php
									break;
							}
							?>

							<a data-toggle="tooltip" class="remove-btn btn-action-icon deleted job-table-action job-button-delete" href="javascript:void(0)" data-job_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-delete-job-nonce' )); ?>" title="<?php esc_attr_e('Remove', 'workio'); ?>">
								<i class="ti-trash"></i>
							</a>

				        </div>
				    </div>
				</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php
			WP_Job_Board_Mixes::custom_pagination( array(
				'wp_query' => $jobs,
				'max_num_pages' => $jobs->max_num_pages,
				'prev_text'     => '<i class="ti-angle-left"></i>',
				'next_text'     => '<i class="ti-angle-right"></i>',
			));

			wp_reset_postdata();
		?>
	<?php else : ?>
		<div class="alert alert-warning">
			<p><?php esc_html_e( 'You don\'t have any jobs, yet. Start by creating new one.', 'workio' ); ?></p>
		</div>
	<?php endif; ?>
	</div>
</div>