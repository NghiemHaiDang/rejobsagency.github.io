<?php 
global $post;
$thumbsize = !isset($thumbsize) ? workio_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = workio_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-list-item'); ?>>    
    <?php
        if ( !empty($thumb) ) {
            ?>
            <div class="top-image">
                <?php
                    echo trim($thumb);
                ?>
                <?php workio_post_categories_first($post); ?>
             </div>
            <?php
        }
    ?>
    <div class="entry-content <?php echo esc_attr( (!empty($thumb))?'has-image':'' ); ?>">
        <?php 
            if ( is_sticky() && is_home() && ! is_paged() ) {
                printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'workio' ) );
            }
        ?>
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>
        <div class="top-info-blog">
            <div class="entry-date"><i class="fa fa-calendar-check-o text-theme"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?>
            </div>
            <?php if(empty($thumb)){ ?>
                <div class="entry-category">
                    <?php workio_post_categories_first($post); ?>
                </div>
            <?php } ?>
            <div class="comment">
                <div class="visible-xs">
                    <i class="fa fa-calendar-check-o text-theme"></i><span class="comments"><?php comments_number( esc_html__('0', 'workio'), esc_html__('1', 'workio'), esc_html__('%', 'workio') ); ?></span>
                </div>
                <div class="hidden-xs">
                    <i class="fa fa-calendar-check-o text-theme"></i><span class="comments"><?php comments_number( esc_html__('0 Comments', 'workio'), esc_html__('1 Comment', 'workio'), esc_html__('% Comments', 'workio') ); ?></span>
                </div>
            </div>
        </div>
        <div class="description hidden-xs"><?php echo workio_substring( get_the_excerpt(),35, '...' ); ?></div>
        <div class="description visible-xs"><?php echo workio_substring( get_the_excerpt(),20, '' ); ?></div>
        <div class="more">
            <a class="readmore" href="<?php the_permalink(); ?>">
                <?php echo esc_html__('Read More','workio') ?><i class="fa fa-angle-double-right"></i>
            </a>
        </div>
    </div>
</article>