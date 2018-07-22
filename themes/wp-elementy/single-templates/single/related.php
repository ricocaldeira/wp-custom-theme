<?php
$orig_post = $post;  
global $post;  
$tags = wp_get_post_tags($post->ID);  

if ($tags) {
    $tag_ids = array();  
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
    $args = array(  
        'tag__in' => $tag_ids,  
        'post__not_in' => array($post->ID),  
        'posts_per_page'=>3, // Number of related posts to display.  
        'ignore_sticky_posts'=>1  
    );

    $related_posts = new WP_Query($args);
    if ($related_posts->have_posts()) { ?>
        <h4 class="related-post-heading mt-50 mb-25"><?php esc_html_e('Related Post', 'wp-elementy'); ?></h4>
        <div class="row related-posts">
    	<?php while( $related_posts->have_posts() ) {
	    	$related_posts->the_post();   
	    	?>
	    		<article id="related-post-<?php the_ID(); ?>" <?php post_class('cms-blog-item col-sm-4 col-md-4 wow fadeIn pb-50'); ?>>
					<div class="entry-feature entry-feature-image mb-15">
						<a href="<?php the_permalink(); ?>">
							<?php if(has_post_thumbnail()) : ?>
								<?php the_post_thumbnail( 'elementy-related' ); ?>
							<?php else: ?>
								<img src="<?php echo get_template_directory_uri().'/assets/images/no-image.jpg'; ?>" alt="">
							<?php endif; ?>
						</a>
					</div>
					<header class="entry-header">
						<h5 class="entry-title">
					    	<a href="<?php the_permalink(); ?>">
					    		<?php echo strip_tags(get_the_title()); ?>
					    	</a>
					    </h5>
					</header>
					<div class="entry-meta mb-20 clearfix">
						<ul>
					        <li class="entry-date">
					            <span><?php echo get_the_date('F d') ?></span>
					        </li>
					        <li class="entry-author">
					            <?php the_author_posts_link(); ?>
					        </li>
					   	</ul>
					</div>
				</article><!-- #post-## -->
	    	<?php
		}
		echo '</div>';
    }  
}
$post = $orig_post;
wp_reset_postdata();