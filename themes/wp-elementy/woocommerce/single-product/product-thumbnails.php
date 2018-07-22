<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	?>
	<div id="woo-thumbnails-<?php echo rand(0, 999); ?>" class="woo-thumbnails cms-carousel-wrapper owl-images-wrap mt-20">
		<div class="cms-owl-carousel owl-carousel owl-theme"
			data-per-view = "4"
			data-margin = "20"
			data-autoplay = "true" 
		    data-pagination ="false" 
		    data-nav ="true" 
		    data-loop="false" >
			<?php
				foreach ( $attachment_ids as $attachment_id ) {
					$classes = array( 'zoom' );

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link )
						continue;

					$image_title 	= esc_attr( get_the_title( $attachment_id ) );
					$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
						'title'	=> $image_title,
						'alt'	=> $image_title
						) );

					$image_class = esc_attr( implode( ' ', $classes ) );

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', $image_link, 'lightbox', $image_caption, $image ), $attachment_id, $post->ID, $image_class );
				}
			?>
		</div>
	</div>
	<?php
}
