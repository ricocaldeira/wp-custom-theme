<?php $_opt_theme_option = wp_elementy_getall_theme_option(); ?>

<div class="entry-content row">
    <div class="author-info-wrap col-md-3 text-center mb-50">
        <div class="author-info-inner text-center mb-30">
            <div class="author-avatar">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ), 92 ); ?>
            </div>
            <div class="author-name mt-15">
                <?php esc_html_e('by', 'wp-elementy'); ?>
                <span><?php echo get_the_author(); ?></span>
                <?php if (get_the_author_meta('sub_name')) : ?>
                    <p><?php echo esc_html(get_the_author_meta('sub_name')); ?></p>
                <?php endif; ?>
            </div>
            <ul class="author-social-wrap">
                <li class="facebook"><a href="<?php echo esc_url(get_the_author_meta('facebook')); ?>"><i class="fa fa-facebook"></i> </a></li>
                <li class="twitter"><a href="<?php echo esc_url(get_the_author_meta('twitter')); ?>"><i class="fa fa-twitter"></i> </a></li>
                <li class="linkedin"><a href="<?php echo esc_url(get_the_author_meta('linkedin')); ?>"><i class="fa fa-linkedin"></i> </a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="content-inner clearfix">
            <?php the_content();
                wp_link_pages( array(
                    'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:','wp-elementy') . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span class="page-numbers">',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div>
        <div class="single-metadata-wrap mb-80 clearfix">
            <div class="row">
                <div class="display-flex">
                    <?php wp_elementy_single_metadata(); ?>  
                </div>
            </div>
        </div> 
    </div>
</div>