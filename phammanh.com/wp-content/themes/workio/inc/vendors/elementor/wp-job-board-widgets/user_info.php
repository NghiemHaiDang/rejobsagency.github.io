<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_User_Info extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_user_info';
    }

	public function get_title() {
        return esc_html__( 'Apus Header User Info', 'workio' );
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
            'layout_type',
            [
                'label' => esc_html__( 'Layout Type', 'workio' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'popup' => esc_html__('Popup', 'workio'),
                    'page' => esc_html__('Page', 'workio'),
                ),
                'default' => 'popup'
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

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'workio' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'workio' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'workio' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'workio' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Color', 'workio' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color Text', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .top-wrapper-menu .infor-account .name-acount' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn-login' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Color Hover Text', 'workio' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .top-wrapper-menu .infor-account .name-acount:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn-login:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn-login:focus' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $userdata = get_userdata($user_id);
            $user_name = $userdata->display_name;
            if ( WP_Job_Board_User::is_employer($user_id) || WP_Job_Board_User::is_candidate($user_id) ) {
                if ( WP_Job_Board_User::is_employer($user_id) ) {
                    $menu_nav = 'employer-menu';
                    $employer_id = WP_Job_Board_User::get_employer_by_user_id($user_id);
                    $user_name = get_post_field('post_title', $employer_id);
                    $avatar = get_the_post_thumbnail( $employer_id, 'thumbnail' );
                } elseif ( method_exists('WP_Job_Board_User', 'is_employee') && WP_Job_Board_User::is_employee($user_id) ) {
                    $user_id = WP_Job_Board_User::get_user_id();
                    
                    $menu_nav = 'employee-menu';
                    $employer_id = WP_Job_Board_User::get_employer_by_user_id($user_id);
                    $user_name = get_post_field('post_title', $employer_id);
                    $avatar = get_the_post_thumbnail( $employer_id, 'thumbnail' );
                } else {
                    $menu_nav = 'candidate-menu';
                    $candidate_id = WP_Job_Board_User::get_candidate_by_user_id($user_id);
                    $user_name = get_post_field('post_title', $candidate_id);
                    $avatar = get_the_post_thumbnail( $candidate_id, 'thumbnail' );
                }
            }
            ?>
            <div class="top-wrapper-menu author-verify <?php echo esc_attr($el_class); ?>">
                <a class="drop-dow" href="javascript:void(0);">
                    <div class="infor-account flex-middle">
                        <div class="avatar-wrapper">
                            <?php if ( !empty($avatar)) {
                                echo trim($avatar);
                            } else {
                                echo get_avatar($user_id, 54);
                            } ?>
                        </div>
                        <div class="name-acount"><?php echo esc_html($user_name); ?> 
                            <?php if ( !empty($menu_nav) && has_nav_menu( $menu_nav ) ) { ?>                                
                                <i class="ti-angle-down"></i>
                            <?php } ?>
                        </div>
                    </div>
                </a>
                <?php
                    if ( !empty($menu_nav) && has_nav_menu( $menu_nav ) ) {
                        $args = array(
                            'theme_location' => $menu_nav,
                            'container_class' => 'inner-top-menu',
                            'menu_class' => 'nav navbar-nav topmenu-menu',
                            'fallback_cb' => '',
                            'menu_id' => '',
                            'walker' => new Workio_Nav_Menu()
                        );
                        wp_nav_menu($args);
                    }
                ?>
            </div>
        <?php } else {
            $login_register_page_id = wp_job_board_get_option('login_register_page_id');
        ?>
            <div class="top-wrapper-menu <?php echo esc_attr($el_class); ?>">
                <?php if ( $layout_type == 'page' ) { ?>
                    <a class="btn btn-theme btn-login login" href="<?php echo esc_url( get_permalink( $login_register_page_id ) ); ?>" title="<?php esc_attr_e('Sign in','workio'); ?>"><?php esc_html_e('Login / Register', 'workio'); ?>
                    </a>
                <?php } else { ?>
                    <a class="btn btn-login login apus-user-login" href="#apus_login_forgot_tab" title="<?php esc_attr_e('Login','workio'); ?>">
                        <i class="ti-user"></i>
                        <?php esc_html_e('Login', 'workio'); ?>
                    </a>

                    <a class="btn btn-login register apus-user-register" href="#apus_register_tab" title="<?php esc_attr_e('Register','workio'); ?>">
                        <i class="ti-pencil-alt"></i>
                        <?php esc_html_e('Register', 'workio'); ?>
                    </a>
                    
                    <?php get_template_part('template-parts/login-register'); ?>

                <?php } ?>
            </div>
        <?php }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_User_Info );