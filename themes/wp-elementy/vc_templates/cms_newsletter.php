<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Newsletter
 */
$layout = $custom_layout = $font_family = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$layout = (empty($layout)) ? 'default' : $layout;


if (class_exists('Newsletter')) {
	if ( $layout == 'default' ): ?>
        <div class="subs-bottom-wrap">
            <div class="cms-newsletter-wrap container clearfix">
                <div class="col-sm-8">
                    <h3 class=""><?php esc_html_e( 'Newsletter', 'wp-elementy' ); ?></h3>
                </div>
                <div class="col-sm-4">
                    <form action="<?php echo esc_url( home_url( '/'  ) );?>?na=s" onsubmit="return newsletter_check(this)" method="post" class="cms-newsletter pull-right">
                        <input type="hidden" name="nr" value="widget">
                        <input type="email" class="newsletter-email" required="" name="ne" placeholder="<?php esc_html_e('Email address', 'wp-elementy'); ?>">
                        <button class="newsletter-submit" type="submit"><i class="icon icon-arrows-slim-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    <?php else:
        if (strpos($custom_layout, '{subscription_form}') !== false) {
            $custom_layout = str_replace('{subscription_form}', NewsletterSubscription::instance()->get_subscription_form($referrer), $custom_layout);
        } else {
            for ($i = 1; $i <= 10; $i++) {
                if (strpos($custom_layout, "{subscription_form_$i}") !== false) {
                    $custom_layout = str_replace("{subscription_form_$i}", NewsletterSubscription::instance()->get_form($i), $custom_layout);
                    break;
                }
            }
        }
        echo balancetags( $custom_layout );
    endif;
}