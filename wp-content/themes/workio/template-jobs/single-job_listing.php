<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

?>
<section class="detail-version-v1">
	
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<!-- heading -->
				<?php echo WP_Job_Board_Template_Loader::get_template_part( 'single-job_listing/header' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>

	<section id="primary" class="content-area inner">
		<div id="main" class="site-main content" role="main">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post();
					global $post;
					$latitude = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'map_location_latitude', true );
					$longitude = WP_Job_Board_Job_Listing::get_post_meta( $post->ID, 'map_location_longitude', true );
				?>
					<div class="single-listing-wrapper" data-latitude="<?php echo esc_attr($latitude); ?>" data-longitude="<?php echo esc_attr($longitude); ?>">
						<?php
							echo WP_Job_Board_Template_Loader::get_template_part( 'content-single-job_listing' );
							
						?>
					</div>
				<?php endwhile; ?>

				<?php the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Previous page', 'workio' ),
					'next_text'          => esc_html__( 'Next page', 'workio' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'workio' ) . ' </span>',
				) ); ?>
			<?php else : ?>
				<div class="<?php echo apply_filters('workio_job_content_class', 'container');?>">
					<?php get_template_part( 'content', 'none' ); ?>
				</div>
			<?php endif; ?>
		</div><!-- .site-main -->
	</section><!-- .content-area -->
</section>
<?php get_footer(); ?>
