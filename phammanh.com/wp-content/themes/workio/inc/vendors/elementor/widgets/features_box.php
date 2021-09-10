<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Features_Box extends Widget_Base {

    public function get_name() {
        return 'apus_element_features_box';
    }

    public function get_title() {
        return esc_html__( 'Apus Features Box', 'workio' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return [ 'workio-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Features Box', 'workio' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image_icon',
            [
                'label' => esc_html__( 'Image or Icon', 'workio' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'icon' => esc_html__('Icon', 'workio'),
                    'image' => esc_html__('Image', 'workio'),
                ),
                'default' => 'image'
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'workio' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fas fa-star',
                'condition' => [
                    'image_icon' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'workio' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'image_icon' => 'image',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', 
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'image_icon' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title & Description', 'workio' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'This is the heading', 'workio' ),
                'placeholder' => esc_html__( 'Enter your title', 'workio' ),
            ]
        );

        $repeater->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Content', 'workio' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'workio' ),
                'placeholder' => esc_html__( 'Enter your description', 'workio' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link to', 'workio' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'workio' ),
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'features',
            [
                'label' => esc_html__( 'Features Box', 'workio' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'workio' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'number',
                'default' => '3'
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'workio' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'workio'),
                    'carousel' => esc_html__('Carousel', 'workio'),
                ),
                'default' => 'grid'
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'workio' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Layout 1', 'workio'),
                    'style2' => esc_html__('Layout 2 - List', 'workio'),
                    'style3' => esc_html__('Layout 3 - Grid', 'workio'),                                        
                    'style4' => esc_html__('Layout 4 - (Ex: List media for footer)', 'workio'),
                    'style5' => esc_html__('Layout 5 - (Ex: Contact, Info, Metadata)', 'workio'),
                ),
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'workio' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter button text', 'workio' ),
                'default' => 'Read More'
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'workio' ),
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .item-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'workio' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'workio' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Settings', 'workio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .item-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .item .item-inner' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_border_size',            
            [
                'label' => esc_html__( 'Border Size', 'workio' ),                 
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-features-box .item .item-inner' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
                ],
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',            
            [
                'label' => esc_html__( 'Box Rounded Corner', 'workio' ),                 
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-features-box .item .item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );

        $this->add_responsive_control(
            'bg_padding',            
            [
                'label' => esc_html__( 'Box Padding', 'workio' ),          
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-features-box .item .item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bg_margin',            
            [
                'label' => esc_html__( 'Box Margin', 'workio' ),                 
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-features-box .item .item-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_img',
            [
                'label' => esc_html__( 'Icon & Image', 'workio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Font Size', 'workio' ),                
                'type' => Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .features-box-image.icon i' => 'font-size: {{VALUE}}px;', 
                    '{{WRAPPER}} .widget-features-box .features-box-image.icon i:before' => 'font-size: {{VALUE}}px;', 
                    '{{WRAPPER}} .widget-features-box .features-box-image.icon i:after' => 'font-size: {{VALUE}}px;', 
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_width_height',
            [
                'label' => esc_html__( 'Icon Size', 'workio' ),
                'type' => Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .features-box-image.icon' => 'width: {{VALUE}}px;height: {{VALUE}}px;',                     
                ],
            ]
        );

        $this->add_control(
            'icon_align',   
            [
                'label' => esc_html__( 'Icon Alignment', 'workio' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'workio' ),
                        'icon' => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'workio' ),
                        'icon' => 'fas fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'workio' ),
                        'icon' => 'fas fa-align-right',
                    ],
                    'baseline' => [
                        'title' => esc_html__( 'Justified', 'workio' ),
                        'icon' => 'fas fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .widget-features-box .features-box-image.icon' => 'justify-content: {{VALUE}};align-items: {{VALUE}};',  
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .features-box-image.icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .features-box-image.icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_border_color',
            [
                'label' => esc_html__( 'Icon Border Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .features-box-image.icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_image_size',
            [
                'label' => esc_html__( 'Image Background Size', 'workio' ),                
                'type' => Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .item-inner .features-box-image' => 'width: {{VALUE}}px;',                    
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_image_gap',
            [
                'label' => esc_html__( 'Image Gap', 'workio' ),                
                'type' => Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-features-box .item-inner .features-box-image' => 'padding-right: {{VALUE}}px;',                     
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_typography',
            [
                'label' => esc_html__( 'Typography', 'workio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'workio' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title a, {{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'workio' ),
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($features) ) {
            ?>
            <div class="widget-features-box <?php echo esc_attr($el_class.' '.$alignment.' '.$style); ?>">
                    <?php if($layout == 'grid') { ?>
                        <div class="row">
                            <?php 
                                if($columns > 1){
                                    $sm = 6;
                                } else{
                                    $sm = 12;
                                }
                            ?>
                            <?php foreach ($features as $item): ?>
                                    <div class="col-xs-12 col-sm-<?php echo esc_attr($sm);?> col-md-<?php echo esc_attr(12/$columns);?> col-lg-<?php echo esc_attr(12/$columns);?>">
                                        <div class="item">
                                        
                                        <div class="item-inner">

                                        <?php
                                        $has_content = ! empty( $item['title_text'] ) || ! empty( $item['description_text'] );
                                        $html = '';

                                        if ( $item['image_icon'] == 'image' ) {
                                            if ( ! empty( $item['image']['url'] ) ) {
                                                $this->add_render_attribute( 'image', 'src', $item['image']['url'] );
                                                $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $item['image'] ) );
                                                $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $item['image'] ) );


                                                $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );

                                                if ( ! empty( $item['link']['url'] ) ) {
                                                    $image_html = '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>' . $image_html . '</a>';
                                                }

                                                $html .= '<div class="features-box-image img">' . $image_html . '</div>';
                                            }
                                        } elseif ( $item['image_icon'] == 'icon' && !empty($item['icon'])) {
                                            $html .= '<div class="features-box-image icon"><i class="'.$item['icon'].'"></i></div>';
                                        }

                                        if ( $has_content ) {
                                            $html .= '<div class="features-box-content">';

                                            if ( ! empty( $item['title_text'] ) ) {
                                                
                                                $title_html = $item['title_text'];

                                                if ( ! empty( $item['link']['url'] ) ) {
                                                    $html .= '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'><h3 class="title">'.$title_html.'</h3></a>';
                                                } else {
                                                    $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                                                }
                                            }

                                            if ( ! empty( $item['description_text'] ) ) {
                                                $html .= sprintf( '<div class="description">%1$s</div>', $item['description_text'] );
                                            }

                                            $html .= '</div>';
                                        }

                                        if ( ! empty( $item['link']['url'] ) && $button_text ) {
                                            $html .= '<a class="read-more-btn" href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>'.$button_text.'</a>';
                                        }

                                        echo wp_kses_post($html);
                                        ?>

                                    </div>

                                </div>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php }else { ?>
                        <div class="slick-carousel <?php echo esc_attr($columns < count($features) ?'':'hidden-dots'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="true" data-nav="false">
                            <?php foreach ($features as $item): ?>
                                        
                                    <div class="item-inner">

                                            <?php
                                            $has_content = ! empty( $item['title_text'] ) || ! empty( $item['description_text'] );
                                            $html = '';

                                            if ( $item['image_icon'] == 'image' ) {
                                                if ( ! empty( $item['image']['url'] ) ) {
                                                    $this->add_render_attribute( 'image', 'src', $item['image']['url'] );
                                                    $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $item['image'] ) );
                                                    $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $item['image'] ) );


                                                    $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );

                                                    if ( ! empty( $item['link']['url'] ) ) {
                                                        $image_html = '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>' . $image_html . '</a>';
                                                    }

                                                    $html .= '<div class="features-box-image img">' . $image_html . '</div>';
                                                }
                                            } elseif ( $item['image_icon'] == 'icon' && !empty($item['icon'])) {
                                                $html .= '<div class="features-box-image icon"><i class="'.$item['icon'].'"></i></div>';
                                            }

                                            if ( $has_content ) {
                                                $html .= '<div class="features-box-content">';

                                                if ( ! empty( $item['title_text'] ) ) {
                                                    
                                                    $title_html = $item['title_text'];

                                                    if ( ! empty( $item['link']['url'] ) ) {
                                                        $html .= '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'><h3 class="title">'.$title_html.'</h3></a>';
                                                    } else {
                                                        $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                                                    }
                                                }

                                                if ( ! empty( $item['description_text'] ) ) {
                                                    $html .= sprintf( '<div class="description">%1$s</div>', $item['description_text'] );
                                                }

                                                $html .= '</div>';
                                            }

                                            if ( ! empty( $item['link']['url'] ) && $button_text ) {
                                                $html .= '<a class="read-more-btn" href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>'.$button_text.'</a>';
                                            }

                                            echo wp_kses_post($html);
                                            ?>

                                    </div>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Features_Box );