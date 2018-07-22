<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Fox
 */

$page_title_layout = '';
$page_title_layout = wp_elementy_get_pagetitle_layout();
?>
<div id="cshero-header" class="<?php wp_elementy_header_class('cshero-main-header header-fullscreen-menu-wrap'); ?>">
    <div class="container-m-30 clearfix">
        <div id="cshero-header-logo" class="cshero-header-logo pull-left">
            <?php wp_elementy_header_logo(); ?>
            <button type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#site-navigation" id="cshero-menu-mobile">
                <span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
            </button>
            <a href="#" id="elementy-fullscreen-trigger" class=""><span class="elementy-menu-icon"></span></a>
        </div><!-- #site-logo -->
    </div>
</div><!-- #site-navigation -->