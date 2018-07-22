<?php
$css = $el_class  = $font_family = '';
$pricing_package_name = $pricing_price = $pricing_currency = $pricing3_atts = $pricing_link = $pricing_feature = $a_href = $a_title = $a_target = '';
$pricing_options = array();

$classes = array();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$pricing_lists = array();
$classes[] = $el_class;
$classes[] = $cms_template;
$classes[] = vc_shortcode_custom_css_class($css);
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

$link = (isset($atts['pricing_link'])) ? $atts['pricing_link'] : '';
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_title = (!empty($link['title'])) ? $link['title'] : esc_html__('Get Started', 'wp-elementy');
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_blank';
}
$pricing_options = (array) vc_param_group_parse_atts($pricing3_atts);
?>

<div class="clearfix cms-pricing-wrap <?php echo esc_attr($css_class); ?>">
	<div class="cms-grid-item-pricing">
		<div class="cms-pricing-item-inner <?php echo (!empty($pricing_feature)) ? 'pricing-feature-item' : ''; ?>">
			<h1 class="cms-pricing-title <?php echo (!empty($pricing_feature)) ? 'pr-feature' : ''; ?> <?php echo esc_attr($font_family); ?>">
                <?php echo esc_html($pricing_package_name); ?>
            </h1>
            <div class="price-heading <?php echo (!empty($pricing_feature)) ? 'pr-feature' : ''; ?>">
				<span class="currency"><?php echo esc_html($pricing_currency) ?></span><span class="price"><?php echo esc_html($pricing_price); ?></span>
				<span class="time">mo</span>	
			</div>
			<?php if (!empty($pricing_options)) : ?>
				<div class="price-content <?php echo (!empty($pricing_feature)) ? 'pr-feature' : ''; ?>">		
					<ul class="pricing-options <?php echo esc_attr($font_family); ?>">
						<?php foreach ($pricing_options as $key => $value) {
							echo '<li>'. $value['pricing_attribute'] .'</li>';
						}?>
					</ul>
				</div>
			<?php endif; ?>
			<div class="price-button <?php echo ( $pricing_feature == 1 ) ? ' pr-feature' : '' ?>">
				<?php
                    if ( !empty($pricing_feature) ) {
                        echo '<a class="cms-button md cms-default cms-shape-rounded '.$font_family.'" href="'. esc_url($a_href) .'" target="'.esc_attr($a_target).'">'. esc_html($a_title) .'</a>';
                    } else {
                        echo '<a class="cms-button md cms-border cms-shape-rounded '.$font_family.'" href="'. esc_url($a_href) .'" target="'.esc_attr($a_target).'">'. esc_html($a_title) .'</a>';
                    }
                ?>
			</div>
		</div>
	</div>
</div>