<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' );

$cms_woo_shop = $cms_woo_sidebar = $cms_woo_columns = '';
$cms_woo_columns = wp_elementy_get_theme_option('woo_archive_layout');
$cms_woo_shop = ($cms_woo_columns != 'full-width') ? 'col-sm-8' : 'col-sm-12';
$shop_col = '';
if ( !empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 2 ) {
	$shop_col = 2;
} 
elseif (!empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 3 ) {
	$shop_col = 3;
} 
elseif (!empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 4 ) {
	$shop_col = 4;
}
else {
	$shop_col = apply_filters( 'loop_shop_columns', 4 );
}
switch ($cms_woo_columns) {
	case 'full-width':
		$cms_woo_shop = 'col-sm-12 pos-static';
		$cms_woo_sidebar = '';
		break;

	case 'left-sidebar':
		$cms_woo_shop = 'col-sm-8 col-md-offset-1 pos-static';
		$cms_woo_sidebar = 'col-sm-4 col-md-3';
		break;

	default:
		$cms_woo_shop = 'col-sm-8 pos-static';
		$cms_woo_sidebar = 'col-sm-4 col-md-3 col-md-offset-1';
		break;
}
?>
<section id="primary" class="content-area no_breadcrumb">
    <main id="main" class="site-main" role="main">    
        <div class="container">
            <div class="row">
				<?php if ($cms_woo_columns == 'left-sidebar') : ?>
					<div class="<?php echo esc_attr($cms_woo_sidebar); ?> <?php echo (!empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 4 ) ? 'hidden' : ''; ?>">
	                    <div id="secondary" class="widget-area" role="complementary">
	                        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
	                            <?php dynamic_sidebar( 'woocommerce_sidebar' ); ?>
	                        </div>
	                    </div>
	                </div>	
				<?php endif; ?>

                <div class="<?php echo (!empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 4 ) ? 'col-sm-12 pos-static' : esc_attr($cms_woo_shop); ?>">
					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>
						<?php
							/**
							 * woocommerce_archive_description hook.
							 *
							 * @hooked woocommerce_taxonomy_archive_description - 10
							 * @hooked woocommerce_product_archive_description - 10
							 */
							do_action( 'woocommerce_archive_description' );
						?>

						<?php if ( have_posts() ) : ?>
							<div class="before-shop-loop mb-70 clearfix">
								<?php
									/**
									 * woocommerce_before_shop_loop hook.
									 *
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									do_action( 'woocommerce_before_shop_loop' );
								?>	
							</div>
							<?php woocommerce_product_loop_start(); ?>

								<?php woocommerce_product_subcategories(); ?>

								<?php
                                    $index = 0;
                                ?>
                				<?php while ( have_posts() ) : the_post(); ?>
                                    
                					<?php
                                        if ($index > 0 && $index%$shop_col == 0) {
                                            echo '</div><div class="row">';
                                        }
                                        wc_get_template_part( 'content', 'product' ); 
                                    ?>
                
                				<?php $index++; endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php
								/**
								 * woocommerce_after_shop_loop hook.
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
				<?php if ($cms_woo_columns == 'right-sidebar') : ?>
					<div class="<?php echo esc_attr($cms_woo_sidebar); ?> <?php echo (!empty($_GET['shop-cols']) && intval($_GET['shop-cols']) == 4 ) ? 'hidden' : ''; ?>">
	                    <div id="secondary" class="widget-area" role="complementary">
	                        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
	                            <?php dynamic_sidebar( 'woocommerce_sidebar' ); ?>
	                        </div>
	                    </div>
	                </div>	
				<?php endif; ?>
			</div>
		</div>
	</main>
</section>

<?php get_footer( 'shop' ); ?>
