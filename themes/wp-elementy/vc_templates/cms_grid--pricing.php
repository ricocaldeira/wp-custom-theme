<?php 
    /* get categories */
    $taxo = 'category-pricing';
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

    $pricing_layout = !empty( $atts['cms_pricing_layout'] ) ? $atts['cms_pricing_layout'] : 'layout1';
?>
<div class="cms-grid-wraper cms-grid-pricing clearfix <?php echo esc_attr($pricing_layout);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="cms-grid <?php echo esc_attr($atts['grid_class']);?> cms-pricing-item-wrap row">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()) {
            $posts->the_post();
            $pricing_value = wp_elementy_get_meta_option('pricing_value');
            $pricing_price = wp_elementy_get_meta_option('pricing_price');
            $pricing_time = wp_elementy_get_meta_option('pricing_time');
            $pricing_button_url = wp_elementy_get_meta_option('pricing_button_url');
            $pricing_button_text = wp_elementy_get_meta_option('pricing_button_text');
            $pricing_is_feature = wp_elementy_get_meta_option('pricing_is_feature');

            ?>
            <div class="cms-grid-item cms-grid-item-pricing <?php echo esc_attr($atts['item_class']);?>">
                <div class="cms-pricing-item-inner <?php echo ( $pricing_is_feature == 1 ) ? ' pricing-feature-item' : '' ?>">
                    <h1 class="cms-pricing-title <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">
                        <?php the_title();?>
                    </h1>
                    <div class="price-heading <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">
    					<span class="currency"><?php echo esc_html($pricing_price) ?></span><span class="price"><?php echo esc_html($pricing_value); ?></span>
    					<span class="time">
    						<?php echo esc_html($pricing_time) ?>
    					</span>	
    				</div>
    				<div class="price-content <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">		
    					<?php the_content(); ?>
    				</div>
    				<div class="price-button <?php echo ( $pricing_is_feature == 1 ) ? ' pr-feature' : '' ?>">
    					<?php
                            if ( $pricing_is_feature == 1 ) {
                                echo '<a class="cms-button md cms-default cms-shape-rounded" href="'. esc_url($pricing_button_url) .'">'. esc_html($pricing_button_text) .'</a>';
                            } else {
                                echo '<a class="cms-button md cms-border cms-shape-rounded" href="'. esc_url($pricing_button_url) .'">'. esc_html($pricing_button_text) .'</a>';
                            }
                        ?>
    				</div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>