<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Workio
 * @since Workio 1.0
 */

get_header();
$sidebar_configs = workio_get_blog_layout_configs();

$columns = workio_get_config('blog_columns', 1);
$bscol = floor( 12 / $columns );
$_count  = 0;

workio_render_breadcrumbs();
?>
<section id="main-container" class="main-content  <?php echo apply_filters('workio_blog_content_class', 'container');?> inner">
		
	<a href="javascript:void(0)" class="mobile-sidebar-btn hidden-lg hidden-md <?php echo esc_attr( (isset($sidebar_configs['left']))?'mobile-left':'mobile-right' ); ?>"> <i class="fa fa-bars"></i></a>

	<div class="mobile-sidebar-panel-overlay"></div>
	<div class="row">
		<div id="main-content" class="col-xs-12 <?php echo esc_attr( is_active_sidebar( 'sidebar-default' ) ? 'col-md-8' : 'col-md-12'); ?>">
			<main id="main" class="site-main layout-blog" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header hidden">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				<div class="layout-posts-list">
				    <div class="jobs-wrapper items-wrapper">
							<div class="row">
					<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
                        if (get_post_type($post->ID) == 'job_listing') {
                            do_action( 'wp_job_board_before_job_content', $post->ID ); ?>

                            <div class="col-sm-6 col-md-4 col-xs-12">
                                <article <?php post_class('job-grid job-grid-default map-item job-style-inner'); ?> <?php workio_job_item_map_meta($post); ?>>
                                <?php workio_job_display_featured_urgent_label($post); ?>
                                <?php workio_job_display_job_type($post); ?>
                                <?php workio_job_display_employer_logo($post); ?>
                            
                                <div class="job-information">
                                    <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                                    <?php workio_job_display_full_location($post, 'icon'); ?>
                                    <?php workio_job_display_tags($post, 'no-title'); ?>
                            	</div>
                                <div class="job-metas">
                                    <?php workio_job_display_salary($post, 'no-icon-title'); ?>
                                    <?php workio_job_display_add_shortlist_btn($post); ?>           
                                </div>
                            </article><!-- #post-## -->
                            
                            <?php do_action( 'wp_job_board_after_job_content', $post->ID ); ?>
                            </div>
                        <?php }
                        
                        elseif (get_post_type($post->ID) == 'employer') {
                            header ('Location: /?filter-author='.$post->post_author);
						    //echo $post->post_author;
                        }
                        ?>
					
							<?php //get_template_part( 'content', 'search' ); ?>
						<?php
						$_count++;
					// End the loop.
					endwhile; ?>
				</div> </div> </div>
				<?php 
				// Previous/next page navigation.
				workio_paging_nav();

			// If no content, include the "No posts found" template.
			else :
				//get_template_part( 'template-posts/content', 'none' );
				header ('Location: /404-khong-tim-thay-noi-dung/');

			endif;
			?>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
		<?php if ( is_active_sidebar( 'sidebar-default' ) ): ?>
			<div class="col-md-4 col-sm-12 col-xs-12 ">
				<div class="sidebar sidebar-right">
		        	
		   			<?php dynamic_sidebar('sidebar-default'); ?>
			   		
	           	</div>
	        </div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>