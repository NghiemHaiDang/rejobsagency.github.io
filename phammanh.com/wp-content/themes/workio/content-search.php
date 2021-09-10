<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Workio
 * @since Workio 1.0
 */
?>
<?php 
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
             </div>
            <?php
        }
    ?>
    <div class="entry-content <?php echo esc_attr( (!empty($thumb))?'has-image':'' ); ?>">
        <div class="top-info-blog">
            <div class="author">
                <a class="entry-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">                
                    <i class="ti-user"></i><?php echo get_the_author(); ?>                
                </a>
            </div>
            <div class="entry-date"><i class="ti-calendar"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?>
            </div>
            <div class="entry-category">
                <?php workio_post_categories_first($post); ?>
            </div>
        </div>
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>
        <div class="description hidden-xs"><?php echo workio_substring( get_the_excerpt(),40, '' ); ?></div>
        <div class="description visible-xs"><?php echo workio_substring( get_the_excerpt(),20, '' ); ?></div>
        <div class="comment hidden">
            <i class="flaticon-comment" aria-hidden="true"></i><span class="comments"><?php comments_number( '0', '1', '%' ); ?></span>
        </div>
    </div>
</article>