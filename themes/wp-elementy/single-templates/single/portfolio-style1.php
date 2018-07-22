<article id="postforlio-<?php the_ID(); ?>" <?php post_class('cms-portf-single wow fadeIn clearfix'); ?> >
    <?php wp_elementy_port_featured(); ?>
    <div class="entry-portf row">
		<?php wp_elementy_get_portfolio_detail(); ?>
    </div>
</article>