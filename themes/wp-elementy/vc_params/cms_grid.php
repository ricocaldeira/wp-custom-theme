<?php
/* For blog */
vc_add_param('cms_grid', array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Blog layout', 'wp-elementy' ),
    'param_name' => 'cms_blog_layout',
    'description' => esc_html__( 'Select blog layout, only blog masonry layout can apply Grid Setting', 'wp-elementy' ),
    'value' => array(
        esc_html__( 'Blog Default', 'wp-elementy' ) => 'default',
        esc_html__( 'Blog Small Image', 'wp-elementy' ) => 'small-image',
        esc_html__( 'Blog Full Width', 'wp-elementy' ) => 'fullwidth',
        esc_html__( 'Blog Masonry', 'wp-elementy' ) => 'masonry',
    ),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => array(
            'cms_grid.php',
        ),
    ),
    
    "group" => esc_html__("Template", 'wp-elementy')
));

/* Pricing */
vc_add_param("cms_grid", array(
    "heading" => esc_html__("Pricing Table Layout", 'wp-elementy'),
    "param_name" => "cms_pricing_layout",
    'type' => 'img',
    'admin_label' => true,
    'value' => array(
        'layout1' => get_template_directory_uri().'/vc_params/pricing/pricing-layout1.jpg',
        'layout2' => get_template_directory_uri().'/vc_params/pricing/pricing-layout2.jpg',
    ),
    'description' => esc_html__( 'Select a pricing layout.', 'wp-elementy' ),
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
		'element' => 'cms_template',
		'value' => 'cms_grid--pricing.php',
	),
	'std' => 'layout1',
));

/* Portfolio */
vc_add_param("cms_grid", array(
    "heading" => esc_html__("Portfolio Heading", 'wp-elementy'),
    "param_name" => "cms_portfolio_heading",
    'type' => 'textfield',
    'admin_label' => true,
    'value' => '',
    'description' => '',
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => 'cms_grid--portfolio.php',
    ),
));

vc_add_param('cms_grid', array(
    'type' => 'dropdown',
    "heading" => esc_html__("Font family",'wp-elementy'),
    'param_name' => 'font-family-heading',
    "group" => esc_html__("Template", 'wp-elementy'),
    'value' => wp_elementy_font_family_for_heading(),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => 'cms_grid--portfolio.php',
    ),
));

vc_add_param("cms_grid", array(
    "heading" => esc_html__("Portfolio thumbnail size", 'wp-elementy'),
    "param_name" => "cms_portfolio_thumbsize",
    'type' => 'dropdown',
    'admin_label' => true,
    'value' => array(
        esc_html__( 'Square', 'wp-elementy' ) => 'elementy-thumbnail-square',
        esc_html__( 'Wide', 'wp-elementy' ) => 'elementy-thumbnail-wide',
        esc_html__( 'Masonry - just appear for masonry layout', 'wp-elementy' ) => 'elementy-thumbnail-masonry',
    ),
    'description' => esc_html__( 'Select a pricing layout.', 'wp-elementy' ),
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => 'cms_grid--portfolio.php',
    ),
));

vc_add_param("cms_grid", array(
    "heading" => esc_html__("Portfolio Gutter", 'wp-elementy'),
    "param_name" => "cms_portfolio_gutter",
    'type' => 'dropdown',
    'admin_label' => true,
    'value' => array(
        '0px' => '0px',
        '5px' => '5px',
        '10px' => '10px',
        '15px' => '15px',
        '20px' => '20px',
        '25px' => '25px',
        '30px' => '30px',
    ),
    'description' => esc_html__( 'Select a gutter, which is spacing between each item', 'wp-elementy' ),
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => 'cms_grid--portfolio.php',
    ),
    'std' => '0px',
));

vc_add_param('cms_grid',array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Use special layout', 'wp-elementy' ),
    'param_name' => 'cms_portf_special',
    'std' => "false",
    'description' => esc_html__( 'Suitable for page: Home car tuning and should show 4 items', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => array(
            'cms_grid--portfolio.php',
        ),
    ),
    "group" => esc_html__("Template", 'wp-elementy')
));

vc_add_param('cms_grid',array(
    'type' => 'textfield',
    'heading' => esc_html__( 'Intro text', 'wp-elementy' ),
    'param_name' => 'cms_portf_special_text',
    'description' => esc_html__( 'Suitable for page: Home car tuning', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'cms_portf_special',
        'value' => "true",
    ),
    "group" => esc_html__("Template", 'wp-elementy')
));

vc_add_param('cms_grid',array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Show Pagination', 'wp-elementy' ),
    'param_name' => 'cms_pagination',
    'std' => true,
    'description' => esc_html__( 'Show Pagination', 'wp-elementy' ),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => array(
            'cms_grid.php',
            'cms_grid--portfolio.php',
            'cms_grid--shop.php'
        ),
    ),
    "group" => esc_html__("Template", 'wp-elementy')
)); 

vc_add_param("cms_grid", array(
    "heading" => esc_html__("Add Read more button?", 'wp-elementy'),
    "param_name" => "cms_readmore",
    'type' => 'checkbox',
    'dependency' => array(
        'element' => 'cms_template',
        'value' => array('cms_grid--team.php', 'cms_grid--portfolio.php'),
    ),
    'std' => false,
    "group" => esc_html__("Template", 'wp-elementy'),
));

vc_add_param("cms_grid", array(
    'type' => 'vc_link',
    'heading' => esc_html__( 'URL (Link)', 'wp-elementy' ),
    'param_name' => 'link',
    'description' => esc_html__( 'Add link and text to button.', 'wp-elementy' ),
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_readmore',
        'value' => 'true',
    ),
));

vc_add_param("cms_grid", array(
    "heading" => esc_html__("Readmore style", 'wp-elementy'),
    "param_name" => "cms_readmore_style",
    'description' => esc_html__( 'Not work with portfolio special layout', 'wp-elementy' ),
    'type' => 'dropdown',
    'admin_label' => true,
    'value' => array(
        'Full width' => 'full',
        'Normal' => 'normal',
    ),
    'description' => '',
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_readmore',
        'value' => 'true',
    ),
));

vc_add_param("cms_grid", array(
    "heading" => esc_html__("Readmore Font Size", 'wp-elementy'),
    "param_name" => "cms_readmore_font_size",
    'description' => '',
    'type' => 'dropdown',
    'value' => array(
        'Default - 16px' => 'font-default',
        'Large - 20px' => 'font-20',
    ),
    'description' => '',
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_readmore',
        'value' => 'true',
    ),
));

/* Clients */
vc_add_param("cms_grid", array(
    "heading" => esc_html__("Client Layout", 'wp-elementy'),
    "param_name" => "cms_client_layout",
    'type' => 'img',
    'admin_label' => true,
    'value' => array(
        'layout1' => get_template_directory_uri().'/vc_params/clients/client-layout1.png',
        'layout2' => get_template_directory_uri().'/vc_params/clients/client-layout2.png',
    ),
    'description' => esc_html__( 'Select a clients layout.', 'wp-elementy' ),
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => 'cms_grid--clients.php',
    ),
    'std' => 'layout1',
));

/* Testimonials */
vc_add_param("cms_grid", array(
    "heading" => esc_html__("Testimonials Layout", 'wp-elementy'),
    "param_name" => "cms_testi_layout",
    'type' => 'img',
    'admin_label' => true,
    'value' => array(
        'layout1' => get_template_directory_uri().'/vc_params/testimonials/grid-test1.png',
        'layout2' => get_template_directory_uri().'/vc_params/testimonials/grid-test2.png',
    ),
    'description' => esc_html__( 'Select a testimonials layout.', 'wp-elementy' ),
    "group" => esc_html__("Template", 'wp-elementy'),
    'dependency' => array(
        'element' => 'cms_template',
        'value' => 'cms_grid--testimonials.php',
    ),
    'std' => 'layout1',
));