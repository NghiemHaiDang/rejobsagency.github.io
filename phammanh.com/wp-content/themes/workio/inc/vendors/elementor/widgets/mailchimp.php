<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Mailchimp extends Widget_Base {

	public function get_name() {
        return 'apus_element_mailchimp';
    }

	public function get_title() {
        return esc_html__( 'Apus MailChimp Sign-Up Form', 'workio' );
    }
    
	public function get_categories() {
        return [ 'workio-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'MailChimp Sign-Up Form', 'workio' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'workio' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'workio' ),
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'workio' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'workio'),
                    'dark' => esc_html__('Dark', 'workio'),                    
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => esc_html__( 'Button Style', 'workio' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Button - No Icon', 'workio'),
                    'with-icon' => esc_html__('Button - Icon', 'workio'),                    
                ),
                'default' => ''
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
                'label' => esc_html__( 'Styles', 'workio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_radius',            
            [
                'label' => esc_html__( 'Button Rounded Corner', 'workio' ),                 
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-mailchimp input[type="button"], .widget-mailchimp .button,.widget-mailchimp button,.widget-mailchimp input[type="submit"], .widget-mailchimp.with-icon button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
                ],
            ]
        );

        $this->add_responsive_control(
            'input_radius',            
            [
                'label' => esc_html__( 'Input Rounded Corner', 'workio' ),                 
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-mailchimp input[type="text"], .widget-mailchimp input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',            
            [
                'label' => esc_html__( 'Input Padding', 'workio' ),                 
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .widget-mailchimp input[type="text"], .widget-mailchimp input[type="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );

        $this->add_responsive_control(
            'button_height',
            [
                'label' => esc_html__( 'Button Size - Height', 'workio' ),                
                'type' => Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="button"], .widget-mailchimp input[type="submit"], .widget-mailchimp.with-icon button' => 'height: {{VALUE}}px;',    
                ],
            ]
        );

        $this->add_responsive_control(
            'input_height',
            [
                'label' => esc_html__( 'Input Size - Height', 'workio' ),                
                'type' => Controls_Manager::NUMBER,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="text"], .widget-mailchimp input[type="email"]' => 'height: {{VALUE}}px;',    
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'workio' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',                        
            [
                'label' => esc_html__( 'Title Margin', 'workio' ),                 
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [                                        
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'workio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp .mc4wp-form label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button Style', 'workio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__( 'Button Color', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="button"], .widget-mailchimp input[type="submit"]' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp.with-icon button i, .widget-mailchimp.with-icon input[type="button"] i,.widget-mailchimp.with-icon input[type="reset"] i,.widget-mailchimp.with-icon input[type="submit"] i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__( 'Button Hover Color', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:hover, .widget-mailchimp input[type="submit"]:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:focus, .widget-mailchimp input[type="submit"]:focus' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:active, .widget-mailchimp input[type="submit"]:active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp.with-icon button:hover i, .widget-mailchimp.with-icon input[type="button"]:hover i,.widget-mailchimp.with-icon input[type="reset"]:hover i,.widget-mailchimp.with-icon input[type="submit"]:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__( 'Button Background', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="button"], .widget-mailchimp input[type="submit"],.widget-mailchimp.with-icon button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_hover',
            [
                'label' => esc_html__( 'Button Background Hover', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:hover, .widget-mailchimp input[type="submit"]:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:focus, .widget-mailchimp input[type="submit"]:focus' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:active, .widget-mailchimp input[type="submit"]:active' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp.with-icon button:active, .widget-mailchimp.with-icon button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_border_color',
            [
                'label' => esc_html__( 'Button Border Color', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="button"], .widget-mailchimp input[type="submit"], .widget-mailchimp.with-icon button' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_border_hover',
            [
                'label' => esc_html__( 'Button Border Hover', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:hover, .widget-mailchimp input[type="submit"]:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:focus, .widget-mailchimp input[type="submit"]:focus' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="button"]:active, .widget-mailchimp input[type="submit"]:active' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp.with-icon button:active, .widget-mailchimp.with-icon button:hover, .widget-mailchimp.with-icon button:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Button Typography', 'workio' ),
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .widget-mailchimp input[type="button"], .widget-mailchimp input[type="submit"]',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__( 'Input Style', 'workio' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        

        $this->add_control(
            'input_color',
            [
                'label' => esc_html__( 'Input Color', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="text"], .widget-mailchimp input[type="email"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_placeholder_color',
            [
                'label' => esc_html__( 'Input Placeholder Color', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="text"]::-webkit-input-placeholder, .widget-mailchimp input[type="email"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="text"]::-moz-placeholder, .widget-mailchimp input[type="email"]input::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="text"]:-ms-input-placeholder, .widget-mailchimp input[type="email"]input:-ms-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-mailchimp input[type="text"]:-moz-placeholder, .widget-mailchimp input[type="email"]input:-moz-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label' => esc_html__( 'Input Background', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="text"], .widget-mailchimp input[type="email"]' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_border_color',
            [
                'label' => esc_html__( 'Input Border', 'workio' ),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [                    
                    '{{WRAPPER}} .widget-mailchimp input[type="text"], .widget-mailchimp input[type="email"]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-mailchimp clearfix <?php echo esc_attr($el_class.' '.$style.' '.$button_style); ?>">
            <?php if ( !empty($title) ) { ?>
                <h2 class="title"><?php echo esc_html($title); ?></h2>
            <?php } ?>
            <?php mc4wp_show_form(''); ?>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Mailchimp );