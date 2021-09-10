<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$experience = WP_Job_Board_Candidate::get_post_meta($post->ID, 'experience', true );

if ( !empty($experience) ) {
?>
    <div id="job-candidate-experience" class="candidate-detail-experience my_resume_eduarea">
        <h4 class="title"><?php esc_html_e('Work &amp; Experience', 'workio'); ?></h4>
        <div class="candidate-detail-resume">
            <?php foreach ($experience as $item) { ?>
                <dl class="content">
                    <dt class="heading-detail-info">
                        <?php if ( !empty($item['title']) ) { ?>
                            <span><?php echo esc_html($item['title']); ?></span>
                        <?php } ?>

                        <?php if ( !empty($item['start_date']) || !empty($item['end_date']) ) { ?>
                            <span class="start_date">
                                <?php if ( !empty($item['start_date']) ) { ?>
                                    <?php echo esc_html($item['start_date']); ?>
                                <?php } ?>
                                <?php if ( !empty($item['end_date']) ) { ?>
                                    - <?php echo esc_html($item['end_date']); ?>
                                <?php } ?>
                            </span>
                        <?php } ?>
                    </dt>
                    <dd>          
                        <?php if ( !empty($item['company']) ) { ?>
                            <h3 class="title-detail-info"><?php echo esc_html($item['company']); ?></h3>
                        <?php } ?>            
                        <?php if ( !empty($item['description']) ) { ?>
                            <p class="mb0 candidate-detail-description"><?php echo esc_html($item['description']); ?></p>                    
                        <?php } ?>
                    </dd>
                </dl>
            <?php } ?>
        </div>     
    </div>
<?php }