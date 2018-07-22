<?php
vc_remove_param('cms_counter_single', 'title');
vc_remove_param('cms_counter_single', 'description');
vc_remove_param('cms_counter_single', 'content_align');
vc_remove_param('cms_counter_single', 'icon_type');
vc_remove_param('cms_counter_single', 'icon_fontawesome');
vc_remove_param('cms_counter_single', 'icon_openiconic');
vc_remove_param('cms_counter_single', 'icon_typicons');
vc_remove_param('cms_counter_single', 'icon_entypo');
vc_remove_param('cms_counter_single', 'icon_linecons');
vc_remove_param('cms_counter_single', 'icon_pixelicons');
vc_remove_param('cms_counter_single', 'icon_pe7stroke');
vc_remove_param('cms_counter_single', 'icon_rticon');
vc_remove_param('cms_counter_single', 'icon_glyphicons');

vc_add_param('cms_counter_single', array(
        "type" => "dropdown",
        "heading" => esc_html__("Layout", 'wp-elementy'),
        "param_name" => "counter_layout",
        "value" => array(
        	"Bold Layout" => "bold-layout",
        	"Normal Layout" => "normal-layout",
        	"Light Layout" => "light-layout",
        	),
        "group" => esc_html__("Counters Settings", 'wp-elementy')
    )
);