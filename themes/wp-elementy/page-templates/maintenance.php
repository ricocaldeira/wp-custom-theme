<?php
/**
 * Template Name: Maintenance Page
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 * @author Fox
 */
get_header(); ?>
<div id="primary" class="">
    <main id="main" class="site-main" role="main">
        <section class="manitenance-page">
            <div class="manitenance-inner container">
                <div class="row m-bot-40">
                    <div class="col-md-4 text-center maintenance-icon-container">
                        <i class="icon_tools maintenance-icon" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8 maintenance-text-container">
                        <h1><?php esc_html_e('Sorry', 'wp-elementy'); ?></h1>
                        <h2><?php esc_html_e('Server Maintenance', 'wp-elementy'); ?></h2>
                        <p><?php esc_html_e('The page is currently unavailable due to the server maintenance. Please check back later when the maintenance is over. If you need support, you may simply send us an email at', 'wp-elementy'); ?> <a href="mailto:email@elementy.com" class="a-invert">email@elementy.com</a></p>
                    </div>
                </div>
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
        </section>
    </main>
</div>
<?php get_footer(); ?>