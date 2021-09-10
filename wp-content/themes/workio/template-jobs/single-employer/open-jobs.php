<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$limit = workio_get_config('employer_releated_number', 3);
$user_id = WP_Job_Board_User::get_user_by_employer_id($post->ID);
$args = array(
    'post_type' => 'job_listing',
    'posts_per_page' => $limit,
    'author' => $user_id
);
$jobs = new WP_Query( $args );
if( $jobs->have_posts() ):
    $jobs_url = WP_Job_Board_Mixes::get_jobs_page_url();
    $jobs_url = add_query_arg( 'filter-author', $user_id, remove_query_arg( 'filter-author', $jobs_url ) );
?>
    <div class="widget-openjob">
            <div class="flex-middle top-info">
                <h4 class="title">
                    <?php esc_html_e( 'Open Position', 'workio' ); ?>
                </h4>
                <div class="ali-right">
                    <a href="<?php echo esc_url($jobs_url); ?>" class="view_all">
                        <?php echo esc_html__('Browse Full List','workio') ?><i class="ti-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="widget-content">
                <div class="row">
                    <?php
                        $i = 1;
                        while ( $jobs->have_posts() ) : $jobs->the_post();
                            ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 <?php echo esc_attr($i%2 == 1)?'md-clearfix':''; ?> <?php echo esc_attr($i%2 == 1)?'sm-clearfix':''; ?>">
                                <?php echo WP_Job_Board_Template_Loader::get_template_part( 'jobs-styles/inner-grid-v1' ); ?>
                            </div>
                            <?php
                        $i++; endwhile;
                    ?>
                </div>
                <?php wp_reset_postdata(); ?>
            </div>
    </div>
<?php endif; ?>