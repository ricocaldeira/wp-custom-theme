<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $offset = $column_text_color = $col_pos_abs = $col_pos_sta = $css_animation = $css_animation_delay = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$column_text_color = ( !empty($column_text_color) ) ? 'style="color:'.$column_text_color.';"' : '';
$col_pos_abs = (!empty($col_pos_abs)) ? 'pos-abs' : '';
$col_pos_sta = (!empty($col_pos_sta)) ? 'pos-static' : '';

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	'cms-sameheight',
	$width,
	$css_animation,
	$col_pos_abs,
	$col_pos_sta
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$animate_delay_time = ( !empty($css_animation_delay) ) ? 'data-wow-delay="'.$css_animation_delay.'"' : '';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) .$animate_delay_time. ' >';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '" '.$column_text_color.'>';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
