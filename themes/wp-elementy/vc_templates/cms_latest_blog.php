<?php
$latest_categories_name = $latest_blog_layout = $latest_number_post_to_show = $latest_exclude_post = $latest_number_cols = $latest_viewall = $latest_viewall_text = $blog_heading = $latest_excerpt = $latest_heading_font = $latest_heading_fw = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$latest_blog_layout = (!empty( $latest_blog_layout )) ? $latest_blog_layout : 'layout1';
$latest_excerpt = (!empty( $latest_excerpt )) ? $latest_excerpt : '';

$args_query = array(
    'posts_per_page'   => $latest_number_post_to_show,
    'category__in' => $latest_categories_name,
    'orderby'       => 'post_date',
    'order'         => 'DESC'
);

switch ($latest_number_cols) {
	case 2:
		$el_class = 'col-sm-12 col-md-6';
		break;
	case 4:
		$el_class = 'col-sm-12 col-md-3';
		break;
	case 6:
		$el_class = 'col-sm-12 col-md-2';
		break;
	
	default:
		$el_class = 'col-sm-12 col-md-4';
		break;
}
$recent_posts = new WP_Query($args_query);
?>
<?php if ( !empty($blog_heading) ) : ?>
	<div class="latest-blog-heading mb-50">
		<h2>
			<?php echo esc_html($blog_heading); ?>
			<?php if (!empty($latest_viewall)) : ?>
				<a href="<?php echo esc_url( get_category_link( $latest_categories_name )); ?>" title=""><?php echo esc_html($latest_viewall_text); ?></a>
			<?php endif; ?>
		</h2>
	</div>
<?php endif; ?>
<?php if ($latest_blog_layout == 'layout1') : ?>
<div class="latest-blog-wrap row <?php echo esc_attr($latest_blog_layout); ?>">
	<?php if ($recent_posts->have_posts()) : ?>
		<?php while($recent_posts->have_posts()) : $recent_posts->the_post(); global $post; ?>
			<div class="cms-latest-blog <?php echo esc_attr($el_class); ?>">
				<div class="cms-latest-blog-inner wow fadeIn pb-70">
					<div class="entry-feature entry-feature-image">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('medium'); ?>
						</a>
					</div>
					<div class="entry-header">
						<h3 class="entry-title">
					    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </h3>
					    <ul class="entry-metadata clearfix">
					    	<li class="entry-post-date">
					    		<?php echo get_the_date('F d, Y'); ?>	
					    	</li>
					    	<li class="entry-author">
					    		<?php
					    			the_author_posts_link();
				                ?>
					    	</li>
					    </ul>
					    <?php if ($latest_excerpt) : ?>
						    <div class="entry-excerpt">
						    	<?php
						    		ob_start();
						    		the_excerpt();
						    		$entry_excertp = ob_get_clean();

						    		echo wp_trim_words($entry_excertp, 19, '');
						    	?>
						    </div>
						<?php endif; ?>
					</div>	
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php endif; ?>


<?php
/* Layout 2 */
if ($latest_blog_layout == 'layout2') : ?>
<div class="latest-blog-wrap <?php echo esc_attr($latest_blog_layout); ?>">
	<?php if ($recent_posts->have_posts()) : ?>
		<?php while($recent_posts->have_posts()) : $recent_posts->the_post(); global $post; ?>
			<div class="cms-latest-blog row">
				<div class="col-md-6 pr-0">
					<div class="entry-feature entry-feature-image">
						<a href="<?php the_permalink(); ?>">
							<?php
								$thumb_url = get_the_post_thumbnail_url();

								if ( strpos($thumb_url, '.gif') ) {
									echo '<img src="'.$thumb_url.'" alt="">';
								} else {
									the_post_thumbnail('medium');	
								}
							?>
						</a>
					</div>
				</div>
				<div class="col-md-6 pl-0">
					<div class="entry-header">
						<div class="entry-header-inner">
							<h3 class="entry-title <?php echo esc_attr($latest_heading_fw); ?>">
						    	<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($latest_heading_font);?>"><?php the_title(); ?></a>
						    </h3>
						    <ul class="entry-metadata clearfix <?php echo ($latest_heading_font == 'font-montserrat') ? 'font-montserrat' : 'font-opensans';?>">
						    	<li class="entry-post-date">
						    		<?php echo get_the_date('F d, Y'); ?>	
						    	</li>
						    	<li class="entry-author">
						    		<?php
						    			the_author_posts_link();
					                ?>
						    	</li>
						    </ul>
						</div>
					</div>	
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php endif; ?>
<div class="clearfix"></div>
<?php if (!empty($latest_viewall) && empty($blog_heading) ) : ?>
	<a class="latest-blog-readmore <?php echo ($latest_heading_font == 'font-montserrat') ? 'font-montserrat' : 'font-poppins';?> <?php echo esc_attr($latest_heading_fw); ?>" href="<?php echo esc_url( get_category_link( $latest_categories_name )); ?>" title=""><?php echo esc_html($latest_viewall_text); ?></a>
<?php endif; ?>

<?php
/* Layout 3 */
if ($latest_blog_layout == 'layout3') : ?>
<div class="latest-blog-fullwidth row <?php echo esc_attr($latest_blog_layout); ?>">
	<?php if ($recent_posts->have_posts()) : ?>
		<?php
		$i = 0;
		while($recent_posts->have_posts()) : $recent_posts->the_post(); global $post; ?>
			<div class="cms-latest-blog wow fadeIn clearfix" data-wow-delay="<?php echo esc_attr($i*150); ?>ms">
				<div class="col-md-4 mb-20">
					<div class="entry-wrap">
						<h3 class="entry-title font-josefin">
					    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </h3>
					    <ul class="entry-metadata font-josefin clearfix">
					    	<li class="entry-post-date">
					    		<?php echo get_the_date('d F'); ?>	
					    	</li>
					    	<li class="entry-cat">
					    		<?php
					    			the_category(', ');
				                ?>
					    	</li>
					    </ul>
					</div>
				</div>
				<div class="col-md-8">
					<?php if ($latest_excerpt) : ?>
					    <div class="entry-excerpt mb-20">
					    	<?php
					    		ob_start();
					    		the_excerpt();
					    		$entry_excertp = ob_get_clean();

					    		echo wp_trim_words($entry_excertp, 40, '');
					    	?>
					    </div>
					<?php endif; ?>
				</div>
			</div>
		<?php
		$i++;
		endwhile; ?>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php
/* Layout 4 */
if ($latest_blog_layout == 'layout4') : ?>
<div class="latest-blog-fullwidth row <?php echo esc_attr($latest_blog_layout); ?>">
	<?php if ($recent_posts->have_posts()) : ?>
		<?php
		$i = 0;
		while($recent_posts->have_posts()) : $recent_posts->the_post(); global $post; ?>
			<div class="cms-latest-blog wow fadeIn pb-30 clearfix" data-wow-delay="<?php echo esc_attr($i*150); ?>ms">
				<div class="col-md-4 mb-20">
					<div class="date-wrap">
						<span class="date-num"><?php echo get_the_date('d'); ?></span>
						<span class="month-num"><?php echo get_the_date('F'); ?></span>
					</div>
					<div class="title-wrap">
						<h3 class="entry-title ">
					    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </h3>
					    <div class="entry-meta-wrap clearfix">
					    	<span class="cate">
					    		<?php the_category(', '); ?>
					    	</span>
					    	<span class="author">
					    		<?php the_author(); ?>
					    	</span>
					    </div>
					</div>
				</div>
				<div class="col-md-8">
					<?php if ($latest_excerpt) : ?>
					    <div class="entry-excerpt mb-20">
					    	<?php
					    		ob_start();
					    		the_excerpt();
					    		$entry_excertp = ob_get_clean();

					    		echo wp_trim_words($entry_excertp, 40, '');
					    	?>
					    </div>
					<?php endif; ?>
				</div>
			</div>
		<?php
		$i++;
		endwhile; ?>
	<?php endif; ?>
</div>
<?php endif; ?>