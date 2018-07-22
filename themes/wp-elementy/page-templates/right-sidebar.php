<?php
/**
 * Template Name: Right Sidebar
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 * @author Fox
 */

get_header(); ?>

<div id="primary" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <main id="main" class="site-main" role="main">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the page content template.
                    get_template_part( 'single-templates/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    // End the loop.
                endwhile;
                ?>

            </main><!-- .site-main -->
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

            <?php get_sidebar(); ?>

        </div><!-- #sidebar -->
    </div>
</div><!-- .content-area -->

<?php get_footer(); ?>