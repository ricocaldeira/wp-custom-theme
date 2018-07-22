<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Fox
 *
 */

$page_title_layout = '';
$page_title_layout = wp_elementy_get_pagetitle_layout();
?>

<div id="cshero-header" class="<?php wp_elementy_header_class('cshero-main-header header-side-wrap'); ?>">
    <div class="container-m-30 clearfix">
        <div id="cshero-header-logo" class="cshero-header-logo pull-left">
            <?php wp_elementy_header_logo(); ?>
            <a href="#" id="elementy-menu-trigger" class=""><span class="elementy-menu-icon"></span></a>
        </div><!-- #site-logo -->
    </div>
</div><!-- #site-navigation -->