<?php
vc_add_param("vc_single_image", array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'CSS Animation', 'wp-elementy' ),
	'param_name' => 'css_animation',
	'value' => wp_elementy_animate_lib(),
	'description' => esc_html__( 'Select "animation in" for page transition.', 'wp-elementy' ),
));

vc_add_param("vc_single_image", array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'On click action', 'wp-elementy' ),
	'param_name' => 'onclick',
	'value' => array(
		esc_html__( 'None', 'wp-elementy' ) => '',
		esc_html__( 'Link to large image', 'wp-elementy' ) => 'img_link_large',
		esc_html__( 'Open Magnific Popup', 'wp-elementy' ) => 'link_image',
		esc_html__( 'Open custom link', 'wp-elementy' ) => 'custom_link',
		esc_html__( 'Zoom', 'wp-elementy' ) => 'zoom',
	),
	'description' => esc_html__( 'Select action for click action.', 'wp-elementy' ),
	'std' => ''
));