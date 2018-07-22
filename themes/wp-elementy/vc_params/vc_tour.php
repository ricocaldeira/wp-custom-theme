<?php
vc_add_param("vc_tta_tour", array(
	'type' => 'dropdown',
	'param_name' => 'style',
	'value' => array(
		esc_html__( 'Style 1', 'wp-elementy' ) => 'tour-style-1',
		esc_html__( 'Style 2', 'wp-elementy' ) => 'tour-style-2',
	),
	'heading' => esc_html__( 'Style', 'wp-elementy' ),
	'description' => esc_html__( 'Select accordion display style.', 'wp-elementy' ),
));

vc_remove_param( "vc_tta_tour", "color" );
vc_remove_param( "vc_tta_tour", "shape" );