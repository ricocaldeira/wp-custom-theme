<?php
/**
 * Class CmsRecentPosts
 */
class CmsRecentPosts extends WP_Widget {
    /**
     * Widget Setup
     */
    function __construct() {
        $widget_ops = array('classname' => 'cms-recent-posts', 'description' => esc_html__('A widget that displays recent posts.', 'wp-elementy') );
        $control_ops = array('id_base' => 'cms_recent_posts');
        parent::__construct('cms_recent_posts', esc_html__('CMS Recent Posts', 'wp-elementy'), $widget_ops, $control_ops);
    }

    /**
     * Display Widget
     * @param array $args
     * @param array $instance
     */
    function widget($args, $instance) {
        extract($args);
        $title = $instance['title'];
        $posts = $instance['posts'];
        $show_featured = (!empty($instance['show_featured'])) ? '1' : '0';
        $show_date = (!empty($instance['show_date'])) ? '1' : '0';

        $args_query = array(
            'orderby' => 'ID',
            'order' => 'DESC',
            'posts_per_page' => $posts
        );
        $cms_recentposts = new WP_Query($args_query);

        echo ''.$before_widget;
        if($title) {
            echo $before_title.esc_attr($title).$after_title;
        }
        ?>
        <?php if ($cms_recentposts->have_posts()) : ?>
            <div class="latest-post-footer-wrap mt-25">
                <ul class="cms-latest-post-wrap clearfix">
                <?php while($cms_recentposts->have_posts()): $cms_recentposts->the_post(); global $post; ?>
                    <li class="latest-post-footer-item <?php echo (!empty($show_featured)) ? 'has-img' : '';?>">
                        <?php if (!empty($show_featured) && has_post_thumbnail()): ?>
                            <div class="featured-wrap">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                            </div>
                        <?php endif ?>
                        <div class="latest-item-info">
                            <h4 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <?php if (!empty($show_date)) : ?>
                                <div class="entry-date"><?php the_time('F d') ?></div>
                            <?php endif; ?>   
                        </div>
                    </li>
                <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
        <!-- END WIDGET -->
        <?php
        echo ''.$after_widget;
        wp_reset_postdata();
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts'] = $new_instance['posts'];
        $instance['show_featured'] = $new_instance['show_featured'] ? 1 : 0;
        $instance['show_date'] = $new_instance['show_date'] ? 1 : 0;
        
        return $instance;
    }

    function form($instance) {


        $defaults = array('title' => 'Recent Posts', 'categories' => 'all', 'posts' => 3, 'show_featured' => '', 'show_date' => '');
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
            <label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'wp-elementy') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" value="<?php echo esc_html($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('posts')); ?>"><?php esc_html_e('Number of posts:', 'wp-elementy') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_html($this->get_field_id('posts')); ?>" name="<?php echo esc_html($this->get_field_name('posts')); ?>" value="<?php echo esc_html($instance['posts']); ?>" />
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $instance['show_featured'] ); ?> id="<?php echo esc_html($this->get_field_id('show_featured')); ?>" name="<?php echo esc_html($this->get_field_name('show_featured')); ?>" /> <label for="<?php echo esc_html($this->get_field_id('show_featured')); ?>"><?php esc_html_e('Show featured image', 'wp-elementy'); ?></label>
            <br/>
            <input class="checkbox" type="checkbox"<?php checked( $instance['show_date'] ); ?> id="<?php echo esc_html($this->get_field_id('show_date')); ?>" name="<?php echo esc_html($this->get_field_name('show_date')); ?>" /> <label for="<?php echo esc_html($this->get_field_id('show_date')); ?>"><?php esc_html_e('Show date', 'wp-elementy'); ?></label>
        </p>
    <?php
    }
}

register_widget('CmsRecentPosts');
?>