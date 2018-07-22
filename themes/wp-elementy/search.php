<?php
/**
 * The template for displaying Search Results pages
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header(); ?>

<section id="primary" class="container">
    <div class="row">
        <div class="col-sm-8">
            <main id="main" class="site-main" role="main">
            <?php if ( have_posts() ) :
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    get_template_part( 'single-templates/content/content', 'search' );
                endwhile;
                /* get paging_nav. */
                wp_elementy_paging_nav();
            else :
                get_template_part( 'single-templates/search', 'not-found' );
            endif; ?>
            </main><!-- #content -->
        </div><!-- #primary -->
        <div class="col-sm-4 col-md-3 col-md-offset-1">
            <?php get_sidebar(); ?>
        </div>   
    </div>
</section>

<?php get_footer(); ?>