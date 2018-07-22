<?php
vc_remove_param('cms_fancybox_single', 'title');
vc_remove_param('cms_fancybox_single', 'description');
vc_remove_param('cms_fancybox_single', 'content_align');
vc_remove_param('cms_fancybox_single', 'button_type');
vc_remove_param('cms_fancybox_single', 'button_link');
vc_remove_param('cms_fancybox_single', 'button_text');

vc_add_param('cms_fancybox_single', array(
    "type" => "textfield",
    "heading" => esc_html__("Number",'wp-elementy'),
    "param_name" => "text_number",
    "value" => "",
    "description" => esc_html__("Number Of Item",'wp-elementy'),
    'group' => 'Fancy Content',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style10'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    "type" => "textfield",
    "heading" => esc_html__("Title Item",'wp-elementy'),
    "param_name" => "title_item",
    "value" => "",
    "description" => esc_html__("Title Of Item",'wp-elementy'),
    'group' => 'Fancy Content',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style2', 'style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9', 'style10'),
    ),
    'admin_label' => true
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Font family for heading",'wp-elementy'),
    'param_name' => 'font-family-heading',
    'value' => wp_elementy_font_family_for_heading(),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style9'),
    ),
    'group' => 'Custom Font'
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'checkbox',
    'heading' => 'Add underline ?',
    'param_name' => 'add_underline',
    "description" => esc_html__("Just appear for layout 6",'wp-elementy'),
    "group" => esc_html__("Fancy Content", 'wp-elementy'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
    'std' => "false"
));

vc_add_param('cms_fancybox_single', array(
    "type" => "textarea",
    "heading" => esc_html__("Content Item",'wp-elementy'),
    "param_name" => "description_item",
    'group' => 'Fancy Content',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9'),
    ),
));

vc_add_param("cms_fancybox_single", array(
    "type" => "attach_image",
    "heading" => esc_html__("Image Item", 'wp-elementy'),
    "param_name" => "image",
    'group' => 'Fancy Content',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => 'style1',
    ),
));

vc_add_param("cms_fancybox_single", array(
    'type' => 'vc_link',
    'heading' => esc_html__( 'URL (Link)', 'wp-elementy' ),
    'param_name' => 'link',
    'description' => esc_html__( 'Add link to button.', 'wp-elementy' ),
    'group' => 'Fancy Content',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style1', 'style6'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Button styles",'wp-elementy'),
    'param_name' => 'button_style',
    "group" => esc_html__("Fancy Content", 'wp-elementy'),
    'value' => array(
        esc_html__( 'Dark Button', 'wp-elementy' ) => 'gray',
        esc_html__( 'White Button', 'wp-elementy' ) => 'cms-white',
        esc_html__( 'Border Dark Button', 'wp-elementy' ) => 'cms-dark-border',
        esc_html__( 'Border White Button', 'wp-elementy' ) => 'cms-white-border',
    ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Button Shape",'wp-elementy'),
    'param_name' => 'shape',
    "group" => esc_html__("Fancy Content", 'wp-elementy'),
    'value' => array(
        esc_html__( 'Rounded', 'wp-elementy' ) => 'cms-shape-rounded',
        esc_html__( 'Square', 'wp-elementy' ) => 'cms-shape-square',
        esc_html__( 'Round', 'wp-elementy' ) => 'cms-shape-round',
    ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'checkbox',
    'heading' => 'Add arrow to button',
    'param_name' => 'button_arrow',
    "description" => esc_html__("Just appear for layout 6",'wp-elementy'),
    "group" => esc_html__("Fancy Content", 'wp-elementy'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    "type" => "textfield",
    "heading" => esc_html__("Extra Class",'wp-elementy'),
    "param_name" => "class",
    "value" => "",
    "description" => '',
    "group" => esc_html__("Template", 'wp-elementy'),
));

/* Start Icon */
vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Icon library', 'wp-elementy' ),
    'param_name' => 'icon_type',
    'value' => array(
        esc_html__( 'Font Awesome', 'wp-elementy' ) => 'fontawesome',
        esc_html__( 'Elegant Icon', 'wp-elementy' ) => 'elegant',
        esc_html__( 'Linea Icons', 'wp-elementy' ) => 'lineaicon',
    ),
    'description' => esc_html__( 'Select icon library.', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style2', 'style3', 'style4', 'style5', 'style7', 'style8', 'style9'),
    ),
    'group' => 'Fancy Content',
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Icon Item', 'wp-elementy' ),
    'param_name' => 'icon_fontawesome',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'fontawesome',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'icon_type',
        'value' => 'fontawesome',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    'group' => 'Fancy Content',
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Icon Item', 'wp-elementy' ),
    'param_name' => 'icon_lineaicon',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'lineaicon',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'icon_type',
        'value' => 'lineaicon',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    'group' => 'Fancy Content',
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Icon', 'wp-elementy' ),
    'param_name' => 'icon_elegant',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'elegant',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'icon_type',
        'value' => 'elegant',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-elementy' ),
    'group' => 'Fancy Content',
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Icon Size",'wp-elementy'),
    'param_name' => 'icon_size',
    'group' => 'Fancy Content',
    'value' => array(
        esc_html__( 'Large', 'wp-elementy' ) => 'icon-large',
        esc_html__( 'Normal', 'wp-elementy' ) => 'icon-normal',
        esc_html__( 'Big', 'wp-elementy' ) => 'icon-big',
    ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style7'),
    ),
));

/* Icon size for layout 3*/
vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Icon Size",'wp-elementy'),
    'param_name' => 'icon_size_3',
    'group' => 'Fancy Content',
    'value' => array(
        esc_html__( 'Normal', 'wp-elementy' ) => 'icon-normal',
        esc_html__( 'Big', 'wp-elementy' ) => 'icon-big',
    ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style3'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Margin bottom",'wp-elementy'),
    'param_name' => 'mg-bt',
    'group' => 'Fancy Content',
    'value' => array(
        esc_html__( 'Default - 50px', 'wp-elementy' ) => 'mb-50',
        esc_html__( 'Custom - 20px', 'wp-elementy' ) => 'mb-20',
        esc_html__( 'None - 0px', 'wp-elementy' ) => 'mb-0',
    ),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style7'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    "type" => "cms_template",
    "param_name" => "cms_template",
    "admin_label" => false,
    "heading" => esc_html__("Shortcode Template",'wp-elementy'),
    "shortcode" => "cms_fancybox_single",
    "group" => esc_html__("Template", 'wp-elementy'),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'img',
    'admin_label' => true,
    'heading' => esc_html__( 'Fancy Style', 'wp-elementy' ),
    'value' => array(
        'style3' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout3.png',
        'style4' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout4.png',
        'style8' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout8.png',
        'style7' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout7.png',
        'style6' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout6.png',
        'style9' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout9.png',
        'style10' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout10.png',
        'style2' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout2.jpg',
        'style1' => get_template_directory_uri().'/vc_params/cms-fancybox/fancy-layout1.jpg',
    ),
    'param_name' => 'fancy_style',
    'description' => esc_html__( 'Select fancy style.', 'wp-elementy' ),
    'weight' => 1,
    "group" => esc_html__("Template", 'wp-elementy'),
));

vc_add_param("cms_fancybox_single", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Animation Delay Time", 'wp-elementy'),
    "description" => esc_html__('Animation Delay Time - Default animate effect is FadeIn', 'wp-elementy'),
    "param_name" => "css_animation_delay",
    "value" => wp_elementy_animate_time_delay_lib(),
    "group" => esc_html__("Fancy Content", 'wp-elementy')
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    'heading' => 'Heading Font',
    "description" => esc_html__("Just appear for layout 6",'wp-elementy'),
    'param_name' => 'set_monserrat_font',
    'value' => wp_elementy_font_family_for_heading(),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
    'group' => 'Custom Font'
));

vc_add_param("cms_fancybox_single", array(
    'type' => 'colorpicker',
    'heading' => esc_html__( 'Heading color', 'wp-elementy' ),
    'param_name' => 'heading_color',
    'description' => esc_html__( 'Set color for heading', 'wp-elementy' ),
    'group' => 'Custom Font',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    'heading' => 'Content Font',
    "description" => esc_html__("Just appear for layout 6",'wp-elementy'),
    'param_name' => 'content_font',
    'value' => array('Default' => 'font-default') + wp_elementy_font_family_for_heading(),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
    'group' => 'Custom Font'
));

vc_add_param("cms_fancybox_single", array(
    'type' => 'colorpicker',
    'heading' => esc_html__( 'Content color', 'wp-elementy' ),
    'param_name' => 'desc_color',
    'description' => esc_html__( 'Set color for description', 'wp-elementy' ),
    'group' => 'Custom Font',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style6'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Font Heading",'wp-elementy'),
    'param_name' => 'font-family',
    'group' => 'Custom Font',
    'value' => wp_elementy_font_family_for_heading(),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style7'),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    'heading' => 'Content Font',
    "description" => esc_html__("Just appear for layout 7",'wp-elementy'),
    'param_name' => 'content_font',
    'value' => array('Default' => 'font-default') + wp_elementy_font_family_for_heading(),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style7'),
    ),
    'group' => 'Custom Font'
));

vc_add_param("cms_fancybox_single", array(
    'type' => 'colorpicker',
    'heading' => esc_html__('Color', 'wp-elementy'),
    'param_name' => 'value_color',
    'value' => '',
    'description' => esc_html__('Select color for heading and content.', 'wp-elementy'),
    'group' => 'Custom Font',
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array('style7'),
    ),
));