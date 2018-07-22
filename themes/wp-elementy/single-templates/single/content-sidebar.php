<?php $_opt_theme_option = wp_elementy_getall_theme_option(); ?>

<?php if (!empty($_opt_theme_option['show_single_title'])):  ?>
<h4 class="entry-title"><?php the_title(); ?></h4>
<?php endif; ?>

<?php wp_elementy_single_post_metadata(); ?>
<div class="entry-content">
    <div class="content-inner mb-80 clearfix">
        <?php the_content();
            wp_link_pages( array(
                'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:','wp-elementy') . '</span>',
                'after'       => '</div>',
                'link_before' => '<span class="page-numbers">',
                'link_after'  => '</span>',
            ) );
        ?>
    </div>
    <div class="single-metadata-wrap clearfix">
        <div class="row">
            <div class="display-flex">
                <?php wp_elementy_single_metadata(); ?>  
            </div>
        </div>
    </div> 
</div>
<div class="post-author-container clearfix mt-50 mb-50 pos-rev">
	<div class="post-author-avatar">
		<?php echo get_avatar(get_the_author_meta(get_the_ID()), 92); ?>
	</div>
	<div class="post-author-bio">
		<div class="author-info">
            <?php the_author_posts_link(); ?>
        </div>
        <div class="author-bio"><?php echo get_the_author_meta('description'); ?></div>
	</div>
</div>
<?php if ( $_opt_theme_option['show_navigation_post'] ) : ?>
<hr class="mt-0 mb-0">
<div class="entry-navigation clearfix">
    <?php
        /* Get single post nav. */
        wp_elementy_post_nav();
    ?>    
</div>
<?php endif; ?>
<hr class="mt-0 mb-0">
<div class="single-related-post clearfix">
    <?php
        /* Related post */
        get_template_part( 'single-templates/single/related');
    ?>
</div>
<div class="single-comments-area">
    <?php // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif; ?>
</div>