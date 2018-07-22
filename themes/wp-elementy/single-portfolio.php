<?php
/**
 * The Template for displaying single portfolio
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
get_header(); 
$portfolio_single_layout = 'style1';
?>
    <div id="primary">
        <main id="main" class="site-main">
            <div class="container">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'single-templates/single/portfolio', $portfolio_single_layout); ?>
                    <hr class="mt-0 mb-0">
                    <div class="entry-navigation clearfix">
                        <?php
                            /* Get single post nav. */
                            wp_elementy_portfolio_nav();
                        ?>    
                    </div>

                    <?php wp_elementy_get_portfolio_related() ?>
                <?php endwhile; // end of the loop. ?>
            </div>
        </main> <!-- #content -->
    </div> <!-- #primary -->
<?php get_footer(); ?>