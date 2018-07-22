<?php
    /* get categories */
    $taxo = 'category-portfolio';
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

    $gutter = $thumb_size = '';
    $gutter = ( !empty($atts['cms_portfolio_gutter']) ) ? $atts['cms_portfolio_gutter'] : '0px';
    $thumb_size = (!empty($atts['cms_portfolio_thumbsize'])) ? $atts['cms_portfolio_thumbsize'] : 'elementy-thumbnail-square';

    $related_layout = (!empty($atts['related_layout'])) ? $atts['related_layout'] : '';

    $link = (isset($atts['link'])) ? $atts['link'] : '';
    $link = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href = $link['url'];
        $a_title = $link['title'];
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
    $cms_readmore_style = (!empty($atts['cms_readmore_style'])) ? $atts['cms_readmore_style'] : 'full';
    $heading = (!empty($atts['cms_portfolio_heading'])) ? $atts['cms_portfolio_heading'] : '';
    $font_family = (!empty($atts['font-family-heading'])) ? $atts['font-family-heading'] : 'font-poppins';
    $cms_portf_special = (!empty($atts['cms_portf_special'])) ? $atts['cms_portf_special'] : '';
    $cms_portf_special_text = (!empty($atts['cms_portf_special_text'])) ? $atts['cms_portf_special_text'] : '';
    $cms_readmore_font_size = (!empty($atts['cms_readmore_font_size'])) ? $atts['cms_readmore_font_size'] : '';
?>
<?php if (!empty($related_layout)): ?>
    <div class="<?php echo esc_attr($atts['grid_class']);?>" style="margin-left: -<?php echo esc_attr($gutter) ?>">
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
            <div class="cms-portfolio-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="portfolio-item-inner" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                    <div class="related-thumb">
                        <a href="<?php the_permalink(); ?>" class="">
                            <?php
                                if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                    $thumbnail = get_the_post_thumbnail(get_the_ID(), 'elementy-related');
                                else:
                                    $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                                endif;

                                echo balanceTags($thumbnail);
                            ?>
                        </a>
                    </div>
                    <div class="related-title">
                        <h5>
                            <a href="<?php the_permalink(); ?>" class="">
                                <?php the_title(); ?>
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
<?php else: ?>
    <?php if (empty($cms_portf_special)) : ?>
    <div class="cms-grid-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
        <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
            <div class="cms-filter-wrap cms-grid-filter container">
                <div class="cms-grid-filter-inphone hidden">
                    <a href="#"><span><?php esc_html_e('Select Filter', 'wp-elementy');?></span></a>
                </div>
                <ul class="cms-filter-category portfolio-filter clearfix <?php echo esc_attr($font_family); ?>">
                    <li class="<?php echo esc_attr($font_family); ?>"><a class="active" href="#" data-group="all"><?php echo esc_html('All project', 'wp-elementy'); ?></a></li>
                    <?php 
                    if(is_array($atts['categories']))
                    foreach($atts['categories'] as $category):?>
                        <?php $term = get_term( $category, $taxo );?>
                        <li class="<?php echo esc_attr($font_family); ?>"><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                                <?php echo esc_html($term->name);?>
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>
        <div class="clearfix <?php echo esc_attr($atts['grid_class']);?>" style="margin-left: -<?php echo esc_attr($gutter) ?>">
            <?php if ($heading) : ?>
                <div class="cms-portfolio-item cms-portfolio-heading-item <?php echo esc_attr($atts['item_class']);?>">
                    <div class="portfolio-item-heading" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                        <div class="port-img-overlay">
                            <?php
                                $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/bg-black.png" alt="'.get_the_title().'" />';
                                echo balanceTags($thumbnail);
                            ?>
                        </div>
                        <div class="block-center">
                            <div class="port-heading <?php echo esc_attr($font_family); ?>">
                                <?php echo wp_kses($heading, array('i' => array(), 'br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

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
                <div class="cms-portfolio-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                    <div class="portfolio-item-inner" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                        <div class="port-img-overlay">
                            <?php 
                                if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                    $thumbnail = get_the_post_thumbnail(get_the_ID(), $thumb_size);
                                else:
                                    $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                                endif;

                                echo balanceTags($thumbnail);
                            ?>
                        </div>
                        <div class="port-overlay-cont">
                            <div class="port-cont-inner">
                                <h4>
                                    <a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($font_family); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                                <div class="port-cat-wrap <?php echo ($font_family == 'font-raleway') ? esc_attr($font_family) : ''; ?>">
                                    <?php echo get_the_term_list( get_the_ID(), $taxo, '', ', ', '' ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php if (!empty($atts['cms_pagination']) && $atts['cms_pagination'] == true) wp_elementy_paging_nav(); ?>
        <?php if ($use_link == true): ?>
            <div class="cms-grid-viewall <?php echo esc_attr($cms_readmore_style); ?> clearfix" style="min-height: 95px;">
                <div class="cms-button-wrap">
                    <a class="<?php echo esc_attr($font_family.' '.$cms_readmore_font_size); ?>" href="<?php echo esc_url($a_href) ?>" title="<?php echo esc_attr($a_title); ?>" target="<?php echo esc_attr($a_target); ?>">
                        <span><?php echo esc_html($a_title); ?></span>
                    </a>
                </div>
            </div>
        <?php endif ?>
    </div>

    <?php else : 
        $posts = $atts['posts'];
        $port_query = $posts->query;
        $port_lists = $posts->posts;
        $_posts_per_page = $port_query['posts_per_page'];
        global $post;

        for ( $i = 0; $i < 3; $i++ ) { ?>
            <?php
                if ( !empty($port_lists[$i]) ) : 
                    $post = $port_lists[$i];
                setup_postdata($post); 
            ?>
                <div class="cms-portfolio-item portf-cpecial-item <?php echo esc_attr($atts['item_class']);?>">
                    <div class="portfolio-item-inner" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                        <div class="port-img-overlay">
                            <?php 
                                if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                    $thumbnail = get_the_post_thumbnail(get_the_ID(), $thumb_size);
                                else:
                                    $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                                endif;

                                echo balanceTags($thumbnail);
                            ?>
                        </div>
                        <div class="port-content-wrap">
                            <div class="port-cont-inner">
                                <h3 class="<?php echo esc_attr($font_family); ?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <a class="readmore" href="<?php the_permalink(); ?>">
                                    <?php esc_html_e('Read More', 'wp-elementy'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php
            wp_reset_postdata();
            } 
        ?>

        <?php if ( !empty($cms_portf_special_text)) : ?>
            <div class="cms-portfolio-item portf-cpecial-item text-intro-item <?php echo esc_attr($atts['item_class']);?>">
                <div class="portfolio-item-inner" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                    <div class="port-img-overlay">
                        <?php
                            echo '<img src="'.get_template_directory_uri().'/assets/images/bg-red-cube.png" alt="" />';
                        ?>
                    </div>
                    <div class="port-content-wrap">
                        <div class="port-cont-inner">
                            <h3>
                                <?php echo esc_html($cms_portf_special_text); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div> 
        <?php endif; ?>

        <?php if ( $use_link == true) : ?>
            <div class="cms-portfolio-item portf-cpecial-item readmore-item <?php echo esc_attr($atts['item_class']);?>">
                <div class="portfolio-item-inner" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                    <a href="<?php echo esc_url($a_href) ?>" title="<?php echo esc_attr($a_title); ?>" target="<?php echo esc_attr($a_target); ?>">
                        <div class="port-img-overlay">
                            <?php
                                echo '<img src="'.get_template_directory_uri().'/assets/images/bg-red-cube.png" alt="" />';
                            ?>
                        </div>
                        <div class="port-content-wrap">
                            <div class="port-cont-inner">
                                <div class="text">
                                    <?php echo (!empty($a_title)) ? $a_title : esc_html_e('View More', 'wp-elementy'); ?>    
                                </div>
                                <div class="icon icon-arrows-slim-right"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;

        for ( $i = 3; $i < $_posts_per_page; $i++ ) { ?>
            <?php
                if ( !empty($port_lists[$i]) ) : 
                    $post = $port_lists[$i];
                setup_postdata($post);
            ?>
                <div class="cms-portfolio-item portf-cpecial-item <?php echo esc_attr($atts['item_class']);?>">
                    <div class="portfolio-item-inner" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                        <div class="port-img-overlay">
                            <?php 
                                if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                    $thumbnail = get_the_post_thumbnail(get_the_ID(), array(960, 480));
                                else:
                                    $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                                endif;

                                echo balanceTags($thumbnail);
                            ?>
                        </div>
                        <div class="port-content-wrap">
                            <div class="port-cont-inner">
                                <h3 class="<?php echo esc_attr($font_family); ?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <a class="readmore" href="<?php the_permalink(); ?>">
                                    <?php esc_html_e('Read More', 'wp-elementy'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php
            wp_reset_postdata();
            } 
        ?>
    <?php endif; ?>
<?php endif ?>