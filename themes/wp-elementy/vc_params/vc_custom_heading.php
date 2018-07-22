<?php
vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Custom Heading Type", 'wp-elementy'),
    "admin_label" => true,
    "param_name" => "cms_custom_headding_type",
    "value" => array(
        "Default" => "",
        "Heading with line" => "heading-line",
        "Heading with underline" => "heading-underline",
        "Text Rotator" => "text-rotator",
        "Special underline - (3px height, 100px width)" => "line-3-100",
        "Special underline - (5px height, 100px width)" => "line-5-100",
    ),
    "description" => esc_html__('Select custom heading type', 'wp-elementy'),
    "group" => esc_html__("CMS Custom", 'wp-elementy')
));

vc_add_param('vc_custom_heading', array(
    'type' => 'checkbox',
    'heading' => 'Remove margin default of heading',
    'param_name' => 'cms_custom_remove_m',
    'description' => 'Remove margin top and bottom default of Heading',
    'std' => false,
    "group" => esc_html__("CMS Custom", 'wp-elementy')
));

vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Letter spacing", 'wp-elementy'),
    "admin_label" => true,
    "param_name" => "cms_custom_headding_letterspacing",
    "value" => array(
        "Normal" => "",
        "1px" => "sp-1",
        "2px" => "sp-2",
        "3px" => "sp-3",
        "15px" => "sp-15",
    ),
    "description" => esc_html__('Select letter spacing for custom heading', 'wp-elementy'),
    "group" => esc_html__("CMS Custom", 'wp-elementy')
));