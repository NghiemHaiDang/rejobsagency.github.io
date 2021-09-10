<?php

function workio_employer_display_logo($post, $size = 'workio-logo-size') {
	?>
    <div class="employer-logo">
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

function workio_employer_display_full_location($post, $display_type = 'normal') {
	$location = WP_Job_Board_Employer::get_post_meta( $post->ID, 'address', true );
	if ( empty($location) ) {
		$location = WP_Job_Board_Employer::get_post_meta( $post->ID, 'map_location_address', true );
	}
	if( $display_type == 'icon' ){
		$prefix = '<i class="ti-location-pin"></i>';
	} elseif( $display_type == 'title' ) {
		$prefix = '<span class="location-label">'.esc_html__('Location:', 'workio').'</span>';
	} else {
		$prefix = '';
	}
	if ( $location ) {
		$map_location = WP_Job_Board_Employer::get_post_meta( $post->ID, 'map_location_address', true );
        if ( empty($map_location) ) {
            $map_location = $location;
        }
		?>
		<div class="job-location"><?php echo trim($prefix); ?> <a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $map_location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a></div>
		<?php
    }
}

function workio_employer_display_open_position($post) {
	$user_id = WP_Job_Board_User::get_user_by_employer_id($post->ID);
	$args = array(
	        'post_type' => 'job_listing',
	        'post_per_page' => -1,
	        'post_status' => 'publish',
	        'fields' => 'ids',
	        'author' => $user_id
	    );
	$jobs = WP_Job_Board_Query::get_posts($args);
	$count_jobs = $jobs->found_posts;
	
	?>
	<div class="open-job">
        <span class="open-job-label"><?php echo esc_html__('Jobs Open:', 'workio'); ?></span> <?php echo intval($count_jobs); ?>
    </div>
    <?php
}

function workio_employer_display_found_date($post) {
	$founded_date = WP_Job_Board_Employer::get_post_meta($post->ID, 'founded_date', true);
	if ( $founded_date ) {
		?>
		<div class="found-date">
	        <span class="found-date-label"><?php echo esc_html__('Member Since', 'workio'); ?></span> <?php echo esc_html($founded_date); ?>
	    </div>
	    <?php
	}
}

function workio_employer_display_nb_jobs($post) {
	$user_id = WP_Job_Board_User::get_user_by_employer_id($post->ID);
	$args = array(
	        'post_type' => 'job_listing',
	        'post_per_page' => -1,
	        'post_status' => 'publish',
	        'fields' => 'ids',
	        'author' => $user_id
	    );
	$jobs = WP_Job_Board_Query::get_posts($args);
	$count_jobs = $jobs->found_posts;
	
	?>
	<div class="nb-job">
        <?php echo sprintf(_n('<span class="text-red">%d</span> <span class="text">Job</span>', '<span class="text-red">%d</span> <span class="text">Jobs</span>', intval($count_jobs), 'workio'), intval($count_jobs)); ?>
    </div>
    <?php
}

function workio_employer_display_nb_reviews($post) {
	if ( comments_open($post) || get_comments_number($post) ) {
		$employer_id = $post->ID;
		$total_reviews = WP_Job_Board_Review::get_total_reviews($employer_id);
		$total_reviews_display = $total_reviews ? WP_Job_Board_Mixes::format_number($total_reviews) : 0;
		?>
		<div class="nb_reviews">
	        <?php echo sprintf(_n('<span class="text-green">%d</span> <span class="text">Review</span>', '<span class="text-green">%d</span> <span class="text">Reviews</span>', intval($total_reviews), 'workio'), $total_reviews_display); ?>
	    </div>
	    <?php
	}
}

function workio_employer_display_nb_views($post) {
	$employer_id = $post->ID;
	$views = WP_Job_Board_Employer::get_post_meta($employer_id, 'views_count', true);
	$views_display = $views ? WP_Job_Board_Mixes::format_number($views) : 0;
	?>
	<div class="nb_views">
        <?php echo sprintf(_n('<span class="text-blue">%d</span> <span class="text">View</span>', '<span class="text-blue">%d</span> <span class="text">Views</span>', intval($views), 'workio'), $views_display); ?>
    </div>
    <?php
}

function workio_employer_display_featured_icon($post, $display_type = 'no-icon') {
	$featured = WP_Job_Board_Employer::get_post_meta( $post->ID, 'featured', true );
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

function workio_employer_display_phone($employer_id, $echo = true) {
	$post = get_post($employer_id);
	$phone = WP_Job_Board_Employer::get_display_phone( $post );
	ob_start();
	if ( $phone ) {
		?>
		<div class="job-phone"><i class="fa fa-phone"></i> <a href="tel:<?php echo trim($phone); ?>"><?php echo esc_html($phone); ?></a></div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function workio_employer_display_email($employer_id, $echo = true) {
	$post = get_post($employer_id);
	$email = WP_Job_Board_Employer::get_display_email( $post );
	ob_start();
	if ( $email ) {
		?>
		<div class="job-email"><i class="ti-email"></i> <a href="tel:<?php echo trim($email); ?>"><?php echo esc_html($email); ?></a></div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}
function workio_employer_display_category($employer_id, $display_type = 'no-title') {
	$categories = get_the_terms( $employer_id, 'employer_category' );
	$count = 1;
	if ( $categories ) {
		?>
		<?php if($display_type == 'icon'){ ?> 
			<div class="job-category">
				<i class="ti-home"></i>
				<?php
				foreach ($categories as $term) {
					?>
		            	<a class="category-employer" href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
						<?php if( $count < count($categories) ) { ?>, <?php } ?>
		        	<?php $count++;
		    	} ?>
	    	</div>
		<?php } else { ?>
			<div class="job-category">
				<?php
				foreach ($categories as $term) {
					?>
		            	<a class="category-employer" href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a>
		            	<?php if( $count < count($categories) ) { ?>, <?php } ?>
		        	<?php $count++;
		    	} ?>
	    	</div>
    	<?php } ?>
    	<?php
    }
}

function workio_employer_display_follow_btn($employer_id, $show_text = true) {
	if ( WP_Job_Board_Candidate::check_following($employer_id) ) {
		$classes = 'btn-unfollow-employer';
		$nonce = wp_create_nonce( 'wp-job-board-unfollow-employer-nonce' );
		$text = esc_html__('Following', 'workio');
		$icon = 'fa fa-heart';
	} else {
		$classes = 'btn-follow-employer';
		$nonce = wp_create_nonce( 'wp-job-board-follow-employer-nonce' );
		$text = esc_html__('Follow us', 'workio');
		$icon = 'fa fa-heart-o';
	}
	?>
	<a href="javascript:void(0)" class="btn-action-job button <?php echo esc_attr($classes); echo esc_attr((!empty($show_text))?' has-text':' no-text'); ?>" data-employer_id="<?php echo esc_attr($employer_id); ?>" data-nonce="<?php echo esc_attr($nonce); ?>"><i class="<?php echo esc_attr($icon); ?>"></i>
		<?php if ( $show_text ) { ?>
			<span><?php echo esc_html($text); ?></span>
		<?php } ?>
	</a>
	<?php
}


// Employer Archive hooks
function workio_employer_display_per_page_form($wp_query) {
    $total              = $wp_query->found_posts;
    $per_page           = $wp_query->get( 'posts_per_page' );
    $_per_page          = wp_job_board_get_option('number_employers_per_page', 12);

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
    <form method="POST" action="<?php echo esc_url(WP_Job_Board_Mixes::get_employers_page_url()); ?>" class="form-workio-ppp">
        
    	<select name="employers_ppp" onchange="this.form.submit()">
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
		<?php WP_Job_Board_Mixes::query_string_form_fields( null, array( 'employers_ppp', 'submit', 'paged' ) ); ?>
    </form>
    <?php
}

add_action( 'wp_job_board_before_employer_archive', 'workio_employer_display_per_page_form', 26 );