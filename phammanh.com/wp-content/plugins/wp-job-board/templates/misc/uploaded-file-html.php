<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$input_name = isset($input_name) ? $input_name : '';
?>
<div class="wp-job-board-uploaded-file">
	<?php
	if ( !isset($file_url) ) {

		if ( is_numeric( $value ) ) {
			$image_src = wp_get_attachment_image_src( absint( $value ) );
			$file_url = $image_src ? $image_src[0] : '';

			$mime_type = get_post_mime_type($value);
		} else {
			$file_url = $value;
			$value = WP_Job_Board_Image::get_attachment_id_from_url($value);

			$mime_type = get_post_mime_type($value);
		}
	}

	switch ($mime_type) {
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
			?>
			<span class="wp-job-board-uploaded-file-preview"><img src="<?php echo $file_url; ?>" /> <a class="wp-job-board-remove-uploaded-file" href="#">[<?php _e( 'remove', 'wp-job-board' ); ?>]</a></span>
			<?php
			break;
		default:
			?>
			<span class="wp-job-board-uploaded-file-name"><code><?php echo esc_html( basename( $file_url ) ); ?></code> <a class="wp-job-board-remove-uploaded-file" href="#">[<?php _e( 'remove', 'wp-job-board' ); ?>]</a></span>
			<?php
			break;
	}
	
	?>

	<input type="hidden" class="input-text" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	
</div>