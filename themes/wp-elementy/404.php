<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<div id="primary" class="">
	<main id="main" class="site-main" role="main">
		<section class="error-404 not-found text-center">
			<div class="p-160-cont clearfix">
				<h1 class="404-page-title"><?php esc_html_e( '404', 'wp-elementy' ); ?></h1>
				<h3 style="line-height: 40px; margin-bottom: 50px;"><?php esc_html_e( 'The Page You\'re Looking for,', 'wp-elementy' ); ?> <br /><?php esc_html_e('Couldn\'t Be Found', 'wp-elementy')?></h3>
				<a href="<?php echo esc_url( home_url( '/'  ) );?>" class="cms-button cms-shape-rounded"><?php esc_html_e('Back to homepage', 'wp-elementy');?></a>
			</div>
			<?php if (class_exists('Newsletter')) : ?>
				<div class="page-section pt-100-b-80-cont bg-gray">
					<div class="container">
						<div class="col-sm-6">
							<?php
                                if ( class_exists('ZNews_twitter') ) {
                                    the_widget( 'ZNews_Twitter_Widget', array( 
                                            'title' => '',
                                            'mode' => 'horizontal',
                                            'row' => 1,
                                            'speed' => 5000,
                                            'auto' => 0,
                                            'ticker' => 0,
                                            'minslides' => 1,
                                            'maxslides' => 1,
                                            'slidewidth' => 0,
                                            'controls' => 0,
                                            'pager' => 0,
                                            'layout' => 'feed-gray.php',
                                    ) ); 
                                }
                            ?>
						</div>
						<div class="col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2">
							<?php
								$custom_layout = '{subscription_form_3}';

								if (strpos($custom_layout, "{subscription_form_3}") !== false) {
				                    $custom_layout = str_replace("{subscription_form_3}", NewsletterSubscription::instance()->get_form(3), $custom_layout);
				                }
				                echo balancetags( $custom_layout );
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</section><!-- .error-404 -->
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>
