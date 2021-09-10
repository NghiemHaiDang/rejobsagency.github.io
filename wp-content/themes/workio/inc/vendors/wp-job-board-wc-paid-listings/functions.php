<?php

function workio_job_paid_listing_template_folder_name($folder) {
	$folder = 'template-paid-listings';
	return $folder;
}
add_filter( 'wp-job-board-wc-paid-listings-theme-folder-name', 'workio_job_paid_listing_template_folder_name', 10 );


add_action( 'wp_job_board_wc_paid_listings_package_options_product_tab_content', 'workio_product_package_options' );
function workio_product_package_options() {
	woocommerce_wp_text_input( array(
		'id'			=> '_jobs_icon_class',
		'label'			=> esc_html__( 'Package icon class', 'workio' ),
		'desc_tip'		=> 'true',
		'description'	=> esc_html__( 'Enter icon class for this package', 'workio' ),
		'type' 			=> 'text',
	) );
}

function workio_save_package_option_field( $post_id ) {
	
	if ( isset( $_POST['_jobs_icon_class'] ) ) {
		update_post_meta( $post_id, '_jobs_icon_class', sanitize_text_field( $_POST['_jobs_icon_class'] ) );
	}
}
add_action( 'woocommerce_process_product_meta_job_package', 'workio_save_package_option_field'  );