<?php
/**
 * Search form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 20.0.0
 */


$form = '<form role="search" method="get" id="product-searchform" class="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
	<div>
		<input type="text" value="' . get_search_query() . '" name="s" id="s-product" placeholder="' . esc_html__( 'Search', 'wp-elementy' ) . '" />
		<button type="submit" id="cms-searchsubmit" value="'. esc_attr__( 'Search', 'wp-elementy' ) .'" /><i class="icon_search"></i></button>
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>';
echo balanceTags($form);