<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     20.0.0
 */

global $woocommerce_loop;

if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}
?>
<div class="elementy-products-wrap clearfix <?php echo ( !empty($woocommerce_loop['columns']) ) ? 'woo-'.$woocommerce_loop['columns'].'-cols-ir':''; ?> <?php echo (wp_elementy_woo_has_pagination() == true) ? 'mb-70' : ''; /* If has pagination */?>">
	<div class="row">