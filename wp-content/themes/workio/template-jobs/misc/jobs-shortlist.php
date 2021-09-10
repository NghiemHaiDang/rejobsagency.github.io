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
			<div class="search-jobs-shortlist-form widget-search">
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
			<div class="sort-jobs-shortlist-form sortby-form">
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
		if ( !empty($job_ids) && is_array($job_ids) ) {
			if ( get_query_var( 'paged' ) ) {
			    $paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
			    $paged = get_query_var( 'page' );
			} else {
			    $paged = 1;
			}
			$query_vars = array(
				'post_type'         => 'job_listing',
				'posts_per_page'    => get_option('posts_per_page'),
				'paged'    			=> $paged,
				'post_status'       => 'publish',
				'post__in'       	=> $job_ids,
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
			
			if ( $jobs->have_posts() ) { ?>
			<div class="jobs-wrapper">
				<?php while ( $jobs->have_posts() ) : $jobs->the_post();
					global $post;
					$author_id = $post->post_author;
					$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);
					$types = get_the_terms( $post->ID, 'job_listing_type' );
					$address = get_post_meta( $post->ID, WP_JOB_BOARD_JOB_LISTING_PREFIX . 'address', true );
					$salary = WP_Job_Board_Job_Listing::get_salary_html($post->ID);

					$job_id = $post->ID;
					?>

					<?php do_action( 'wp_job_board_before_job_content', $post->ID ); ?>
					<div class="style-list-jobs">
						<article <?php post_class('job-list shortlist-job job-style-inner job-shortlist-wrapper'); ?>>
						    <div class="featured-urgent-label">
						        <?php workio_job_display_featured_icon($post); ?>  
						        <?php workio_job_display_urgent_icon($post); ?>              
						    </div>
							<div class="flex-middle-sm job-list-container">
								<?php if ( has_post_thumbnail($employer_id) ) { ?>
							        <div class="job-employer-logo">
							            <?php echo get_the_post_thumbnail( $employer_id, 'thumbnail' ); ?>
							        </div>
							    <?php } ?>
							    <div class="infor-center">
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
							                <?php workio_job_display_postdate($post, 'no-icon-title'); ?>
							            </div>

								        <div class="job-metas">
							                <?php workio_job_display_full_location($post, 'title'); ?>
							                <?php workio_job_display_job_categories($post, 'title'); ?>
							                <?php workio_job_display_salary($post, 'title'); ?>
							            </div>
							    	</div>
								</div>
								<div class="ali-right">
						        	<a href="javascript:void(0)" class="btn-loading btn-remove-job-shortlist btn-action-icon deleted" data-job_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-job-shortlist-nonce' )); ?>">
						        		<i class="ti-trash"></i><span><?php echo esc_html__('Remove','workio') ?></span>
						        	</a>
						        </div>
							</div>
						</article><!-- #post-## -->
					</div>
					<?php do_action( 'wp_job_board_after_job_content', $post->ID );
				endwhile; ?>
				</div>
				<?php WP_Job_Board_Mixes::custom_pagination( array(
					'wp_query' => $jobs,
					'max_num_pages' => $jobs->max_num_pages,
					'prev_text'     => esc_html__( 'Previous page', 'workio' ),
					'next_text'     => esc_html__( 'Next page', 'workio' ),
				));

				wp_reset_postdata();
			}
		?>

		<?php } else { ?>
			<div class="not-found"><?php esc_html_e('No jobs found.', 'workio'); ?></div>
		<?php } ?>
	</div>
</div>