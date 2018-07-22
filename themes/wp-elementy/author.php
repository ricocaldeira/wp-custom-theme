<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
				<?php
				if ( have_posts() ) :
					if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="author-info mb-50">
							<div class="author-avatar">
								<?php
								/**
								 * Filter the author bio avatar size.
								 *
								 * @since Twenty Twelve 1.0
								 *
								 * @param int $size The height and width of the avatar in pixels.
								 */
								echo get_avatar( get_the_author_meta( 'user_email' ), 90 );
								?>
							</div><!-- .author-avatar -->
							<div class="author-description">
								<h2><?php printf( esc_html__( 'About %s', 'wp-elementy' ), get_the_author() ); ?></h2>
								<p><?php the_author_meta( 'description' ); ?></p>
							</div><!-- .author-description	-->
						</div><!-- .author-info -->
					<?php
					endif;
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
		<div class="col-sm-4 col-md-3 col-md-offset-1">
	    	<?php get_sidebar(); ?>
	    </div>
	</div>
</section><!-- #primary -->

<?php get_footer(); ?>