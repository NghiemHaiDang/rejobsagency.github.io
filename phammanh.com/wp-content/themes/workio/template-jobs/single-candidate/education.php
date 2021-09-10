<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$education = WP_Job_Board_Candidate::get_post_meta($post->ID, 'education', true );

if ( !empty($education) ) {
?>
    <div id="job-candidate-education" class="candidate-detail-education my_resume_eduarea">
        <h4 class="title"><?php esc_html_e('Education', 'workio'); ?></h4>
        <div class="candidate-detail-resume">
            <?php foreach ($education as $item) { ?>
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
                        <?php if ( !empty($item['academy']) ) { ?>
                            <h3 class="title-detail-info"><?php echo esc_html($item['academy']); ?></h3>
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