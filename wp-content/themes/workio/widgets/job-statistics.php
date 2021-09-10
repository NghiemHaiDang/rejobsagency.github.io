<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
if ( empty($post->post_type) || $post->post_type != 'job_listing' ) {
    return;
}
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

?>
<div class="job-detail-statistic">
    <?php if ( $show_post_date ) { ?>
    	<div class="statistic-item flex-middle">
            <div class="icon text-theme">
        		<i class="flaticon-calendar"></i>
            </div>
    		<span class="text"><?php echo sprintf(wp_kses(__('<span class="number">%s</span> ago', 'workio'), array('span' => array('class' => array()))), human_time_diff(get_the_time('U'), current_time('timestamp')) ); ?></span>
    	</div>
    <?php } ?>

    <?php if ( $show_views ) {
    	$views = intval(get_post_meta($post->ID, '_viewed_count', true));
	?>
    	<div class="statistic-item flex-middle">
            <div class="icon text-theme">
        		<i class="flaticon-visibility"></i>
            </div>
    		<span class="text"><?php echo sprintf(_n('<span class="number">%d</span> View', '<span class="number">%d</span> Views', intval($views), 'workio'), intval($views)); ?></span>
    	</div>
    <?php } ?>

    <?php if ( $show_applicants ) {
		$total = WP_Job_Board_Job_Listing::count_applicants($post->ID);
	?>
    	<div class="statistic-item flex-middle">
            <div class="icon text-theme">
    		  <i class="flaticon-mobile"></i>
            </div>
    		<span class="text"><?php echo sprintf(_n('<span class="number">%d</span> Applicant', '<span class="number">%d</span> Applicants', intval($total), 'workio'), intval($total)); ?></span>
    	</div>
    <?php } ?>

</div>