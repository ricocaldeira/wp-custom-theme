<?php
vc_remove_param('vc_btn', 'i_align');
vc_remove_param('vc_btn', 'css_animation');
vc_remove_param('vc_btn', 'custom_onclick');
vc_remove_param('vc_btn', 'custom_onclick_code');

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Style', 'wp-elementy' ),
    'description' => esc_html__( 'Select button display style.', 'wp-elementy' ),
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'Default', 'wp-elementy' ) => 'cms-default',
        esc_html__( 'Border button', 'wp-elementy' ) => 'cms-border',
        esc_html__( 'Button with icon', 'wp-elementy' ) => 'cms-has-icon',
        esc_html__( 'Fullwidth button', 'wp-elementy' ) => 'fullwidth',
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Fullwidth color', 'wp-elementy' ),
    'description' => esc_html__( 'Select button color.', 'wp-elementy' ),
    'param_name' => 'fullwidth_color',
    'value' => array(
        esc_html__( 'Default', 'wp-elementy' ) => '',
        esc_html__( 'Dark color', 'wp-elementy' ) => 'fullw-dark-color',
    ),
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'fullwidth',
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Shape', 'wp-elementy' ),
    'description' => esc_html__( 'Select button shape.', 'wp-elementy' ),
    'param_name' => 'shape',
    // need to be converted
    'value' => array(
        esc_html__( 'Rounded', 'wp-elementy' ) => 'rounded',
        esc_html__( 'Square', 'wp-elementy' ) => 'square',
        esc_html__( 'Round', 'wp-elementy' ) => 'round',
    ),
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default',
            'cms-border',
            'cms-has-icon',
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Alignment', 'wp-elementy' ),
    'param_name' => 'align',
    'description' => esc_html__( 'Select button alignment.', 'wp-elementy' ),
    // compatible with btn2, default left to be compatible with btn1
    'value' => array(
        esc_html__( 'Inline', 'wp-elementy' ) => 'inline',
        // default as well
        esc_html__( 'Left', 'wp-elementy' ) => 'left',
        // default as well
        esc_html__( 'Right', 'wp-elementy' ) => 'right',
        esc_html__( 'Center', 'wp-elementy' ) => 'center',
    ),
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default',
            'cms-border',
            'cms-has-icon',
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Add icon?', 'wp-elementy' ),
    'param_name' => 'add_icon',
    'default' => "false",
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default',
            'cms-border',
            'cms-has-icon',
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Color', 'wp-elementy' ),
    'param_name' => 'color',
    'description' => esc_html__( 'Select button color.', 'wp-elementy' ),
    'value' => array(
           esc_html__( 'Dark', 'wp-elementy' ) => 'default',
           esc_html__( 'Gray', 'wp-elementy' ) => 'cms-gray',
           esc_html__( 'Cyan', 'wp-elementy' ) => 'cms-cyan',
           esc_html__( 'Violet', 'wp-elementy' ) => 'cms-violet',
           esc_html__( 'Blue', 'wp-elementy' ) => 'cms-blue',
           esc_html__( 'Teal', 'wp-elementy' ) => 'cms-teal',
           esc_html__( 'Green', 'wp-elementy' ) => 'cms-green',
           esc_html__( 'Lime', 'wp-elementy' ) => 'cms-lime',
           esc_html__( 'Yellow Light', 'wp-elementy' ) => 'cms-yellow-light',
           esc_html__( 'Deeporange', 'wp-elementy' ) => 'cms-deeporange',
           esc_html__( 'White', 'wp-elementy' ) => 'cms-white',
       ),
    'std' => '',
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default',
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Size', 'wp-elementy' ),
    'param_name' => 'size',
    'description' => esc_html__( 'Select button display size.', 'wp-elementy' ),
    'std' => 'md',
    'value' => array(
        esc_html__( 'Large', 'wp-elementy' ) => 'lg',
        esc_html__( 'Medium', 'wp-elementy' ) => 'md',
        esc_html__( 'Small', 'wp-elementy' ) => 'sm',
    ),
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default', 'cms-border', 'cms-has-icon'
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Animate for icon', 'wp-elementy' ),
    'param_name' => 'css_animation',
    'description' => esc_html__( 'Select button color.', 'wp-elementy' ),
    'value' => array(
           // Btn1 Colors
           esc_html__( 'No', 'wp-elementy' ) => '',
           esc_html__( 'From Top', 'wp-elementy' ) => 'from-top',
           esc_html__( 'From Left', 'wp-elementy' ) => 'from-left',
           esc_html__( 'Right Out', 'wp-elementy' ) => 'right-out',
           esc_html__( 'Right In', 'wp-elementy' ) => 'right-in',
           esc_html__( 'Fade in', 'wp-elementy' ) => 'fade-in',
           esc_html__( 'Fade out', 'wp-elementy' ) => 'fade-out',
           esc_html__( 'Left In', 'wp-elementy' ) => 'hide-left-in',
       ),
    'std' => '',
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default', 'cms-border', 'cms-has-icon'
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Block button', 'wp-elementy' ),
    'param_name' => 'set_block',
    'std' => false,
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default', 'cms-border', 'cms-has-icon'
        ),
    ),
));