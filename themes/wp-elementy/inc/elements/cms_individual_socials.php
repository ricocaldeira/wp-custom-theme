<?php
vc_map(array(
    "name" => 'CMS Individual Social',
    "base" => "cms_individual_social",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('Show social from theme option', 'wp-elementy'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Select social", 'wp-elementy'),
            "param_name" => "social_position",
            "value" => array(
                'From Comming Soon Setting' => 'comming-soon',
                'From Footer Setting' => 'footer',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Content align',
            'param_name' => 'social_align',
            'value' => array(
                'Align Left' => 'text-left',
                'Align Center' => 'text-center',
                'Align Right' => 'text-right',
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Icon size',
            'param_name' => 'social_icon_size',
            'value' => array(
                'Normal - 16px' => 'icon-normal',
                'Large - 18px' => 'icon-large',
            )
        ),
    )
));
class WPBakeryShortCode_cms_individual_social extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}