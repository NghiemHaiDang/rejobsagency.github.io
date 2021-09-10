<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_query;
if ( isset( $_REQUEST['load_type'] ) && WP_Job_Board_Mixes::is_ajax_request() ) {
	if ( 'items' !== $_REQUEST['load_type'] ) {
        echo WP_Job_Board_Template_Loader::get_template_part('archive-employer-ajax-full', array('employers' => $wp_query));
	} else {
		echo WP_Job_Board_Template_Loader::get_template_part('archive-employer-ajax-employers', array('employers' => $wp_query));
	}

} else {
	get_header();
	$sidebar_configs = workio_get_employers_layout_configs();

	workio_render_breadcrumbs();
	?>

	<?php if ( workio_get_employer_layout_type() == 'main' && is_active_sidebar( 'employers-filter-top-sidebar' ) ) { ?>
		<div class="employers-filter-top-sidebar-wrapper filter-employer-sidebar-wrapper">
	   		<?php dynamic_sidebar( 'employers-filter-top-sidebar' ); ?>
	   	</div>
	<?php } ?>
	
	<section id="main-container" class="main-content <?php echo apply_filters('workio_employer_content_class', 'container');?> inner">
		<?php workio_before_content( $sidebar_configs ); ?>
		<div class="row">
			<?php workio_display_sidebar_left( $sidebar_configs ); ?>

			<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
				<main id="main" class="site-main" role="main">

					<?php
						echo WP_Job_Board_Template_Loader::get_template_part('loop/employer/archive-inner', array('employers' => $wp_query));

						echo WP_Job_Board_Template_Loader::get_template_part('loop/employer/pagination', array('employers' => $wp_query));
					?>
					
				</main><!-- .site-main -->
			</div><!-- .content-area -->
			
			<?php workio_display_sidebar_right( $sidebar_configs ); ?>
		</div>
	</section>

	<?php get_footer();
}