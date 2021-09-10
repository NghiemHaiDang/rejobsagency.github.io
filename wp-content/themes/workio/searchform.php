<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
<div class="widget-search">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'workio' ); ?>" name="s" class="form-control"/>
		<button type="submit" class="btn btn-sm btn-search"><i class=" ti-search "></i></button>
		<input type="hidden" name="post_type" value="post" class="post_type" />
	</form>
</div>