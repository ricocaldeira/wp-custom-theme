<?php
    $counter_layout = (!empty($atts['counter_layout'])) ? $atts['counter_layout'] : 'bold-layout';
?>
<div class="cms-counter-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="cms-counter-single <?php echo esc_attr($counter_layout); ?>">
		<div id="counter_<?php echo esc_attr($atts['html_id']);?>" class="cms-counter" data-suffix="<?php echo esc_attr($atts['suffix']);?>" data-prefix="<?php echo esc_attr($atts['prefix']);?>" data-type="<?php echo esc_attr(strtolower($atts['type']));?>" data-digit="<?php echo esc_attr($atts['digit']);?>">
		</div>
        <?php if($atts['c_title']):?>
            <h5><?php echo esc_html($atts['c_title']); ?></h5>
        <?php endif;?>
	</div>
</div>