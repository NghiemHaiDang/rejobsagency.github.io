<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Workio_Elementor_Jobs_User_Packages extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_jobs_user_packages';
    }

	public function get_title() {
        return esc_html__( 'Apus User Packages', 'workio' );
    }
    
	public function get_categories() {
        return [ 'workio-jobs-elements' ];
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
            'title',
            [
                'label' => esc_html__( 'Title', 'workio' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'default' => '',
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

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        ?>
        <div class="box-dashboard-wrapper">
            <div class="inner-list">
                <?php if ($title!=''): ?>
                    <h2 class="title">
                        <?php echo esc_attr( $title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( ! is_user_logged_in() ) {
                    ?>
                    <div class="box-list-2">
                        <div class="text-warning"><?php  esc_html_e( 'Please login with "Employer" to see this page.', 'workio' ); ?></div>
                    </div>  
                    <?php
                } else {
                    $packages = WP_Job_Board_Wc_Paid_Listings_Mixes::get_packages_by_user( get_current_user_id(), false );
                    if ( !empty($packages) ) {
                    ?>
                        <div class="widget-user-packages <?php echo esc_attr($el_class); ?>">
                            <div class="widget-content table-responsive">
                                <table class="user-packages">
                                    <thead>
                                        <tr>
                                            <td><?php esc_html_e('ID', 'workio'); ?></td>
                                            <td><?php esc_html_e('Package', 'workio'); ?></td>
                                            <td><?php esc_html_e('Package Type', 'workio'); ?></td>
                                            <td><?php esc_html_e('Package Info', 'workio'); ?></td>

                                            <td><?php esc_html_e('Status', 'workio'); ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($packages as $package) {
                                            $prefix = WP_JOB_BOARD_WC_PAID_LISTINGS_PREFIX;
                                            $package_type = get_post_meta($package->ID, $prefix. 'package_type', true);
                                            $package_types = WP_Job_Board_Wc_Paid_Listings_Post_Type_Packages::package_types();
                                            $subscription_type = get_post_meta($package->ID, $prefix. 'subscription_type', true);
                                        ?>
                                            <tr>
                                                <td><?php echo trim($package->ID); ?></td>
                                                <td class="title"><?php echo trim($package->post_title); ?></td>
                                                <td>
                                                    <?php
                                                        if ( !empty($package_types[$package_type]) ) {
                                                            echo esc_html($package_types[$package_type]);
                                                        } else {
                                                            echo '--';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="package-info-wrapper">
                                                    <?php
                                                        switch ($package_type) {
                                                            case 'cv_package':
                                                                $candidate_ids = get_post_meta($package->ID, $prefix. 'cv_viewed_count', true);
                                                                if ( !empty($candidate_ids) ) {
                                                                    $candidate_ids = explode(',', $candidate_ids);
                                                                    $cv_viewed_count = count( $candidate_ids );
                                                                } else {
                                                                    $cv_viewed_count = 0;
                                                                }
                                                                $cv_package_expiry_time = get_post_meta($package->ID, $prefix. 'cv_package_expiry_time', true);
                                                                $cv_number_of_cv = get_post_meta($package->ID, $prefix. 'cv_number_of_cv', true);
                                                                
                                                                ?>
                                                                <ul class="lists-info">
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('CV Count:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($cv_viewed_count); ?></span>
                                                                    </li>
                                                                    <?php if ( $subscription_type !== 'listing' ) { ?>
                                                                        <li>
                                                                            <span class="title"><?php esc_html_e('Expiry Time:', 'workio'); ?></span>
                                                                            <span class="value"><?php echo sprintf(_n('%d Day', '%d Days', intval($cv_package_expiry_time), 'workio'), intval($cv_package_expiry_time)); ?></span>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('CV Limit:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($cv_number_of_cv); ?></span>
                                                                    </li>
                                                                </ul>
                                                                <?php
                                                                break;
                                                            case 'contact_package':
                                                                $candidate_ids = get_post_meta($package->ID, $prefix. 'contact_viewed_count', true);
                                                                if ( !empty($candidate_ids) ) {
                                                                    $candidate_ids = explode(',', $candidate_ids);
                                                                    $contact_viewed_count = count( $candidate_ids );
                                                                } else {
                                                                    $contact_viewed_count = 0;
                                                                }
                                                                $contact_package_expiry_time = get_post_meta($package->ID, $prefix. 'contact_package_expiry_time', true);
                                                                $contact_number_of_cv = get_post_meta($package->ID, $prefix. 'contact_number_of_cv', true);
                                                                ?>
                                                                <ul class="lists-info">
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('CV Count:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($contact_viewed_count); ?></span>
                                                                    </li>
                                                                    <?php if ( $subscription_type !== 'listing' ) { ?>
                                                                        <li>
                                                                            <span class="title"><?php esc_html_e('Expiry Time:', 'workio'); ?></span>
                                                                            <span class="value"><?php echo sprintf(_n('%d Day', '%d Days', intval($contact_package_expiry_time), 'workio'), intval($contact_package_expiry_time)); ?></span>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('CV Limit:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($contact_number_of_cv); ?></span>
                                                                    </li>
                                                                </ul>
                                                                <?php
                                                                break;
                                                            case 'candidate_package':
                                                                $candidate_ids = get_post_meta($package->ID, $prefix. 'candidate_applied_count', true);
                                                                if ( !empty($candidate_ids) ) {
                                                                    $candidate_ids = explode(',', $candidate_ids);
                                                                    $candidate_applied_count = count( $candidate_ids );
                                                                } else {
                                                                    $candidate_applied_count = 0;
                                                                }
                                                                $candidate_package_expiry_time = get_post_meta($package->ID, $prefix. 'candidate_package_expiry_time', true);
                                                                $candidate_number_of_applications = get_post_meta($package->ID, $prefix. 'candidate_number_of_applications', true);
                                                                ?>
                                                                <ul class="lists-info">
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('CV Count:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($contact_viewed_count); ?></span>
                                                                    </li>
                                                                    <?php if ( $subscription_type !== 'listing' ) { ?>
                                                                        <li>
                                                                            <span class="title"><?php esc_html_e('Expiry Time:', 'workio'); ?></span>
                                                                            <span class="value"><?php echo sprintf(_n('%d Day', '%d Days', intval($candidate_package_expiry_time), 'workio'), intval($candidate_package_expiry_time)); ?></span>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('CV Limit:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($candidate_number_of_applications); ?></span>
                                                                    </li>
                                                                </ul>
                                                                <?php
                                                                break;
                                                            case 'resume_package':
                                                                $urgent_resumes = get_post_meta($package->ID, $prefix. 'urgent_resumes', true);
                                                                $featured_resumes = get_post_meta($package->ID, $prefix. 'feature_resumes', true);
                                                                $resumes_duration = get_post_meta($package->ID, $prefix. 'resumes_duration', true);
                                                                ?>
                                                                <ul class="lists-info">
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('Urgent:', 'workio'); ?></span>
                                                                        <span class="value">
                                                                            <?php
                                                                                if ( $urgent_resumes == 'on' ) {
                                                                                    esc_html_e('Yes', 'workio');
                                                                                } else {
                                                                                    esc_html_e('No', 'workio');
                                                                                }
                                                                            ?>
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('Featured:', 'workio'); ?></span>
                                                                        <span class="value">
                                                                            <?php
                                                                                if ( $featured_resumes == 'on' ) {
                                                                                    esc_html_e('Yes', 'workio');
                                                                                } else {
                                                                                    esc_html_e('No', 'workio');
                                                                                }
                                                                            ?>
                                                                        </span>
                                                                    </li>
                                                                    <?php if ( $subscription_type !== 'listing' ) { ?>
                                                                        <li>
                                                                            <span class="title"><?php esc_html_e('Resume Duration:', 'workio'); ?></span>
                                                                            <span class="value"><?php echo intval($resumes_duration); ?></span>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <?php
                                                                break;
                                                            case 'job_package':
                                                            default:
                                                                $urgent_jobs = get_post_meta($package->ID, $prefix. 'urgent_jobs', true);
                                                                $feature_jobs = get_post_meta($package->ID, $prefix. 'feature_jobs', true);
                                                                $package_count = get_post_meta($package->ID, $prefix. 'package_count', true);
                                                                $job_limit = get_post_meta($package->ID, $prefix. 'job_limit', true);
                                                                $job_duration = get_post_meta($package->ID, $prefix. 'job_duration', true);
                                                                ?>
                                                                <ul class="lists-info">
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('Urgent:', 'workio'); ?></span>
                                                                        <span class="value">
                                                                            <?php
                                                                                if ( $urgent_jobs == 'on' ) {
                                                                                    esc_html_e('Yes', 'workio');
                                                                                } else {
                                                                                    esc_html_e('No', 'workio');
                                                                                }
                                                                            ?>
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('Featured:', 'workio'); ?></span>
                                                                        <span class="value">
                                                                            <?php
                                                                                if ( $feature_jobs == 'on' ) {
                                                                                    esc_html_e('Yes', 'workio');
                                                                                } else {
                                                                                    esc_html_e('No', 'workio');
                                                                                }
                                                                            ?>
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('Posted:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($package_count); ?></span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="title"><?php esc_html_e('Limit Posts:', 'workio'); ?></span>
                                                                        <span class="value"><?php echo intval($job_limit); ?></span>
                                                                    </li>
                                                                    <?php if ( $subscription_type !== 'listing' ) { ?>
                                                                        <li>
                                                                            <span class="title"><?php esc_html_e('Listing Duration:', 'workio'); ?></span>
                                                                            <span class="value"><?php echo intval($job_duration); ?></span>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <?php
                                                                break;
                                                        }
                                                    ?>
                                                    </div>
                                                </td>
                                                <td>

                                                    <?php
                                                        $valid = false;
                                                        $user_id = get_current_user_id();
                                                        switch ($package_type) {
                                                            case 'cv_package':
                                                                $valid = WP_Job_Board_Wc_Paid_Listings_Mixes::cv_package_is_valid($user_id, $package->ID);
                                                                break;
                                                            case 'contact_package':
                                                                $valid = WP_Job_Board_Wc_Paid_Listings_Mixes::contact_package_is_valid($user_id, $package->ID);
                                                                break;
                                                            case 'candidate_package':
                                                                $valid = WP_Job_Board_Wc_Paid_Listings_Mixes::candidate_package_is_valid($user_id, $package->ID);
                                                                break;
                                                            case 'resume_package':
                                                                $valid = WP_Job_Board_Wc_Paid_Listings_Mixes::resume_package_is_valid($user_id, $package->ID);
                                                                break;
                                                            case 'job_package':
                                                            default:
                                                                $valid = WP_Job_Board_Wc_Paid_Listings_Mixes::package_is_valid($user_id, $package->ID);
                                                                break;
                                                        }
                                                        if ( !$valid ) {
                                                            echo '<span class="action finish">'.esc_html__('Finished', 'workio').'</span>';
                                                        } else {
                                                            echo '<span class="action active">'.esc_html__('Active', 'workio').'</span>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="not-found"><?php esc_html_e('Don\'t have any packages', 'workio'); ?></div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    <?php }

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Workio_Elementor_Jobs_User_Packages );