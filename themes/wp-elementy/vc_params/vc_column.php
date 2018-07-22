<?php
vc_add_param("vc_column", array(
	'type' => 'colorpicker',
	'heading' => esc_html__( 'Text color', 'wp-elementy' ),
	'param_name' => 'column_text_color',
	'description' => esc_html__( 'Set color for text in this column', 'wp-elementy' ),
	'group' => 'CMS Custom'
));

vc_add_param('vc_column', array(
	'type' => 'checkbox',
	'heading' => esc_html__( 'Is Absolute?', 'wp-elementy' ),
	'param_name' => 'col_pos_abs',
	'description' => esc_html__( 'Set this column is position absolute - min-width: 992px', 'wp-elementy' ),
	'value' => array( esc_html__( 'Yes', 'wp-elementy' ) => 'yes' ),
	'std' => false,
	'group' => 'CMS Custom'
));

vc_add_param('vc_column', array(
	'type' => 'checkbox',
	'heading' => esc_html__( 'Is Static?', 'wp-elementy' ),
	'param_name' => 'col_pos_sta',
	'description' => esc_html__( 'Set this column is position static', 'wp-elementy' ),
	'value' => array( esc_html__( 'Yes', 'wp-elementy' ) => 'yes' ),
	'group' => 'CMS Custom',
	'std' => false
));

vc_add_param("vc_column_inner", array(
	'type' => 'colorpicker',
	'heading' => esc_html__( 'Text color', 'wp-elementy' ),
	'param_name' => 'column_text_color',
	'description' => esc_html__( 'Set color for text in this column', 'wp-elementy' ),
	'group' => 'CMS Custom'
));

vc_add_param('vc_column', array(
	"type" => "dropdown",
    "heading" => esc_html__("Animation", 'wp-elementy'),
    "description" => esc_html__('Animation', 'wp-elementy'),
    "param_name" => "css_animation",
    "value" => wp_elementy_animate_lib(),
    'group' => 'CMS Custom'
));

vc_add_param('vc_column', array(
	"type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Animation Delay Time", 'wp-elementy'),
    "description" => esc_html__('Animation Delay Time', 'wp-elementy'),
    "param_name" => "css_animation_delay",
    "value" => wp_elementy_animate_time_delay_lib(),
    'group' => 'CMS Custom'
));

vc_add_param('vc_column_inner', array(
	"type" => "dropdown",
    "heading" => esc_html__("Font family", 'wp-elementy'),
    "description" => esc_html__('Font family for text in this row', 'wp-elementy'),
    "param_name" => "col_font_family",
    "value" => array('Default' => 'font-default') + wp_elementy_font_family_for_heading(),
    'group' => 'CMS Custom'
));

vc_add_param('vc_column_inner', array(
	"type" => "dropdown",
    "heading" => esc_html__("Animation", 'wp-elementy'),
    "description" => esc_html__('Animation', 'wp-elementy'),
    "param_name" => "css_animation",
    "value" => wp_elementy_animate_lib(),
    'group' => 'CMS Custom'
));