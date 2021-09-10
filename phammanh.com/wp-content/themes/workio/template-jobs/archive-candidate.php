<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
if ( isset( $_REQUEST['load_type'] ) && WP_Job_Board_Mixes::is_ajax_request() ) {
	if ( 'items' !== $_REQUEST['load_type'] ) {
        echo WP_Job_Board_Template_Loader::get_template_part('archive-candidate-ajax-full', array('candidates' => $wp_query));
	} else {
		echo WP_Job_Board_Template_Loader::get_template_part('archive-candidate-ajax-candidates', array('candidates' => $wp_query));
	}
} else {
	get_header();

	$layout_type = workio_get_candidates_layout_type();
	if ( $layout_type == 'half-map' ) {
	?>
		<section id="main-container" class="inner">
			<div class="row no-margin layout-type-<?php echo esc_attr($layout_type); ?>">
				<div id="main-content" class="col-sm-12 col-md-7 no-padding">
					<div class="inner-left">
						<?php if ( is_active_sidebar( 'candidates-filter-top-sidebar' ) ): ?>
							<div class="filter-sidebar">
								<div class="mobile-groups-button hidden-lg hidden-md clearfix text-center">
									<button class=" btn btn-sm btn-theme btn-view-map" type="button"><i class="fa fa-map-o" aria-hidden="true"></i> <?php esc_html_e( 'Map View', 'workio' ); ?></button>
									<button class=" btn btn-sm btn-theme  btn-view-listing hidden-sm hidden-xs" type="button"><i class="fa fa-list" aria-hidden="true"></i> <?php esc_html_e( 'Listing View', 'workio' ); ?></button>
								</div>
								<div class="filter-scroll">
						   			<?php dynamic_sidebar( 'candidates-filter-top-sidebar' ); ?>
						   		</div>
						   	</div>
						   	<div class="over-dark"></div>
					   	<?php endif; ?>
					   	<div class="content-listing">
					   		
							<?php
								echo WP_Job_Board_Template_Loader::get_template_part('loop/candidate/archive-inner', array('candidates' => $wp_query));

								echo WP_Job_Board_Template_Loader::get_template_part('loop/candidate/pagination', array('candidates' => $wp_query) );
							?>
						</div>
					</div><!-- .site-main -->
				</div><!-- .content-area -->
				<div class="col-md-5 no-padding">
					<div id="jobs-google-maps" class="hidden-sm hidden-xs fix-map"></div>
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
			<div id="jobs-google-maps" class="hidden-sm hidden-xs top-map top-map-candidate"></div>
			<section class="main-content <?php echo apply_filters('workio_page_content_class', 'container');?> inner">

				<?php if ( is_active_sidebar( 'candidates-filter-sidebar' ) ): ?>
					<a href="javascript:void(0)" class="mobile-sidebar-btn hidden-lg hidden-md space-20"> <i class="fa fa-bars"></i> </a>
					<div class="mobile-sidebar-panel-overlay"></div>
				<?php endif; ?>
				
				<div class="row">
					<?php
						$main_class = 'col-xs-12';
						if ( is_active_sidebar( 'candidates-filter-sidebar' ) ) {
							$main_class = 'col-md-8 col-lg-8 col-sm-12 col-xs-12';
						}
					?>
					<div id="main-content" class="<?php echo esc_attr($main_class); ?>">
						
					   	<div class="content-listing">
					   		
							<?php
								echo WP_Job_Board_Template_Loader::get_template_part('loop/candidate/archive-inner', array('candidates' => $wp_query));

								echo WP_Job_Board_Template_Loader::get_template_part('loop/candidate/pagination', array('candidates' => $wp_query) );
							?>
						</div><!-- .site-main -->
					</div><!-- .content-area -->
					
					<?php if ( is_active_sidebar( 'candidates-filter-sidebar' ) ): ?>
						<div class="sidebar-wrapper col-md-4 col-lg-4 col-sm-12 col-xs-12">
						  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						  		<div class="close-sidebar-btn hidden-lg hidden-md"><i class="ti-close"></i> <span><?php esc_html_e('Close', 'workio'); ?></span></div>
						   		<?php dynamic_sidebar( 'candidates-filter-sidebar' ); ?>
						  	</aside>
						</div>
				   	<?php endif; ?>
				</div>
			</section>
		</section>
	<?php
	} else {
		$sidebar_configs = workio_get_candidates_layout_configs();

		workio_render_breadcrumbs();
		?>

		<?php if ( workio_get_candidate_layout_type() == 'main' && is_active_sidebar( 'candidates-filter-top-sidebar' ) ) { ?>
			<div class="candidates-filter-top-sidebar-wrapper filter-candidate-sidebar-wrapper">
		   		<?php dynamic_sidebar( 'candidates-filter-top-sidebar' ); ?>
		   	</div>
		<?php } ?>
		
		<section id="main-container" class="main-content <?php echo apply_filters('workio_candidate_content_class', 'container');?> inner">
			<?php workio_before_content( $sidebar_configs ); ?>
			<div class="row">
				<?php workio_display_sidebar_left( $sidebar_configs ); ?>

				<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
					<main id="main" class="site-main content" role="main">
						
						<?php
							echo WP_Job_Board_Template_Loader::get_template_part('loop/candidate/archive-inner', array('candidates' => $wp_query));

							echo WP_Job_Board_Template_Loader::get_template_part('loop/candidate/pagination', array('candidates' => $wp_query) );
						?>
					</main><!-- .site-main -->
				</div><!-- .content-area -->
				
				<?php workio_display_sidebar_right( $sidebar_configs ); ?>
			</div>
		</section><!-- .content-area -->

		<?php
	}
	get_footer();
}