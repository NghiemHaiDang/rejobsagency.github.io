<?php 
global $product;
$product_id = $product->get_id();
?>
<div class="product-block grid" data-product-id="<?php echo esc_attr($product_id); ?>">
    <div class="grid-inner">
        <div class="block-inner">
            <figure class="image">
                <?php
                    $image_size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';
                    workio_product_image($image_size);
                ?>

                <?php
                    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
                    remove_action('woocommerce_before_shop_loop_item_title', 'workio_swap_images', 10);
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
            </figure>

        </div>
        <div class="metas">            
            <div class="products-grid-meta">
                <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php
                    /**
                    * woocommerce_after_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_template_loop_rating - 5
                    * @hooked woocommerce_template_loop_price - 10
                    */
                    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
                    do_action( 'woocommerce_after_shop_loop_item_title');
                ?>    
            </div>
            <div class="groups-button">
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>                    
                <?php if (workio_get_config('show_quickview', false)) { ?>
                    <div class="view">
                        <a href="#" class="quickview" data-product_id="<?php echo esc_attr($product_id); ?>" data-toggle="modal" data-target="#apus-quickview-modal">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>             
        </div>
    </div>
</div>