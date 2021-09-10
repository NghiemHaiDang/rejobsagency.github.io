<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Job_Board_Category_Banner extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_job_board_category_banner';
    }

	public function get_title() {
        return esc_html__( 'Apus Category Banner', 'workio' );
    }
    
	public function get_categories() {
        return [ 'workio-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Category Banner', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slug',
            [
                'label' => esc_html__( 'Category Slug', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your Category Slug here', 'workio' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'workio' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'workio' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Category Icon', 'workio' ),
                'type' => Elementor\Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'show_nb_jobs',
            [
                'label' => esc_html__( 'Show Number Jobs', 'workio' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'workio' ),
                'label_off' => esc_html__( 'Show', 'workio' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'workio'),
                    'style2' => esc_html__('Style 2', 'workio'),
                ),
                'default' => 'style1'
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
            'section_icon_style',
            [
                'label' => esc_html__( 'Settings', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .category-banner-inner',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'workio' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .category-banner-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .category-banner-inner',
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => esc_html__( 'Icon Font Size', 'workio' ),                
                'type' => Elementor\Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .category-banner-inner .category-icon i, .category-banner-inner.style2 .icon-top i:before' => 'font-size: {{VALUE}}px;',  
                ],
            ]
        );

        $this->add_responsive_control(
            'background_image_size',
            [
                'label' => esc_html__( 'Image Size', 'workio' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .category-banner-inner .category-banner-image .image-wrapper' => 'width: {{VALUE}}px;height: {{VALUE}}px;',                     
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'workio' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'workio' ),
                        'icon' => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'workio' ),
                        'icon' => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'workio' ),
                        'icon' => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'workio' ),
                        'icon' => 'fas fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .category-banner-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_color',
            [
                'label' => esc_html__( 'Color', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-banner-inner .category-icon' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Heading Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-banner-inner .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_job_color',
            [
                'label' => esc_html__( 'Number Job Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-banner-inner .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color',
            [                
                'label' => esc_html__( 'Background', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-banner-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Typography', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'workio' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .category-banner-inner .title',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Number Job Typography', 'workio' ),
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .category-banner-inner .number',
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( empty($slug) ) {
            return;
        }
        ?>
        <div class="widget-job-category-banner <?php echo esc_attr($el_class.' '.$alignment); ?>">
            
            <?php
            $term = get_term_by( 'slug', $slug, 'job_listing_category' );
            if ($term) {
            ?>
                <a href="<?php echo esc_url(get_term_link( $term, 'job_listing_category' )); ?>">
                    <div class="category-banner-inner <?php echo esc_attr($style); ?>">
                        <?php if ( !empty($icon) ) { ?>
                            <div class="icon-top"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                        <?php } ?>
                        <div class="inner">
                            <?php if ( $style == 'style2' ) { ?>
                                <?php if ( !empty($image['id']) ) { ?>
                                    <div class="category-banner-image">
                                         <?php echo workio_get_attachment_thumbnail($image['id'], 'full'); ?>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if ( !empty($icon) ) { ?>
                                    <div class="category-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                                <?php } ?>
                            <?php } ?>

                            <?php if ( !empty($title) ) { ?>
                                <h4 class="title">
                                    <?php echo trim($title); ?>
                                </h4>
                            <?php } ?>

                            
                        </div>
                        <?php if ( $show_nb_jobs ) {
                                $args = array(
                                    'fields' => 'ids',
                                    'categories' => array($term->slug),
                                    'limit' => 1
                                );
                                $query = workio_get_jobs($args);
                                $number_jobs = $count = $query->found_posts;
                                $number_jobs = $number_jobs ? WP_Job_Board_Mixes::format_number($number_jobs) : 0;
                        ?>
                        <div class="number"><?php echo sprintf(_n('<span>%d</span> Open Position', '<span>%d</span> Open Positions', $count, 'workio'), $number_jobs); ?></div>
                        <?php } ?>
                    </div>
                </a>
            <?php } ?>
        </div>
        <?php
    }
}
Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Job_Board_Category_Banner );