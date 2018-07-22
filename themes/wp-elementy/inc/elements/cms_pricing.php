<?php
vc_map(array(
    "name" => 'CMS Pricing Table',
    "base" => "cms_pricing",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" =>  '',
    "params" => array(
        array(
            "type" => "img",
            "param_name" => "cms_template",
            "admin_label" => true,
            "heading" => esc_html__("Shortcode Template",'wp-elementy'),
            "group" => esc_html__("Template", 'wp-elementy'),
            'value' => array(
                'pricing1' => get_template_directory_uri().'/vc_params/pricing/pricing-layout1.jpg',
                'pricing2' => get_template_directory_uri().'/vc_params/pricing/pricing-layout2.jpg',
            ),
        ),
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Package name",'wp-elementy'),
            "param_name" => "pricing_package_name",
            'admin_label' => true,
        ),
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Price",'wp-elementy'),
            "param_name" => "pricing_price",
        ),
        array(
            "type" => "textfield",
            "heading" =>esc_html__("Currency",'wp-elementy'),
            "param_name" => "pricing_currency",
        ),
        array(
            'type' => 'param_group',
            'heading' => 'Option',
            'param_name' => 'pricing3_atts',
            'value' => urlencode(
                json_encode( array(
                        array(
                            array(
                                'pricing_domain' => 'Single Domain'
                            ),
                        ),
                    ) 
                ) 
            ),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Option",'wp-elementy'),
                    "param_name" => "pricing_attribute",
                ),
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'wp-elementy' ),
            'param_name' => 'pricing_link',
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Is Feature ?',
            'param_name' => 'pricing_feature',
            'admin_label'=>true,
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra Class",'wp-elementy'),
            "param_name" => "el_class",
            "value" => "",
            "description" =>"",
            'group' => 'Custom'
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Font family",'wp-elementy'),
            "param_name" => "font_family",
            'value' => wp_elementy_font_family_for_heading(),
            "description" =>"Font family for heading and content",
            'group' => 'Custom'
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-elementy' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-elementy' ),
        ),
    )
));

class WPBakeryShortCode_cms_pricing extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}