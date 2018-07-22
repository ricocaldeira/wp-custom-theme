<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header();

$primary_colum = $secord_col = $blog_layout = '';
$blog_layout = wp_elementy_get_theme_option('blog_layout');

$tracking_layout = (!empty( $blog_layout )) ? $blog_layout : 'right-sidebar';
if ( !empty($tracking_layout) && $tracking_layout == 'full-width' ) {
    $primary_colum = 'col-sm-12';
} elseif ( !empty($tracking_layout) && $tracking_layout == 'left-sidebar' ) {
    $primary_colum = 'col-sm-8 col-md-offset-1';
    $secord_col = 'col-sm-4 col-md-3';
} else {
    $primary_colum = 'col-sm-8';
    $secord_col = 'col-sm-4 col-md-3 col-md-offset-1';
}
?>

<section id="primary" class="container">
    <div class="row">
        <?php if ($tracking_layout == 'left-sidebar' ): ?>
            <div class="<?php echo esc_attr($secord_col); ?>">
                <?php get_sidebar(); ?>
            </div>    
        <?php endif ?>
        <div class="<?php echo esc_attr($primary_colum); ?>">
            <main id="main" class="site-main" role="main">

                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                        get_template_part( 'single-templates/content/content', get_post_format() );

                    endwhile; // end of the loop.

                    /* blog nav. */
                    wp_elementy_paging_nav();

                else :
                    /* content none. */
                    get_template_part( 'single-templates/content', 'none' );

                endif; ?>

            </main><!-- #content -->
        </div>
        <?php if ($tracking_layout == 'right-sidebar' ): ?>
        <div class="<?php echo esc_attr($secord_col); ?>">
            <?php get_sidebar(); ?>
        </div>    
        <?php endif ?>
    </div>
</section><!-- #primary -->

<?php get_footer(); ?>