<?php
vc_add_param("vc_message", array (
	'type' => 'checkbox',
	'heading' => esc_html__( 'Alerts closable ?', 'wp-elementy' ),
	'param_name' => 'message_closeable',
	'description' => esc_html__( 'Alerts closable', 'wp-elementy' ),
	'value' => array( esc_html__( 'Yes', 'wp-elementy' ) => 'yes' )
));

vc_add_param("vc_message", array (
	'type' => 'checkbox',
	'heading' => esc_html__( 'Remove Icon ?', 'wp-elementy' ),
	'param_name' => 'message_remove_icon',
	'description' => esc_html__( 'Remove icon', 'wp-elementy' ),
	'value' => array( esc_html__( 'Yes', 'wp-elementy' ) => 'yes' ),
	'std' => "false"
));