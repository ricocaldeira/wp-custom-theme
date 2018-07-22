<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var string $el_width
 * @var string $style
 * @var string $color
 * @var string $border_width
 * @var string $accent_color
 * @var string $el_class
 * @var string $align
 * @var string $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Separator
 */
$el_width = $style = $color = $border_width = $el_class = $align = $css = '';
$icon_name = $iconClass = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if ( isset($atts['icon_type']) ) {
	$icon_name = "icon_" . $atts['icon_type'];
	$iconClass = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
}
$class_to_filter = '';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$vc_text_separator = visual_composer()->getShortCode( 'vc_text_separator' );
$atts['layout'] = 'separator_no_text';

$css_inline = array();
$css_inline['border_width'] = !empty($atts['border_width']) ? $atts['border_width'].'px' : '1px';
$css_inline['border_style'] = !empty($atts['style']) ? $atts['style'] : 'solid';
$css_inline['border_color'] = $atts['color'];
?>
<div class="divider-wrap clearfix">
	<div class="divider <?php echo esc_attr( trim( $css_class.' '.$align ) ); ?>" style=" <?php echo (empty($iconClass)) ? 'height: '.$css_inline['border_width'].';' : '';  ?> border-top: <?php echo esc_attr($css_inline['border_width']) ?> <?php echo esc_attr($css_inline['border_style']) ?> <?php echo esc_attr($css_inline['border_color']) ?>">
		<?php if ($iconClass) : ?>
			<i class="<?php echo esc_attr($iconClass);?>" style="color: <?php echo esc_attr($css_inline['border_color']) ?>"></i>
		<?php endif; ?>
	</div>
</div>