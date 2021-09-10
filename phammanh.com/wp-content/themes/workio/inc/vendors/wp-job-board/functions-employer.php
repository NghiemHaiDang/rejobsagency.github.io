<?php

function workio_get_employers( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_employers_by' => 'recent',
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
		'post_type'         => 'employer',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_employers_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_EMPLOYER_PREFIX.'featured',
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
            'taxonomy'      => 'employer_category',
            'field'         => 'slug',
            'terms'         => implode(",", $categories ),
            'operator'      => 'IN'
        );
    }
    if ( !empty($locations) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'employer_location',
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

if ( !function_exists('workio_employer_content_class') ) {
	function workio_employer_content_class( $class ) {
		$prefix = 'employers';
		if ( is_singular( 'employer' ) ) {
            $prefix = 'employer';
        }
		if ( workio_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'workio_employer_content_class', 'workio_employer_content_class', 1 , 1  );

if ( !function_exists('workio_get_employers_layout_configs') ) {
	function workio_get_employers_layout_configs() {
		$layout_type = workio_get_config('employers_archive_layout');
		switch ( $layout_type ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => 'employers-filter-sidebar', 'class' => 'col-md-4 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => 'employers-filter-sidebar',  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['right'] = array( 'sidebar' => 'employers-filter-sidebar',  'class' => 'offcanvas-filter-sidebar' ); 
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
		}
		return $configs; 
	}
}

function workio_get_employers_display_mode() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_employers_display_mode', true );
	}
	if ( empty($columns) ) {
		$columns = workio_get_config('employers_display_mode', 3);
	}
	return apply_filters( 'workio_get_employers_columns', $columns );
}

function workio_get_employers_columns() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_employers_columns', true );
	}
	if ( empty($columns) ) {
		$columns = workio_get_config('employers_columns', 3);
	}
	return apply_filters( 'workio_get_employers_columns', $columns );
}

function workio_get_employer_layout_type() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_layout', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = workio_get_config('employers_archive_layout');
	}
	return apply_filters( 'workio_get_employer_layout_type', $layout_type );
}

function workio_get_employers_pagination() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$pagination = get_post_meta( $post->ID, 'apus_page_employers_pagination', true );
	}
	if ( empty($pagination) ) {
		$pagination = workio_get_config('employers_pagination', 'default');
	}
	return apply_filters( 'workio_get_employers_pagination', $pagination );
}



// post per page
add_filter('wp-job-board-employer-filter-query', 'workio_employer_filter_query', 10, 2);
function workio_employer_filter_query( $query, $params) {
	$query_vars = &$query->query_vars;
	$query_vars['posts_per_page'] = workio_employer_get_limit_number();
	$query->query_vars = $query_vars;
	
	return $query;
}

add_filter( 'wp-job-board-employer-query-args', 'workio_employer_filter_query_args', 10, 2 );
function workio_employer_filter_query_args($query_args, $params) {
	$query_args['posts_per_page'] = workio_employer_get_limit_number();
	return $query_args;
}

function workio_employer_get_limit_number() {
	if ( isset( $_REQUEST['employers_ppp'] ) ) {
        $number = intval( $_REQUEST['employers_ppp'] );
    } elseif ( !empty($_COOKIE['employers_per_page']) ) {
        $number = intval( $_COOKIE['employers_per_page'] );
    } else {
        $value = wp_job_board_get_option('number_employers_per_page', 10);
        $number = intval( $value );
    }
    return $number;
}

add_action('init', 'workio_employer_save_ppp');
function workio_employer_save_ppp() {
	if ( !empty( $_REQUEST['employers_ppp'] ) ) {
        $number = intval( $_REQUEST['employers_ppp'] );
        setcookie('employers_per_page', $number, time() + 864000);
        $_COOKIE['employers_per_page'] = $number;
    }
}


// filter horizontal
function workio_employer_get_filter_fields() {
	return apply_filters( 'workio_employer_get_filter_fields', array(
		'title'	=> array(
			'label' => esc_html__( 'Search Employer', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input'),
			'placeholder' => esc_html__( 'e.g. web design', 'workio' ),
			'toggle' => false,
			'for_post_type' => 'employer',
			'show_title' => false,
		),
		'category' => array(
			'label' => esc_html__( 'Category', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'employer_category',
			'toggle' => false,
			'for_post_type' => 'employer',
			'show_title' => false,
		),
		'center-location' => array(
			'label' => esc_html__( 'Employer Location', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input_location'),
			'placeholder' => esc_html__( 'All Location', 'workio' ),
			'show_distance' => true,
			'toggle' => false,
			'for_post_type' => 'employer',
			'show_title' => false,
		),
		'location' => array(
			'label' => esc_html__( 'Employer Location List', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'employer_location',
			'toggle' => false,
			'for_post_type' => 'employer',
			'show_title' => false,
		),
		'founded-date' => array(
			'label' => esc_html__( 'Founded Date', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_found_date_range_slider'),
			'toggle' => false,
			'for_post_type' => 'employer',
			'show_title' => true,
			'style' => 'horizontal',
		),
		'featured' => array(
			'label' => esc_html__( 'Featured', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_checkbox'),
			'for_post_type' => 'employer',
			'show_title' => false,
		),
	));
}

add_filter( 'workio_employer_get_filter_fields', 'workio_add_filter_fields_employer' );
function workio_add_filter_fields_employer($fields) {

	$post_type = 'employer_cfield';
	$prefix = WP_JOB_BOARD_EMPLOYER_CUSTOM_FIELD_PREFIX;
	
	$cfields = workio_generate_filter_fields($post_type, $prefix, 'employer');

	if ( $cfields ) {
		$fields = array_merge($fields, $cfields);
	}
	return $fields;
}
