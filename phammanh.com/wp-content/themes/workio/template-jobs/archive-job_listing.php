<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_query;
if ( isset( $_REQUEST['load_type'] ) && WP_Job_Board_Mixes::is_ajax_request() ) {
	if ( 'items' !== $_REQUEST['load_type'] ) {
        echo WP_Job_Board_Template_Loader::get_template_part('archive-job_listing-ajax-full', array('jobs' => $wp_query));
	} else {
		echo WP_Job_Board_Template_Loader::get_template_part('archive-job_listing-ajax-jobs', array('jobs' => $wp_query));
	}

} else {
	get_header();

	$layout_type = workio_get_jobs_layout_type();
	$jobs_display_mode = workio_get_jobs_display_mode();
	$job_inner_style = workio_get_jobs_inner_style();
	$job_inner_list_style = workio_get_jobs_inner_list_style();

	$args = array(
		'jobs' => $wp_query,
		'job_inner_style' => $job_inner_style,
		'job_inner_list_style' => $job_inner_list_style,
		'jobs_display_mode' => $jobs_display_mode,
	);

	if ( $layout_type == 'half-map' ) {
	?>
		<section id="main-container" class="inner">
			<div class="row no-margin layout-type-<?php echo esc_attr($layout_type); ?>">
				<div id="main-content" class="col-xs-12 col-md-7 no-padding">
					<div class="inner-left">
						<?php if ( is_active_sidebar( 'jobs-filter-top-sidebar' ) ): ?>
							<div class="filter-sidebar">
								<div class="mobile-groups-button hidden-lg hidden-md clearfix text-center">
									<button class=" btn btn-sm btn-theme btn-view-map" type="button"><i class="fa fa-map-o" aria-hidden="true"></i> <?php esc_html_e( 'Map View', 'workio' ); ?></button>
									<button class=" btn btn-sm btn-theme  btn-view-listing hidden-sm hidden-xs" type="button"><i class="fa fa-list" aria-hidden="true"></i> <?php esc_html_e( 'Listing View', 'workio' ); ?></button>
								</div>
								<div class="filter-scroll">
						   			<?php dynamic_sidebar( 'jobs-filter-top-sidebar' ); ?>
						   		</div>
					   		</div>
					   	<?php endif; ?>
					   	<div class="content-listing">
					   		
							<?php
								echo WP_Job_Board_Template_Loader::get_template_part('loop/job/archive-inner', $args);

								echo WP_Job_Board_Template_Loader::get_template_part('loop/job/pagination', array('jobs' => $wp_query));
							?>
						</div>
					</div>
				</div><!-- .content-area -->
				<div class="col-md-5 col-xs-12 no-padding">
					<div id="jobs-google-maps" class="fix-map"></div>
				</div>
			</div>
		</section>
	<?php
	} elseif ( $layout_type == 'top-map' ) {
	?>
		<section id="main-container" class="inner layout-type-<?php echo esc_attr($layout_type); ?>">
			<div class="mobile-groups-button hidden-lg hidden-md clearfix text-center">
				<button class=" btn btn-sm btn-theme btn-view-map" type="button"><i class="fa fa-map-o" aria-hidden="true"></i> <?php esc_html_e( 'Map View', 'workio' ); ?></button>
				<button class=" btn btn-sm btn-theme  btn-view-listing hidden-sm hidden-xs" type="button"><i class="fa fa-list" aria-hidden="true"></i> <?php esc_html_e( 'Listing View', 'workio' ); ?></button>
			</div>
			<div id="jobs-google-maps" class="hidden-sm hidden-xs top-map"></div>
			<div class="main-content <?php echo apply_filters('workio_page_content_class', 'container');?> inner">
				
				<?php if ( is_active_sidebar( 'jobs-filter-sidebar' ) ): ?>
					<a href="javascript:void(0)" class="mobile-sidebar-btn hidden-lg hidden-md space-20"> <i class="fa fa-bars"></i> </a>
					<div class="mobile-sidebar-panel-overlay"></div>
				<?php endif; ?>

				<div class="row">
					<?php
						$main_class = 'col-xs-12';
						if ( is_active_sidebar( 'jobs-filter-sidebar' ) ) {
							$main_class = 'col-md-8 col-lg-8 col-sm-12 col-xs-12';
						}
					?>
					<div id="main-content" class="<?php echo esc_attr($main_class); ?>">
						
					   	<div class="content-listing">
					   		
							<?php
								echo WP_Job_Board_Template_Loader::get_template_part('loop/job/archive-inner', $args);

								echo WP_Job_Board_Template_Loader::get_template_part('loop/job/pagination', array('jobs' => $wp_query));
							?>
						</div><!-- .site-main -->
					</div><!-- .content-area -->
					
					<?php if ( is_active_sidebar( 'jobs-filter-sidebar' ) ): ?>
						<div class="sidebar-wrapper col-md-4 col-lg-4 col-sm-12 col-xs-12">
						  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						  		<div class="close-sidebar-btn hidden-lg hidden-md"><i class="ti-close"></i> <span><?php esc_html_e('Close', 'workio'); ?></span></div>
						   		<?php dynamic_sidebar( 'jobs-filter-sidebar' ); ?>
						  	</aside>
						</div>
				   	<?php endif; ?>
				</div>
			</div>
		</section>
	<?php
	} else {
		$sidebar_configs = workio_get_jobs_layout_configs();

		workio_render_breadcrumbs();
	?>
		<?php if ( workio_get_jobs_layout_type() == 'main' && is_active_sidebar( 'jobs-filter-top-sidebar' ) ) { ?>
			<div class="jobs-filter-top-sidebar-wrapper filter-top-sidebar-wrapper">
		   		<?php dynamic_sidebar( 'jobs-filter-top-sidebar' ); ?>
		   	</div>
		<?php } ?>
		<section id="main-container" class="main-content <?php echo apply_filters('workio_job_content_class', 'container');?> inner">
			<?php workio_before_content( $sidebar_configs ); ?>
			<div class="row">
				<?php workio_display_sidebar_left( $sidebar_configs ); ?>

				<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
					<main id="main" class="site-main layout-type-<?php echo esc_attr($layout_type); ?>" role="main">

						<?php
							echo WP_Job_Board_Template_Loader::get_template_part('loop/job/archive-inner', $args);

							echo WP_Job_Board_Template_Loader::get_template_part('loop/job/pagination', array('jobs' => $wp_query));
						?>


					</main><!-- .site-main -->
				</div><!-- .content-area -->
				
				<?php workio_display_sidebar_right( $sidebar_configs ); ?>
			</div>
		</section>
	<?php
	}

	get_footer();
}