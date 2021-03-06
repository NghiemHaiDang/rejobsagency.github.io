<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Workio
 * @since Workio 1.0
 */
/*
*Template Name: Employers Template
*/

if ( isset( $_REQUEST['load_type'] ) && WP_Job_Board_Mixes::is_ajax_request() ) {
	if ( get_query_var( 'paged' ) ) {
	    $paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
	    $paged = get_query_var( 'page' );
	} else {
	    $paged = 1;
	}

	$query_args = array(
		'post_type' => 'employer',
	    'post_status' => 'publish',
	    'post_per_page' => wp_job_board_get_option('number_employers_per_page', 10),
	    'paged' => $paged,
	);
	$params = null;
	if ( WP_Job_Board_Employer_Filter::has_filter() ) {
		$params = $_GET;
	}
	$employers = WP_Job_Board_Query::get_posts($query_args, $params);
	
	if ( 'items' !== $_REQUEST['load_type'] ) {
		echo WP_Job_Board_Template_Loader::get_template_part('archive-employer-ajax-full', array('employers' => $employers));
	} else {
		echo WP_Job_Board_Template_Loader::get_template_part('archive-employer-ajax-employers', array('employers' => $employers));
	}
} else {
	get_header();
	$sidebar_configs = workio_get_page_layout_configs();
	workio_render_breadcrumbs();
	?>

	<?php if ( workio_get_employer_layout_type() == 'main' && is_active_sidebar( 'employers-filter-top-sidebar' ) ) { ?>
		<div class="employers-filter-top-sidebar-wrapper filter-employer-sidebar-wrapper">
	   		<?php dynamic_sidebar( 'employers-filter-top-sidebar' ); ?>
	   	</div>
	<?php } ?>

	<section id="main-container" class="main-content <?php echo apply_filters('workio_page_content_class', 'container');?> inner">
		<?php workio_before_content( $sidebar_configs ); ?>
		<div class="row">
			<?php workio_display_sidebar_left( $sidebar_configs ); ?>

			<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
				<main id="main" class="site-main" role="main">

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
						
						// Include the page content template.
						the_content();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					// End the loop.
					endwhile;
					?>
					
				</main><!-- .site-main -->
			</div><!-- .content-area -->
			
			<?php workio_display_sidebar_right( $sidebar_configs ); ?>
		</div>
	</section>

	<?php get_footer();
}