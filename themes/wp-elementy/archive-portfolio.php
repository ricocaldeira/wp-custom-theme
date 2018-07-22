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

get_header(); 
$args_query = array(
    'post_type' => 'portfolio',
    'orderby' => 'ID',
    'order' => 'DESC',
    'nopaging' => true,
);
$gutter = '15px';
$archive_portfolios = new WP_Query($args_query);
if ($archive_portfolios->have_posts()) {
?>
<div class="container">
    <div class="row">
        <section id="primary" class="clearfix" >
            <?php
                while($archive_portfolios->have_posts()) {
                    $archive_portfolios->the_post(); 
                    ?>
                        <div class="cms-portfolio-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="portfolio-item-inner" style="margin-bottom: <?php echo esc_attr($gutter) ?>; margin-left: <?php echo esc_attr($gutter) ?>;">
                                <div class="port-img-overlay">
                                    <?php 
                                        if(has_post_thumbnail() && !post_password_required() && !is_attachment()):
                                            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'elementy-thumbnail-wide');
                                        else:
                                            $thumbnail = '<img src="'.get_template_directory_uri().'/assets/images/no-image.jpg" alt="'.get_the_title().'" />';
                                        endif;

                                        echo balanceTags($thumbnail);
                                    ?>
                                </div>
                                <div class="port-overlay-cont">
                                    <div class="port-cont-inner">
                                        <h4>
                                            <a href="<?php the_permalink(); ?>" class="font-poppins">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>
                                        <div class="port-cat-wrap font-opensans">
                                            <?php echo get_the_term_list( get_the_ID(), 'category-portfolio', '', ', ', '' ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </section>
    </div>
</div>
<?php
wp_reset_postdata();
}

get_footer(); ?>