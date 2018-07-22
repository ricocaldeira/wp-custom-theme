<?php
$step_heading_1 = $step_desc_1 = $step_heading_2 = $step_desc_2 = $step_heading_3 = $step_desc_3 = $final_heading = $bg_color = $bg_color_hover = $set_monserrat_font = $content_font = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$link = (isset($atts['link'])) ? $atts['link'] : '';
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}
$set_monserrat_font = (!empty($atts['set_monserrat_font'])) ? $atts['set_monserrat_font'] : 'font-poppins';
$font_weight_number = (!empty($atts['font_weight_number'])) ? $atts['font_weight_number'] : '';
?>
<div class="cms-progress-wrap p-110-cont <?php echo esc_attr($content_font); ?>">
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="cms-process wow fadeIn">
				<div class="cms-process-inner">
					<div class="proc-icon <?php echo esc_attr( $font_weight_number ); ?> pos-l-12">01</div>
					<h3 class="<?php echo esc_attr($set_monserrat_font); ?>"><?php echo wp_kses($step_heading_1, array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?></h3>
					<p><?php echo esc_html($step_desc_1); ?></p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="cms-process wow fadeIn" data-wow-delay="200ms">
				<div class="cms-process-inner">
					<div class="proc-icon <?php echo esc_attr( $font_weight_number ); ?>">02</div>
					<h3 class="<?php echo esc_attr($set_monserrat_font); ?>"><?php echo wp_kses($step_heading_2, array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?></h3>
					<p><?php echo esc_html($step_desc_2); ?></p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="cms-process wow fadeIn" data-wow-delay="400ms">
				<div class="cms-process-inner">
					<div class="proc-icon <?php echo esc_attr( $font_weight_number ); ?>">03</div>
					<h3 class="<?php echo esc_attr($set_monserrat_font); ?>"><?php echo wp_kses($step_heading_3, array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?></h3>
					<p><?php echo esc_html($step_desc_3); ?></p>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-6 col-sm-6">
			<div class="cms-process-a wow fadeIn" data-wow-delay="600ms" onclick="">
				<a href="<?php echo (!empty($a_href)) ? esc_url($a_href) : '#'; ?>" class="work-proc2-a <?php echo esc_attr($set_monserrat_font); ?>" target="<?php echo (!empty($a_target)) ? esc_attr($a_target) : ''; ?>">
					<div class="work-proc2-a-text">
						<?php
							$title_w = array();
							$title_w = explode('<br />', $final_heading);
							if ( count($title_w) > 1 ) {
								echo esc_html($title_w[0]);
								echo '<br /><span class="border-bot">'.$title_w[1].'</span>';
							} else {
								echo esc_html($title_w[0]);
							}
						?>
					</div>
					<div class="work-proc2-bg-block"></div>
				</a>
			</div>
		</div>
	</div>
</div>

