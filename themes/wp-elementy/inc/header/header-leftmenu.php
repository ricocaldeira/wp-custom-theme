<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Fox
 */

$page_title_layout = '';
$page_title_layout = wp_elementy_get_pagetitle_layout();
?>
<div class="elementy-menu-left">
    <header id="masthead" class="site-header" >
        <div id="cshero-header-left">
            <div id="cshero-header-logo" class="cshero-header-logo">
                <?php wp_elementy_header_logo(); ?>
            </div>
            <div class="left-nav-wrap clearfix">
                <button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#site-navigation" id="cshero-menu-mobile">
                    <span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
                </button>
                <div class="cshero-header-cart-search cms-in-phone pull-right">
                    <?php do_action('wp_elementy_header_cart_search'); ?>
                </div>
            </div>
            
            <div id="site-navigation" class="main-navigation collapse">
                <?php
                    if (is_active_sidebar('left-menu-area')) {
                        dynamic_sidebar('left-menu-area');
                    }
                ?>
            </div>
        </div>
    </header>
</div>