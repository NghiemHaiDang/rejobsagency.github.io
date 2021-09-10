<?php

function workio_get_jobs( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_jobs_by' => 'recent',
		'orderby' => '',
		'order' => '',
		'post__in' => array(),
		'fields' => null, // ids
		'author' => null,
		'categories' => array(),
		'types' => array(),
		'locations' => array(),
	));
	extract($params);

	$query_args = array(
		'post_type'         => 'job_listing',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_jobs_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_JOB_LISTING_PREFIX.'featured',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
		case 'urgent':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_JOB_LISTING_PREFIX.'urgent',
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
            'taxonomy'      => 'job_listing_category',
            'field'         => 'slug',
            'terms'         => implode(",", $categories ),
            'operator'      => 'IN'
        );
    }
    if ( !empty($types) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_type',
            'field'         => 'slug',
            'terms'         => implode(",", $types ),
            'operator'      => 'IN'
        );
    }
    if ( !empty($locations) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_location',
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

if ( !function_exists('workio_job_content_class') ) {
	function workio_job_content_class( $class ) {
		$prefix = 'jobs';
		if ( is_singular( 'job_listing' ) ) {
            $prefix = 'job';
        }
		if ( workio_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'workio_job_content_class', 'workio_job_content_class', 1 , 1  );

if ( !function_exists('workio_get_jobs_layout_configs') ) {
	function workio_get_jobs_layout_configs() {
		$layout_type = workio_get_jobs_layout_type();
		switch ( $layout_type ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => 'jobs-filter-sidebar', 'class' => 'col-md-4 col-lg-4 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-8 col-lg-8 col-sm-12 col-xs-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => 'jobs-filter-sidebar',  'class' => 'col-md-4 col-lg-4 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-8 col-lg-8 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
		}
		return $configs; 
	}
}

function workio_get_jobs_layout_type() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_layout_type', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = workio_get_config('jobs_layout_type', 'main-right');
	}
	return apply_filters( 'workio_get_jobs_layout_type', $layout_type );
}

function workio_get_jobs_display_mode() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$display_mode = get_post_meta( $post->ID, 'apus_page_display_mode', true );
	}
	if ( empty($display_mode) ) {
		$display_mode = workio_get_config('jobs_display_mode', 'list');
	}
	return apply_filters( 'workio_get_jobs_display_mode', $display_mode );
}

function workio_get_jobs_inner_style() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$inner_style = get_post_meta( $post->ID, 'apus_page_inner_style', true );
	}
	if ( empty($inner_style) ) {
		$inner_style = workio_get_config('jobs_inner_style', 'list');
	}
	return apply_filters( 'workio_get_jobs_inner_style', $inner_style );
}

function workio_get_jobs_inner_list_style() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$inner_style = get_post_meta( $post->ID, 'apus_page_inner_list_style', true );
	}
	if ( empty($inner_style) ) {
		$inner_style = workio_get_config('jobs_inner_list_style', 'list');
	}
	return apply_filters( 'workio_get_jobs_inner_list_style', $inner_style );
}

function workio_get_jobs_columns() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_jobs_columns', true );
	}
	if ( empty($columns) ) {
		$columns = workio_get_config('jobs_columns', 3);
	}
	return apply_filters( 'workio_get_jobs_columns', $columns );
}

function workio_get_jobs_pagination() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$pagination = get_post_meta( $post->ID, 'apus_page_jobs_pagination', true );
	}
	if ( empty($pagination) ) {
		$pagination = workio_get_config('jobs_pagination', 'default');
	}
	return apply_filters( 'workio_get_jobs_pagination', $pagination );
}

function workio_job_scripts() {
	
	wp_enqueue_style( 'leaflet' );
	wp_enqueue_script( 'jquery-highlight' );
    wp_enqueue_script( 'leaflet' );
    wp_enqueue_script( 'leaflet-GoogleMutant' );
    wp_enqueue_script( 'control-geocoder' );
    wp_enqueue_script( 'esri-leaflet' );
    wp_enqueue_script( 'esri-leaflet-geocoder' );
    wp_enqueue_script( 'leaflet-markercluster' );
    wp_enqueue_script( 'leaflet-HtmlIcon' );


	wp_register_script( 'workio-job', get_template_directory_uri() . '/js/job.js', array( 'jquery', 'wp-job-board-main' ), '20150330', true );
	wp_localize_script( 'workio-job', 'workio_job_opts', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'template' => apply_filters( 'workio_autocompleate_search_template', '<a href="{{url}}" class="media autocompleate-media">
			<div class="media-left media-middle">
				<img src="{{image}}" class="media-object" height="70" width="70">
			</div>
			<div class="media-body media-middle">
				<h4>{{title}}</h4>
				<div class="location"><div class="listing-location listing-address">
			<i class="ti-location-pin"></i>{{location}}</div></div>
				</div></a>' ),
        'empty_msg' => apply_filters( 'workio_autocompleate_search_empty_msg', esc_html__( 'Unable to find any listing that match the currenty query', 'workio' ) ),
	));
	wp_enqueue_script( 'workio-job' );


	$mapbox_token = '';
	$mapbox_style = '';
	$custom_style = '';
	$map_service = wp_job_board_get_option('map_service', '');
	if ( $map_service == 'mapbox' ) {
		$mapbox_token = wp_job_board_get_option('mapbox_token', '');
		$mapbox_style = wp_job_board_get_option('mapbox_style', 'streets-v11');
		if ( empty($mapbox_style) || !in_array($mapbox_style, array( 'streets-v11', 'light-v10', 'dark-v10', 'outdoors-v11', 'satellite-v9' )) ) {
			$mapbox_style = 'streets-v11';
		}
	} else {
		$custom_style = wp_job_board_get_option('google_map_style', '');
	}

	wp_register_script( 'workio-job-map', get_template_directory_uri() . '/js/job-map.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'workio-job-map', 'workio_job_map_opts', array(
		'map_service' => $map_service,
		'mapbox_token' => $mapbox_token,
		'mapbox_style' => $mapbox_style,
		'custom_style' => $custom_style,

		'default_latitude' => wp_job_board_get_option('default_maps_location_latitude', '43.6568'),
		'default_longitude' => wp_job_board_get_option('default_maps_location_longitude', '-79.4512'),
		'default_pin' => wp_job_board_get_option('default_maps_pin', ''),
	));
	wp_enqueue_script( 'workio-job-map' );
}
add_action( 'wp_enqueue_scripts', 'workio_job_scripts', 10 );

function workio_job_create_resume_pdf_styles() {
	return array(
		get_template_directory() . '/css/resume-pdf.css'
	);
}
add_filter( 'wp-job-board-style-pdf', 'workio_job_create_resume_pdf_styles', 10 );

function workio_job_template_folder_name($folder) {
	$folder = 'template-jobs';
	return $folder;
}
add_filter( 'wp-job-board-theme-folder-name', 'workio_job_template_folder_name', 10 );


function workio_job_get_filter_fields() {
	return apply_filters( 'workio_job_get_filter_fields', array(
		'title'	=> array(
			'label' => esc_html__( 'Search Keywords', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input'),
			'placeholder' => esc_html__( 'e.g. web design', 'workio' ),
			'show_title' => false,
			'for_post_type' => 'job_listing',
		),
		'category' => array(
			'label' => esc_html__( 'Category', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'job_listing_category',
			'toggle' => false,
			'show_title' => false,
			'for_post_type' => 'job_listing',
		),
		'center-location' => array(
			'label' => esc_html__( 'Location', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input_location'),
			'placeholder' => esc_html__( 'All Location', 'workio' ),
			'show_distance' => false,
			'toggle' => false,
			'show_title' => false,
			'for_post_type' => 'job_listing',
		),
		'location' => array(
			'label' => esc_html__( 'Location list', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'job_listing_location',
			'toggle' => false,
			'show_title' => false,
			'for_post_type' => 'job_listing',
		),
		'type' => array(
			'label' => esc_html__( 'Job Type', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'job_listing_type',
			'toggle' => false,
			'show_title' => false,
			'for_post_type' => 'job_listing',
		),
		'salary' => array(
			'label' => esc_html__( 'Salary', 'workio' ),
			'field_call_back' => 'workio_filter_field_job_salary',
			'toggle' => false,
			'show_title' => true,
			'for_post_type' => 'job_listing',
			'show_salary_type' => false,
			'style' => 'horizontal',
		),
		'date-posted' => array(
			'label' => esc_html__( 'Date Posted', 'workio' ),
			'field_call_back' => 'workio_filter_field_input_date_posted',
			'toggle' => false,
			'show_title' => false,
			'for_post_type' => 'job_listing',
		),
		'tag' => array(
			'label' => esc_html__( 'Job Tag', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
			'taxonomy' => 'job_listing_tag',
			'toggle' => false,
			'show_title' => false,
			'for_post_type' => 'job_listing',
		),
		'featured' => array(
			'label' => esc_html__( 'Featured', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_checkbox'),
			'for_post_type' => 'job_listing',
		),
		'urgent' => array(
			'label' => esc_html__( 'Urgent', 'workio' ),
			'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_checkbox'),
			'for_post_type' => 'job_listing',
		),
	));
}

function workio_filter_field_input_date_posted($instance, $args, $key, $field) {
	$name = 'filter-'.$key;
	$selected = !empty( $_GET[$name] ) ? $_GET[$name] : 'all';
	$options = WP_Job_Board_Abstract_Filter::date_posted_options();

	include WP_Job_Board_Template_Loader::locate( 'widgets/filter-fields/select' );
}

function workio_filter_field_job_salary($instance, $args, $key, $field) {
	$name = 'filter-'.$key;
	$selected = !empty( $_GET[$name] ) ? $_GET[$name] : '';

	$salary_min = WP_Job_Board_Query::get_min_max_meta_value(WP_JOB_BOARD_JOB_LISTING_PREFIX.'salary', 'job_listing');
	$salary_max = WP_Job_Board_Query::get_min_max_meta_value(WP_JOB_BOARD_JOB_LISTING_PREFIX.'max_salary', 'job_listing');
	if ( empty($salary_min) && empty($salary_max) ) {
		return;
	}
	$min = $max = 0;
	$min = $salary_min->min < $salary_max->min ? $salary_min->min : $salary_max->min;
	$max = $salary_min->max > $salary_max->max ? $salary_min->max : $salary_max->max;
	
	if ( $min >= $max ) {
		return;
	}
	include WP_Job_Board_Template_Loader::locate( 'widgets/filter-fields/salary_horizontal_range_slider' );
}


add_filter( 'workio_job_get_filter_fields', 'workio_add_filter_fields_job_listing' );
function workio_add_filter_fields_job_listing($fields) {

	$post_type = 'job_cfield';
	$prefix = WP_JOB_BOARD_JOB_CUSTOM_FIELD_PREFIX;
	
	$cfields = workio_generate_filter_fields($post_type, $prefix, 'job_listing');

	if ( $cfields ) {
		$fields = array_merge($fields, $cfields);
	}
	return $fields;
}

function workio_generate_filter_fields($post_type, $prefix, $for_post_type) {
	$custom_fields = WP_Job_Board_Post_Type_Job_Custom_Fields::get_custom_fields($post_type);
	$fields = array();
	foreach ($custom_fields as $post) {
		$field_type = get_post_meta( $post->ID, $prefix . 'field_type', true );
        $show_filter = get_post_meta( $post->ID, $prefix . 'show_filter', true );

        if ( $show_filter && in_array($field_type, array('text', 'select', 'radio', 'checkbox', 'multicheck', 'pw_multiselect')) ) {
        	$toggle = true;
        	if ( $field_type == 'checkbox' ) {
        		$toggle = false;
        	}
        	$callback = array( __CLASS__, 'filter_field_'.$field_type );
        	if ( in_array($field_type, array( 'select', 'radio', 'multicheck', 'pw_multiselect')) ) {
        		$callback = 'workio_filter_field_select';
        	}
        	$fields[$post->post_name] = array(
        		'label' => $post->post_title,
        		'post_type' => $post_type,
        		'for_post_type' => $for_post_type,
        		'prefix' => $prefix,
        		'toggle' => false,
        		'field_call_back' => $callback,
        		'show_title' => false,
        	);
        }
	}
	return $fields;
}

function workio_filter_field_select($instance, $args, $key, $field) {
	$options = WP_Job_Board_Post_Type_Job_Custom_Fields::get_options_by_name($key, $field);
    $name = 'filter-custom-'.$key;
    $selected = ! empty( $_GET[$name] ) ? $_GET[$name] : '';
	
	if ( $options ) {
		foreach ($options as $key => $option) {
			$options[$key]['count'] = WP_Job_Board_Abstract_Filter::filter_count($name, $option['value'], $field);
		}
	}
	
	include WP_Job_Board_Template_Loader::locate( 'widgets/filter-fields/select' );
}

// post per page
add_filter('wp-job-board-job_listing-filter-query', 'workio_job_filter_query', 10, 2);
function workio_job_filter_query( $query, $params) {
	$query_vars = &$query->query_vars;
	$query_vars['posts_per_page'] = workio_job_get_limit_number();
	$query->query_vars = $query_vars;
	
	return $query;
}

add_filter( 'wp-job-board-job_listing-query-args', 'workio_job_filter_query_args', 10, 2 );
function workio_job_filter_query_args($query_args, $params) {
	$query_args['posts_per_page'] = workio_job_get_limit_number();
	return $query_args;
}

function workio_job_get_limit_number() {
	if ( isset( $_REQUEST['jobs_ppp'] ) ) {
        $number = intval( $_REQUEST['jobs_ppp'] );
    } elseif ( !empty($_COOKIE['jobs_per_page']) ) {
        $number = intval( $_COOKIE['jobs_per_page'] );
    } else {
        $value = wp_job_board_get_option('number_jobs_per_page', 10);
        $number = intval( $value );
    }
    return $number;
}

add_action('init', 'workio_job_save_ppp');
function workio_job_save_ppp() {
	if ( !empty( $_REQUEST['jobs_ppp'] ) ) {
        $number = intval( $_REQUEST['jobs_ppp'] );
        setcookie('jobs_per_page', $number, time() + 864000);
        $_COOKIE['jobs_per_page'] = $number;
    }
}

function workio_check_employer_candidate_review($post) {
	if ( (comments_open($post) || get_comments_number($post)) ) {
		if ( $post->post_type == 'employer' ) {
			if ( method_exists('WP_Job_Board_Employer', 'check_restrict_review') ) {
				if ( WP_Job_Board_Employer::check_restrict_review($post) ) {
					return true;
				} else {
					return false;
				}
			}
		} elseif ( $post->post_type == 'candidate' ) {
			if ( method_exists('WP_Job_Board_Candidate', 'check_restrict_review') ) {
				if ( WP_Job_Board_Candidate::check_restrict_review($post) ) {
					return true;
				} else {
					return false;
				}
			}
		}
		return true;
	}
	return false;
}

function workio_is_jobs_page() {
	if ( is_page() ) {
		$page_name = basename(get_page_template());
		if ( $page_name == 'page-jobs.php' ) {
			return true;
		}
	} elseif( is_post_type_archive('job_listing') || is_tax('job_listing_category') || is_tax('job_listing_type') || is_tax('job_listing_location') || is_tax('job_listing_tag') ) {
		return true;
	}
	return false;
}


add_filter('wp_job_board_settings_general', 'workio_jobs_settings_general', 10);
function workio_jobs_settings_general($fields) {
	$rfields = array();
	foreach ($fields as $key => $field) {
		$rfields[] = $field;
		if ( $field['id'] == 'default_maps_location_longitude' ) {
			$rfields[] = array(
				'name'    => esc_html__( 'Map Pin', 'workio' ),
				'desc'    => esc_html__( 'Enter your map pin', 'workio' ),
				'id'      => 'default_maps_pin',
				'type'    => 'file',
				'options' => array(
					'url' => true,
				),
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
	return $rfields;
}

function workio_placeholder_img_src( $size = 'thumbnail' ) {
	$src               = get_template_directory_uri() . '/images/placeholder.png';
	$placeholder_image = workio_get_config('job_placeholder_image');
	if ( !empty($placeholder_image['id']) ) {
        if ( is_numeric( $placeholder_image['id'] ) ) {
			$image = wp_get_attachment_image_src( $placeholder_image['id'], $size );

			if ( ! empty( $image[0] ) ) {
				$src = $image[0];
			}
		} else {
			$src = $placeholder_image;
		}
    }

	return apply_filters( 'workio_job_placeholder_img_src', $src );
}


// add_filter( 'wp_job_board_submit_job_form_submit_button_text', 'workio_job_form_submit_button_text' );
// function workio_job_form_submit_button_text($submit_button_text) {
// 	return esc_html__( 'Save', 'workio' );
// }

// add_filter( 'wp_job_board_submit_job_steps', 'workio_submit_job_steps', 10, 1 );
// function workio_submit_job_steps($steps) {
// 	if ( !empty($steps['preview']) ) {
// 		unset($steps['preview']);
// 	}
// 	return $steps;
// }

function workio_locations_walk( $terms, $id_parent, &$dropdown ) {
    foreach ( $terms as $key => $term ) {
        if ( $term->parent == $id_parent ) {
            $dropdown = array_merge( $dropdown, array( $term ) );
            unset($terms[$key]);
            workio_locations_walk( $terms, $term->term_id,  $dropdown );
        }
    }
}

// autocomplete search jobs
add_action( 'wp_ajax_workio_autocomplete_search_jobs', 'workio_autocomplete_suggestions_jobs' );
add_action( 'wp_ajax_nopriv_workio_autocomplete_search_jobs', 'workio_autocomplete_suggestions_jobs' );

function workio_autocomplete_suggestions_jobs() {
    // Query for suggestions
    $suggestions = array();
    $args = array(
		'post_type' => 'job_listing',
		'posts_per_page' => 10,
		'fields' => 'ids'
	);
    $filter_params = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;
	$jobs = WP_Job_Board_Query::get_posts( $args, $filter_params );

	if ( !empty($jobs->posts) ) {
		foreach ($jobs->posts as $post_id) {
			$author_id = get_post_field('post_author', $post_id);
			$employer_id = WP_Job_Board_User::get_employer_by_user_id($author_id);
			$suggestion['title'] = get_the_title($post_id);
			$suggestion['url'] = get_permalink($post_id);

			if ( has_post_thumbnail( $employer_id ) ) {
	            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $employer_id ), 'thumbnail' );
	            $suggestion['image'] = $image[0];
	        } else {
	            $suggestion['image'] = workio_placeholder_img_src();
	        }
	        $suggestion['location'] = '';

	        $locations = get_the_terms( $post_id, 'job_listing_location' );
	        if ( $locations ) {
                $terms = array();
                workio_locations_walk($locations, 0, $terms);
                if ( !empty($terms[0]) ) {
                	$suggestion['location'] = $terms[0]->name;
                }
            }

        	$suggestions[] = $suggestion;
		}
		wp_reset_postdata();
	}

    echo json_encode( $suggestions );
 
    exit;
}

// autocomplete search candidates
add_action( 'wp_ajax_workio_autocomplete_search_candidates', 'workio_autocomplete_suggestions_candidates' );
add_action( 'wp_ajax_nopriv_workio_autocomplete_search_candidates', 'workio_autocomplete_suggestions_candidates' );

function workio_autocomplete_suggestions_candidates() {
    // Query for suggestions
    $suggestions = array();
    $args = array(
		'post_type' => 'candidate',
		'posts_per_page' => 10,
		'fields' => 'ids'
	);
    $filter_params = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;
	$candidates = WP_Job_Board_Query::get_posts( $args, $filter_params );

	if ( !empty($candidates->posts) ) {
		foreach ($candidates->posts as $post_id) {
			$suggestion['title'] = get_the_title($post_id);
			$suggestion['url'] = get_permalink($post_id);

			if ( has_post_thumbnail( $post_id ) ) {
	            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
	            $suggestion['image'] = $image[0];
	        } else {
	            $suggestion['image'] = workio_placeholder_img_src();
	        }
	        $suggestion['location'] = '';

	        $locations = get_the_terms( $post_id, 'candidate_location' );
	        if ( $locations ) {
                $terms = array();
                workio_locations_walk($locations, 0, $terms);
                if ( !empty($terms[0]) ) {
                	$suggestion['location'] = $terms[0]->name;
                }
            }

        	$suggestions[] = $suggestion;
		}
		wp_reset_postdata();
	}

    echo json_encode( $suggestions );
 
    exit;
}



// custom fields
add_filter( 'cmb2_meta_boxes', 'workio_jobs_more_fields', 100 );
function workio_jobs_more_fields( array $metaboxes ) {
	$prefix = WP_JOB_BOARD_JOB_LISTING_PREFIX;
	if ( !empty($metaboxes[ $prefix . 'general' ]['fields']) ) {
		$fields = $metaboxes[ $prefix . 'general' ]['fields'];
		
		$fields[] = array(
			'name'              => esc_html__( 'Photos', 'workio' ),
			'id'                => $prefix . 'photos',
			'type'              => 'file_list',
			'query_args' => array( 'type' => 'image' ), // Only images attachment
			'text' => array(
				'add_upload_files_text' => esc_html__( 'Add or Upload Images', 'workio' ),
			),
		);

		$fields[] = array(
			'name'              => esc_html__( 'Video URL', 'workio' ),
			'id'                => $prefix . 'video_url',
			'type'              => 'text',
		);
		$metaboxes[ $prefix . 'general' ]['fields'] = $fields;
	}
	return $metaboxes;
}

add_filter('wp-job-board-job_listing-fields-front', 'workio_jobs_fields_front', 10);
function workio_jobs_fields_front($fields) {
	$prefix = WP_JOB_BOARD_JOB_LISTING_PREFIX;

	$fields[] = array(
		'name'              => esc_html__( 'Photos', 'workio' ),
		'id'                => $prefix . 'portfolio_photos',
		'type'              => 'wp_job_board_file',
		'ajax'				=> true,
		'file_multiple'		=> true,
		'mime_types' => array( 'gif', 'jpeg', 'jpg', 'png' ),
		'priority'           => 4.5,
	);

	$fields[] = array(
		'name'              => esc_html__( 'Video URL', 'workio' ),
		'id'                => $prefix . 'video_url',
		'type'              => 'text',
		'priority'          => 43,
	);

	return $fields;
}

add_filter( 'wp-job-board-get-salary-type-html', 'workio_jobs_salary_type_html', 10, 3 );
function workio_jobs_salary_type_html($salary_type_html, $salary_type, $post_id) {
	switch ($salary_type) {
		case 'yearly':
			$salary_type_html = esc_html__(' / year', 'workio');
			break;
		case 'monthly':
			$salary_type_html = esc_html__(' / month', 'workio');
			break;
		case 'weekly':
			$salary_type_html = esc_html__(' / week', 'workio');
			break;
		case 'hourly':
			$salary_type_html = esc_html__(' / hour', 'workio');
			break;
	}
	return $salary_type_html;
}


// demo function
function workio_check_demo_account() {
	if ( defined('WORKIO_DEMO_MODE') && WORKIO_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$return = array( 'status' => false, 'msg' => esc_html__('Demo users are not allowed to modify information.', 'workio') );
		   	echo wp_json_encode($return);
		   	exit;
		}
	}
}
add_action('wp-job-board-process-apply-email', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-apply-internal', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-remove-applied', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-add-job-shortlist', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-remove-job-shortlist', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-follow-employer', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-unfollow-employer', 'workio_check_demo_account', 10);

add_action('wp-job-board-process-add-candidate-shortlist', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-remove-candidate-shortlist', 'workio_check_demo_account', 10);

add_action('wp-job-board-process-forgot-password', 'workio_check_demo_account', 10);
add_action('wp-job-board-process-change-password', 'workio_check_demo_account', 10);
add_action('wp-job-board-before-delete-profile', 'workio_check_demo_account', 10);
add_action('wp-job-board-before-remove-job-alert', 'workio_check_demo_account', 10 );

function workio_check_demo_account2($error) {
	if ( defined('WORKIO_DEMO_MODE') && WORKIO_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$error[] = esc_html__('Demo users are not allowed to modify information.', 'workio');
		}
	}
	return $error;
}
add_filter('wp-job-board-submission-validate', 'workio_check_demo_account2', 10, 2);
add_filter('wp-job-board-edit-validate', 'workio_check_demo_account2', 10, 2);

function workio_check_demo_account3($post_id, $prefix) {
	if ( defined('WORKIO_DEMO_MODE') && WORKIO_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$_SESSION['messages'][] = array( 'danger', esc_html__('Demo users are not allowed to modify information.', 'workio') );
			$redirect_url = get_permalink( wp_job_board_get_option('edit_profile_page_id') );
			WP_Job_Board_Mixes::redirect( $redirect_url );
			exit();
		}
	}
}
add_action('wp-job-board-process-profile-before-change', 'workio_check_demo_account3', 10, 2);

function workio_check_demo_account5($post_id, $prefix) {
	if ( defined('WORKIO_DEMO_MODE') && WORKIO_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$_SESSION['messages'][] = array( 'danger', esc_html__('Demo users are not allowed to modify information.', 'workio') );
			$redirect_url = get_permalink( wp_job_board_get_option('my_resume_page_id') );
			WP_Job_Board_Mixes::redirect( $redirect_url );
			exit();
		}
	}
}
add_action('wp-job-board-process-resume-before-change', 'workio_check_demo_account5', 10, 2);

function workio_check_demo_account4() {
	if ( defined('WORKIO_DEMO_MODE') && WORKIO_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$return['msg'] = esc_html__('Demo users are not allowed to modify information.', 'workio');
			$return['status'] = false;
			echo json_encode($return); exit;
		}
	}
}
add_action('wp-private-message-before-reply-message', 'workio_check_demo_account4');
add_action('wp-private-message-before-add-message', 'workio_check_demo_account4');
add_action('wp-private-message-before-delete-message', 'workio_check_demo_account4');