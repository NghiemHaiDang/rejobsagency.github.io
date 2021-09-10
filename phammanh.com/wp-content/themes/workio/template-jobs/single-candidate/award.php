<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$award = WP_Job_Board_Candidate::get_post_meta($post->ID, 'award', true );

if ( !empty($award) ) {
?>
    <div id="job-candidate-award" class="my_resume_eduarea">
        <h4 class="title"><?php esc_html_e('Awards', 'workio'); ?></h4>
        <div class="candidate-detail-resume candidate-detail-awards">
            <?php foreach ($award as $item) { ?>
                <dl class="content">
                    <dt class="heading-detail-info">
                        <?php if ( !empty($item['title']) ) { ?>
                            <span><?php echo esc_html($item['title']); ?></span>
                        <?php } ?>
                        <?php if ( !empty($item['year']) ) { ?>
                            <span class="year"><?php echo esc_html($item['year']); ?></span>
                        <?php } ?>
                    </dt>
                    <dd>
                        <?php if ( !empty($item['description']) ) { ?>
                            <p class="mb0 candidate-detail-description"><?php echo esc_html($item['description']); ?></p>
                        <?php } ?>                        
                    </dd>
                </dl>
            <?php } ?>
        </div>
    </div>
<?php }