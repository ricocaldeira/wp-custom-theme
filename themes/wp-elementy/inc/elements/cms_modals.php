<?php
vc_map(array(
    "name" => 'CMS Modals',
    "base" => "cms_modals",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('Modals popup', 'wp-elementy'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__( 'Modal Mode', 'wp-elementy' ),
            "param_name" => "cms_modals_mode",
            "value" => array(
                esc_html__('Follow Bootstrap', 'wp-elementy') => 'modal-bootstrap',
                esc_html__('Custom layout', 'wp-elementy') => 'modal-custom-layout',
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( 'Modal Button Text', 'wp-elementy' ),
            "param_name" => "cms_modals_btn_text",
            "value" => '',
            'dependency' => array(
                'element' => 'cms_modals_mode',
                'value' => array('modal-bootstrap'),
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( 'Modal Heading', 'wp-elementy' ),
            "param_name" => "cms_modals_heading",
            "value" => '',
            'admin_label' => true
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Featured Item", 'wp-elementy'),
            "param_name" => "image",
            'dependency' => array(
                'element' => 'cms_modals_mode',
                'value' => 'modal-custom-layout',
            ),
        ),
        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'heading' => esc_html__( 'Text', 'wp-elementy' ),
            'param_name' => 'content',
            'value' => esc_html__( '<p>I am message box. Click edit button to change this text.</p>', 'wp-elementy' ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__( 'Modal Size', 'wp-elementy' ),
            "param_name" => "cms_modals_size",
            "value" => array(
                esc_html__('Large', 'wp-elementy') => 'modal-lg',
                esc_html__('Small', 'wp-elementy') => 'modal-sm',
            ),
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__( 'Full width button', 'wp-elementy' ),
            "param_name" => "cms_btn_block",
            'dependency' => array(
                'element' => 'cms_modals_mode',
                'value' => array('modal-bootstrap'),
            ),
        ),
        /*array(
            "type" => "textfield",
            "heading" => esc_html__( "Extra class name", "wp-elementy" ),
            "param_name" => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "wp-elementy" )
        )*/
    )
));
class WPBakeryShortCode_cms_modals extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}