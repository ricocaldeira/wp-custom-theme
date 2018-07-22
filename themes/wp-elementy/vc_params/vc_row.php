<?php

/*vc_add_param('vc_row', array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Use video background?', 'wp-elementy' ),
    'param_name' => 'video_bg',
    'description' => esc_html__( 'If checked, video will be used as row background.', 'wp-elementy' ),
    'value' => array(
        'None' => 'none',
        'Use Youtube Video' => 'youtube_bg',
        'Use Mp4' => 'mb4_bg',
    ),
    'group' => 'CMS Custom'
));
vc_add_param('vc_row', array(
    'type' => 'textfield',
    'heading' => esc_html__( 'YouTube link', 'wp-elementy' ),
    'param_name' => 'video_bg_url',
    'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
    // default video url
    'description' => esc_html__( 'Add YouTube link.', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'video_bg',
        'value' => 'youtube_bg',
    ),
    'group' => 'CMS Custom'
));*/
vc_add_param('vc_row', array(
    'type' => 'textfield',
    'heading' => esc_html__( 'Mp4 link', 'wp-elementy' ),
    'param_name' => 'video_mp4_link',
    'value' => '',
    // default video url
    'description' => esc_html__( 'Add Mp4 link.', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'video_bg',
        'value' => 'mb4_bg',
    ),
    'group' => 'CMS Custom'
));

vc_add_param('vc_row', array(
    'type' => 'textfield',
    'heading' => esc_html__( 'One Page Offset', 'wp-elementy' ),
    'param_name' => 'onepage_offset',
    'value' => '',
    'description' => esc_html__( 'Enter number if you want edit onepage scroll', 'wp-elementy' ),
    'group' => 'CMS Custom'
));

vc_add_param('vc_row', array(
	'type' => 'checkbox',
	'heading' => esc_html__( 'Overflow visible ?', 'wp-elementy' ),
	'param_name' => 'cms_row_ovf_vib',
	'description' => esc_html__( 'Set row is overflow visible', 'wp-elementy' ),
	'value' => array( esc_html__( 'Yes', 'wp-elementy' ) => 'yes' ),
	'group' => 'CMS Custom'
));

vc_add_param('vc_row', array(
    "type" => "dropdown",
    "heading" => esc_html__("Animation", 'wp-elementy'),
    "description" => esc_html__('Animation for this row', 'wp-elementy'),
    "param_name" => "css_animation",
    "value" => wp_elementy_animate_lib(),
    'group' => 'CMS Custom'
));

vc_add_param('vc_row', array(
    'type' => 'checkbox',
    'heading' => esc_html__("Row Arrow", 'wp-elementy'),
    'param_name' => 'row_arrow',
    'std' => false,
    'group' => 'CMS Custom'
));

vc_add_param("vc_row", array(
    'type' => 'vc_link',
    'heading' => esc_html__( 'URL (Link)', 'wp-elementy' ),
    'param_name' => 'link',
    'description' => esc_html__( 'Add link and text to arrow.', 'wp-elementy' ),
    'group' => 'CMS Custom',
    'dependency' => array(
        'element' => 'row_arrow',
        'value' => 'true',
    ),
));

vc_add_param("vc_row", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Arrow name', 'wp-elementy' ),
    'param_name' => 'arrow_name',
    'description' => esc_html__( 'Select arrow name.', 'wp-elementy' ),
    'value' => array(
    	'Arrow down' => 'icon-arrows-down'
    ),
    'group' => 'CMS Custom',
    'dependency' => array(
        'element' => 'row_arrow',
        'value' => 'true',
    ),
));

vc_add_param('vc_row', array(
    'type' => 'colorpicker',
    'heading' => esc_html__( 'Arrow color', 'wp-elementy' ),
    'param_name' => 'cms_arrow_color',
    'description' => esc_html__( 'Set color for arrow', 'wp-elementy' ),
    'group' => 'CMS Custom',
    'dependency' => array(
        'element' => 'row_arrow',
        'value' => 'true',
    ),
));

vc_add_param('vc_row', array(
    'type' => 'el_id',
    'heading' => esc_html__( 'Row ID', 'wp-elementy' ),
    'param_name' => 'el_id',
    'group' => 'CMS Custom',
    'description' => sprintf( esc_html__( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'wp-elementy' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
));
