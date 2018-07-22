<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( !empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 2 ) {
	$woocommerce_loop['columns'] = 2;
} 
elseif (!empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 3 ) {
	$woocommerce_loop['columns'] = 3;
} 
elseif (!empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 4 ) {
	$woocommerce_loop['columns'] = 4;
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array();
switch ($woocommerce_loop['columns']) {
	case 1:
		$classes[] = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-55 cms-product text-center';
		break;
	case 2:
		$classes[] = 'col-xs-6 col-sm-6 col-md-6 col-lg-6 pb-55 cms-product text-center';
		break;
	case 4:
		$classes[] = 'col-xs-6 col-sm-6 col-md-3 col-lg-3 pb-55 cms-product text-center';
		break;
	default:
		$classes[] = 'col-xs-6 col-sm-6 col-md-4 col-lg-4 pb-55 cms-product text-center';
		break;
}
?>
<div <?php post_class( $classes ); ?>>
	<div class="cms-woo-item-wrap">
		<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );

			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

		?>
		<div class="product-info-wrap">
				<h4 class="woo-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h4>
			<?php

			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			<div class="woo-btn-action clearfix">
				<div class="woo-btn-action-inner">
					<?php
						/**
						 * woocommerce_after_shop_loop_item hook.
						 *
						 * @hooked woocommerce_template_loop_product_link_close - 5
						 * @hooked woocommerce_template_loop_add_to_cart - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item' );
						do_action('wp_elementy_add_to_wishlist_custom_btn');
					?>	
				</div>
			</div>
		</div>
	</div>
</div>
