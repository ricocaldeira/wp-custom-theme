<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 30.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>
<div class="elementy-table-resp">
	<div class="table-responsive">
		<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" class="woocommerce-cart-form mw-100-767">
		<div class="mb-60">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<table class="cms-shop-table table table-striped shopping-cart-table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
					<tr>
						<th class="product-number">&nbsp;</th>
						<th class="product-thumbnail"><?php esc_html_e( 'Photo', 'wp-elementy' ); ?></th>
						<th class="product-name"><?php esc_html_e( 'Product', 'wp-elementy' ); ?></th>
						<th class="product-price"><?php esc_html_e( 'Price', 'wp-elementy' ); ?></th>
						<th class="product-quantity"><?php esc_html_e( 'Quantity', 'wp-elementy' ); ?></th>
						<th class="product-subtotal"><?php esc_html_e( 'Total', 'wp-elementy' ); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					$i = 1;
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
								<td class="text-center"><?php echo esc_html($i); ?></td>
								<td class="product-thumbnail">
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $product_permalink ) {
											echo $thumbnail;
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
										}
									?>
								</td>
								<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'wp-elementy' ); ?>">
									<?php
										if ( ! $product_permalink ) {
											echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
										} else {
											echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
										}

										// Meta data
										echo WC()->cart->get_item_data( $cart_item );

										// Backorder notification
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'wp-elementy' ) . '</p>';
										}
									?>
								</td>

								<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'wp-elementy' ); ?>">
									<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									?>
								</td>

								<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'wp-elementy' ); ?>">
									<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {
											$product_quantity = woocommerce_quantity_input( array(
												'input_name'  => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
												'min_value'   => '0',
											), $_product, false );
										}

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
									?>
								</td>

								<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'wp-elementy' ); ?>">
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
									?>
								</td>

								<td class="product-remove">
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
											esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'wp-elementy' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										), $cart_item_key );
									?>
								</td>
							</tr>
							<?php
						}
						$i++;
					}

					do_action( 'woocommerce_cart_contents' );
					?>
					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</div>
		
		<hr class="mt-0 mb-30">
		<div class="row cms-coupon-wrap">
			<div class="col-sm-8">
				<?php if ( wc_coupons_enabled() ) { ?>
					<div class="coupon row">
						<div class="col-sm-6 mb-10">
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_html_e( 'COUPON CODE', 'wp-elementy' ); ?>" /> 	
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
						<div class="col-sm-6 mb-30">
							<input type="submit" class="cms-button medium gray-light w-100-767" name="apply_coupon" value="<?php esc_html_e( 'APPLY CODE', 'wp-elementy' ); ?>" />	
						</div>
						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-sm-4 text-right text-center-767 mb-30">
				<input type="submit" class="cms-button medium gray-light w-100-767" name="update_cart" value="<?php esc_html_e( 'UPDATE CART', 'wp-elementy' ); ?>" />
				<?php do_action( 'woocommerce_cart_actions' ); ?>
				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</div>
		</div>
		</form>
	</div>
</div>

<hr class="mt-0 mb-60">
<div class="cart-collaterals clearfix">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
