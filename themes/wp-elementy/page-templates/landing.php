<?php
/**
 * Template Name: Landing Page
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 * @author Fox
 */
get_header(); ?>

<div id="primary" class="container intro-demo">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <main id="main" class="site-main">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                    // Include the page content template.
                    get_template_part( 'single-templates/content', 'page' );
                    // End the loop.
                endwhile;
                ?>
            </main><!-- .site-main -->
        </div>
    </div>
</div><!-- .content-area -->
<?php get_footer(); ?>