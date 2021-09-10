<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$jobs_display_mode = workio_get_jobs_display_mode();
$job_inner_style = workio_get_jobs_inner_style();
$job_inner_list_style = workio_get_jobs_inner_list_style();

$args = array(
	'jobs' => $jobs,
	'job_inner_style' => $job_inner_style,
	'job_inner_list_style' => $job_inner_list_style,
	'jobs_display_mode' => $jobs_display_mode,
);

echo WP_Job_Board_Template_Loader::get_template_part('loop/job/archive-inner', $args);

echo WP_Job_Board_Template_Loader::get_template_part('loop/job/pagination', array('jobs' => $jobs));
