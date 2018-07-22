<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $css
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$source = $text = $link = $google_fonts = $font_container = $el_class = $css = $font_container_data = $google_fonts_data = $cms_custom_headding_type = $cms_custom_remove_m = $cms_custom_headding_letterspacing = $text_rotator = '';
$text_rotator_array = array();
// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$cms_custom_headding_type = (isset($atts['cms_custom_headding_type'])) ? ' cms-custom-heading '.$atts['cms_custom_headding_type'].' cms-'.$font_container_data['values']['tag'] : '';
$cms_custom_remove_m = (!empty($cms_custom_remove_m)) ? ' cms-set-margin-0 ' : '';

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

if ( isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if ( ! empty( $styles ) ) {
	$style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
} else {
	$style = '';
}

if ( 'post_title' === $source ) {
	$text = get_the_title( get_the_ID() );
}

if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$text = '<a href="' . esc_attr( $link['url'] ) . '"'
		. ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
		. ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
		. '>' . wp_kses( $text, array('br' => array(), 'em' => array(), 'strong' => array(), ) ) . '</a>';
} else {
	if ( $atts['cms_custom_headding_type'] == 'text-rotator') {
		$text_rotator_array = explode('|', $text);

		if ( count($text_rotator_array) > 1 ) {
			$text_rotator .= '<span>'.$text_rotator_array[0].' </span>';
			$text_rotator .= '<span class="cd-words-wrapper waiting">';
			for ($i=0; $i < count($text_rotator_array); $i++) { 
				if ($i == 1) {
					$text_rotator .= '<b class="is-visible">'.$text_rotator_array[1].'</b>';
				}
				if ($i > 1) {
					$text_rotator .= '<b class="">'.$text_rotator_array[$i].'</b>';
				}
			}
			$text_rotator .= '</span>';
		}

		$text = $text_rotator;
	} else {
		$text = wp_kses( $text, array('i' => array(), 'br' => array(), 'em' => array(), 'strong' => array(), ) );
	}
}

$tag_inner_class = 'cms-heading-inner';
if ( $atts['cms_custom_headding_type'] == 'text-rotator') $tag_inner_class .= ' cd-headline zoom';

$output = '';
$output .= '<div class="' . esc_attr(trim($css_class. $cms_custom_headding_type. $cms_custom_remove_m.' '.$cms_custom_headding_letterspacing)) . '" >';
$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="'.$tag_inner_class.'">';
$output .= $text;
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= '</div>';
echo $output;