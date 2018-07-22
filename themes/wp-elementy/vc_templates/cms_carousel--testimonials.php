<?php
$custom_class = array();
$custom_class[] = (!empty($atts['cms_arrow_outside'])) ? 'arrow-nav-outside' : '';
$custom_class[] = (!empty($atts['cms_testi_color'])) ? $atts['cms_testi_color'] : '';
$set_monserrat_font = (!empty($atts['set_monserrat_font'])) ? $atts['set_monserrat_font'] : 'font-poppins';
?>
<div class="cms-carousel owl-carousel cms-carousel-testimonial <?php echo esc_attr($atts['template']);?> <?php echo implode(' ', $custom_class); ?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php

    $posts = $atts['posts'];

    while($posts->have_posts()){
        $posts->the_post();

        $testi_position = (wp_elementy_get_meta_option('page_testimonial_position')) ? wp_elementy_get_meta_option('page_testimonial_position') : '';
    ?>
        <div class="cms-carousel-item">
            <?php
                $testi_layout = (!empty($atts['crs_testi_layout'])) ? $atts['crs_testi_layout'] : 'layout1';
                switch ($testi_layout) {
                    case 'layout2':
                        ?>
                        <div class="cms-testimonials-wrap mb-30 clearfix <?php echo esc_attr($testi_layout); ?>">
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

                                        echo  balanceTags($thumbnail);
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
                    break;

                    case 'layout3':
                        ?>
                        <div class="cms-testimonials-wrap mb-30 clearfix <?php echo esc_attr($testi_layout); ?>">
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

                                        echo ''.$thumbnail;
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
                    break;

                    case 'layout4':
                        ?>
                        <div class="cms-testimonials-wrap mb-30 clearfix <?php echo esc_attr($testi_layout); ?>">
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

                                        echo ''.$thumbnail;
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
                    break;

                    case 'layout5':
                        ?>
                        <div class="cms-testimonials-wrap mb-30 clearfix <?php echo esc_attr($testi_layout); ?>">
                            <blockquote>
                                <span class="cms-quote-before">“</span>
                                <?php echo esc_attr(get_the_content()); ?>
                                <span class="cms-quote-after">”</span>
                                <footer><?php the_title(); ?></footer>
                            </blockquote>
                        </div>
                    <?php
                    break;

                    case 'layout6':
                        ?>
                        <div class="cms-testimonials-wrap clearfix <?php echo esc_attr($testi_layout); ?>">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="cms-testi-author-wrap text-center">
                                            <div class="cms-img-container">
                                                <?php 
                                                    if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                                        $class = 'has-thumbnail cms-grid-testimonials-media';
                                                        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                                                    else:
                                                        $class = ' no-image cms-grid-testimonials-media';
                                                        $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                                                    endif;

                                                    echo ''.$thumbnail;
                                                ?>
                                            </div>
                                            <div class="cms-small-author">
                                                <span class="author-testimonial font-opensans"><?php the_title(); ?></span>
                                                <span class="quote-author-description font-opensans">
                                                    <?php echo esc_attr($testi_position); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="cms-testi-text <?php echo esc_attr($set_monserrat_font); ?>">
                                            <?php echo esc_attr(get_the_content()); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    break;
                    
                    default:
                        ?>
                        <div class="cms-testimonials-wrap mb-30 clearfix <?php echo esc_attr($testi_layout); ?>">
                            <div class="cms-testi-text">
                                <?php the_content(); ?>
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

                                        echo ''.$thumbnail;
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
                    break;
                }
            ?>
        </div>
        <?php //the_terms( get_the_ID(), 'categories-testimonial', '', ' / ' ); ?>
        <?php
    }
    ?>
</div>