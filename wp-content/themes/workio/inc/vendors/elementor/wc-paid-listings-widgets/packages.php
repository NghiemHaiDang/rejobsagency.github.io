<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Jobs_Packages extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_jobs_packages';
    }

    public function get_title() {
        return esc_html__( 'Apus Packages', 'workio' );
    }
    
    public function get_categories() {
        return [ 'workio-elements' ];
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
            'package_type',
            [
                'label' => esc_html__( 'Packages Type', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'job_package' => esc_html__('Job Package', 'workio'),
                    'cv_package' => esc_html__('CV Package', 'workio'),
                    'contact_package' => esc_html__('Contact Package', 'workio'),
                    'candidate_package' => esc_html__('Candidate Package', 'workio'),
                    'resume_package' => esc_html__('Resume Package', 'workio'),
                ),
                'default' => 'job_package'
            ]
        );
        $this->add_control(
            'number',
            [
                'label' => esc_html__( 'Number Product', 'workio' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
                'description' => esc_html__( 'Number Product to display', 'workio' ),
                'default' => 3
            ]
        );
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'default' => 3,
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
            'section_package_style',
            [
                'label' => esc_html__( 'Setting', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .subwoo-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'box_br_color',
            [
                'label' => esc_html__( 'Border Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'box_hv_br_color',
            [
                'label' => esc_html__( 'Border Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .subwoo-inner.is_featured' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_package_color',
            [
                'label' => esc_html__( 'Color', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner .price' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'block_bg_color',
            [                
                'label' => esc_html__( 'Block Background', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_highlight_feature',            
            [
                'label' => esc_html__( 'Featured', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_br_color',
            [
                'label' => esc_html__( 'Box Border Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                                        
                    '{{WRAPPER}} .subwoo-inner.is_featured' => 'border-color: {{VALUE}};',                      
                ],
            ]
        );

        $this->add_control(
            'icon_ft_color',
            [
                'label' => esc_html__( 'Icon Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                                        
                    '{{WRAPPER}} .subwoo-inner.is_featured .icon-wrapper' => 'color: {{VALUE}} !important;',                      
                ],
            ]
        );

        $this->add_control(
            'icon_ft_br_color',
            [
                'label' => esc_html__( 'Icon Border Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                                        
                    '{{WRAPPER}} .subwoo-inner.is_featured .icon-wrapper' => 'border-color: {{VALUE}} !important;',                      
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_typography',
            [
                'label' => esc_html__( 'Typography', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Price', 'workio' ),
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .subwoo-inner .price',                
            ]
        );
        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title', 'workio' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .subwoo-inner .title',                
            ]
        );
        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description', 'workio' ),
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .subwoo-inner',                
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->start_controls_tabs(
            'style_tabs'
        );

            $this->start_controls_tab(
                'style_normal_tab',
                [
                    'label' => __( 'Normal', 'workio' ),
                ]
            );

            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Color', 'workio' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [                    
                        '{{WRAPPER}} .subwoo-inner .add-cart .button' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'button_border_color',
                [                
                    'label' => esc_html__( 'Border', 'workio' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [                    
                        '{{WRAPPER}} .subwoo-inner .add-cart .button' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'button_bg_color',
                [                
                    'label' => esc_html__( 'Background', 'workio' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [                    
                        '{{WRAPPER}} .subwoo-inner .add-cart .button' => 'background-color: {{VALUE}};',
                    ],
                ]
            );


            $this->end_controls_tab();

            $this->start_controls_tab(
                'style_hover_tab',
                [
                    'label' => __( 'Hover', 'workio' ),
                ]
            );

            $this->add_control(
                'hv_button_color',
                [
                    'label' => esc_html__( 'Color', 'workio' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [                    
                        '{{WRAPPER}} .subwoo-inner:hover .add-cart .button' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .subwoo-inner.is_featured .add-cart .button' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .subwoo-inner .add-cart .added_to_cart' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'hv_button_border_color',
                [                
                    'label' => esc_html__( 'Border', 'workio' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [                    
                        '{{WRAPPER}} .subwoo-inner:hover .add-cart .button' => 'border-color: {{VALUE}};',
                        '{{WRAPPER}} .subwoo-inner.is_featured .add-cart .button' => 'border-color: {{VALUE}};',
                        '{{WRAPPER}} .subwoo-inner .add-cart .added_to_cart' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'hv_button_bg_color',
                [                
                    'label' => esc_html__( 'Background', 'workio' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [                    
                        '{{WRAPPER}} .subwoo-inner:hover .add-cart .button' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .subwoo-inner.is_featured .add-cart .button' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .subwoo-inner .add-cart .added_to_cart' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner .icon-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner .icon-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bg',
            [                
                'label' => esc_html__( 'Background', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner .icon-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => esc_html__( 'Font Size', 'workio' ),                
                'type' => Elementor\Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner .icon-wrapper > *:before' => 'font-size: {{VALUE}}px;',                     
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Size', 'workio' ),                
                'type' => Elementor\Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .subwoo-inner .icon-wrapper' => 'width: {{VALUE}}px; height: {{VALUE}}px;',                     
                ],
            ]
        );
        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'workio' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .subwoo-inner .icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_border_size',
            [
                'label' => esc_html__( 'Border Size', 'workio' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .subwoo-inner .icon-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );       

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        $loop = workio_get_products( array('product_type' => $package_type, 'post_per_page' => $number));
        ?>
        <div class="woocommerce widget-subwoo <?php echo esc_attr($el_class); ?>">
            <?php if ($loop->have_posts()): ?>
                <div class="slick-carousel <?php echo esc_attr($columns < $loop->post_count?'':'hidden-dots'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="true" data-nav="false">

                    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                        <div class="item">
                            <div class="subwoo-inner <?php echo esc_attr($alignment); ?> <?php echo esc_attr($product->is_featured() ? 'is_featured' : ''); ?>">
                                <?php if($product->is_featured()){ ?>
                                    <div class="bookmark">
                                        <?php echo esc_html_e( 'featured', 'workio' ); ?>                                        
                                    </div>
                                <?php } ?>
                                <div class="item">
                                    <div class="header-sub">
                                        <div class="icon-wrapper">
                                            <?php
                                            $icon_class = get_post_meta($product->get_id(), '_jobs_icon_class', true);
                                            if ( $icon_class ) {
                                                ?>
                                                <span class="<?php echo esc_attr($icon_class); ?>"></span>
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <h3 class="title"><?php the_title(); ?></h3>

                                        <div class="price"><?php echo (!empty($product->get_price())) ? $product->get_price_html() : esc_html__('Free','workio'); ?></div>
                                        
                                        <?php if ( has_excerpt() ) { ?>
                                            <div class="short-des"><?php the_excerpt(); ?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="bottom-sub">

                                        <div class="button-action"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>

                                        <div class="content"><?php the_content(); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Jobs_Packages );