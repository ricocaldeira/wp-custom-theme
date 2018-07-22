<?php
vc_map(array(
    "name" => 'CMS Special Image',
    "base" => "cms_bgimage",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('Set image is background with min-width: 992px or show image with grid layout', 'wp-elementy'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Select Layout", 'wp-elementy'),
            "param_name" => "cms_layout",
            "value" => array(
                'Set image is background' => 'single',
                'Show images' => 'list',
                'App download lists' => 'list-app',
            ),
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Select Image", 'wp-elementy'),
            "param_name" => "image",
            'dependency' => array(
                'element' => 'cms_layout',
                'value' => 'single',
            ),
        ),
        array(
            "type" => "attach_images",
            "heading" => esc_html__("Select Images", 'wp-elementy'),
            "param_name" => "images",
            'dependency' => array(
                'element' => 'cms_layout',
                'value' => array('list', 'list-app'),
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Background Position", 'wp-elementy'),
            "description" => esc_html__('Set background position for image bg', 'wp-elementy'),
            "param_name" => "bg_image_position",
            "value" => wp_elementy_background_position(),
            'dependency' => array(
                'element' => 'cms_layout',
                'value' => 'single',
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Animation Effect", 'wp-elementy'),
            "description" => esc_html__('Animation effect', 'wp-elementy'),
            "param_name" => "css_animation",
            "value" => wp_elementy_animate_lib(),
            'dependency' => array(
                'element' => 'cms_layout',
                'value' => array('single', 'list'),
            ),
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__("Custom Links", 'wp-elementy'),
            "description" => esc_html__('Enter links for each image (Note: divide links with linebreaks (Enter)).', 'wp-elementy'),
            "param_name" => "custom_links",
            "value" => '',
            'dependency' => array(
                'element' => 'cms_layout',
                'value' => array('list-app'),
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( "Extra class name", "wp-elementy" ),
            "param_name" => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wp-elementy" )
        )
    )
));
class WPBakeryShortCode_cms_bgimage extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}