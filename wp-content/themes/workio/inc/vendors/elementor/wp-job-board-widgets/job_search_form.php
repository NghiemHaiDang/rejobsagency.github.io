<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Job_Board_Job_Search_Form extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_job_board_job_search_form';
    }

	public function get_title() {
        return esc_html__( 'Apus Jobs Search Form', 'workio' );
    }
    
	public function get_categories() {
        return [ 'workio-elements' ];
    }

    public function get_form_fields() {
        
        return array(
            'title' => array(
                'label' => esc_html__( 'Search Keywords', 'workio' ),
                'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input'),
                'placeholder' => esc_html__( 'e.g. web design', 'workio' ),
                'for_post_type' => 'job_listing',
            ),
            'category' => array(
                'label' => esc_html__( 'Category', 'workio' ),
                'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
                'taxonomy' => 'job_listing_category',
                'toggle' => true,
                'for_post_type' => 'job_listing',
                'placeholder' => esc_html__( 'All Categories', 'workio' ),
            ),
            'center-location' => array(
                'label' => esc_html__( 'Location', 'workio' ),
                'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_input_location'),
                'placeholder' => esc_html__( 'All Location', 'workio' ),
                'show_distance' => true,
                'toggle' => true,
                'for_post_type' => 'job_listing',
            ),
            'location' => array(
                'label' => esc_html__( 'Location list', 'workio' ),
                'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
                'taxonomy' => 'job_listing_location',
                'placeholder' => esc_html__( 'All Locations', 'workio' ),
                'toggle' => true,
                'for_post_type' => 'job_listing',
            ),
            'type' => array(
                'label' => esc_html__( 'Job Type', 'workio' ),
                'field_call_back' => array( 'WP_Job_Board_Mixes', 'filter_field_taxonomy_hierarchical_select'),
                'taxonomy' => 'job_listing_type',
                'placeholder' => esc_html__( 'All Types', 'workio' ),
                'toggle' => true,
                'for_post_type' => 'job_listing',
            ),
        );
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Search Form', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $fields = $this->get_form_fields();
        $search_fields = array( '' => esc_html__('Choose a field', 'workio') );
        foreach ($fields as $key => $field) {
            $search_fields[$key] = $field['label'];
        }

        $repeater = new Elementor\Repeater();

        $repeater->add_control(
            'filter_field',
            [
                'label' => esc_html__( 'Filter field', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $search_fields
            ]
        );

        $repeater->add_control(
            'placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
            ]
        );

        $repeater->add_control(
            'enable_autocompleate_search',
            [
                'label' => esc_html__( 'Enable autocompleate search', 'workio' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Disbale', 'workio' ),
                'label_off' => esc_html__( 'Enable', 'workio' ),
                'condition' => [
                    'filter_field' => 'title',
                ],
            ]
        );

        $columns = array();
        for ($i=1; $i <= 12 ; $i++) { 
            $columns[$i] = sprintf(esc_html__('%d Columns', 'workio'), $i);
        }
        $repeater->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'default' => 1
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'workio' ),
                'type' => Elementor\Controls_Manager::ICON
            ]
        );
        
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'workio' ),
            ]
        );

        $this->add_control(
            'main_search_fields',
            [
                'label' => esc_html__( 'Main Search Fields', 'workio' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'filter_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Find Jobs',
            ]
        );

        $this->add_control(
            'btn_columns',
            [
                'label' => esc_html__( 'Button Columns', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'default' => 1
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'workio'),                    
                    'no-label' => esc_html__('Overlay - No label', 'workio'),                    
                    'basic' => esc_html__('Basic - No label', 'workio'),                    
                ),
                'default' => 'no-label'
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'workio' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'workio' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Settings', 'workio' ),
                'tab' =>Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .form-group-inner input[type="text"], .form-group-inner .form-control',
            ]
        );

        $this->add_responsive_control(
            'button_radius',            
            [
                'label' => esc_html__( 'Button Rounded Corner', 'workio' ),                 
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .search-form-inner .btn-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );

        $this->add_responsive_control(
            'input_radius',            
            [
                'label' => esc_html__( 'Input Rounded Corner', 'workio' ),                 
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-job-search-form .search-form-inner .form-control,{{WRAPPER}} .widget-job-search-form.basic .search-form-inner .form-group-inner,{{WRAPPER}} .widget-job-search-form .search-form-inner .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                   
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_color',
            [
                'label' => esc_html__( 'Color', 'workio' ),
                'tab' =>Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => esc_html__( 'Color Input', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-job-search-form .action-location .find-me' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form input[type="text"]' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form .form-control' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form textarea' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .widget-job-search-form .select2-container--default.select2-container .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .widget-job-search-form .search-form-inner .select2-container--default .select2-selection--single .select2-selection__placeholder' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form input[type="text"]::-webkit-input-placeholder' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form input[type="text"]::-moz-placeholder' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form input[type="text"]:-ms-input-placeholder' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form input[type="text"]:-moz-placeholder' => 'color: {{VALUE}};',     
                    '{{WRAPPER}} .widget-job-search-form .search-form-inner .form-group-inner' => 'color: {{VALUE}};',                         
                    '{{WRAPPER}} .widget-job-search-form .search-form-inner .form-group-inner i:before' => 'color: {{VALUE}};',     
                ],
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color Input', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .search-form-inner .form-control, {{WRAPPER}} .search-form-inner .select2-container--default .select2-selection--single ' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .action-location .clear-location' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .select2-container--default.select2-container .select2-selection--single .select2-selection__clear' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .action-location .find-me' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .widget-job-search-form.basic .search-form-inner .form-group-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_button_color',
            [
                'label' => esc_html__( 'Background Button Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .form-search .btn-submit' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bg_button_hv_color',
            [
                'label' => esc_html__( 'Background Button Hover Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .form-search .btn-submit:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .form-search .btn-submit:focus' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Label Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                                        
                    '{{WRAPPER}} .search-form-inner .form-group .heading-label' => 'color: {{VALUE}};',       
                    '{{WRAPPER}} .form-group-inner .search-distance-label' => 'color: {{VALUE}};',       
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $filter_fields = $this->get_form_fields();
        $widget_id = workio_random_key();
        $instance = array();
        $args = array( 'widget_id' => $widget_id );
        $search_page_url = WP_Job_Board_Mixes::get_jobs_page_url();

        wp_enqueue_script('select2');
        wp_enqueue_style('select2');
        ?>
        <div class="widget-job-search-form <?php echo esc_attr($el_class.' '.$style); ?>">
            <?php if ( !empty($title) ) { ?>
                <h1 class="title">
                    <?php echo esc_html($title); ?>
                </h1>
            <?php } ?>
            <form action="<?php echo esc_url($search_page_url); ?>" class="form-search" method="GET">
                <div class="search-form-inner">
                    <div class="row">
                        <?php $i = 1;
                        if ( !empty($main_search_fields) ) {
                            foreach ($main_search_fields as $item) {
                                if ( empty($filter_fields[$item['filter_field']]['field_call_back']) ) {
                                    continue;
                                }
                                $columns = !empty($item['columns']) ? $item['columns'] : '1';
                                $filter_field = $filter_fields[$item['filter_field']];

                                if ( $item['filter_field'] == 'title' ) {
                                    if ($item['enable_autocompleate_search']) {
                                        wp_enqueue_script( 'handlebars', get_template_directory_uri() . '/js/handlebars.min.js', array(), null, true);
                                        wp_enqueue_script( 'typeahead-jquery', get_template_directory_uri() . '/js/typeahead.bundle.min.js', array('jquery', 'handlebars'), null, true);
                                        $filter_field['add_class'] = 'apus-autocompleate-input';
                                    }
                                }
                                if ( isset($item['placeholder']) ) {
                                    $filter_field['placeholder'] = $item['placeholder'];
                                }
                                if ( !empty($item['icon']) ) {
                                    $filter_field['icon'] = $item['icon'];
                                }
                                $filter_field['show_title'] = false;
                                ?>
                                <div class="list-field col-xs-12 col-md-<?php echo esc_attr($columns); ?> <?php echo esc_attr( ($i == count($main_search_fields))?'last':'' ); ?>">
                                    <?php call_user_func( $filter_field['field_call_back'], $instance, $args, $item['filter_field'], $filter_field ); ?>
                                </div>
                                <?php $i++;
                            }
                        }
                        ?>
                        <div class="col-xs-12 col-md-<?php echo esc_attr($btn_columns); ?>">
                            <div class="form-group form-group-search">
                                <button class="btn-submit btn btn-block btn-theme-second" type="submit">
                                    <?php echo trim($filter_btn_text); ?>
                                </button>
                            </div>                            
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Job_Board_Job_Search_Form );