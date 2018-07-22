<?php
vc_add_param("vc_tta_tabs", array(
	'type' => 'dropdown',
	'param_name' => 'style',
	'value' => array(
		esc_html__( 'Style 1', 'wp-elementy' ) => 'tab-style-1',
		esc_html__( 'Style 2', 'wp-elementy' ) => 'tab-style-2',
		esc_html__( 'Style 3', 'wp-elementy' ) => 'tab-style-3',
		esc_html__( 'Style 4', 'wp-elementy' ) => 'tab-style-4',
		esc_html__( 'Tab Icon', 'wp-elementy' ) => 'tab-style-5',
	),
	'heading' => esc_html__( 'Style', 'wp-elementy' ),
	'description' => esc_html__( 'Select accordion display style.', 'wp-elementy' ),
));

vc_remove_param( "vc_tta_tabs", "color" );
vc_remove_param( "vc_tta_tabs", "shape" );