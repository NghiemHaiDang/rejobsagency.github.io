<?php

function workio_get_candidates( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_candidates_by' => 'recent',
		'orderby' => '',
		'order' => '',
		'post__in' => array(),
		'fields' => null, // ids
		'author' => null,
		'categories' => array(),
		'locations' => array(),
	));
	extract($params);

	$query_args = array(
		'post_type'         => 'candidate',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_candidates_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_CANDIDATE_PREFIX.'featured',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
		case 'urgent':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_CANDIDATE_PREFIX.'urgent',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
		case 'default':
			$query_args['order'] = 'DESC';
			$query_args['orderby'] = array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
				'ID'         => 'DESC',
			);
			break;
	}

	if ( !empty($post__in) ) {
    	$query_args['post__in'] = $post__in;
    }

    if ( !empty($fields) ) {
    	$query_args['fields'] = $fields;
    }

    if ( !empty($author) ) {
    	$query_args['author'] = $author;
    }

    $tax_query = array();
    if ( !empty($categories) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'candidate_category',
            'field'         => 'slug',
            'terms'         => implode(",", $categories ),
            'operator'      => 'IN'
        );
    }
    if ( !empty($locations) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'candidate_location',
            'field'         => 'slug',
            'terms'         => implode(",", $locations ),
            'operator'      => 'IN'
        );
    }

    if ( !empty($tax_query) ) {
    	$query_args['tax_query'] = $tax_query;
    }
    
    if ( !empty($meta_query) ) {
    	$query_args['meta_query'] = $meta_query;
    }

	return new WP_Query( $query_args );
}

if ( !function_exists('workio_candidate_content_class') ) {
	function workio_candidate_content_class( $class ) {
		$prefix = 'candidates';
		if ( is_singular( 'candidate' ) ) {
            $prefix = 'candidate';
        }
		if ( workio_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'workio_candidate_content_class', 'workio_candidate_content_class', 1 , 1 );

if ( !function_exists('workio_get_candidates_layout_configs') ) {
	function workio_get_candidates_layout_configs() {
		$layout_type = workio_get_candidates_layout_type();
		switch ( $layout_type ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => 'candidates-filter-sidebar', 'class' => 'col-md-4 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => 'candidates-filter-sidebar',  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
		}
		return $configs; 
	}
}

function workio_get_candidates_layout_type() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_candidates_layout_type', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = workio_get_config('candidates_layout_type', 'main-right');
	}
	return apply_filters( 'workio_get_candidates_layout_type', $layout_type );
}

function workio_get_candidates_display_mode() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_candidates_display_mode', true );
	}
	if ( empty($columns) ) {
		$columns = workio_get_config('candidates_display_mode', 3);
	}
	return apply_filters( 'workio_get_candidates_columns', $columns );
}

function workio_get_candidates_columns() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_candidates_columns', true );
	}
	if ( empty($columns) ) {
		$columns = workio_get_config('candidates_columns', 3);
	}
	return apply_filters( 'workio_get_candidates_columns', $columns );
}

function workio_get_candidate_layout_type() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_layout', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = workio_get_config('candidates_archive_layout');
	}
	return apply_filters( 'workio_get_candidate_layout_type', $layout_type );
}

function workio_get_candidates_pagination() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$pagination = get_post_meta( $post->ID, 'apus_page_candidates_pagination', true );
	}
	if ( empty($pagination) ) {
		$pagination = workio_get_config('candidates_pagination', 'default');
	}
	return apply_filters( 'workio_get_candidates_pagination', $pagination );
}


// post per page
add_filter('wp-job-board-candidate-filter-query', 'workio_candidate_filter_query', 10, 2);
function workio_candidate_filter_query( $query, $params) {
	$query_vars = &$query->query_vars;
	$query_vars['posts_per_page'] = workio_candidate_get_limit_number();
	$query->query_vars = $query_vars;
	
	return $query;
}

add_filter( 'wp-job-board-candidate-query-args', 'workio_candidate_filter_query_args', 10, 2 );
function workio_candidate_filter_query_args($query_args, $params) {
	$query_args['posts_per_page'] = workio_candidate_get_limit_number();
	return $query_args;
}

function workio_candidate_get_limit_number() {
	if ( isset( $_REQUEST['candidates_ppp'] ) ) {
        $number = intval( $_REQUEST['candidates_ppp'] );
    } elseif ( !empty($_COOKIE['candidates_per_page']) ) {
        $number = intval( $_COOKIE['candidates_per_page'] );
    } else {
        $value = wp_job_board_get_option('number_candidates_per_page', 10);
        $number = intval( $value );
    }
    return $number;
}

add_action('init', 'workio_candidate_save_ppp');
function workio_candidate_save_ppp() {
	if ( !empty( $_REQUEST['candidates_ppp'] ) ) {
        $number = intval( $_REQUEST['candidates_ppp'] );
        setcookie('candidates_per_page', $number, time() + 864000);
        $_COOKIE['candidates_per_page'] = $number;
    }
}

function workio_candidate_check_hidden_review() {
	$view = wp_job_board_get_option('candidates_restrict_review', 'all');
	if ( $view == 'always_hidden' ) {
		return false;
	}
	return true;
}


function workio_is_candidates_page() {
	if ( is_page() ) {
		$page_name = basename(get_page_template());
		if ( $page_name == 'page-candidates.php' ) {
			return true;
		}
	} elseif( is_archive('candidate') || is_tax('candidate_category') || is_tax('candidate_location') ) {
		return true;
	}
	return false;
}


// custom fields
add_filter( 'cmb2_meta_boxes', 'workio_is_candidates_fields', 100 );
function workio_is_candidates_fields( array $metaboxes ) {
	$prefix = WP_JOB_BOARD_CANDIDATE_PREFIX;
	if ( !empty($metaboxes[ $prefix . 'general' ]['fields']) ) {
		$fields = $metaboxes[ $prefix . 'general' ]['fields'];
		$rfields = array();
		foreach ($fields as $key => $field) {
			$rfields[] = $field;
			if ( !empty($field['id']) && $field['id'] == $prefix . 'attached_user' ) {
				$rfields[] = array(
					'name'              => esc_html__( 'Cover Photo', 'workio' ),
					'id'                => $prefix . 'cover_photo',
					'type'              => 'file',
					'query_args' => array(
						'type' => array(
							'image/gif',
							'image/jpeg',
							'image/png',
						),
					),
				);
			}
		}
		$metaboxes[ $prefix . 'general' ]['fields'] = $rfields;
	}
	return $metaboxes;
}

add_filter('wp-job-board-candidate-fields-front', 'workio_is_candidates_fields_front', 10);
function workio_is_candidates_fields_front($fields) {
	$prefix = WP_JOB_BOARD_CANDIDATE_PREFIX;
	$rfields = array();
	foreach ($fields as $key => $field) {
		$rfields[] = $field;
		if ( !empty($field['id']) && $field['id'] == $prefix . 'featured_image' ) {
			$rfields[] = array(
				'name'              => esc_html__( 'Cover Photo', 'workio' ),
				'id'                => $prefix . 'cover_photo',
				'type'              => 'wp_job_board_file',
				'multiple'			=> false,
				'ajax'				=> true,
				'mime_types' => array( 'gif', 'jpeg', 'jpg', 'png' ),
				'priority'           => 1,
			);
		}
	}
	return $rfields;
}



// filter horizontal
function workio_candidate_get_filter_fields() {
	return apply_filters( 'workio_candidate_get_filter_fields', array(
		'title'	=> array(
			'label' => esc_html__( 'Search Keywords', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input'),
			'placeholder' => esc_html__( 'e.g. web design', 'workio' ),
			'toggle' => false,
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
		'category' => array(
			'label' => esc_html__( 'Category', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'candidate_category',
			'toggle' => false,
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
		'center-location' => array(
			'label' => esc_html__( 'Location', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input_location'),
			'placeholder' => esc_html__( 'All Location', 'workio' ),
			'show_distance' => true,
			'toggle' => false,
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
		'location' => array(
			'label' => esc_html__( 'Location List', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'candidate_location',
			'toggle' => false,
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
		'date-posted' => array(
			'label' => esc_html__( 'Date Posted', 'workio' ),
			'field_call_back' => 'workio_filter_field_input_date_posted',
			'toggle' => false,
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
		'salary' => array(
			'label' => esc_html__( 'Salary', 'workio' ),
			'field_call_back' => 'workio_filter_field_candidate_salary',
			'toggle' => false,
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
		'featured' => array(
			'label' => esc_html__( 'Featured', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_checkbox'),
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
		'urgent' => array(
			'label' => esc_html__( 'Urgent', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_checkbox'),
			'for_post_type' => 'candidate',
			'show_title' => false,
		),
	));
}

add_filter( 'workio_candidate_get_filter_fields', 'workio_add_filter_fields_candidate' );
function workio_add_filter_fields_candidate($fields) {

	$post_type = 'candidate_cfield';
	$prefix = WP_JOB_BOARD_CANDIDATE_CUSTOM_FIELD_PREFIX;
	
	$cfields = workio_generate_filter_fields($post_type, $prefix, 'candidate');

	if ( $cfields ) {
		$fields = array_merge($fields, $cfields);
	}
	return $fields;
}

function workio_filter_field_candidate_salary($instance, $args, $key, $field) {
	$name = 'filter-'.$key;
	$selected = !empty( $_GET[$name] ) ? $_GET[$name] : '';

	$salary_min = WP_Job_Board_Query::get_min_max_meta_value(WP_JOB_BOARD_CANDIDATE_PREFIX.'salary', 'candidate');
	if ( empty($salary_min) ) {
		return;
	}
	$min = $max = 0;
	$min = $salary_min->min ? $salary_min->min : 0;
	$max = $salary_min->max ? $salary_min->max : 0;
	
	if ( $min >= $max ) {
		return;
	}
	include WP_Job_Board_Template_Loader::locate( 'widgets/filter-fields/salary_horizontal_range_slider' );
}