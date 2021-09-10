<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Workio
 * @since Workio 1.0
 */
$footer = apply_filters( 'workio_get_footer_layout', 'default' );
global $post;
?>
	</div><!-- .site-content -->
	<?php if ( basename( get_page_template() ) == 'page-dashboard.php' ) {?>
		<div class="wrapper-footer-dashboard <?php echo esc_attr(get_post_meta( $post->ID, 'apus_page_layout', true )); ?>">
	<?php } ?>
		<?php if ( !empty($footer) ): ?>
			<?php workio_display_footer_builder($footer); ?>
		<?php else: ?>
			<footer id="apus-footer" class="apus-footer " role="contentinfo">
				<div class="footer-default">
					<div class="apus-footer-inner">
						<div class="apus-copyright">
							<div class="container">
								<div class="copyright-content clearfix">
									<div class="text-copyright text-center">
										<?php
											
											$allowed_html_array = array( 'a' => array('href' => array()) );
											echo wp_kses(sprintf(__('&copy; %s - Workio. All Rights Reserved. <br/> Powered by <a href="//themeforest.net/user/apuswp">ApusWP</a>', 'workio'), date("Y")), $allowed_html_array);
										?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer><!-- .site-footer -->
		<?php endif; ?>
	<?php if ( basename( get_page_template() ) == 'page-dashboard.php' ) {?>
		</div>
	<?php } ?>
	<?php
	if ( workio_get_config('back_to_top') ) { ?>
		<a href="#" id="back-to-top" class="add-fix-top">
			<i class="flaticon-startup"></i>
		</a>
	<?php
	}
	?>
</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>