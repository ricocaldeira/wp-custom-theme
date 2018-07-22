<?php $clients_layout = !empty( $atts['cms_client_layout'] ) ? $atts['cms_client_layout'] : 'layout1'; ?>
<div class="cms-grid-wraper cms-grid-clients-wrap <?php echo esc_attr($atts['template'].' '.$clients_layout);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="row border-bot <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $clients_query = $size = $clients_query = $posts_per_page = $posts_per_row = $cms_team_grid_class = '';
        $posts = $atts['posts'];
        $size = 'full';
        $clients_query = $posts->query;
        $posts_per_page = $clients_query['posts_per_page'];

        if ( $posts_per_page > 6) {
            switch (round($posts_per_page/2)) {
                case 2:
                    $cms_team_grid_class = 'col-xs-6 col-sm-6';
                    break;
                case 6:
                    $cms_team_grid_class = 'col-xs-6 col-sm-2';
                    break;
                case 4:
                    $cms_team_grid_class = 'col-xs-6 col-sm-3';
                    break;
                default:
                    $cms_team_grid_class = 'col-xs-6 col-sm-4';
                    break;
            }

            $i = 0;
            while($posts->have_posts()) {
                $posts->the_post();
                if ( $i > 0 && $i%( round($posts_per_page/2) ) == 0 ) {
                    echo '</div><div class="row cms-grid">';
                }
                ?>
                <div class="client-item <?php echo esc_attr($cms_team_grid_class); ?>">
                    <?php 
                        if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                            $class = ' has-thumbnail';
                            $thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
                        else:
                            $class = ' no-image';
                            $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                        endif;

                        echo balanceTags($thumbnail);
                    ?>
                </div>
                <?php
                $i++;
            }
        } elseif ( $posts_per_page <= 6 ) {
            while($posts->have_posts()) {
                $posts->the_post();
                ?>
                <div class="client-item <?php echo esc_attr($atts['item_class']);?>">
                    <?php 
                        if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                            $class = ' has-thumbnail';
                            $thumbnail = get_the_post_thumbnail(get_the_ID(), $size);
                        else:
                            $class = ' no-image';
                            $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                        endif;

                        echo balanceTags($thumbnail);
                    ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>