<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Workio
 * @since Workio 1.0
 */
/*
*Template Name: 404 Page
*/
get_header();
$icon = workio_get_config('icon-img');
$bg = workio_get_config('bg-img');
if( !empty($bg) && !empty($bg['url'])) {
	$style = " style='background-image: url(".esc_url($bg['url']).")' ";
}else{
	$style = '';
}
?>
<section class="page-404" <?php echo trim($style); ?>>
	<div id="main-container" class="inner">
		<div id="main-content" class="main-page">
			<section class="error-404 not-found clearfix">
				<div class="container">
					<div class="content-inner text-center">
						<div class="slogan">
							<h4 class="title-big">
								<?php
								$title = workio_get_config('404_title');
								if ( !empty($title) ) {
									echo esc_html($title);
								} else {
									esc_html_e('Có thể bạn đã truy cập sai trang', 'workio');
								}
								?>
							</h4>
						</div>
						<div class="top-image">
							<?php if( !empty($icon) && !empty($icon['url'])) { ?>
								<img src="<?php echo esc_url( $icon['url']); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php }else{ ?>
								<img src="<?php echo esc_url( get_template_directory_uri().'/images/404.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php } ?>
						</div>						

						<div class="page-content hidden">
							<div class="return">
								<a class="btn-theme-second btn btn-back-home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Trở lại trang chủ','workio') ?></a>
							</div>
						</div><!-- .page-content -->

					</div>
				</div>
			</section><!-- .error-404 -->
		</div><!-- .content-area -->
	</div>
</section>
<?php get_footer(); ?>