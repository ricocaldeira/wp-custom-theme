<?php
vc_map(array(
    "name" => 'CMS Featured Products',
    "base" => "cms_featured_products",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => '',
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Select Layout", 'wp-elementy'),
            "param_name" => "cms_layout",
            "value" => array(
                'Set image is background' => 'single',
                'Show images' => 'list',
            ),
        ),
    )
));
class WPBakeryShortCode_cms_bgimage extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}