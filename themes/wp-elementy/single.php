<?php
/**
 * The Template for displaying all single posts
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header(); 
$_opt_theme_option = wp_elementy_getall_theme_option();
$left_sb_class = $right_sb_class = $blog_class = '';
$layout_single = wp_elementy_get_theme_option('single_layout');

if ( isset($_GET['single-layout']) && !empty($_GET['single-layout']) ) {
    $layout_single = trim($_GET['single-layout']);
}

switch ($layout_single) {
    case 'left-sidebar':
        $left_sb_class = 'col-sm-4 col-md-3';
        $blog_class = 'col-sm-8 col-md-offset-1 blog-main-posts '.$layout_single;
        break;

    case 'right-sidebar':
        $right_sb_class = 'col-sm-4 col-md-3 col-md-offset-1';
        $blog_class = 'col-sm-8 blog-main-posts '.$layout_single;
        break;
    
    default:
        $blog_class = 'col-sm-12 blog-main-posts';
        break;
}
?>

<?php if(!empty($layout_single) && $layout_single != 'full-width') : ?>
<div id="primary" class="container">
    <div class="row">
        <?php if (!empty($layout_single) && $layout_single == 'left-sidebar') : ?>
            <div class="<?php echo esc_attr($left_sb_class); ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
        
        <div class="site-main <?php echo esc_attr($blog_class); ?>">
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
                $format = get_post_format() ? get_post_format() : 'standard';
                $post_layout = '1';
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('wow fadeIn pb-90 cms-blog-single wow fadeIn cms-single-blog clearfix post-title-'. $post_layout); ?>>
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
                                        <?php the_post_thumbnail('full'); ?>
                                    </div>
                                <?php
                                break;
                        }
                    ?>
                    <?php get_template_part( 'single-templates/single/content-sidebar'); ?>
                </article>
                <?php
                // End the loop.
            endwhile;
            ?>
        </div>

        <?php if (!empty($layout_single) && $layout_single == 'right-sidebar') : ?>
            <div class="<?php echo esc_attr($right_sb_class); ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if(!empty($layout_single) && $layout_single == 'full-width') : ?>
    <div id="primary">
        <main id="main" class="site-main" role="main">
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
                $format = get_post_format() ? get_post_format() : 'standard';
                $post_layout = '1';
                //$post_layout = wp_elementy_get_meta_option('post_layout');
                ?>
                    <div class="container">
                        <div class="blog-main-posts full-width pb-50 clearfix">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('cms-blog-single wow fadeIn cms-single-blog clearfix post-title-'. $post_layout); ?>>
                                <?php
                                    switch ($format) {
                                        case 'video':
                                            ?>
                                                <div class="entry-feature entry-feature-video mb-55"><?php wp_elementy_post_video(); ?></div>
                                            <?php
                                            break;

                                        case 'quote':
                                            ?>
                                                <div class="entry-feature entry-feature-quote mb-55"><?php wp_elementy_post_quote(); ?></div>
                                            <?php
                                            break;

                                        case 'gallery':
                                            ?>
                                                <div class="entry-feature entry-feature-gallery mb-55"><?php wp_elementy_post_gallery(); ?></div>
                                            <?php
                                            break;

                                        case 'audio':
                                            ?>
                                                <div class="entry-feature entry-feature-audio mb-55"><?php wp_elementy_post_audio(); ?></div>
                                            <?php
                                            break;

                                        default:
                                            ?>
                                                <div class="entry-feature entry-feature-image mb-55">
                                                    <?php the_post_thumbnail('full'); ?>
                                                </div>
                                            <?php
                                            break;
                                    }
                                ?>
                                <?php get_template_part( 'single-templates/single/content-fullwidth'); ?>
                            </article>
                            <?php if ( $_opt_theme_option['show_navigation_post'] ) : ?>
                                <hr class="mt-0 mb-0">
                                <div class="entry-navigation clearfix">
                                    <?php
                                        /* Get single post nav. */
                                        wp_elementy_post_nav();
                                    ?>    
                                </div>
                            <?php endif; ?>
                            <hr class="mt-0 mb-0">
                            <div class="single-related-post clearfix">
                                <?php
                                    /* Related post */
                                    get_template_part( 'single-templates/single/related');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="single-comments-area">
                        <div class="container">
                            <?php // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif; ?>
                        </div>
                    </div>
                <?php
                // End the loop.
            endwhile;
            ?>
        </main>
    </div><!-- #primary -->
<?php endif; ?>

<?php get_footer(); ?>