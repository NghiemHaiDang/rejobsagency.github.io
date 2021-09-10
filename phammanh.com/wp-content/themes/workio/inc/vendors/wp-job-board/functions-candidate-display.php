<?php

function workio_candidate_display_logo($post, $size = 'workio-logo-size') {
	?>
    <div class="candidate-logo candidate-thumbnail">
        <a href="<?php echo esc_url( get_permalink($post) ); ?>">
            <?php if ( has_post_thumbnail($post->ID) ) {
                $thumbnail_id = get_post_thumbnail_id($post->ID);
                echo workio_get_attachment_thumbnail( $thumbnail_id, $size );
            } else { ?>
                <img src="<?php echo esc_url(workio_placeholder_img_src($size)); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
            <?php } ?>
        </a>
    </div>
    <?php
}

function workio_candidate_display_categories($post, $display_type = 'no-icon') {
	$categories = get_the_terms( $post->ID, 'candidate_category' );
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){
		?>
		<div class="candidate-category">
			<?php if ($display_type == 'icon') { ?>
					<i class="ti-home"></i>
			<?php } ?>
            <?php $i=1; foreach ($categories as $term) { ?>
                <a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a><?php echo esc_html( $i < count($categories) ? ', ' : '' ); ?>
            <?php $i++; } ?>
        </div>
		<?php
    }
}

function workio_candidate_display_short_location($post, $display_type = 'no-title') {
	$locations = get_the_terms( $post->ID, 'candidate_location' );
	if ( ! empty( $locations ) && ! is_wp_error( $locations ) ){
        if ( $display_type == 'icon' ) {
            ?>
            <div class="candidate-location with-icon">
            <?php
        } elseif ( $display_type == 'title' ) {
            ?>
            <div class="candidate-location with-title">
                <strong><?php esc_html_e('Location:', 'workio'); ?></strong>
            <?php
        } else {
            ?>
            <div class="candidate-location">
		<?php
        }
        ?>
            <?php $i=1; foreach ($locations as $term) { ?>
                <a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a><?php echo esc_html( $i < count($locations) ? ', ' : '' ); ?>
            <?php $i++; } ?>
        </div>
		<?php
    }
}

function workio_candidate_display_tags($post, $display_type = 'no-title', $limit = 4) {
    $tags = get_the_terms( $post->ID, 'candidate_tag' );
    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ){
        ?>
        <div class="job-tags">
            <?php
            if ( $display_type == 'title' ) {
                ?>
                <div class="with-title">
                <strong><?php esc_html_e('Tags:', 'workio'); ?></strong>
                <?php
            } else {
                ?>
                <div class="with-title">
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
                    <span class="tag-job"><?php echo sprintf(esc_html__('+%d more', 'workio'), (count($tags) - $limit) ); ?></span>
                    <?php
                }
            ?>
            </div>
        </div>
        <?php
    }
}

function workio_candidate_display_full_location($post, $display_type = 'no-icon-title', $echo = true) {
	$location = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'address', true );
	if ( empty($location) ) {
		$location = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'map_location_address', true );
	}
	ob_start();
	if ( $location ) {
		$map_location = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'map_location_address', true );
        if ( empty($map_location) ) {
            $map_location = $location;
        }
		if ( $display_type == 'icon' ) {
			?>
			<div class="candidate-location with-icon"><i class="ti-location-pin"></i> <a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $map_location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a></div>
			<?php
		} elseif ( $display_type == 'title' ) {
			?>
			<div class="candidate-location with-title">
				<strong><?php esc_html_e('Location:', 'workio'); ?></strong> <span><a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $map_location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a></span>
			</div>
			<?php
		} else {
			?>
			<div class="candidate-location"><a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $map_location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a></div>
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

function workio_candidate_display_job_title($post) {
	$job_title = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'job_title', true );
	if ( $job_title ) { ?>
        <div class="candidate-job">
            <?php echo esc_html($job_title); ?>
        </div>
    <?php }
}

function workio_candidate_display_featured_urgent_label($post){
    $featured = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'featured', true );
    $urgent = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'urgent', true );
    if ( $urgent || $featured ) {
        ?>
        <div class="featured-urgent-label">
            <?php if ( $featured ) { ?>
                <span class="featured"><?php esc_attr_e('featured', 'workio'); ?></span>
            <?php } ?>
            <?php if ( $urgent ) { ?>
                <span class="urgent"><?php esc_html_e('Urgent', 'workio'); ?></span>
            <?php } ?>
        </div>
        <?php
    }
}

function workio_candidate_display_featured_icon($post, $display_type = 'no-icon') {
	$featured = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'featured', true );
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

function workio_candidate_display_urgent_icon($post, $display_type = 'no-icon') {
	$urgent = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'urgent', true );
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

function workio_candidate_display_phone($post, $echo = true) {
	$phone = WP_Job_Board_Candidate::get_display_phone( $post->ID );
	ob_start();
	if ( $phone ) { ?>
        <div class="candidate-phone"><i class="ti-mobile"></i> <a href="tel:<?php echo trim($phone); ?>"><?php echo trim($phone); ?></a></div>
    <?php }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_candidate_display_email($post, $echo = true) {
	$email = WP_Job_Board_Candidate::get_display_email( $post->ID );
	ob_start();
	if ( $email ) { ?>
        <div class="candidate-email"><i class="ti-email"></i><a href="mailto:<?php echo trim($email); ?>"><?php echo trim($email); ?></a></div>
    <?php }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_candidate_display_salary($post, $display_type = 'no-icon-title', $echo = true) {
	$salary = WP_Job_Board_Candidate::get_salary_html($post->ID);
	ob_start();
	if ( $salary ) {
		if ( $display_type == 'icon' ) {
			?>
			<div class="candidate-salary with-icon"><i class="ti-credit-card"></i> <?php echo trim($salary); ?></div>
			<?php
		} elseif ( $display_type == 'title' ) {
			?>
			<div class="candidate-salary with-title">
                <strong><?php esc_html_e('Salary:', 'workio'); ?></strong> <span><?php echo trim($salary); ?></span>
			</div>
			<?php
		} else {
			?>
			<div class="candidate-salary"><?php echo trim($salary); ?></div>
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

function workio_candidate_display_birthday($post, $display_type = 'no-icon-title', $echo = true) {
	$birthday = WP_Job_Board_Candidate::get_post_meta($post->ID, 'founded_date', true);
	ob_start();
	if ( $birthday ) {
		$birthday = strtotime($birthday);
		$birthday = date(get_option('date_format'), $birthday);
		if ( $display_type == 'icon' ) {
			?>
			<div class="candidate-birthday with-icon"><i class="ti-shield"></i> <?php echo esc_html($birthday); ?></div>
			<?php
		} elseif ( $display_type == 'title' ) {
			?>
			<div class="candidate-birthday with-title">
				<strong><?php esc_html_e('Birthday:', 'workio'); ?></strong> <span><?php echo esc_html($birthday); ?></span>
			</div>
			<?php
		} else {
			?>
			<div class="candidate-birthday"><?php echo esc_html($birthday); ?></div>
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

function workio_candidate_display_nb_reviews($post) {
    if ( comments_open($post) || get_comments_number($post) ) {
        $rating_avg = WP_Job_Board_Review::get_ratings_average($post->ID);
        if ( workio_candidate_check_hidden_review() && !empty($rating_avg) ) { ?>
            <div class="rating-avg-star"><?php echo WP_Job_Board_Review::print_review($rating_avg); ?></div>
        <?php }
    }
}

function workio_candidate_display_shortlist_btn($post, $show_icon = true, $show_text = false) {
	if ( WP_Job_Board_Employer::check_added_shortlist($post->ID) ) {
        $classes = 'btn-action-job btn-added-candidate-shortlist';
        $nonce = wp_create_nonce( 'wp-job-board-remove-candidate-shortlist-nonce' );
        $text = esc_html__('Shortlisted', 'workio');
        $icon = 'fa fa-heart';
    } else {
        $classes = 'btn-action-job btn-add-candidate-shortlist';
        $nonce = wp_create_nonce( 'wp-job-board-add-candidate-shortlist-nonce' );
        $text = esc_html__('Shortlist', 'workio');
        $icon = 'fa fa-heart-o';
    }
    ?>
    <a title="<?php echo esc_attr($text); ?>" href="javascript:void(0);" class="<?php echo esc_attr($classes); echo esc_attr((!empty($show_text))?' has-text':' no-text'); ?>" data-candidate_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr($nonce); ?>">
        <?php if ( $show_icon ) { ?>
            <i class="<?php echo esc_attr($icon); ?>"></i>
        <?php } ?>
        <?php if ( $show_text ) { ?>
            <span><?php echo esc_html($text); ?></span>
        <?php } ?>
    </a>
    <?php
}

function workio_candidate_item_map_meta($post) {
    $latitude = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'map_location_latitude', true );
    $longitude = WP_Job_Board_Candidate::get_post_meta( $post->ID, 'map_location_longitude', true );
    
    echo 'data-latitude="'.esc_attr($latitude).'" data-longitude="'.esc_attr($longitude).'"';
}

// Cndidate Archive hooks
function workio_candidate_display_per_page_form($wp_query) {
    $total              = $wp_query->found_posts;
    $per_page           = $wp_query->get( 'posts_per_page' );
    $_per_page          = wp_job_board_get_option('number_candidates_per_page', 12);

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
    <form method="POST" action="<?php echo esc_url(WP_Job_Board_Mixes::get_candidates_page_url()); ?>" class="form-workio-ppp">
        
    	<select name="candidates_ppp" onchange="this.form.submit()">
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
		<?php WP_Job_Board_Mixes::query_string_form_fields( null, array( 'candidates_ppp', 'submit', 'paged' ) ); ?>
    </form>
    <?php
}

remove_action( 'wp_job_board_before_candidate_archive', array( 'WP_Job_Board_Candidate', 'display_candidates_count_results' ), 10 );
remove_action( 'wp_job_board_before_candidate_archive', array( 'WP_Job_Board_Candidate', 'display_candidates_alert_form' ), 20 );

add_action( 'wp_job_board_before_candidate_archive', array( 'WP_Job_Board_Candidate', 'display_candidates_count_results' ), 20 );
add_action( 'wp_job_board_before_candidate_archive', 'workio_candidate_display_per_page_form', 26 );