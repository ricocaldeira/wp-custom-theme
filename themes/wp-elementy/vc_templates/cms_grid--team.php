<?php 
    /* get categories */
    $taxo = 'category-team';
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
    $cms_readmore_font_size = (!empty($atts['cms_readmore_font_size'])) ? $atts['cms_readmore_font_size'] : '';
?>
<div class="cms-grid-wraper cms-grid-team-wrap clearfix" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
        <div class="cms-filter-wrap cms-grid-filter container">
            <div class="cms-grid-filter-inphone hidden">
                <a href="#"><span><?php esc_html_e('Select Filter', 'wp-elementy');?></span></a>
            </div>
            <ul class="cms-filter-category portfolio-filter clearfix">
                <li><a class="active" href="#" data-group="all"><?php echo esc_html('All Team', 'wp-elementy'); ?></a></li>
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

    <div class="cms-grid <?php echo esc_attr($atts['grid_class']);?> cms-team-wrap row mb-40">
        <?php
        $posts = $atts['posts'];
        $groups = array();
        $groups[] = '"all"';
        foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
            $groups[] = '"category-'.$category->slug.'"';
        }
        $i = 0;
        while($posts->have_posts()) {
            $posts->the_post();
            $team_role = wp_elementy_get_meta_option('page_team_role');
            $team_fb = wp_elementy_get_meta_option('page_team_fb');
            $team_twitter = wp_elementy_get_meta_option('page_team_twitter');
            $team_dribbble = wp_elementy_get_meta_option('page_team_dribbble');
            $team_linkedin = wp_elementy_get_meta_option('page_team_linkedin');
            ?>
            <div class="cms-grid-team <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="cms-team-inner mb-30 text-center wow fadeInUp" data-wow-delay="<?php echo esc_attr($i*200); ?>ms">
                    <div class="team-image">
                        <?php 
                            if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                $thumbnail = get_the_post_thumbnail(get_the_ID(), 'elementy-thumbnail-square');
                            else:
                                $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                            endif;

                            echo balanceTags($thumbnail);
                        ?>
                    </div>  
                    <h3 class="team-title">
                        <?php the_title();?>
                    </h3>
                    <?php if (!empty($team_role)): ?>
                        <span class="team-role">
                            <?php echo esc_html($team_role); ?>
                        </span>    
                    <?php endif ?>
                    <ul class="team-scials-wrap">
                        <?php if (!empty($team_fb)): ?>
                            <li>
                               <a href="<?php echo esc_url($team_fb); ?>"><i class="social_facebook"></i></a> 
                            </li>    
                        <?php endif ?>
                        <?php if (!empty($team_twitter)): ?>
                            <li>
                               <a href="<?php echo esc_url($team_twitter); ?>"><i class="social_twitter"></i></a> 
                            </li>    
                        <?php endif ?>
                        <?php if (!empty($team_dribbble)): ?>
                            <li>
                               <a href="<?php echo esc_url($team_dribbble); ?>"><i class="social_dribbble"></i></a> 
                            </li>    
                        <?php endif ?>
                        <?php if (!empty($team_linkedin)): ?>
                            <li>
                               <a href="<?php echo esc_url($team_linkedin); ?>"><i class="social_linkedin"></i></a> 
                            </li>    
                        <?php endif ?>
                    </ul>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
    <?php if ($use_link == true): ?>
        <div class="cms-grid-viewall <?php echo esc_attr($cms_readmore_style); ?> clearfix" style="min-height: 95px;">
            <div class="cms-button-wrap">
                <a class="<?php echo esc_attr($cms_readmore_font_size); ?>" href="<?php echo esc_url($a_href) ?>" title="<?php echo esc_attr($a_title); ?>" target="<?php echo esc_attr($a_target); ?>">
                    <span><?php echo esc_html($a_title); ?></span>
                </a>
            </div>
        </div>
    <?php endif ?>
</div>