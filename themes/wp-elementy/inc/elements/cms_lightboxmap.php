<?php
vc_map(array(
    "name" => 'CMS Lightbox Map',
    "base" => "cms_lightboxmap",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('Lightbox Map', 'wp-elementy'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__( 'Map Link', 'wp-elementy' ),
            "param_name" => "map_link",
            "value" => ''
        ),
        array (
            "type" => "attach_image",
            "heading" => esc_html__("Image thumbnail",'wp-elementy'),
            "param_name" => "image_thumbnail",
            "description" => esc_html__("Thumbnail for video", 'wp-elementy')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__( "Extra class name", 'wp-elementy' ),
            "param_name" => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wp-elementy' )
        )
    )
));
class WPBakeryShortCode_cms_lightboxmap extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}