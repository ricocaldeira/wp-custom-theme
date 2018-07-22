<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $nav_menu
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Wp_Custommenu
 */
$title = $nav_menu = $el_class = $vc_wp_custommenu_font = $vc_wp_custommenu_color = $vc_wp_custommenu_color_hover = $vc_wp_custommenu_font_bold = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$font_family = (!empty($atts['vc_wp_custommenu_font'])) ? $atts['vc_wp_custommenu_font'] : 'font-poppins';
$el_class .= ' elementy-custom-widget-nav ';
$el_class .= $font_family;

$unique_id = uniqid();

/* For css */
$_custom_css = '#elementy-custom-widget-nav-'.$unique_id.' .widget {
		font-family: inherit;
	}
	#elementy-custom-widget-nav-'.$unique_id.' li a {
		color: '.$vc_wp_custommenu_color.';

	}
	#elementy-custom-widget-nav-'.$unique_id.' li a:hover, #elementy-custom-widget-nav-'.$unique_id.' li a:hover {color: '.$vc_wp_custommenu_color_hover.';}
';

if ( !empty($vc_wp_custommenu_font_bold) ) {
	$_custom_css .= '#elementy-custom-widget-nav-'.$unique_id.' li a {font-weight: bold;}';
}

elementy_inline_style($_custom_css);
/* End css inline */

$output = '<div id="elementy-custom-widget-nav-'.$unique_id.'" class="vc_wp_custommenu wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'WP_Nav_Menu_Widget';
$args = array();
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo $output;
} else {
	echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_custommenu' );
}
