<?php
vc_remove_param( 'vc_images_carousel', 'mode' );
vc_remove_param( 'vc_images_carousel', 'partial_view' );
vc_remove_param( 'vc_images_carousel', 'speed' );

vc_add_param("vc_images_carousel", array (
	'type' => 'dropdown',
	'heading' => esc_html__( 'On click action', 'wp-elementy' ),
	'param_name' => 'onclick',
	'value' => array(
		esc_html__( 'Open Magific Popup', 'wp-elementy' ) => 'link_image',
		esc_html__( 'None', 'wp-elementy' ) => 'link_no',
		esc_html__( 'Open custom links', 'wp-elementy' ) => 'custom_link',
	),
	'description' => esc_html__( 'Select action for click event.', 'wp-elementy' ),
));

vc_add_param("vc_images_carousel", array (
	'type' => 'dropdown',
	'heading' => esc_html__( 'Pagination position', 'wp-elementy' ),
	'param_name' => 'paging_postition',
	'value' => array(
		esc_html__( 'Inside', 'wp-elementy' ) => 'paging_inside',
		esc_html__( 'Outside', 'wp-elementy' ) => 'paging_outside',
	),
	'description' => esc_html__( 'Select pagination position', 'wp-elementy' ),
));