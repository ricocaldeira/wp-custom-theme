<?php
vc_add_param("vc_wp_custommenu", array(
    "heading" => esc_html__("Font family", 'wp-elementy'),
    "param_name" => "vc_wp_custommenu_font",
    'type' => 'dropdown',
    "admin_label" => true,
    'value' => wp_elementy_font_family_for_heading()
));

vc_add_param("vc_wp_custommenu", array(
    "type" => "colorpicker",
    "heading" => esc_html__( 'Link color', 'wp-elementy' ),
    "param_name" => "vc_wp_custommenu_color",
));

vc_add_param("vc_wp_custommenu", array(
    "type" => "colorpicker",
    "heading" => esc_html__( 'Link color hover', 'wp-elementy' ),
    "param_name" => "vc_wp_custommenu_color_hover",
));

vc_add_param("vc_wp_custommenu", array(
    "type" => "checkbox",
    "heading" => esc_html__( 'Set font weight bold', 'wp-elementy' ),
    "param_name" => "vc_wp_custommenu_font_bold",
));