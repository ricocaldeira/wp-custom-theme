<?php
vc_add_param("cms_carousel", array(
    'type' => 'dropdown',
    'admin_label' => true,
    'param_name' => 'crs_testi_layout',
    'heading' => esc_html__( 'Testimonial layout', 'wp-elementy' ),
    'value' => array(
        /*'layout1' => get_template_directory_uri().'/vc_params/testi/testi-1.png',*/
        'Layout 1' => 'layout1',
        'Layout 2' => 'layout2',
        'Layout 3' => 'layout3',
        'Layout 4' => 'layout4',
        'Layout 5' => 'layout5',
        'Layout 6' => 'layout6',
    ),
    'description' => esc_html__( 'Select testimoial layout.', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => array(
            'cms_carousel--testimonials.php',
        ),
    ),
    "group" => esc_html__("Template", 'wp-elementy'),
));

vc_add_param("cms_carousel", array(
    "heading" => esc_html__("Set nav outside of container?", 'wp-elementy'),
    "param_name" => "cms_arrow_outside",
    'type' => 'checkbox',
    'dependency' => array(
        'element' => 'cms_template',
        'value' => 'cms_carousel--testimonials.php'
    ),
    'std' => false,
    "group" => esc_html__("Template", 'wp-elementy'),
));

vc_add_param("cms_carousel", array(
    'type' => 'dropdown',
    'admin_label' => true,
    'param_name' => 'cms_testi_color',
    'heading' => esc_html__( 'Testimonial color', 'wp-elementy' ),
    'value' => array(
        'Default color' => 'default',
        'White color' => 'white-color',
    ),
    'description' => esc_html__( 'Select testimoial color. Just appear for layout 6', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => array(
            'cms_carousel--testimonials.php',
        ),
    ),
    "group" => esc_html__("Template", 'wp-elementy'),
));

vc_add_param('cms_carousel', array(
    'type' => 'dropdown',
    'heading' => 'Font family',
    'param_name' => 'set_monserrat_font',
    'value' => wp_elementy_font_family_for_heading(),
    "description" => '',
    'dependency' => array(
        'element' => 'crs_testi_layout',
        'value' => 'layout6',
    ),
    "group" => esc_html__("Template", 'wp-elementy'),
));

vc_add_param("cms_carousel", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Icon library', 'wp-elementy' ),
    'value' => array(
        esc_html__( 'Font Awesome', 'wp-elementy' ) => 'fontawesome',
        esc_html__( 'Elegant Icon', 'wp-elementy' ) => 'elegant',
        esc_html__( 'Linea Icons', 'wp-elementy' ) => 'lineaicon',
    ),
    'param_name' => 'l_icon_type',
    'description' => esc_html__( 'Select icon library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));

vc_add_param("cms_carousel", array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Prev Icon', 'wp-elementy' ),
    'param_name' => 'l_icon_fontawesome',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'fontawesome',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'l_icon_type',
        'value' => 'fontawesome',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));

vc_add_param("cms_carousel", array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Prev Icon', 'wp-elementy' ),
    'param_name' => 'l_icon_lineaicon',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'lineaicon',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'l_icon_type',
        'value' => 'lineaicon',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));

vc_add_param("cms_carousel", array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Prev Icon', 'wp-elementy' ),
    'param_name' => 'l_icon_elegant',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'elegant',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'l_icon_type',
        'value' => 'elegant',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));

vc_add_param("cms_carousel", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Icon library', 'wp-elementy' ),
    'value' => array(
        esc_html__( 'Font Awesome', 'wp-elementy' ) => 'fontawesome',
        esc_html__( 'Elegant Icon', 'wp-elementy' ) => 'elegant',
        esc_html__( 'Linea Icons', 'wp-elementy' ) => 'lineaicon',
    ),
    'param_name' => 'r_icon_type',
    'description' => esc_html__( 'Select icon library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));

vc_add_param("cms_carousel", array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Next Icon', 'wp-elementy' ),
    'param_name' => 'r_icon_fontawesome',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'fontawesome',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'r_icon_type',
        'value' => 'fontawesome',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));

vc_add_param("cms_carousel", array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Next Icon', 'wp-elementy' ),
    'param_name' => 'r_icon_lineaicon',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'lineaicon',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'r_icon_type',
        'value' => 'lineaicon',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));

vc_add_param("cms_carousel", array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Next Icon', 'wp-elementy' ),
    'param_name' => 'r_icon_elegant',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'elegant',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'r_icon_type',
        'value' => 'elegant',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    "group" => esc_html__("Carousel Settings", 'wp-elementy')
));


























