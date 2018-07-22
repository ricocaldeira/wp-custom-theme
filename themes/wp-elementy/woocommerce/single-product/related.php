<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     30.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = wc_get_related_products( 6 );

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 6,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->get_id() )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;
$index = 0;
if ( $products->have_posts() ) : ?>
	<div class="woo-related-product-wrap">
		<h3><?php esc_html_e( 'Related Products', 'wp-elementy' ); ?></h3>
		<?php woocommerce_product_loop_start(); ?>
			<div class="container">
				<div class="row">
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<?php echo ($index > 0 && $index%3 == 0) ? '</div><div class="row">' : ''; ?>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 cms-product text-left">
							<div class="cms-woo-item-wrap clearfix mb-30">
								<?php if (has_post_thumbnail()) : ?>
									<div class="woo-related-thumb pull-left">
										<a href="<?php the_permalink(); ?>">
											<?php echo get_the_post_thumbnail(get_the_ID(), 'shop_thumbnail'); ?>
										</a>
									</div>
								<?php endif; ?>
								<div class="woo-related-cont">
									<h4>
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h4>
									<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
									<div class="related-price">
										<?php echo balanceTags($product->get_price_html()); ?>
									</div>
									<div class="woo-btn-action clearfix">
										<?php do_action('woocommerce_after_shop_loop_item'); ?>	
										<?php do_action('wp_elementy_add_to_wishlist_custom_btn'); ?>
									</div>
								</div>	
							</div>
						</div>

					<?php $index++; endwhile; // end of the loop. ?>
				</div>
			</div>
		<?php woocommerce_product_loop_end(); ?>
	</div>
<?php endif;
wp_reset_postdata();