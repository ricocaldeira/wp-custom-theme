<?php
$mode = $item_title = $show_value = $value = $value_suffix = $bg_color = $color = $height = $layout = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="cms-progress-wraper">
    <div class="cms-progress-body">
        <div class="cms-progress-item-wrap <?php echo esc_attr($layout); ?>">
            <?php if ($layout == 'layout1') : ?>
                <div class="cms-progress progress" 
                    style="background-color:<?php echo esc_attr($bg_color);?>;
                    width: 100%;
                    height:<?php echo esc_attr($height);?>;
                    " >
                    <div id="item-<?php echo rand(0, 999); ?>" 
                        class="progress-bar" role="progressbar" 
                        data-valuetransitiongoal="<?php echo esc_attr($value); ?>" 
                        style="background-color:<?php echo esc_attr($color);?>;"
                        >
                        <div class="progressbar-inner">
                            <?php if($item_title):?>
                                <span class="cms-progress-title">
                                    <?php echo apply_filters('the_title',$item_title);?>
                                </span>
                            <?php endif;?>
                            <?php if($show_value == 'true'): ?>
                                <span class="progressbar-value">
                                    <?php echo ' - '.esc_html($value.$value_suffix);?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="progressbar-inner clearfix">
                    <?php if($item_title):?>
                        <span class="cms-progress-title pull-left">
                            <?php echo apply_filters('the_title',$item_title);?>
                        </span>
                    <?php endif;?>
                    <?php if($show_value == 'true'): ?>
                        <span class="progressbar-value pull-right">
                            <?php echo esc_html($value.$value_suffix);?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="cms-progress progress" 
                    style="background-color:<?php echo esc_attr($bg_color);?>;
                    width: 100%;
                    height:<?php echo esc_attr($height);?>;
                    " >
                    <div id="item-<?php echo rand(0, 999); ?>" 
                        class="progress-bar" role="progressbar" 
                        data-valuetransitiongoal="<?php echo esc_attr($value); ?>" 
                        style="background-color:<?php echo esc_attr($color);?>;"
                        >
                        <span>
                            <?php if($show_value): ?>
                                <?php echo esc_attr($value.$value_suffix);?>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
