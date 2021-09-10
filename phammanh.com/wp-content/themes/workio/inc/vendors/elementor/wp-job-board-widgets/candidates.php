<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Job_Board_Candidates extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_job_board_candidates';
    }

	public function get_title() {
        return esc_html__( 'Apus Candidates', 'workio' );
    }
    
	public function get_categories() {
        return [ 'workio-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Candidates', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
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
            'category_slugs',
            [
                'label' => esc_html__( 'Categories Slug', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,)', 'workio' ),
            ]
        );

        $this->add_control(
            'location_slugs',
            [
                'label' => esc_html__( 'Location Slug', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,)', 'workio' ),
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'workio' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
                'description' => esc_html__( 'Limit jobs to display', 'workio' ),
                'default' => 4
            ]
        );
        
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order by', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'workio'),
                    'date' => esc_html__('Date', 'workio'),
                    'ID' => esc_html__('ID', 'workio'),
                    'author' => esc_html__('Author', 'workio'),
                    'title' => esc_html__('Title', 'workio'),
                    'modified' => esc_html__('Modified', 'workio'),
                    'rand' => esc_html__('Random', 'workio'),
                    'comment_count' => esc_html__('Comment count', 'workio'),
                    'menu_order' => esc_html__('Menu order', 'workio'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Sort order', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'workio'),
                    'ASC' => esc_html__('Ascending', 'workio'),
                    'DESC' => esc_html__('Descending', 'workio'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'get_candidates_by',
            [
                'label' => esc_html__( 'Get Candidates By', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'default' => esc_html__('Default', 'workio'),
                    'featured' => esc_html__('Featured Candidates', 'workio'),
                    'urgent' => esc_html__('Urgent Candidates', 'workio'),
                    'recent' => esc_html__('Recent Candidates', 'workio'),
                ),
                'default' => 'recent'
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'workio'),
                    'carousel' => esc_html__('Carousel', 'workio'),
                    'list' => esc_html__('List', 'workio'),
                ),
                'default' => 'list'
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your column number here', 'workio' ),
                'default' => 4,
                'condition' => [
                    'layout_type' => ['carousel', 'grid'],
                ],
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your rows number here', 'workio' ),
                'default' => 1,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'workio' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'workio' ),
                'label_off'     => esc_html__( 'Hide', 'workio' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'workio' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'workio' ),
                'label_off'     => esc_html__( 'Hide', 'workio' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'workio' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'workio' ),
                'label_off'     => esc_html__( 'No', 'workio' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'workio' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'workio' ),
                'label_off'     => esc_html__( 'No', 'workio' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'view_all',
            [
                'label' => esc_html__( 'View All', 'workio' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'workio' ),
                'label_off' => esc_html__( 'Show', 'workio' ),
            ]
        );

        $this->add_control(
            'text_view',
            [
                'label' => esc_html__( 'Text View All', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Load More Candidate List',
                'condition' => [
                    'view_all' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'link_view',
            [
                'label' => esc_html__( 'View Link', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Link here', 'workio' ),
                'condition' => [
                    'view_all' => ['yes'],
                ]
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
            'section_job_color',
            [
                'label' => esc_html__( 'Color', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'candidate_box_border_color',
            [
                'label' => esc_html__( 'Block Border', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .candidate-archive-layout' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'candidate_title_color',
            [
                'label' => esc_html__( 'Candidate Title', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .candidate-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'candidate_job_color',            
            [
                'label' => esc_html__( 'Candidate Job', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .candidate-job' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'candidate_content_color',
            [                
                'label' => esc_html__( 'Description', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .candidate-archive-layout' => 'color: {{VALUE}};',                    
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_typo',
            [
                'label' => esc_html__( 'Typography', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Candidate Title', 'workio' ),
                'name' => 'title_candidate_typography',
                'selector' => '{{WRAPPER}} .candidate-title',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Job Tags', 'workio' ),
                'name' => 'tag_typography',
                'selector' => '{{WRAPPER}} .job-tags a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_candidate_button',
            [
                'label' => esc_html__( 'Button', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'candidate_button_color',
            [
                'label' => esc_html__( 'Color', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .view-detail' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_button_bg',            
            [                
                'label' => esc_html__( 'Background', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .view-detail' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography', 'workio' ),
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .view-detail',
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        $category_slugs = !empty($category_slugs) ? array_map('trim', explode(',', $category_slugs)) : array();
        $location_slugs = !empty($location_slugs) ? array_map('trim', explode(',', $location_slugs)) : array();

        $args = array(
            'limit' => $limit,
            'get_candidates_by' => $get_candidates_by,
            'orderby' => $orderby,
            'order' => $order,
            'categories' => $category_slugs,
            'locations' => $location_slugs,
        );
        $loop = workio_get_candidates($args);
        if ( $loop->have_posts() ) {
            ?>
            <div class="widget-candidates widget <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
                <?php if ( $title ) { ?>
                    <h2 class="widget-title text-center"><?php echo esc_html($title); ?></h2>
                <?php } ?>
                <div class="widget-content">
                    <?php if ( $layout_type == 'carousel' ): ?>
                        <div class="slick-carousel <?php echo esc_attr( (($limit/$rows)<=$columns) ? 'hidden-dots' : '' ); ?>" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>">
                            <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                                <div class="item">
                                    <?php get_template_part( 'template-jobs/candidates-styles/inner', 'grid'); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php elseif ( $layout_type == 'grid' ): ?>
                        <?php
                            $mdcol = 12/$columns;
                            $smcol = $columns >= 2 ? 6 : 12;
                        ?>
                        <div class="row">
                            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <div class="col-md-<?php echo esc_attr($mdcol); ?> col-sm-<?php echo esc_attr($smcol); ?> col-xs-12">
                                    <?php get_template_part( 'template-jobs/candidates-styles/inner', 'grid' ); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <!-- list -->
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="style-list-candidate">
                                <?php get_template_part( 'template-jobs/candidates-styles/inner', 'list' ); ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <?php if ( $view_all == 'yes' && !empty($link_view) && !empty($text_view) ) { ?>
                    <div class="bottom-view text-center">
                        <a href="<?php echo esc_url( $link_view ); ?>" class="btn btn-theme btn-outline">
                            <?php echo esc_html($text_view); ?><i class="ti-arrow-right"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php
        }

    }

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Job_Board_Candidates );