<?php
vc_add_param("vc_gallery", array (
	'type' => 'dropdown',
	'heading' => esc_html__( 'Gallery type', 'wp-elementy' ),
	'param_name' => 'type',
	'value' => array(
		esc_html__( 'Flex slider fade', 'wp-elementy' ) => 'flexslider_fade',
		esc_html__( 'Flex slider slide', 'wp-elementy' ) => 'flexslider_slide',
		esc_html__( 'Nivo slider', 'wp-elementy' ) => 'nivo',
		esc_html__( 'Image grid', 'wp-elementy' ) => 'image_grid',
	),
	'description' => esc_html__( 'Select gallery type.', 'wp-elementy' )
));

vc_add_param("vc_gallery", array(
	'type' => 'textfield',
	'heading' => esc_html__( 'Gutter', 'wp-elementy' ),
	'param_name' => 'grid_gutter',
	'value' => '',
	'description' => esc_html__( 'Margin right each item, for example: 10px, 20px.. Default is 30px', 'wp-elementy' ),
	'std' => '',
	'dependency' => array(
        'element' => 'type',
        'value' => array(
            'image_grid',
        ),
    ),
));

vc_add_param("vc_gallery", array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'On click action', 'wp-elementy' ),
	'param_name' => 'onclick',
	'value' => array(
		esc_html__( 'None', 'wp-elementy' ) => '',
		esc_html__( 'Link to large image', 'wp-elementy' ) => 'img_link_large',
		esc_html__( 'Open Magnific Popup', 'wp-elementy' ) => 'link_image',
		esc_html__( 'Open custom link', 'wp-elementy' ) => 'custom_link',
	),
	'description' => esc_html__( 'Select action for click action.', 'wp-elementy' ),
	'std' => ''
));