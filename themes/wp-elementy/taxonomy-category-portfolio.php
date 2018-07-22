<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, CMS Theme already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header(); ?>
<div class="container">
    <section id="primary" class="">
        <div id="content" role="main">
            <?php
            $term = get_term_by( 'slug', get_query_var( 'category-portfolio' ), get_query_var( 'taxonomy' ) );

                echo apply_filters('the_content','[cms_grid layout="" col_xs="1" col_sm="2" col_md="3" col_lg="3" cms_portfolio_gutter="15px" cms_portf_special="" cms_pagination="true" cms_readmore="" source="size:9|order_by:date|post_type:portfolio|tax_query:'.$term->term_id.'" cms_template="cms_grid--portfolio.php"]');
            ?>
        </div><!-- #content -->
    </section><!-- #primary -->
</div>
<?php get_footer(); ?>