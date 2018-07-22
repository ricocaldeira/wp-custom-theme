<?php 
/* get categories */
$taxo = 'product_cat';
$_category = array();
if(!isset($atts['cat']) || $atts['cat']==''){
    $terms = get_terms($taxo);
    foreach ($terms as $cat){
        $_category[] = $cat->term_id;
    }
} else {
    $_category  = explode(',', $atts['cat']);
}
$atts['categories'] = $_category;
?>
<div class="woocommerce cms-grid-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
        <div class="cms-grid-filter cms-filter-wrap container">
            <ul class="cms-filter-category portfolio-filter clearfix">
                <li><a class="active" href="#" data-group="all"><?php echo esc_html('All products', 'wp-elementy'); ?></a></li>
                <?php 
                if(is_array($atts['categories']))
                foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxo );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo esc_html($term->name);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="pb-55 cms-product text-center <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                

                <div class="cms-woo-item-wrap">
                    <?php
                    /**
                     * woocommerce_before_shop_loop_item hook.
                     *
                     * @hooked woocommerce_template_loop_product_link_open - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item' );

                    /**
                     * woocommerce_before_shop_loop_item_title hook.
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );

                    ?>
                        <h4 class="woo-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                    <?php

                    /**
                     * woocommerce_after_shop_loop_item_title hook.
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    ?>
                    <div class="woo-btn-action clearfix">
                        <div class="woo-btn-action-inner">
                            <?php
                                /**
                                 * woocommerce_after_shop_loop_item hook.
                                 *
                                 * @hooked woocommerce_template_loop_product_link_close - 5
                                 * @hooked woocommerce_template_loop_add_to_cart - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop_item' );
                                do_action('wp_elementy_add_to_wishlist_custom_btn');
                            ?>  
                        </div>
                    </div>
                </div>


            </div>
            <?php
        }
        ?>
    </div>
    <?php if (!empty($atts['cms_pagination']) && $atts['cms_pagination'] == true) wp_elementy_paging_nav(); ?>
</div>