<?php

function workio_wp_job_board_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-pencil',
        'title' => esc_html__('Jobs Settings', 'workio'),
        'fields' => array(
            array(
                'id' => 'show_job_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'workio'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'workio'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'workio').'</em>',
                'id' => 'job_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'job_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'workio'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'workio'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Job Archives', 'workio'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'jobs_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'jobs_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'workio'),
                'default' => false
            ),
            array(
                'id' => 'jobs_layout_type',
                'type' => 'select',
                'title' => esc_html__('Jobs Layout', 'workio'),
                'subtitle' => esc_html__('Choose a default layout archive job.', 'workio'),
                'options' => array(
                    'main' => esc_html__('Main Content', 'workio'),
                    'left-main' => esc_html__('Left Sidebar - Main Content', 'workio'),
                    'main-right' => esc_html__('Main Content - Right Sidebar', 'workio'),
                    'half-map' => esc_html__('Half Map', 'workio'),
                    'top-map' => esc_html__('Top Map', 'workio'),
                ),
                'default' => 'main-right',
            ),
            array(
                'id' => 'jobs_display_mode',
                'type' => 'select',
                'title' => esc_html__('Jobs display mode', 'workio'),
                'subtitle' => esc_html__('Choose a default display mode for archive job.', 'workio'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'workio'),
                    'list' => esc_html__('List', 'workio'),
                ),
                'default' => 'list'
            ),
            array(
                'id' => 'jobs_inner_style',
                'type' => 'select',
                'title' => esc_html__('Jobs grid style', 'workio'),
                'subtitle' => esc_html__('Choose a job style.', 'workio'),
                'options' => array(
                    'grid' => esc_html__('Grid Default', 'workio'),
                    'grid-v1' => esc_html__('Grid V1', 'workio'),
                ),
                'default' => 'grid',
                'required' => array('jobs_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'jobs_inner_list_style',
                'type' => 'select',
                'title' => esc_html__('Jobs list style', 'workio'),
                'subtitle' => esc_html__('Choose a job style.', 'workio'),
                'options' => array(
                    'list' => esc_html__('List Default', 'workio'),
                    'list-v1' => esc_html__('List V1', 'workio'),
                ),
                'default' => 'list',
                'required' => array('jobs_display_mode', '=', array('list'))
            ),
            array(
                'id' => 'jobs_columns',
                'type' => 'select',
                'title' => esc_html__('Job Columns', 'workio'),
                'options' => $columns,
                'default' => 3,
                'required' => array('jobs_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'jobs_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'workio'),
                'options' => array(
                    'default' => esc_html__('Default', 'workio'),
                    'loadmore' => esc_html__('Load More Button', 'workio'),
                    'infinite' => esc_html__('Infinite Scrolling', 'workio'),
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'job_placeholder_image',
                'type' => 'media',
                'title' => esc_html__('Placeholder Image', 'workio'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your placeholder.', 'workio'),
            ),
        )
    );
    
    
    // Job Page
    $sections[] = array(
        'title' => esc_html__('Single Job', 'workio'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'job_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'job_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'workio'),
                'default' => false
            ),
            array(
                'id' => 'show_job_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'workio'),
                'default' => 1
            ),
            array(
                'id' => 'job_block_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Job Block Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'job_releated_show',
                'type' => 'switch',
                'title' => esc_html__('Show Jobs Releated', 'workio'),
                'default' => 1
            ),
            array(
                'id' => 'job_releated_number',
                'title' => esc_html__('Number of related jobs to show', 'workio'),
                'default' => 2,
                'min' => '1',
                'step' => '1',
                'max' => '50',
                'type' => 'slider',
                'required' => array('job_releated_show', '=', true)
            ),
            array(
                'id' => 'job_releated_columns',
                'type' => 'select',
                'title' => esc_html__('Releated Jobs Columns', 'workio'),
                'options' => $columns,
                'default' => 2,
                'required' => array('job_releated_show', '=', true)
            ),
        )
    );
	
    return $sections;
}
add_filter( 'workio_redux_framwork_configs', 'workio_wp_job_board_redux_config', 10, 3 );


// employers
function workio_wp_job_board_employer_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-pencil',
        'title' => esc_html__('Employer Settings', 'workio'),
        'fields' => array(
            array(
                'id' => 'show_employer_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'workio'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'workio'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'workio').'</em>',
                'id' => 'employer_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'employer_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'workio'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'workio'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Employer Archives', 'workio'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'employers_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'employers_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'workio'),
                'default' => false
            ),
            
            array(
                'id' => 'employers_display_mode',
                'type' => 'select',
                'title' => esc_html__('Employers display mode', 'workio'),
                'subtitle' => esc_html__('Choose a default display mode for archive employer.', 'workio'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'workio'),
                    'list' => esc_html__('List', 'workio'),
                    'simple' => esc_html__('Simple', 'workio'),
                ),
                'default' => 'list'
            ),
            array(
                'id' => 'employers_columns',
                'type' => 'select',
                'title' => esc_html__('Employer Columns', 'workio'),
                'options' => $columns,
                'default' => 4,
                'required' => array('employers_display_mode', '=', array('grid', 'simple'))
            ),
            array(
                'id' => 'employers_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'workio'),
                'options' => array(
                    'default' => esc_html__('Default', 'workio'),
                    'loadmore' => esc_html__('Load More Button', 'workio'),
                    'infinite' => esc_html__('Infinite Scrolling', 'workio'),
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'employers_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'employers_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Product Layout', 'workio'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive employers page.', 'workio'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'workio'),
                        'alt' => esc_html__('Main Content', 'workio'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'workio'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'workio'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'workio'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'workio'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
        )
    );
    
    
    // Employer Page
    $sections[] = array(
        'title' => esc_html__('Single Employer', 'workio'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'employer_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'employer_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'workio'),
                'default' => false
            ),
            array(
                'id' => 'show_employer_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'workio'),
                'default' => 1
            )
        )
    );
    
    return $sections;
}
add_filter( 'workio_redux_framwork_configs', 'workio_wp_job_board_employer_redux_config', 10, 3 );


// candidates
function workio_wp_job_board_candidate_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-pencil',
        'title' => esc_html__('Candidate Settings', 'workio'),
        'fields' => array(
            array(
                'id' => 'show_candidate_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'workio'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'workio'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'workio').'</em>',
                'id' => 'candidate_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'candidate_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'workio'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'workio'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Candidate Archives', 'workio'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'candidates_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'candidates_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'workio'),
                'default' => false
            ),
            array(
                'id' => 'candidates_layout_type',
                'type' => 'select',
                'title' => esc_html__('Candidates Layout', 'workio'),
                'subtitle' => esc_html__('Choose a default layout archive candidate.', 'workio'),
                'options' => array(
                    'main' => esc_html__('Main Content', 'workio'),
                    'left-main' => esc_html__('Left Sidebar - Main Content', 'workio'),
                    'main-right' => esc_html__('Main Content - Right Sidebar', 'workio'),
                    'half-map' => esc_html__('Half Map', 'workio'),
                    'top-map' => esc_html__('Top Map', 'workio'),
                ),
                'default' => 'main-right',
            ),
            array(
                'id' => 'candidates_display_mode',
                'type' => 'select',
                'title' => esc_html__('Candidates display mode', 'workio'),
                'subtitle' => esc_html__('Choose a default display mode for archive candidate.', 'workio'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'workio'),
                    'list' => esc_html__('List', 'workio'),
                ),
                'default' => 'list'
            ),
            array(
                'id' => 'candidates_columns',
                'type' => 'select',
                'title' => esc_html__('Candidate Columns', 'workio'),
                'options' => $columns,
                'default' => 4,
                'required' => array('candidates_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'candidates_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'workio'),
                'options' => array(
                    'default' => esc_html__('Default', 'workio'),
                    'loadmore' => esc_html__('Load More Button', 'workio'),
                    'infinite' => esc_html__('Infinite Scrolling', 'workio'),
                ),
                'default' => 'default'
            )
        )
    );
    
    
    // Candidate Page
    $sections[] = array(
        'title' => esc_html__('Single Candidate', 'workio'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'candidate_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'candidate_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'workio'),
                'default' => false
            ),
            array(
                'id' => 'show_candidate_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'workio'),
                'default' => 1
            ),
            array(
                'id' => 'candidate_block_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Candidate Block Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'candidate_releated_show',
                'type' => 'switch',
                'title' => esc_html__('Show Candidates Releated', 'workio'),
                'default' => 1
            ),
            array(
                'id' => 'candidate_releated_number',
                'title' => esc_html__('Number of related candidates to show', 'workio'),
                'default' => 4,
                'min' => '1',
                'step' => '1',
                'max' => '50',
                'type' => 'slider',
                'required' => array('candidate_releated_show', '=', true)
            ),
            array(
                'id' => 'candidate_releated_columns',
                'type' => 'select',
                'title' => esc_html__('Releated Candidates Columns', 'workio'),
                'options' => $columns,
                'default' => 3,
                'required' => array('candidate_releated_show', '=', true)
            ),
        )
    );
    
    // Register Form settings
    $sections[] = array(
        'title' => esc_html__('Register Form', 'workio'),
        'fields' => array(
            array(
                'id' => 'register_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'workio').'</h3>',
            ),
            array(
                'id' => 'register_form_enable_candidate',
                'type' => 'switch',
                'title' => esc_html__('Enable Register Candidate', 'workio'),
                'default' => true,
            ),
            array(
                'id' => 'register_form_enable_employer',
                'type' => 'switch',
                'title' => esc_html__('Enable Register Employer', 'workio'),
                'default' => true,
            ),
            array(
                'id' => 'register_form_enable_phone',
                'type' => 'switch',
                'title' => esc_html__('Enable Candidate phone', 'workio'),
                'default' => true,
            ),
            array(
                'id' => 'register_form_enable_candidate_category',
                'type' => 'switch',
                'title' => esc_html__('Enable Candidate Category', 'workio'),
                'default' => true,
                'required' => array('register_form_enable_candidate', '=', true)
            ),
            array(
                'id' => 'register_form_enable_employer_category',
                'type' => 'switch',
                'title' => esc_html__('Enable Employer Category', 'workio'),
                'default' => true,
                'required' => array('register_form_enable_employer', '=', true)
            ),
            array(
                'id' => 'register_form_enable_employer_company',
                'type' => 'switch',
                'title' => esc_html__('Enable Employer Company Name', 'workio'),
                'default' => true,
                'required' => array('register_form_enable_employer', '=', true)
            ),
        )
    );

    return $sections;
}
add_filter( 'workio_redux_framwork_configs', 'workio_wp_job_board_candidate_redux_config', 10, 3 );
