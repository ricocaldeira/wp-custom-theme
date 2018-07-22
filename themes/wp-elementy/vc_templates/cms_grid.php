<?php
$blog_layout = (!empty($atts['cms_blog_layout'])) ? $atts['cms_blog_layout'] : 'default';

if ($blog_layout == 'default' || $blog_layout == 'fullwidth') : ?>
    <div class="cms-grid-wraper <?php echo esc_attr($atts['template']);?> clearfix" id="<?php echo esc_attr($atts['html_id']);?>">
        <div class="cms-blog-<?php echo esc_attr($blog_layout);?>">
            <?php
            $posts = $atts['posts'];
            while($posts->have_posts()) {
                $posts->the_post();
                $format = get_post_format() ? : 'standard';
                $blog_featured_size = ($blog_layout == 'default') ? 'large' : 'full';
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('cms-blog-item wow fadeIn pb-90 clearfix'); ?>>
                        <?php
                            switch ($format) {
                                case 'video':
                                    ?>
                                        <div class="entry-feature entry-feature-video mb-30"><?php wp_elementy_post_video(); ?></div>
                                    <?php
                                    break;

                                case 'quote':
                                    ?>
                                        <div class="entry-feature entry-feature-quote mb-30"><?php wp_elementy_post_quote(); ?></div>
                                    <?php
                                    break;

                                case 'gallery':
                                    ?>
                                        <div class="entry-feature entry-feature-gallery mb-30"><?php wp_elementy_post_gallery(); ?></div>
                                    <?php
                                    break;

                                case 'audio':
                                    ?>
                                        <div class="entry-feature entry-feature-audio mb-30"><?php wp_elementy_post_audio(); ?></div>
                                    <?php
                                    break;

                                default:
                                    ?>
                                        <div class="entry-feature entry-feature-image mb-30">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( $blog_featured_size ); ?>
                                            </a>
                                        </div>
                                    <?php
                                    break;
                            }
                        ?>
                        <header class="entry-header">
                            <h4 class="entry-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                        if(is_sticky()){
                                            echo "<i class='fa fa-thumb-tack'></i>";
                                        }
                                    ?>
                                    <?php echo strip_tags(get_the_title()); ?>
                                </a>
                            </h4>
                        </header>
                        <div class="entry-meta mb-20">
                            <?php wp_elementy_archive_posts_metadata(); ?>
                        </div>
                        <div class="entry-content <?php echo ($blog_layout == 'fullwidth') ? 'mb-31' : '';?>">
                            <?php the_excerpt();
                                wp_link_pages( array(
                                    'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'wp-elementy') . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span class="page-numbers">',
                                    'link_after'  => '</span>',
                                ) );
                            ?>
                        </div>
                        <footer class="entry-footer">
                            <?php wp_elementy_post_readmore(); ?>
                        </footer>
                    </article>
                <?php
            }
            ?>
        </div>
        <?php if (!empty($atts['cms_pagination']) && $atts['cms_pagination'] == true) wp_elementy_paging_nav(); ?>
    </div>
<?php elseif ($blog_layout == 'small-image') : ?>
    <div class="cms-grid-wraper <?php echo esc_attr($atts['template']);?> clearfix" id="<?php echo esc_attr($atts['html_id']);?>">
        <div class="cms-blog-<?php echo esc_attr($blog_layout);?>">
            <div class="row">
                <?php
                $posts = $atts['posts'];
                $col_lg = $atts['col_lg'];
                $bt_col = (!empty($col_lg)) ? 12/$col_lg : '6';
                $index = 0;
                while($posts->have_posts()) {
                    $posts->the_post();
                    $format = get_post_format() ? : 'standard';
                    if ( $index > 0 && $index%$col_lg == 0 ) echo '</div><div class="row row-'.$index.'">';
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('cms-blog-item wow fadeIn pb-90 clearfix col-md-'.$bt_col); ?>>
                            <?php
                                switch ($format) {
                                    case 'video':
                                        ?>
                                            <div class="entry-feature entry-feature-video mb-30"><?php wp_elementy_post_video(); ?></div>
                                        <?php
                                        break;

                                    case 'quote':
                                        ?>
                                            <div class="entry-feature entry-feature-quote mb-30"><?php wp_elementy_post_quote(); ?></div>
                                        <?php
                                        break;

                                    case 'gallery':
                                        ?>
                                            <div class="entry-feature entry-feature-gallery mb-30"><?php wp_elementy_post_gallery(); ?></div>
                                        <?php
                                        break;

                                    case 'audio':
                                        ?>
                                            <div class="entry-feature entry-feature-audio mb-30"><?php wp_elementy_post_audio(); ?></div>
                                        <?php
                                        break;

                                    default:
                                        ?>
                                            <div class="entry-feature entry-feature-image mb-30 w-100">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail( 'elementy-related' ); ?>
                                                </a>
                                            </div>
                                        <?php
                                        break;
                                }
                            ?>
                            <header class="entry-header">
                                <h4 class="entry-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            if(is_sticky()){
                                                echo "<i class='fa fa-thumb-tack'></i>";
                                            }
                                        ?>
                                        <?php echo strip_tags(get_the_title()); ?>
                                    </a>
                                </h4>
                            </header>
                            <div class="entry-meta mb-20">
                                <?php wp_elementy_archive_posts_metadata(); ?>
                            </div>
                            <div class="entry-content">
                                <?php the_excerpt();
                                    wp_link_pages( array(
                                        'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'wp-elementy') . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span class="page-numbers">',
                                        'link_after'  => '</span>',
                                    ) );
                                ?>
                            </div>
                            <footer class="entry-footer">
                                <?php wp_elementy_post_readmore(); ?>
                            </footer>
                        </article>
                    <?php
                    $index++;
                }
                ?>
            </div><!-- end row -->
        </div>
        <?php if (!empty($atts['cms_pagination']) && $atts['cms_pagination'] == true) wp_elementy_paging_nav(); ?>
    </div>
<?php elseif ($blog_layout == 'masonry') : //Blog style is Masonry ?>
    <div class="cms-grid-wraper <?php echo esc_attr($atts['template']);?> clearfix" id="<?php echo esc_attr($atts['html_id']);?>">
        <div class="row cms-blog-<?php echo esc_attr($blog_layout);?> <?php echo esc_attr($atts['grid_class']);?>">
            <?php
            $posts = $atts['posts'];
            while($posts->have_posts()){
                $posts->the_post();
                ?>
                <div class="cms-grid-item cms-blog-masonry <?php echo esc_attr($atts['item_class']);?>">
                    <?php get_template_part( 'single-templates/blog-masonry/content', get_post_format() ); ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php if (!empty($atts['cms_pagination']) && $atts['cms_pagination'] == true) wp_elementy_paging_nav(); ?>
    </div>
<?php endif; ?>