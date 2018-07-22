<?php
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/* Cross Sell Product */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

/* Loop product */
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
/* Thumbnail */
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'wp_elementy_template_loop_product_thumbnail', 10);

add_action('wp_elementy_add_to_wishlist_custom_btn', 'wp_elementy_add_to_wishlist_custom_btn');

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

add_action('wp_elementy_woocommerce_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 10);

add_action('wp_elementy_woocommerce_single_bottom_summary', 'woocommerce_template_single_meta', 10);
add_action('wp_elementy_woocommerce_single_bottom_summary', 'woocommerce_template_single_sharing', 20);

add_action('wp_elementy_woocommerce_single_shop_info', 'wp_elementy_show_shop_info');
add_action('wp_elementy_woocommerce_single_shop_clients_gallery', 'wp_elementy_show_shop_clients_gallery');