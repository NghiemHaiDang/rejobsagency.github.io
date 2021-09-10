<?php

class Workio_Widget_Job_List extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_widget_job_list',
            esc_html__('Apus Simple Jobs List', 'workio'),
            array( 'description' => esc_html__( 'Show list of job', 'workio' ), )
        );
        $this->widgetName = 'job_list';
    }

    public function getTemplate() {
        $this->template = 'job-list.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Latest Jobs',
            'number_post' => '4',
            'orderby' => '',
            'order' => '',
            'get_jobs_by' => 'recent',
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        $orderbys = array(
            '' => esc_html__('Default', 'workio'),
            'date' => esc_html__('Date', 'workio'),
            'ID' => esc_html__('ID', 'workio'),
            'author' => esc_html__('Author', 'workio'),
            'title' => esc_html__('Title', 'workio'),
            'modified' => esc_html__('Modified', 'workio'),
            'rand' => esc_html__('Random', 'workio'),
            'comment_count' => esc_html__('Comment count', 'workio'),
            'menu_order' => esc_html__('Menu order', 'workio'),
        );
        $orders = array(
            '' => esc_html__('Default', 'workio'),
            'ASC' => esc_html__('Ascending', 'workio'),
            'DESC' => esc_html__('Descending', 'workio'),
        );
        $get_jobs_bys = array(
            'featured' => esc_html__('Featured Jobs', 'workio'),
            'urgent' => esc_html__('Urgent Jobs', 'workio'),
            'recent' => esc_html__('Recent Jobs', 'workio'),
        );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'workio' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>">
                <?php echo esc_html__('Order By:', 'workio' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
                <?php foreach ($orderbys as $key => $title) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['orderby'], $key); ?> ><?php echo esc_html( $title ); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')); ?>">
                <?php echo esc_html__('Order:', 'workio' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('order')); ?>" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
                <?php foreach ($orders as $key => $title) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['order'], $key); ?> ><?php echo esc_html( $title ); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('get_jobs_by')); ?>">
                <?php echo esc_html__('Get jobs by:', 'workio' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('get_jobs_by')); ?>" name="<?php echo esc_attr($this->get_field_name('get_jobs_by')); ?>">
                <?php foreach ($get_jobs_bys as $key => $title) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['get_jobs_by'], $key); ?> ><?php echo esc_html( $title ); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'number_post' )); ?>"><?php esc_html_e( 'Num Posts:', 'workio' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_post' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_post' )); ?>" type="text" value="<?php echo esc_attr($instance['number_post']); ?>" />
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number_post'] = ( ! empty( $new_instance['number_post'] ) ) ? strip_tags( $new_instance['number_post'] ) : '';
        $instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
        $instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
        $instance['get_jobs_by'] = ( ! empty( $new_instance['get_jobs_by'] ) ) ? strip_tags( $new_instance['get_jobs_by'] ) : '';
        return $instance;

    }
}
if ( function_exists('apus_framework_reg_widget') ) {
    apus_framework_reg_widget('Workio_Widget_Job_List');
}