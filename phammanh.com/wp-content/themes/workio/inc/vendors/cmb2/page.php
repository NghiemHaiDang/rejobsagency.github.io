<?php

if ( !function_exists( 'workio_page_metaboxes' ) ) {
	function workio_page_metaboxes(array $metaboxes) {
		global $wp_registered_sidebars;
        $sidebars = array();

        if ( !empty($wp_registered_sidebars) ) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'workio' )), workio_get_header_layouts() );
        $footers = array_merge( array('global' => esc_html__( 'Global Setting', 'workio' )), workio_get_footer_layouts() );

		$prefix = 'apus_page_';

        $columns = array(
            '' => esc_html__( 'Global Setting', 'workio' ),
            '1' => esc_html__('1 Column', 'workio'),
            '2' => esc_html__('2 Columns', 'workio'),
            '3' => esc_html__('3 Columns', 'workio'),
            '4' => esc_html__('4 Columns', 'workio'),
            '6' => esc_html__('6 Columns', 'workio')
        );
        // Jobs Page
        $fields = array(
            array(
                'name' => esc_html__( 'Jobs Layout', 'workio' ),
                'id'   => $prefix.'layout_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'main' => esc_html__('Main Content', 'workio'),
                    'left-main' => esc_html__('Left Sidebar - Main Content', 'workio'),
                    'main-right' => esc_html__('Main Content - Right Sidebar', 'workio'),
                    'half-map' => esc_html__('Half Map', 'workio'),
                    'top-map' => esc_html__('Top Map', 'workio'),
                )
            ),
            array(
                'id' => $prefix.'display_mode',
                'type' => 'select',
                'name' => esc_html__('Default Display Mode', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'grid' => esc_html__('Grid', 'workio'),
                    'list' => esc_html__('List', 'workio'),
                )
            ),
            array(
                'id' => $prefix.'inner_style',
                'type' => 'select',
                'name' => esc_html__('Jobs grid style', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'grid' => esc_html__('Grid Default', 'workio'),
                    'grid-v1' => esc_html__('Grid V1', 'workio'),
                ),
            ),
            array(
                'id' => $prefix.'inner_list_style',
                'type' => 'select',
                'name' => esc_html__('Jobs list style', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'list' => esc_html__('List Default', 'workio'),
                    'list-v1' => esc_html__('List V1', 'workio'),
                ),
            ),
            array(
                'id' => $prefix.'jobs_columns',
                'type' => 'select',
                'name' => esc_html__('Grid Listing Columns', 'workio'),
                'options' => $columns,
            ),
            array(
                'id' => $prefix.'jobs_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'default' => esc_html__('Default', 'workio'),
                    'loadmore' => esc_html__('Load More Button', 'workio'),
                    'infinite' => esc_html__('Infinite Scrolling', 'workio'),
                ),
            ),
        );
        
        $metaboxes[$prefix . 'jobs_setting'] = array(
            'id'                        => $prefix . 'jobs_setting',
            'title'                     => esc_html__( 'Jobs Settings', 'workio' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );


        // Employers Page
        $fields = array(
            array(
                'id' => $prefix.'employers_display_mode',
                'type' => 'select',
                'name' => esc_html__('Employers display mode', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'grid' => esc_html__('Grid', 'workio'),
                    'list' => esc_html__('List', 'workio'),
                    'simple' => esc_html__('Simple', 'workio'),
                )
            ),
            array(
                'id' => $prefix.'employers_columns',
                'type' => 'select',
                'name' => esc_html__('Employer Columns', 'workio'),
                'options' => $columns,
                'description' => esc_html__('Apply for display mode is grid and simple.', 'workio'),
            ),
            array(
                'id' => $prefix.'employers_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'default' => esc_html__('Default', 'workio'),
                    'loadmore' => esc_html__('Load More Button', 'workio'),
                    'infinite' => esc_html__('Infinite Scrolling', 'workio'),
                ),
            ),
        );
        $metaboxes[$prefix . 'employers_setting'] = array(
            'id'                        => $prefix . 'employers_setting',
            'title'                     => esc_html__( 'Employers Settings', 'workio' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );

        // Candidates Page
        $fields = array(
            array(
                'name' => esc_html__( 'Candidates Layout', 'workio' ),
                'id'   => $prefix.'candidates_layout_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'main' => esc_html__('Main Content', 'workio'),
                    'left-main' => esc_html__('Left Sidebar - Main Content', 'workio'),
                    'main-right' => esc_html__('Main Content - Right Sidebar', 'workio'),
                    'half-map' => esc_html__('Half Map', 'workio'),
                    'top-map' => esc_html__('Top Map', 'workio'),
                )
            ),
            array(
                'id' => $prefix.'candidates_display_mode',
                'type' => 'select',
                'name' => esc_html__('Candidates display mode', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'grid' => esc_html__('Grid', 'workio'),
                    'list' => esc_html__('List', 'workio'),
                )
            ),
            array(
                'id' => $prefix.'candidates_columns',
                'type' => 'select',
                'name' => esc_html__('Candidate Columns', 'workio'),
                'options' => $columns,
                'description' => esc_html__('Apply for display mode is grid.', 'workio'),
            ),
            array(
                'id' => $prefix.'candidates_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'workio'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'workio' ),
                    'default' => esc_html__('Default', 'workio'),
                    'loadmore' => esc_html__('Load More Button', 'workio'),
                    'infinite' => esc_html__('Infinite Scrolling', 'workio'),
                ),
            ),
        );
        $metaboxes[$prefix . 'candidates_setting'] = array(
            'id'                        => $prefix . 'candidates_setting',
            'title'                     => esc_html__( 'Candidates Settings', 'workio' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );

        // General
	    $fields = array(
			array(
				'name' => esc_html__( 'Select Layout', 'workio' ),
				'id'   => $prefix.'layout',
				'type' => 'select',
				'options' => array(
					'main' => esc_html__('Main Content Only', 'workio'),
					'left-main' => esc_html__('Left Sidebar - Main Content', 'workio'),
					'main-right' => esc_html__('Main Content - Right Sidebar', 'workio')
				)
			),
			array(
                'id' => $prefix.'fullwidth',
                'type' => 'select',
                'name' => esc_html__('Is Full Width?', 'workio'),
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'workio'),
                    'yes' => esc_html__('Yes', 'workio')
                )
            ),
            array(
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'workio'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'workio'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'show_breadcrumb',
                'type' => 'select',
                'name' => esc_html__('Show Breadcrumb?', 'workio'),
                'options' => array(
                    'no' => esc_html__('No', 'workio'),
                    'yes' => esc_html__('Yes', 'workio')
                ),
                'default' => 'yes',
            ),
            array(
                'id' => $prefix.'breadcrumb_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Background Color', 'workio')
            ),
            array(
                'id' => $prefix.'breadcrumb_image',
                'type' => 'file',
                'name' => esc_html__('Breadcrumb Background Image', 'workio')
            ),
            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'workio'),
                'description' => esc_html__('Choose a header for your website.', 'workio'),
                'options' => $headers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'header_transparent',
                'type' => 'select',
                'name' => esc_html__('Header Transparent', 'workio'),
                'description' => esc_html__('Choose a header for your website.', 'workio'),
                'options' => array(
                    'no' => esc_html__('No', 'workio'),
                    'yes' => esc_html__('Yes', 'workio')
                ),
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'header_fixed',
                'type' => 'select',
                'name' => esc_html__('Header Fixed Top', 'workio'),
                'description' => esc_html__('Choose a header position', 'workio'),
                'options' => array(
                    'no' => esc_html__('No', 'workio'),
                    'yes' => esc_html__('Yes', 'workio')
                ),
                'default' => 'no'
            ),
            array(
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'workio'),
                'description' => esc_html__('Choose a footer for your website.', 'workio'),
                'options' => $footers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'workio'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'workio')
            )
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'workio' ),
			'object_types'              => array( 'page' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'workio_page_metaboxes' );

if ( !function_exists( 'workio_cmb2_style' ) ) {
	function workio_cmb2_style() {
        wp_enqueue_style( 'workio-cmb2-style', get_template_directory_uri() . '/inc/vendors/cmb2/assets/style.css', array(), '1.0' );
		wp_enqueue_script( 'workio-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), '20150330', true );
	}
}
add_action( 'admin_enqueue_scripts', 'workio_cmb2_style' );


