<?php
vc_add_param("vc_tta_accordion", array(
	'type' => 'dropdown',
	'param_name' => 'style',
	'value' => array(
		esc_html__( 'Border Heading', 'wp-elementy' ) => 'border-heading',
		esc_html__( 'Background Heading', 'wp-elementy' ) => 'bg-heading',
	),
	'heading' => esc_html__( 'Style', 'wp-elementy' ),
	'description' => esc_html__( 'Select accordion display style.', 'wp-elementy' ),
));

vc_remove_param( "vc_tta_accordion", "color" );
vc_remove_param( "vc_tta_accordion", "shape" );
vc_remove_param( "vc_tta_accordion", "no_fill" );