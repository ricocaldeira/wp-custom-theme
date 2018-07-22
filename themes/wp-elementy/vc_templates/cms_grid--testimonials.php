<?php 
    /* get categories */
    $taxo = 'category-testimonial';
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
    $cms_testi_layout = (!empty($atts['cms_testi_layout'])) ? $atts['cms_testi_layout'] : 'layout1';
?>
<div class="cms-grid-wraper cms-grid-testimonials cms-grid-testimonials-<?php echo esc_attr($cms_testi_layout); ?> clearfix <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="cms-grid <?php echo esc_attr($atts['grid_class']);?> cms-gird-testimonials-item-wrap row">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();

            $testi_position = (!empty(wp_elementy_get_meta_option('page_testimonial_position'))) ? wp_elementy_get_meta_option('page_testimonial_position') : '';
            ?>
            <div class="cms-testimonials-wrap <?php echo esc_attr($atts['item_class']);?> mb-30 layout4 clearfix">
                <div class="cms-testi-text">
                    <?php echo esc_attr(get_the_content()); ?>
                </div>
                <div class="cms-testi-author-wrap">
                    <div class="cms-img-container">
                        <?php 
                            if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                $class = 'has-thumbnail cms-grid-testimonials-media';
                                $thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                            else:
                                $class = ' no-image cms-grid-testimonials-media';
                                $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                            endif;

                            echo balanceTags($thumbnail);
                        ?>
                    </div>
                    <div class="cms-small-author">
                        <span class="author-testimonial"><?php the_title(); ?></span>
                        <span class="quote-author-description">
                            <?php echo esc_attr($testi_position); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>