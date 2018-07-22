<?php
/**
 * add child styles.
 * 
 * @author CMS
 * @since 1.0.0
 */
function theme_enqueue_styles()
{
    $parent_style = 'wp-elementy-static';
    
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array(
        $parent_style
    ));
}