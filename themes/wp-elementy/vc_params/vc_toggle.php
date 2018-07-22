<?php
vc_add_param("vc_toggle", array (
	'type' => 'dropdown',
	'param_name' => 'style',
	'value' => array(
		esc_html__( 'Border Heading', 'wp-elementy' ) => 'border-heading',
		esc_html__( 'Background Heading', 'wp-elementy' ) => 'bg-heading',
	),
	'heading' => esc_html__( 'Style', 'wp-elementy' ),
	'description' => esc_html__( 'Select accordion display style.', 'wp-elementy' ),
));

vc_add_param("vc_toggle", array (
	'type' => 'dropdown',
	'param_name' => 'style',
	'value' => array(
		esc_html__( 'Border Heading', 'wp-elementy' ) => 'border-heading',
		esc_html__( 'Background Heading', 'wp-elementy' ) => 'bg-heading',
	),
	'heading' => esc_html__( 'Style', 'wp-elementy' ),
	'description' => esc_html__( 'Select accordion display style.', 'wp-elementy' )
));

vc_add_param("vc_toggle", array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'CSS Animation', 'wp-elementy' ),
	'param_name' => 'css_animation',
	'value' => wp_elementy_animate_lib(),
	'description' => esc_html__( 'Select "animation in" for page transition.', 'wp-elementy' ),
));
vc_remove_param('vc_toggle', 'color');
vc_remove_param('vc_toggle', 'size');