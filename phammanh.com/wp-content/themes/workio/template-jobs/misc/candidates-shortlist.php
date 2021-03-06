<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script('select2');
wp_enqueue_style('select2');
?>
<div class="box-dashboard-wrapper">
	<div class="inner-list">
		<h3 class="widget-title"><?php echo esc_html__('Candidate Shorlist','workio') ?></h3>
		<div class="search-orderby-wrapper flex-middle-sm">
			<div class="search-candidate-shortlist-form widget-search">
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
			<div class="sort-candidate-shortlist-form sortby-form">
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

		<?php if ( !empty($candidate_ids) && is_array($candidate_ids) ) {
			if ( get_query_var( 'paged' ) ) {
			    $paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
			    $paged = get_query_var( 'page' );
			} else {
			    $paged = 1;
			}
			$query_vars = array(
				'post_type'         => 'candidate',
				'posts_per_page'    => get_option('posts_per_page'),
				'paged'    			=> $paged,
				'post_status'       => 'publish',
				'post__in'       	=> $candidate_ids,
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

			$candidates = new WP_Query($query_vars);
			
			if ( $candidates->have_posts() ) { ?>
				<div class="candidates-wrapper">
					<?php while ( $candidates->have_posts() ) : $candidates->the_post();
						global $post;
						$rating_avg = WP_Job_Board_Review::get_ratings_average($post->ID);
						?>

						<?php do_action( 'wp_job_board_before_candidate_content', $post->ID ); ?>
						<div class="style-list-candidate">
							<article <?php post_class('candidate-shortlist-wrapper candidate-list candidate-archive-layout'); ?>>
								<div class="featured-urgent-label">
									<?php workio_candidate_display_urgent_icon($post); ?>
								</div>
								<div class="flex-sm">
									<?php if ( has_post_thumbnail() ) { ?>
						                <div class="candidate-thumbnail">
						                    <div class="thumbnail-inner">
						                        <a href="<?php the_permalink(); ?>">
						                            <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
						                        </a>
						                        <?php if ( !empty($rating_avg) ) { ?>
						                            <div class="rating-avg"><?php echo round($rating_avg,1,PHP_ROUND_HALF_UP); ?></div>
						                        <?php } ?>
						                    </div>
						                </div>
						            <?php } ?>

								    <div class="flex-middle-sm inner-left">
						                <div class="candidate-information candidate-list-info">
						                	<?php workio_candidate_display_categories($post); ?>
						            		<div class="title-wrapper">
						                        <?php the_title( sprintf( '<h2 class="candidate-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						                          <?php workio_candidate_display_featured_icon($post); ?>
						                    </div>

						                    <div class="info job-metas clearfix">
						                        <?php workio_candidate_display_full_location($post, 'icon'); ?>

						                        <?php workio_candidate_display_salary($post, 'icon'); ?>
						                    </div>
						            	</div>
						            	<?php workio_candidate_display_tags($post, 'no-title'); ?>
						                <div class="ali-right hidden-xs">
						                	<div class="applicant-action-button">
						                    <a data-toggle="tooltip" href="<?php the_permalink(); ?>" class="btn-action-icon view" title="<?php esc_attr_e('View Profile', 'workio'); ?>"><i class="ti-eye"></i></a>
						                    <a data-toggle="tooltip" class="btn-action-icon btn-candidate-private-message" href="#" data-candidate_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-private-message-send-message-form-nonce' )); ?>" title="<?php esc_attr_e('Send message', 'workio'); ?>"><i class="ti-email"></i></a>
								    		<a data-toggle="tooltip" href="javascript:void(0)" class="btn-action-icon deleted btn-remove-candidate-shortlist" data-candidate_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-candidate-shortlist-nonce' )); ?>" title="<?php esc_attr_e('Delete candidate', 'workio'); ?>"><i class="ti-trash"></i></a>
						                	</div>
						                </div>
						            </div>
							    </div>
							    <div class="bottom-action-mobile visible-xs">
							    	<div class="applicant-action-button">
				                    <a data-toggle="tooltip" href="<?php the_permalink(); ?>" class="btn-action-icon view" title="<?php esc_attr_e('View Profile', 'workio'); ?>"><i class="ti-eye"></i></a>
				                    <a data-toggle="tooltip" class="btn-action-icon btn-candidate-private-message" href="#" data-candidate_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-private-message-send-message-form-nonce' )); ?>" title="<?php esc_attr_e('Send message', 'workio'); ?>"><i class="ti-email"></i></a>
						    		<a data-toggle="tooltip" href="javascript:void(0)" class="btn-action-icon deleted btn-remove-candidate-shortlist" data-candidate_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-remove-candidate-shortlist-nonce' )); ?>" title="<?php esc_attr_e('Delete candidate', 'workio'); ?>"><i class="ti-trash"></i></a>
				                	</div>
				                </div>
							</article><!-- #post-## -->
						</div>
						<?php do_action( 'wp_job_board_after_candidate_content', $post->ID );
					endwhile; ?>
				</div>
				<?php WP_Job_Board_Mixes::custom_pagination( array(
					'wp_query' => $candidates,
					'max_num_pages' => $candidates->max_num_pages,
					'prev_text'     => '<i class="ti-angle-left"></i>',
					'next_text'     => '<i class="ti-angle-right"></i>',
				));

				wp_reset_postdata();
			}
		?>

		<?php } else { ?>
			<div class="not-found"><?php esc_html_e('Don\'t have any candidates in shortlist', 'workio'); ?></div>
		<?php } ?>
	</div>
</div>