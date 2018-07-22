<?php
$heading = $image = $link = $animate_delay = $el_class = $a_href = $a_title = $a_target = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$link = (isset($atts['link'])) ? $atts['link'] : '';
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_title = $link['title'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_blank';
}

if (!empty($image)) {
    $attachment_image = wp_get_attachment_image_src($image, 'full');
    $image_url = $attachment_image[0];
}
?>

<div class="landing-item-wrap wow fadeIn mb-30 <?php echo esc_attr($el_class); ?>" <?php echo (!empty($animate_delay)) ? 'data-wow-delay="'.$animate_delay.'"': '';?>>
	<a class="lightbox-item" href="<?php echo esc_attr($a_href); ?>" target="<?php echo esc_attr($a_target); ?>" title="<?php echo esc_attr($a_title); ?>">
		<div class="landing-item-image">
			<img src="<?php echo esc_url($image_url); ?>" alt="">
		</div>
		<div class="landing-item-cont">
			<div class="btn-head">
				<h4><?php echo esc_html($heading); ?></h4>
			</div>
		</div>
	</a>
</div>