<?php

function workio_job_display_employer_logo($post) {
	$author_id = $post->post_author;
	$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);

	?>
    <div class="employer-logo">
        <a href="<?php echo esc_url( get_permalink($post) ); ?>">
        	<?php if ( has_post_thumbnail($employer_id) ) {
        		$thumbnail_id = get_post_thumbnail_id($employer_id);
        		echo workio_get_attachment_thumbnail( $thumbnail_id, 'workio-logo-size' );
        	} else { ?>
            	<img src="<?php echo esc_url(workio_placeholder_img_src()); ?>" alt="<?php echo esc_attr(get_the_title($employer_id)); ?>">
            <?php } ?>
        </a>
    </div>
    <?php
}

function workio_job_display_employer_title($post, $display_type = 'no-icon') {
	$author_id = $post->post_author;
	$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);
	if ( $employer_id ) {
		?>
	        <h3 class="employer-title">
	            <a href="<?php echo esc_url( get_permalink($employer_id) ); ?>">
	            	<?php if ($display_type == 'icon') { ?>
							<i class="ti-home"></i>
					<?php } ?>
	                <?php echo get_the_title( $employer_id ); ?>
	            </a>
	        </h3>
	    <?php
	}
}

function workio_job_display_job_category($post, $display_category = 'no-title', $echo = true) {
	$categories = get_the_terms( $post->ID, 'job_listing_category' );
	ob_start();
	$i = 1;
	if ( $categories ) {
		?>
		<div class="category-job">
			<?php
			if ( $display_category == 'title' ) {
				?>
				<div class="job-category with-title">
					<strong><?php esc_html_e('Category:', 'workio'); ?></strong>
				<?php
			} elseif ($display_category == 'icon') {
				?>
				<div class="job-category with-icon">
					<i class="ti-home"></i>
			<?php
			} else {
				?>
				<div class="job-category">
				<?php
			}
				foreach ($categories as $term) {
					$color = get_term_meta( $term->term_id, '_color', true );
					$style = '';
					if ( $color ) {
						$style = 'color: '.$color;
					}
					?>
		            	<a class="category-job" href="<?php echo get_term_link($term); ?>" style="<?php echo esc_attr($style); ?>"><?php echo esc_html($term->name); ?></a><?php if( $i < count($categories) ) { ?>,<?php } ?>
		        	<?php
		        	$i++;
		    	}
	    	?>
	    	</div>
	    </div>
    	<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_job_categories($post, $display_category = 'no-title', $echo = true) {
	$categories = get_the_terms( $post->ID, 'job_listing_category' );
	ob_start();
	$i = 1;
	if ( $categories ) {
		?>
		<div class="category-job">
			<?php
			if ( $display_category == 'title' ) {
				?>
				<div class="job-category with-title">
					<strong><?php esc_html_e('Category:', 'workio'); ?></strong>
				<?php
			} elseif ($display_category == 'icon') {
				?>
				<div class="job-category with-icon">
					<i class="ti-home"></i>
			<?php
			} else {
				?>
				<div class="job-category">
				<?php
			}
				foreach ($categories as $term) {
					$color = get_term_meta( $term->term_id, '_color', true );
					$style = '';
					if ( $color ) {
						$style = 'color: '.$color;
					}
					?>
		            	<a class="category-job" href="<?php echo get_term_link($term); ?>" style="<?php echo esc_attr($style); ?>"><?php echo esc_html($term->name); ?></a><?php if( $i < count($categories) ) { ?>, <?php } ?>
		        	<?php
		        	$i++;
		    	}
	    	?>
	    	</div>
	    </div>
    	<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_job_type($post, $display_type = 'no-title', $echo = true) {
	$types = get_the_terms( $post->ID, 'job_listing_type' );
	ob_start();
	if ( $types ) {
		?>
		<div class="job-types">
			<?php
			if ( $display_type == 'title' ) {
				?>
				<div class="job-type with-title">
					<strong><?php esc_html_e('Job Type:', 'workio'); ?></strong>
				<?php
			} elseif ($display_type == 'icon') {
				?>
				<div class="job-type with-icon">
					<i class="ti-calendar"></i>
			<?php
			} else {
				?>
				<div class="job-type with-title">
				<?php
			}
				foreach ($types as $term) {
					$color = get_term_meta( $term->term_id, '_color', true );
					$style = '';
					if ( $color ) {
						$style = 'color: '.$color;
					}
					?>
		            	<a class="type-job" href="<?php echo get_term_link($term); ?>" style="<?php echo esc_attr($style); ?>"><?php echo esc_html($term->name); ?></a>
		        	<?php
		    	}
	    	?>
	    	</div>
	    </div>
    	<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_tags($post, $display_type = 'no-title') {
	$tags = get_the_terms( $post->ID, 'job_listing_tag' );
	if ( $tags ) {
		if ( $display_type == 'title' ) {
			?>
			<div class="job-tags with-title">
			<strong><?php esc_html_e('Tagged as:', 'workio'); ?></strong>
			<?php
		} else {
			?>
			<div class="job-tags with-no-title">
			<?php
		}
			$i = 1;
			foreach ($tags as $term) {
				?>
	            	<a class="tag-job" href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a><?php echo esc_attr( $i<count($tags)?', ':'' ); ?>
	        	<?php $i++;
	    	}
    	?>
    	</div>
    	<?php
    }
}

function workio_job_display_tags_v2($post, $display_type = 'no-title', $limit = 3) {
	$tags = get_the_terms( $post->ID, 'job_listing_tag' );
	if ( $tags ) {
		if ( $display_type == 'title' ) {
			?>
			<div class="job-tags with-title">
			<strong><?php esc_html_e('Tagged as:', 'workio'); ?></strong>
			<?php
		} else {
			?>
			<div class="job-tags with-no-title">
			<?php
		}
			$i = 1;
			foreach ($tags as $term) {
			 	if ( $limit > 0 && $i > $limit ) {
                    break;
                }
				?>
	            	<a class="tag-job" href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
	        	<?php
	        	$i++;
	    	}
	    	if ( $limit > 0 && count($tags) > $limit ) {
	    		?>
	    		<span class="count-more-tags"><?php echo sprintf(esc_html__('+%d', 'workio'), (count($tags) - $limit) ); ?></span>
	    		<?php
	    	}
    	?>
    	</div>
    	<?php
    }
}

function workio_job_display_short_location($post, $echo = true) {
	$locations = get_the_terms( $post->ID, 'job_listing_location' );
	ob_start();
	if ( $locations ) {
		?>
		<div class="job-location">
            <i class="flaticon-location-pin"></i>
            <?php $i=1; foreach ($locations as $term) { ?>
                <a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a><?php echo esc_html( $i < count($locations) ? ', ' : '' ); ?>
            <?php $i++; } ?>
        </div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_full_location($post, $display_type = 'no-icon-title', $echo = true) {
	$location = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'address', true );
	if ( empty($location) ) {
		$location = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'map_location_address', true );
	}
	ob_start();
	if ( $location ) {
		$map_location = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'map_location_address', true );
		if ( empty($map_location) ) {
			$map_location = $location;
		}
		if ( $display_type == 'icon' ) {
			?>
			<div class="job-location with-icon"><i class="ti-location-pin"></i><a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $map_location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a></div>
			<?php
		} elseif ( $display_type == 'title' ) {
			?>
			<div class="job-location with-title">
				<strong><?php esc_html_e('Location:', 'workio'); ?></strong> <a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $map_location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a>
			</div>
			<?php
		} else {
			?>
			<div class="job-location"><a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $map_location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a></div>
			<?php
		}
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_salary($post, $display_type = 'no-icon-title', $echo = true) {
	$salary = WP_Job_Board_Job_Listing::get_salary_html($post->ID);
	ob_start();
	if ( $salary ) {
		if ( $display_type == 'icon' ) {
			?>
			<div class="job-salary with-icon"><i class="ti-credit-card"></i><?php echo trim($salary); ?></div>
			<?php
		} elseif ( $display_type == 'title' ) {
			?>
			<div class="job-salary with-title">
				<strong><?php esc_html_e('Salary:', 'workio'); ?></strong> <span><?php echo trim($salary); ?></span>
			</div>
			<?php
		} else {
			?>
			<div class="job-salary"><?php echo trim($salary); ?></div>
			<?php
		}
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_add_shortlist_btn($post, $show_text = false, $show_icon = true) {
    if ( WP_Job_Board_Candidate::check_added_shortlist($post->ID) ) {
        $classes = 'btn-action-job added btn-added-job-shortlist';
        $nonce = wp_create_nonce( 'wp-job-board-remove-job-shortlist-nonce' );
        $text = esc_html__('Shortlisted', 'workio');
        $icon = 'fa fa-heart';
    } else {
        $classes = 'btn-action-job btn-add-job-shortlist';
        $nonce = wp_create_nonce( 'wp-job-board-add-job-shortlist-nonce' );
        $text = esc_html__('Shortlist', 'workio');
        $icon = 'fa fa-heart-o';
    }
    ?>
    <div class="wrapper-shortlist">
        <a href="javascript:void(0);" class="<?php echo esc_attr($classes); echo esc_attr((!empty($show_text))?' has-text':''); ?>" data-job_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr($nonce); ?>">
        	<?php if ( $show_icon ) { ?>
        		<i class="<?php echo esc_attr($icon); ?>"></i>
        	<?php } ?>
        	<?php if ( $show_text ) { ?>
	            <span><?php echo esc_html($text); ?></span>
	        <?php } ?>
        </a>
    </div>
    <?php
}

function workio_job_display_shortlist_btn( $post_id = null ) {
	if ( null == $post_id ) {
		$post_id = get_the_ID();
	}
	
	if ( WP_Job_Board_Candidate::check_added_shortlist($post_id) ) {
		$classes = 'btn-added-job-shortlist btn btn-block btn-shortlist';
		$nonce = wp_create_nonce( 'wp-job-board-remove-job-shortlist-nonce' );
		$text = esc_html__('Shortlisted', 'workio');
	} else {
		$classes = 'btn-add-job-shortlist btn btn-block btn-shortlist';
		$nonce = wp_create_nonce( 'wp-job-board-add-job-shortlist-nonce' );
		$text = esc_html__('Shortlist', 'workio');
	}
	?>
	<a href="javascript:void(0);" class="btn <?php echo esc_attr($classes); ?>" data-job_id="<?php echo esc_attr($post_id); ?>" data-nonce="<?php echo esc_attr($nonce); ?>"><span><?php echo trim($text); ?></span></a>
	<?php
}

function workio_job_display_deadline($post, $display_type = 'no-icon-title', $echo = true) {

	$application_deadline_date = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'application_deadline_date', true );
	ob_start();
	if ( empty($application_deadline_date) || strtotime($application_deadline_date) >= strtotime('now') ) {
		if ( $application_deadline_date ) {
			$deadline_date = strtotime($application_deadline_date);
			?>
			<div class="deadline-time"><?php echo date(get_option('date_format'), $deadline_date); ?></div>
			<?php
		}
	} else {
		?>
		<div class="deadline-closed"><?php esc_html_e('Application deadline closed.', 'workio'); ?></div>
		<?php
	}
	$ouput = ob_get_clean();

	ob_start();
	if ( $display_type == 'icon' ) {
		?>
		<div class="job-deadline with-icon"><i class="ti-credit-card"></i> <?php echo trim($ouput); ?></div>
		<?php
	} elseif ( $display_type == 'title' ) {
		?>
		<div class="job-deadline with-title">
			<strong><?php esc_html_e('Deadline date:', 'workio'); ?></strong> <?php echo trim($ouput); ?>
		</div>
		<?php
	} else {
		?>
		<div class="job-deadline"><?php echo trim($ouput); ?></div>
		<?php
	}
	$output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_postdate($post, $display_type = 'no-icon-title', $format = 'ago', $echo = true) {

	ob_start();
	if ( $format == 'ago' ) {
		$post_date = sprintf(esc_html__(' Posted %s ago', 'workio'), human_time_diff(get_the_time('U'), current_time('timestamp')) );
	} else {
		$post_date = get_the_time(get_option('date_format'));
	}
	if ( $display_type == 'icon' ) {
		?>
		<div class="job-postdate with-icon"><i class="ti-credit-card"></i> <?php echo trim($post_date); ?></div>
		<?php
	} elseif ( $display_type == 'title' ) {
		?>
		<div class="job-postdate with-title">
			<strong><?php esc_html_e('Date:', 'workio'); ?></strong> <?php echo trim($post_date); ?>
		</div>
		<?php
	} else {
		?>
		<div class="job-postdate"><?php echo trim($post_date); ?></div>
		<?php
	}
	$output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_applied_nb($post, $display_type = 'no-icon-title', $echo = true) {
	$query_vars = array(
		'post_type'         => 'job_applicant',
		'posts_per_page'    => 1,
		'paged'    			=> 1,
		'post_status'       => 'publish',
		'meta_query'       => array(
			array(
				'key' => WP_JOB_BOARD_APPLICANT_PREFIX.'job_id',
				'value'     => $post->ID,
				'compare'   => '=',
			),
			array(
				array(
					'relation' => 'OR',
					array(
						'key' => WP_JOB_BOARD_APPLICANT_PREFIX.'rejected',
						'value'     => '',
						'compare'   => '=',
					),
					array(
						'key' => WP_JOB_BOARD_APPLICANT_PREFIX.'rejected',
						'compare' => 'NOT EXISTS',
					)
				)
			)
		)
	);
	$applicants = new WP_Query($query_vars);
	$nb_applicants = $applicants->found_posts;
	ob_start();
	if ( $display_type == 'icon' ) {
		?>
		<div class="job-applied with-icon"><i class="ti-credit-card"></i> <?php echo esc_html($nb_applicants); ?></div>
		<?php
	} elseif ( $display_type == 'title' ) {
		?>
		<div class="job-applied with-title">
			<strong><?php esc_html_e('Applied:', 'workio'); ?></strong> <?php echo esc_html($nb_applicants); ?>
		</div>
		<?php
	} else {
		?>
		<div class="job-applied"><?php echo esc_html($nb_applicants); ?></div>
		<?php
	}
	$output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_job_display_featured_icon($post, $display_type = 'no-icon') {
	$featured = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'featured', true );
	if ( $featured ) {
        if ( $display_type == 'icon' ) {
            ?>
            <span class="featured" data-toggle="tooltip" title="<?php esc_attr_e('Featured', 'workio'); ?>"><i class="fa fa-star"></i></span>
            <?php
        } else {
        ?>
        <span class="featured label-no-icon"><?php esc_attr_e('Featured', 'workio'); ?></span>
    <?php }
    }
}

function workio_job_display_urgent_icon($post, $display_type = 'no-icon') {
	$urgent = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'urgent', true );
	if ( $urgent ) {
		if ( $display_type == 'icon' ) {
	?>
        <span class="urgent" data-toggle="tooltip" title="<?php esc_attr_e('Urgent', 'workio'); ?>"><i class="ti-bell"></i></span>
    <?php } else { ?>
	    	<span class="urgent"><?php esc_html_e('Urgent', 'workio'); ?></span>
	    	<?php
		}
	}
}

function workio_job_display_featured_urgent_label($post){
	$featured = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'featured', true );
	$urgent = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'urgent', true );
	if ( $urgent || $featured ) {
		?>
		<div class="featured-urgent-label">

			<?php if($featured) { ?>
				<span class="featured"><?php esc_attr_e('featured', 'workio'); ?></span>
			<?php } ?>

			<?php if($urgent) { ?>
				<span class="urgent"><?php esc_html_e('Urgent', 'workio'); ?></span>
			<?php } ?>
			
		</div>
		<?php
	}
}

function workio_job_item_map_meta($post) {
	$latitude = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'map_location_latitude', true );
	$longitude = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'map_location_longitude', true );
	
	echo 'data-latitude="'.esc_attr($latitude).'" data-longitude="'.esc_attr($longitude).'"';
}




// Job Archive hooks

function workio_job_display_per_page_form($wp_query) {
    $total              = $wp_query->found_posts;
    $per_page           = $wp_query->get( 'posts_per_page' );
    $_per_page          = wp_job_board_get_option('number_jobs_per_page', 12);

    // Generate per page options
    $products_per_page_options = array();
    while ( $_per_page < $total ) {
        $products_per_page_options[] = $_per_page;
        $_per_page = $_per_page * 2;
    }

    if ( empty( $products_per_page_options ) ) {
        return;
    }

    $products_per_page_options[] = -1;

    ?>
    <form method="POST" action="<?php echo esc_url(WP_Job_Board_Mixes::get_jobs_page_url()); ?>" class="form-workio-ppp">
        
    	<select name="jobs_ppp" onchange="this.form.submit()">
            <?php foreach( $products_per_page_options as $key => $value ) { ?>
                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $per_page ); ?>>
                	<?php
                		if ( $value == -1 ) {
                			esc_html_e( 'All', 'workio' );
                		} else {
                			echo sprintf( esc_html__( '%s Per Page', 'workio' ), $value );
                		}
                	?>
                </option>
            <?php } ?>
        </select>

        <input type="hidden" name="paged" value="1" />
		<?php WP_Job_Board_Mixes::query_string_form_fields( null, array( 'jobs_ppp', 'submit', 'paged' ) ); ?>
    </form>
    <?php
}

remove_action( 'wp_job_board_before_job_archive', array( 'WP_Job_Board_Job_Listing', 'display_jobs_count_results' ), 10 );
remove_action( 'wp_job_board_before_job_archive', array( 'WP_Job_Board_Job_Listing', 'display_jobs_alert_form' ), 20 );

add_action( 'wp_job_board_before_job_archive', array( 'WP_Job_Board_Job_Listing', 'display_jobs_count_results' ), 20 );
add_action( 'wp_job_board_before_job_archive', 'workio_job_display_per_page_form', 26 );