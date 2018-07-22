<?php
vc_map(array(
    "name" => 'CMS Landing Item',
    "base" => "cms_landing_item",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('Create landing item', 'wp-elementy'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Heading", 'wp-elementy'),
            "param_name" => "heading",
            'admin_label' => true
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Select Image", 'wp-elementy'),
            "param_name" => "image",
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'wp-elementy' ),
            'param_name' => 'link',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Animate Delay', 'wp-elementy' ),
            'param_name' => 'animate_delay',
            'value' => wp_elementy_animate_time_delay_lib()
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( "Extra class name", "wp-elementy" ),
            "param_name" => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wp-elementy" )
        )
    )
));
class WPBakeryShortCode_cms_landing_item extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}