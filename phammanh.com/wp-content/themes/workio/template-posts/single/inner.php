<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if(has_post_thumbnail()) { ?>
        <div class="post-layout">
            <div class="top-image image-featured-detail">
                <div class="entry-thumb">
                    <?php
                        $thumb = workio_post_thumbnail();
                        echo trim($thumb);
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>

	<div class="entry-content-detail <?php echo esc_attr((has_post_thumbnail())?'has-img-featured':'' ); ?>">
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <?php the_title(); ?>
            </h4>
        <?php } ?>
        <div class="top-info-blog">
            <div class="author">
                <a class="entry-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">                
                    <i class="fa fa-user-o text-theme"></i><?php echo get_the_author(); ?>      
                </a>
            </div>
            <div class="entry-date"><i class="fa fa-calendar-check-o text-theme"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?>
            </div>
            <div class="entry-category">
                <?php workio_post_categories($post); ?>
            </div>
            <div class="comment">
                <div class="visible-xs">
                    <i class="fa fa-comment text-theme"></i><span class="comments"><?php comments_number( esc_html__('0', 'workio'), esc_html__('1', 'workio'), esc_html__('%', 'workio') ); ?></span>
                </div>
                <div class="hidden-xs">
                    <i class="fa fa-comment text-theme"></i><span class="comments"><?php comments_number( esc_html__('0 Comments', 'workio'), esc_html__('1 Comment', 'workio'), esc_html__('% Comments', 'workio') ); ?></span>
                </div>
            </div>
        </div>
    	<div class="single-info info-bottom">
            <div class="entry-description clearfix">
                <?php                    
                    the_content();
                ?>
            </div><!-- /entry-content -->
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'workio' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'workio' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
            <?php  
                $posttags = get_the_tags();
            ?>
            <?php if( !empty($posttags) || workio_get_config('show_blog_social_share', false) ){ ?>
        		<div class="tag-social clearfix">
                    <?php workio_post_tags(); ?>
        			<?php if( workio_get_config('show_blog_social_share', false) ) {
        				get_template_part( 'template-parts/sharebox' );
        			} ?>
        		</div>
            <?php } ?>
            
    	</div>
    </div>
</article>