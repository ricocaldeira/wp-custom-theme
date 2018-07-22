<?php
vc_map(array(
    "name" => 'CMS Woocommerce',
    "base" => "cms_woocommerce",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('Cms Woocommerce', 'wp-elementy'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__( 'Number product ', 'wp-elementy' ),
            "param_name" => "dropcap_content",
            "value" => '',
            'admin_label' => true
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( "Extra class name", "wp-elementy" ),
            "param_name" => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wp-elementy" )
        )
    )
));
class WPBakeryShortCode_cms_dropcaps extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}