<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs tabs-3">
		<ul class="nav nav-tabs">
			<?php $i = 0; foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo esc_attr( $key ); ?>_tab <?php echo ($i == 0) ? 'active' : '' ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>

			<?php $i++; endforeach; ?>
		</ul>
		<div class="tab-content">
			<?php $j = 0; foreach ( $tabs as $key => $tab ) : ?>
				<div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane fade <?php echo ($j == 0) ? 'active in' : '' ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>
			<?php $j++; endforeach; ?>	
		</div>
	</div>
<?php endif; ?>
