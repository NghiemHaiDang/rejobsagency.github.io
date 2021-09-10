<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Search_Form extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_search_form';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Search Form', 'workio' );
    }
    
	public function get_categories() {
        return [ 'workio-header-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => esc_html__( 'Search post type', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'post' => esc_html__('Posts', 'workio'),
                    'job_listing' => esc_html__('Jobs', 'workio'),
                    'candidate' => esc_html__('Candidate', 'workio'),
                    'employer' => esc_html__('Employer', 'workio'),
                ),
                'default' => 'job_listing',
            ]
        );
        $this->add_control(
            'ali',
            [
                'label' => esc_html__( 'Align Content Search', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'ali-left' => esc_html__('Left ', 'workio'),
                    'ali-right' => esc_html__('Right ', 'workio'),
                    'ali-center' => esc_html__('Center ', 'workio'),
                ),
                'default' => 'ali-left',
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
            'section_title_style',
            [
                'label' => esc_html__( 'Style', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );     

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'workio' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .apus-search-form .btn-search-icon' => 'font-size: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .apus-search-form .btn-search-icon' => 'color: {{VALUE}};',                    
                ],
            ]
        );

        $this->add_control(
            'input_bg',
            [
                'label' => esc_html__( 'Input Background', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .apus-search-form form .form-control' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label' => esc_html__( 'Input Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .apus-search-form form .form-control' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .apus-search-form form .form-control::placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .apus-search-form form .form-control::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .apus-search-form form .form-control::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .apus-search-form form .form-control:-ms-input-placeholder' => 'color: {{VALUE}};',                    
                    '{{WRAPPER}} .apus-search-form form .form-control:-moz-placeholder' => 'color: {{VALUE}};',   
                ],
            ]
        );

        $this->add_control(
            'input_border',
            [
                'label' => esc_html__( 'Input Border', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .apus-search-form form .form-control' => 'border-color: {{VALUE}};',
                ],
            ]
        );
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        ?>
        <div class="apus-search-form <?php echo esc_attr($el_class.' '.$ali); ?>">             
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">                    
                <div class="main-search">
                    <input type="text" placeholder="<?php esc_attr_e( 'find anything...', 'workio' ); ?>" name="s" class="apus-search form-control" autocomplete="off"/>
                </div>
                <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">                
                <button type="submit" class="btn btn-search-icon">
                    <i class="ti-search"></i>
                </button>
            </form>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Search_Form );