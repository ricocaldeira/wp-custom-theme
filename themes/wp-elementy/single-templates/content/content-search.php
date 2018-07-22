<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cms-blog-item wow fadeIn pb-90 clearfix'); ?>>
	<header class="entry-header">
		<h4 class="entry-title">
	    	<a href="<?php the_permalink(); ?>">
	    		<?php
		    		if(is_sticky()){
		                echo "<i class='fa fa-thumb-tack'></i>";
		            }
		    	?>
	    		<?php echo strip_tags(get_the_title()); ?>
	    	</a>
	    </h4>
	</header>
	<div class="entry-meta mb-20">
		<?php wp_elementy_archive_posts_metadata(); ?>
	</div>
	<div class="entry-content">
		<p><?php echo wp_trim_words(get_the_excerpt(),40,'') ?></p>
	</div>
	<footer class="entry-footer">
	    <?php wp_elementy_post_readmore(); ?>
	</footer>
</article>
