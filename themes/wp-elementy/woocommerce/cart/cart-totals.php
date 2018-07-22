<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals-wrap cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">
	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
			<div class="col-sm-6">
				<div class="cart-totals-shipping">
					<h4 class="blog-page-title mt-40 mb-25"><?php esc_html_e( 'Calculate shipping', 'wp-elementy' ); ?></h4>
					<?php woocommerce_shipping_calculator(); ?>
				</div>
			</div>
			<div class="col-sm-5 col-md-offset-1">
				<div class="cart-totals-inner">
					<div class="cart-subtotal-wrap">
						<h5 class="mt-60 mb-10">
							<?php esc_html_e( 'Subtotal: ', 'wp-elementy' ); ?>
							<strong><?php wc_cart_totals_subtotal_html(); ?></strong>
						</h5>
					</div>
					<div class="cart-shipping-info">
						<h5 class="mt-10 mb-10">
							<?php
								echo '<span>'. esc_html__('Shipping: ', 'wp-elementy') .'</span>';
								echo '<strong>'. WC()->cart->get_cart_shipping_total() .'</strong>';
							?>
						</h5>
					</div>
					<div class="cart-total-order">
						<h3 class="mt-10 mb-30">
							<span><?php esc_html_e( 'Order total: ', 'wp-elementy' ); ?></span>
							<strong><?php wc_cart_totals_order_total_html(); ?></strong>
						</h3>
					</div>
				</div>
				<div class="wc-proceed-to-checkout">
					<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
				</div>
			</div>

			<?php if ( WC()->cart->get_cart_tax() ) : ?>
				<p><small><?php

					$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
						? ' ' . esc_html__( ' (taxes estimated for )', 'wp-elementy' ) . WC()->countries->estimated_for_prefix() .  WC()->countries->countries[ WC()->countries->get_base_country() ]
						: '';

					printf( esc_html__( 'Note: Shipping and taxes are estimated and will be updated during checkout based on your billing and shipping information.', 'wp-elementy' ), $estimated_text );

				?></small></p>
			<?php endif; ?>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>
