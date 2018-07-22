<?php
vc_remove_param('cms_progressbar', 'icon_type');
vc_remove_param('cms_progressbar', 'icon_fontawesome');
vc_remove_param('cms_progressbar', 'icon_openiconic');
vc_remove_param('cms_progressbar', 'icon_openiconic');
vc_remove_param('cms_progressbar', 'icon_typicons');
vc_remove_param('cms_progressbar', 'icon_entypo');
vc_remove_param('cms_progressbar', 'icon_linecons');
vc_remove_param('cms_progressbar', 'icon_pixelicons');
vc_remove_param('cms_progressbar', 'icon_pe7stroke');
vc_remove_param('cms_progressbar', 'width');
vc_remove_param('cms_progressbar', 'striped');
vc_remove_param('cms_progressbar', 'border_radius');


vc_add_param("cms_progressbar", array(
    "type" => "colorpicker",
    "heading" => esc_html__( 'Background Color Bar', 'wp-elementy' ),
    "param_name" => "bg_color",
    "group" => esc_html__("Progress Bar Settings", 'wp-elementy'),
    "value" =>"",
    "description" => esc_html__('Background color for wrapper bar. Default is #e9e9e9', 'wp-elementy')
));

vc_add_param("cms_progressbar", array(
	"type" => "dropdown",
	"heading" => esc_html__("Mode", 'wp-elementy'),
	"param_name" => "mode",
	"value" => array(
		"Horizontal" => "horizontal",
		),
	"group" => esc_html__("Progress Bar Settings",  'wp-elementy')
));

vc_add_param("cms_progressbar", array(
    "type" => "dropdown",
    "heading" => esc_html__("Layout", 'wp-elementy'),
    "param_name" => "layout",
    "value" => array(
    	"Layout 1" => "layout1",
    	"Layout 2" => "layout2"
    	),
    "group" => esc_html__("Progress Bar Settings", 'wp-elementy')
));