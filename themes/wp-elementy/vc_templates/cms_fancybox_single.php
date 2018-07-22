<?php
    $icon_name = $iconClass = $hover_effect = $fancy_style = $button_style = $shape = $add_underline = $set_monserrat_font = $mg_bt = $font_family = $value_color = $text_number = $content_font = '';

    $icon_name = "icon_" . $atts['icon_type'];
    $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
    $icon_size = (!empty($atts['icon_size'])) ? $atts['icon_size'] : 'icon-large';
    $icon_size_3 = (!empty($atts['icon_size_3'])) ? $atts['icon_size_3'] : '';

    $fancy_style = isset($atts['fancy_style']) ? $atts['fancy_style'] : 'style1';
    $hover_effect = isset($atts['hover_effect']) ? $atts['hover_effect'] : '';

    $link = (isset($atts['link'])) ? $atts['link'] : '';
    $link = vc_build_link( $link );
    $use_link = false;
    if ( strlen( $link['url'] ) > 0 ) {
        $use_link = true;
        $a_href = $link['url'];
        $a_title = $link['title'];
        $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
    }
    $button_style = (!empty($atts['button_style'])) ? $atts['button_style'] : ' gray ';
    $shape = (!empty($atts['shape'])) ? $atts['shape'] : ' cms-shape-rounded ';

    $image_url = '';
    if (!empty($atts['image'])) {
        $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
        $image_url = $attachment_image[0];
    }

    $animate_class = isset($atts['css_animation']) ? $atts['css_animation'] : 'wow fadeIn';
    $animates = array();
    $animates[] = (!empty($atts['css_animation_delay'])) ? 'data-wow-delay="'.esc_attr($atts['css_animation_delay']).'"' : '';
    $animates[] = (!empty($atts['css_duration'])) ? 'data-wow-duration="'.esc_attr($atts['css_duration']).'"' : '';

    $heading_color = (!empty($atts['heading_color'])) ? $atts['heading_color'] : '';
    $desc_color = (!empty($atts['desc_color'])) ? $atts['desc_color'] : '';
    $mg_bt = (!empty($atts['mg-bt'])) ? $atts['mg-bt'] : 'mb-50';
    $value_color = (!empty($atts['value_color'])) ? $atts['value_color'] : '';

    $font_family = (!empty($atts['font-family'])) ? $atts['font-family'] : 'font-poppins';
    $font_family_heading = (!empty($atts['font-family-heading'])) ? $atts['font-family-heading'] : 'font-poppins';
    $set_monserrat_font = (!empty($atts['set_monserrat_font'])) ? $atts['set_monserrat_font'] : 'font-poppins';
    $content_font = (!empty($atts['content_font'])) ? $atts['content_font'] : 'font-default';
?>

<div class="cms-fancyboxes-wraper <?php echo esc_attr($atts['template'].' fancy-'.$fancy_style);?> <?php echo esc_attr($animate_class); ?> clearfix" <?php echo implode(' ', $animates); ?> id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="cms-fancybox-item <?php echo esc_attr($fancy_style); ?>" onclick="">
        <?php switch ($fancy_style) {
            case 'style1':
                ?>
                    <div class="fancy-content">
                        <?php if ($use_link) : ?>
                            <a href="<?php echo esc_url($a_href) ?>" class="" target="<?php echo esc_attr($a_target) ?>">
                                <img src="<?php echo esc_url($image_url);?>" alt="" />
                            </a>  
                        <?php endif; ?>
                    </div>   
                <?php
                break;

            case 'style2':
                ?>
                    <?php if ( !empty($iconClass) ): ?>
                        <i class="<?php echo esc_attr($iconClass);?>"></i>  
                    <?php endif; ?>
                    <?php if (!empty($atts['title_item'])) : ?>
                        <h6>
                            <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                        </h6>
                    <?php endif; ?>
                <?php
                break;

            case 'style3':
                ?>
                    <div class="text-center <?php echo (!empty($icon_size_3)) ? 'mb-40 mt-25 '.$icon_size_3 : 'mb-70'; ?>">
                        <?php if ( !empty($iconClass) ): ?>
                            <div class="fancy-icon">
                                <i class="<?php echo esc_attr($iconClass);?>"></i>     
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($atts['title_item'])) : ?>
                            <h3 class="fancy-title">
                                <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if (!empty($atts['description_item'])) : ?>
                            <div class="fancy-desc">
                                <?php echo esc_html($atts['description_item']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                break;

            case 'style4':
                ?>
                    <div class="text-left">
                        <?php if ( !empty($iconClass) ): ?>
                            <div class="fancy-icon">
                                <i class="<?php echo esc_attr($iconClass);?>"></i>     
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($atts['title_item'])) : ?>
                            <h3 class="fancy-title">
                                <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if (!empty($atts['description_item'])) : ?>
                            <div class="fancy-desc">
                                <?php echo esc_html($atts['description_item']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                break;

            case 'style5':
                ?>
                    <div class="text-left mb-50">
                        <div class="fancy-header-wrap">
                            <?php if ( !empty($iconClass) ): ?>
                                <div class="fancy-icon">
                                    <i class="<?php echo esc_attr($iconClass);?>"></i>     
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($atts['title_item'])) : ?>
                                <h3 class="fancy-title">
                                    <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                                </h3>
                            <?php endif; ?>   
                        </div>
                        <?php if (!empty($atts['description_item'])) : ?>
                            <div class="fancy-desc">
                                <?php echo esc_html($atts['description_item']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                break;

            case 'style6':
                $add_underline = (!empty($atts['add_underline'])) ? 'line5-100' : '';
                ?>
                    <div class="fes2-main-text-cont">
                        <?php if (!empty($atts['title_item'])) : ?>
                            <h3 class="fes2-title-45 <?php echo ( !empty($add_underline)) ? $add_underline : '';?> <?php echo esc_attr($set_monserrat_font); ?>" <?php echo (!empty($heading_color)) ? 'style="color: '.$heading_color.';"' : ''; ?>>
                                <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if (!empty($atts['description_item'])) : ?>
                            <div class="fancy-desc mt-30 <?php echo esc_attr($content_font); ?>" <?php echo (!empty($desc_color)) ? 'style="color: '.$desc_color.';"' : ''; ?>>
                                <?php echo esc_html($atts['description_item']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($use_link) : ?>
                            <div class="mt-30">
                                <a href="<?php echo esc_url($a_href) ?>" class="cms-button md <?php echo esc_attr($button_style.' '.$shape.' '.$content_font); ?> <?php echo (!empty($atts['button_arrow'])) ? 'has-effect' : '' ?>" target="<?php echo esc_attr($a_target) ?>">
                                    <span class="button-text-anim"><?php echo wp_kses($a_title, array('b' => array(), 'strong' => array() )); ?></span>
                                    <?php if (!empty($atts['button_arrow'])) : ?>
                                        <i class="arrow_right"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                break;

            case 'style7':
                ?>
                    <div class="text-left <?php echo ( empty($iconClass) ) ? 'no-icon pb-10' : $mg_bt; ?> <?php echo esc_attr($icon_size); ?>">
                        <?php if (!empty($iconClass) || !empty($atts['title_item'])) :?>
                        <div class="fancy-header-wrap">
                            <?php if ( !empty($iconClass) ): ?>
                                <div class="fancy-icon" style="color: <?php echo esc_attr($value_color); ?>">
                                    <i class="<?php echo esc_attr($iconClass);?>"></i>     
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($atts['title_item'])) : ?>
                                <h3 class="fancy-title <?php echo esc_attr($font_family); ?>" style="color: <?php echo esc_attr($value_color); ?>">
                                    <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                                </h3>
                            <?php endif; ?>   
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($atts['description_item'])) : ?>
                            <div class="fancy-desc <?php echo esc_attr($content_font); ?>" style="color: <?php echo esc_attr($value_color); ?>">
                                <?php echo esc_html($atts['description_item']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                break;
            case 'style8':
                ?>
                    <div class="text-left">
                        <?php if ( !empty($iconClass) ): ?>
                            <div class="fancy-icon">
                                <i class="<?php echo esc_attr($iconClass);?>"></i>     
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($atts['title_item'])) : ?>
                            <h3 class="fancy-title">
                                <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if (!empty($atts['description_item'])) : ?>
                            <div class="fancy-desc">
                                <?php echo esc_html($atts['description_item']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                break;

            case 'style10':
                ?>
                    <div class="pb-20">
                        <div class="fancy-style10-inner">
                            <?php if (!empty($atts['text_number'])) : ?>
                                <div class="fancy-number">
                                    <?php echo esc_html($atts['text_number']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($atts['title_item'])) :?>
                                <h3 class="fancy-title <?php echo esc_attr($font_family_heading); ?>">
                                    <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array('class' => array()), )); ?>
                                </h3>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                break;
            default: 
                ?>
                    <div class="cis-cont">
                        <?php if ( !empty($iconClass) ): ?> 
                            <div class="cis-icon">
                                <i class="<?php echo esc_attr($iconClass);?>"></i>   
                            </div>
                        <?php endif; ?>
                        <div class="cis-text">
                            <?php if (!empty($atts['title_item'])) : ?>
                                <h3 class="fancy-title <?php echo esc_attr($font_family_heading); ?>">
                                    <?php echo wp_kses($atts['title_item'], array('br' => array(), 'b' => array(), 'em' => array(), 'strong' => array('class' => array()), )); ?>
                                </h3>
                            <?php endif; ?>
                            <?php if (!empty($atts['description_item'])) : ?>
                                <div class="fancy-desc">
                                    <?php echo wp_kses($atts['description_item'], array('a' => array('href' => array(), 'title' => array() ), 'br' => array(), 'b' => array(), 'em' => array(), 'strong' => array(), )); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                break;
        } ?>
    </div>
</div>