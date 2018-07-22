<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

/**
 * get list menu.
 * @return array
 */
function wp_elementy_get_nav_menu(){

    $menus = array(
        '' => esc_html__('Default', 'wp-elementy')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->term_id] = $obj_menu->name;
    }

    return $menus;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_meta_options'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false,
    'meta_mode' => 'multiple'
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

/** page options */
MetaFramework::setMetabox(array(
    'id' => '_page_main_options',
    'label' => esc_html__('Page Setting', 'wp-elementy'),
    'post_type' => 'page',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => false,
    'sections' => array(
        array(
            'title' => esc_html__('General', 'wp-elementy'),
            'id' => 'tab-general',
            'icon' => 'el el-adjust-alt',
            'fields' => array(
                array(
                    'id' => 'page_general_padding',
                    'title' => esc_html__('At moment, main content got padding top and bottom is 140px', 'wp-elementy'),
                    'type' => 'info',
                    'style' => 'success',
                ),
                array(
                    'id' => 'page_general_padding_top',
                    'title' => esc_html__('Set padding top to 0px', 'wp-elementy'),
                    'desc' => esc_html__('Enable this option to set padding top of main content is 0px ', 'wp-elementy'),
                    'default' => '',
                    'type' => 'switch',
                    'default' => false,
                ),
                array(
                    'id' => 'page_general_padding_bottom',
                    'title' => esc_html__('Set padding bottom to 0px', 'wp-elementy'),
                    'desc' => esc_html__('Enable this option to set padding bottom of main content is 0px ', 'wp-elementy'),
                    'default' => '',
                    'type' => 'switch',
                    'default' => false,
                ),
            )
        ),
        array(
            'title' => esc_html__('Header', 'wp-elementy'),
            'id' => 'tab-page-header',
            'icon' => 'el el-credit-card',
            'fields' => array(
                array(
                    'title' => esc_html__('OPTIONS FOR TOPBAR', 'wp-elementy'),
                    'id'   => 'header_topbar_info',
                    'type' => 'info',
                    'style' => 'success',
                ),
                array(
                    'id' => 'topbar-header',
                    'type' => 'select',
                    'title' => esc_html__('Enable Topbar Area', 'wp-elementy'),
                    'options' => array(
                        'inherit' => 'Inherit from ThemeOptions',
                        'none' => 'None',
                        'show' => 'Show',
                    ),
                    'default' => 'inherit',
                    'description' => esc_html__('enable topbar area (contain Left and Right widget area). Only apear for Default Menu', 'wp-elementy'),
                ),
                array(
                    'id' => 'topbar-header-bg',
                    'type' => 'select',
                    'title' => esc_html__('Topbar color', 'wp-elementy'),
                    'options' => array(
                        'dark-color' => 'Dark color',
                        'gray-color' => 'Gray color'
                    ),
                    'description' => '',
                    'required' => array('topbar-header', '=', 'show')
                ),
                array(
                    'title' => esc_html__('GENERAL', 'wp-elementy'),
                    'id'   => 'header_general',
                    'type' => 'info',
                    'style' => 'success',
                ),
                array(
                    'id' => 'header_layout',
                    'title' => esc_html__('Layouts', 'wp-elementy'),
                    'subtitle' => esc_html__('select a layout for header', 'wp-elementy'),
                    'default' => 'default',
                    'type' => 'image_select',
                    'options' => array(
                        'default' => get_template_directory_uri().'/assets/images/header/h-default.png',
                        'side' => get_template_directory_uri().'/assets/images/header/side-menu.jpg',
                        'fullscreen' => get_template_directory_uri().'/assets/images/header/fullscreen-menu.jpg',
                        'leftmenu' => get_template_directory_uri().'/assets/images/header/left-menu.jpg',
                    )
                ),
                array(
                    'title' => esc_html__('OPTIONS FOR HEADER STICKY', 'wp-elementy'),
                    'id'   => 'menu_sticky_info',
                    'type' => 'info',
                    'style' => 'success',
                ),
                array(
                    'subtitle' => esc_html__('enable sticky mode for header of this page.', 'wp-elementy'),
                    'id' => 'menu_sticky',
                    'type' => 'switch',
                    'title' => esc_html__('Sticky Header', 'wp-elementy'),
                    'default' => false,
                ),
                array(
                    'subtitle' => esc_html__('Enable this option if you want header of this page is FIXED - Suitable for page title has background image', 'wp-elementy'),
                    'id' => 'menu_sticky_fixed',
                    'type' => 'switch',
                    'title' => esc_html__('Fixed Header', 'wp-elementy'),
                    'default' => false,
                    'required' => array('menu_sticky', '=', '1'),
                ),
                array(
                    'title' => esc_html__('Header Bg Color', 'wp-elementy'),
                    'subtitle' => esc_html__('Header background color when header sticky', 'wp-elementy'),
                    'id' => 'sticky_header_bg',
                    'type' => 'color',
                    'required' => array('menu_sticky', '=', '1'),
                ),
                array(
                    'title' => esc_html__('Text color', 'wp-elementy'),
                    'subtitle' => esc_html__('Contain menu item level 1, icon when header sticky', 'wp-elementy'),
                    'id' => 'sticky_header_link_color',
                    'type' => 'color',
                    'required' => array('menu_sticky', '=', '1'),
                ),
                array(
                    'title' => esc_html__('Logo', 'wp-elementy'),
                    'subtitle' => esc_html__('This logo will show when set header sticky', 'wp-elementy'),
                    'id' => 'sticky_header_logo',
                    'type' => 'media',
                    'required' => array('menu_sticky', '=', '1')
                ),
                array(
                    'subtitle' => esc_html__('Sticky logo height.', 'wp-elementy'),
                    'id' => 'sticky_logo_height',
                    'type' => 'dimensions',
                    'width' => false,
                    'units' => array( 'px' ), 
                    'title' => 'Sticky logo height',
                    'default' => array(
                        'height' => '42',
                    ),
                    'required' => array('menu_sticky', '=', '1')
                ),

                array(
                    'title' => esc_html__('OPTIONS FOR HEADER STICKY WHEN SCROLL DOWN', 'wp-elementy'),
                    'id'   => 'menu_sticky_scroll_info',
                    'type' => 'info',
                    'style' => 'success',
                    'required' => array('menu_sticky', '=', '1')
                ),
                array(
                    'id' => 'one_page_rem_border',
                    'type' => 'checkbox',
                    'title' => 'Remove border',
                    'subtitle' => 'Remove border of active item when mouser scroll',
                    'required' => array('menu_sticky', '=', '1')
                ),
                array(
                    'title' => esc_html__('Header Bg Color', 'wp-elementy'),
                    'subtitle' => esc_html__('Sticky Header background color when scroll down', 'wp-elementy'),
                    'id' => 'sticky_header_bg_scroll',
                    'type' => 'color_rgba',
                    'required' => array('menu_sticky', '=', '1'),
                ),
                array(
                    'title' => esc_html__('Text color', 'wp-elementy'),
                    'subtitle' => esc_html__('Contain menu item level 1, icon', 'wp-elementy'),
                    'id' => 'sticky_header_link_color_scroll',
                    'type' => 'color',
                    'required' => array('menu_sticky', '=', '1'),
                ),
                array(
                    'title' => esc_html__('Logo', 'wp-elementy'),
                    'subtitle' => esc_html__('This logo will show when header sticky scroll down', 'wp-elementy'),
                    'id' => 'sticky_header_logo_scroll',
                    'type' => 'media',
                    'required' => array('menu_sticky', '=', '1')
                ),
                array(
                    'subtitle' => esc_html__('Scroll logo height.', 'wp-elementy'),
                    'id' => 'scroll_logo_height',
                    'type' => 'dimensions',
                    'width' => false,
                    'units' => array( 'px' ), 
                    'title' => 'Scroll logo height',
                    'default' => array(
                        'height' => '42',
                    ),
                    'required' => array('menu_sticky', '=', '1'),
                ),
                array(
                    'title' => esc_html__('OPTIONS SWITCH MENU LOCATION', 'wp-elementy'),
                    'id'   => 'menu_switch_menu_location',
                    'type' => 'info',
                    'style' => 'success',
                ),
                array(
                    'id'       => 'header_menu',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Menu', 'wp-elementy' ),
                    'subtitle' => esc_html__( 'custom menu for current page', 'wp-elementy' ),
                    'options'  => wp_elementy_get_nav_menu(),
                    'default' => '',
                ),
            )
        ),
        array(
            'title' => esc_html__('Page Title & BC', 'wp-elementy'),
            'id' => 'tab-page-title-bc',
            'icon' => 'el el-map-marker',
            'fields' => array(
                array(
                    'subtitle' => esc_html__('Enable custom Page title & BC.', 'wp-elementy'),
                    'id' => 'enable_custom_pagetitle',
                    'type' => 'switch',
                    'title' => esc_html__('Enable', 'wp-elementy'),
                    'default' => false,
                ),
                array(
                    'id' => 'page_title_layout',
                    'title' => esc_html__('Layouts', 'wp-elementy'),
                    'subtitle' => esc_html__('select a layout for page title', 'wp-elementy'),
                    'default' => '1',
                    'type' => 'image_select',
                    'options' => array(
                        '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                        '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                        '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-custom.png',
                    ),
                    'required' => array( 'enable_custom_pagetitle', '=', '1' )
                ),
                array(
                    'subtitle' => esc_html__('Slider', 'wp-elementy'),
                    'id' => 'pagetitle_slider',
                    'type' => 'select',
                    'title' => esc_html__('Slider', 'wp-elementy'),
                    'options' => wp_elementy_get_list_rev_slider(),
                    'required' => array( 'page_title_layout', '=', '3' )
                ),
                array(
                    'id' => 'page_title_style',
                    'title' => esc_html__('Style', 'wp-elementy'),
                    'subtitle' => esc_html__('select a style for page title', 'wp-elementy'),
                    'default' => '1',
                    'type' => 'image_select',
                    'options' => array(
                        '1' => array(
                            'alt' => 'Small Gray',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/small-grey.png'
                        ),
                        '2' => array(
                            'alt' => 'Small White',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/small-white.png'
                        ),
                        '3' => array(
                            'alt' => 'Small Dark',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/small-dark.png'
                        ),
                        '4' => array(
                            'alt' => 'Big Gray',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/big-grey.png'
                        ),
                        '5' => array(
                            'alt' => 'Big White',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/big-white.png'
                        ),
                        '6' => array(
                            'alt' => 'Big Dark',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/big-dark.png'
                        ),
                        '7' => array(
                            'alt' => 'Big Image',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/big-image.png'
                        ),
                        '8' => array(
                            'alt' => 'Large Image',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image.png'
                        ),
                        '9' => array(
                            'alt' => 'Large Image 2',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image-2.png'
                        ),
                        '10' => array(
                            'alt' => 'Large Image 3',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image-3.png'
                        ),
                        '11' => array(
                            'alt' => 'Large Image 4',
                            'img' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image-4.png'
                        ),
                    ),
                    'required' => array('page_title_layout','=','2')
                ),
                array(
                    'id' => 'custom-page-title',
                    'type' => 'text',
                    'title' => esc_html__('Custom page title', 'wp-elementy'),
                    'subtitle' => 'Changed page title default',
                    'default' => '',
                ),
                array(
                    'id' => 'sub-page-title',
                    'type' => 'textarea',
                    'title' => esc_html__('Sub page title', 'wp-elementy'),
                    'subtitle' => 'Some HTML is allowed in here (a, em, strong, br)',
                    'validate' => 'html',
                    'default' => '',
                    'allowed_html' => array(
                        'a' => array(
                            'href' => array(),
                            'title' => array()
                        ),
                        'br' => array(),
                        'em' => array(),
                        'strong' => array()
                    ),
                    'required' => array(
                        array('page_title_style', '>=', '4'),
                        array('page_title_style', '<', '9')
                    ),
                ),
                array(
                    'title' => esc_html__('Select Background Image', 'wp-elementy'),
                    'subtitle' => esc_html__('Select an image file for your page title background, suitable for Big Image, Large Image style.', 'wp-elementy'),
                    'id' => 'page_title_background',
                    'type' => 'background',
                    'url' => true,
                    'default' =>array(
                        'background-repeat' => 'no-repeat',
                        'background-attachment' => 'inherit',
                        'background-position' => 'center center',
                        'background-size' => 'cover',
                    ),
                    'output' => '.page-title',
                    'required' => array('page_title_style', '>=', '4'),
                ),
                array(
                    'id' => 'page-title-color',
                    'type' => 'color',
                    'title' => esc_html__('Page title color', 'wp-elementy'),
                    'required' => array('page_title_style', '=', 10),
                ),
                array(
                    'id' => 'page-title-overlay',
                    'type' => 'color_rgba',
                    'title' => esc_html__('Page title overlay', 'wp-elementy'),
                    'required' => array('page_title_style', '>=', '7'),
                )  
            )
        ),
        array(
            'title' => esc_html__('Footer', 'wp-elementy'),
            'id' => 'tab-footer-options',
            'icon' => 'el el-lines',
            'fields' => array(
                array(
                    'subtitle' => esc_html__('Enable custom footer layout for this page', 'wp-elementy'),
                    'id' => 'page_footer_options',
                    'type' => 'switch',
                    'title' => esc_html__('Enable', 'wp-elementy'),
                    'default' => false,
                ),
                array(
                    'id' => 'footer_layout',
                    'title' => esc_html__('Layouts', 'wp-elementy'),
                    'subtitle' => esc_html__('select a layout for footer', 'wp-elementy'),
                    'type' => 'image_select',
                    'options' => array(
                        '5' => get_template_directory_uri().'/assets/images/footer/footer-5.jpg',
                        '1' => get_template_directory_uri().'/assets/images/footer/footer-1.png',
                        '2' => get_template_directory_uri().'/assets/images/footer/footer-2.png',
                        '3' => get_template_directory_uri().'/assets/images/footer/footer-3.png',
                        '4' => get_template_directory_uri().'/assets/images/footer/footer-4.jpg',
                    ),
                    'default' => '1',
                    'required' => array('page_footer_options', '=', '1'),
                ),
                array(
                    'title' => esc_html__('OPTIONS FOR FOOTER LAYOUT 3', 'wp-elementy'),
                    'id'   => 'footer_footer_layout3',
                    'type' => 'info',
                    'style' => 'success',
                    'required' => array('footer_layout', '=', '3'),
                ),
                array(
                    'id'       => 'footer-bg',
                    'type'     => 'color',
                    'title'    => esc_html__('Footer Background Color', 'wp-elementy'), 
                    'subtitle' => '',
                    'default'  => '',
                    'required' => array('footer_layout', '=', '3'),
                ),
                array(
                    'id'       => 'footer-link-color',
                    'type'     => 'link_color',
                    'title'    => esc_html__('Footer Link Color', 'wp-elementy'), 
                    'subtitle' => '',
                    'default'  => '',
                    'required' => array('footer_layout', '=', '3'),
                ),

                array(
                    'title' => esc_html__('OPTIONS FOR FOOTER LAYOUT 4', 'wp-elementy'),
                    'id'   => 'footer_footer_layout4',
                    'type' => 'info',
                    'style' => 'success',
                    'required' => array('footer_layout', '=', '4'),
                ),
                array(
                    'id'       => 'footer_background_4',
                    'type'     => 'background',
                    'title'    => esc_html__( 'Background', 'wp-elementy' ),
                    'subtitle' => esc_html__( 'footer background with image, color, etc.', 'wp-elementy' ),
                    'default'  => array(
                        'background-color' => '#303036'
                    ),
                    'required' => array('footer_layout', '=', '4'),
                ),
                array(
                    'id' => 'footer_padding_4',
                    'type' => 'spacing',
                    'mode' => 'padding',
                    'units' => array('px'),
                    'title' => 'Padding',
                    'right' => false,
                    'left' => false,
                    'default'            => array(
                        'padding-top'     => '21', 
                        'padding-bottom'  => '50',
                    ),
                    'required' => array('footer_layout', '=', '4'),
                ),
                array(
                    'id' => 'footer_bottom_border_4',
                    'type' => 'border',
                    'units' => array('px'),
                    'title' => 'Border top',
                    'right' => false,
                    'left' => false,
                    'bottom' => false,
                    'default'  => array(
                        'border-color'  => '', 
                        'border-style'  => 'solid', 
                        'border-top'    => '1px', 
                    ),
                    'required' => array('footer_layout', '=', '4'),
                ),
                array(
                    'title' => esc_html__('Link color', 'wp-elementy'),
                    'subtitle' => '',
                    'id' => 'footer-color-4',
                    'type' => 'color_rgba',
                    'default' => array(
                        'color'  => '#fff',
                        'alpha'    => '0.3',
                    ),
                    'required' => array('footer_layout', '=', '4'),
                ),
                array(
                    'title' => esc_html__('Link color hover', 'wp-elementy'),
                    'subtitle' => '',
                    'id' => 'footer-color-hover-4',
                    'type' => 'color_rgba',
                    'default' => array(
                        'color'  => '#fff',
                        'alpha'    => '1',
                    ),
                    'required' => array('footer_layout', '=', '4'),
                ),
            )
        ),
        array(
            'title' => esc_html__('One Page', 'wp-elementy'),
            'id' => 'tab-one-page',
            'icon' => 'el el-download-alt',
            'fields' => array(
                array(
                    'subtitle' => esc_html__('Enable one page mode for current page.', 'wp-elementy'),
                    'id' => 'page_one_page',
                    'type' => 'switch',
                    'title' => esc_html__('Enable', 'wp-elementy'),
                    'default' => false,
                ),
                array(
                    'id' => 'one_page_speed',
                    'type' => 'text',
                    'title' => 'Speed',
                    'default' => 1000,
                    'required' => array('page_one_page', '=', '1'),
                ),
                array(
                    'id'       => 'one_page_easing',
                    'type'     => 'select',
                    'title'    => 'Easing',
                    'options'  => array(
                        '' => '',
                        'easeInQuad' => 'easeInQuad',
                        'easeOutQuad' => 'easeOutQuad',
                        'easeInOutQuad' => 'easeInOutQuad',
                        'easeInCubic' => 'easeInCubic',
                        'easeOutCubic' => 'easeOutCubic',
                        'easeInOutCubic' => 'easeInOutCubic',
                        'easeInQuart' => 'easeInQuart',
                        'easeOutQuart' => 'easeOutQuart',
                        'easeInOutQuart' => 'easeInOutQuart',
                        'easeInQuint' => 'easeInQuint',
                        'easeOutQuint' => 'easeOutQuint',
                        'easeInOutQuint' => 'easeInOutQuint',
                        'easeInSine' => 'easeInSine',
                        'easeOutQuad' => 'easeOutQuad',
                        'easeOutSine' => 'easeOutSine',
                        'easeInOutSine' => 'easeInOutSine',
                        'easeInExpo' => 'easeInExpo',
                        'easeOutExpo' => 'easeOutExpo',
                        'easeInOutExpo' => 'easeInOutExpo',
                        'easeInCirc' => 'easeInCirc',
                        'easeOutCirc' => 'easeOutCirc',
                        'easeInOutCirc' => 'easeInOutCirc',
                        'easeInElastic' => 'easeInElastic',
                        'easeOutElastic' => 'easeOutElastic',
                        'easeInOutElastic' => 'easeInOutElastic',
                        'easeInBack' => 'easeInBack',
                        'easeOutBack' => 'easeOutBack',
                        'easeInOutBack' => 'easeInOutBack',
                        'easeInBounce' => 'easeInBounce',
                        'easeOutBounce' => 'easeOutBounce',
                        'easeInOutBounce' => 'easeInOutBounce'
                    ),
                    'default' => '',
                    'required' => array('page_one_page', '=', '1'),
                ),
            )
        )
    )
));

/** post options */
MetaFramework::setMetabox(array(
    'id' => '_page_post_format_options',
    'label' => esc_html__('Post Format', 'wp-elementy'),
    'post_type' => 'post',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'color-Color',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id'       => 'opt-video-type',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Video Type', 'wp-elementy' ),
                    'subtitle' => esc_html__( 'Local video, Youtube, Vimeo', 'wp-elementy' ),
                    'options'  => array(
                        'local' => esc_html__('Upload', 'wp-elementy' ),
                        'youtube' => esc_html__('Youtube', 'wp-elementy' ),
                        'vimeo' => esc_html__('Vimeo', 'wp-elementy' ),
                    )
                ),
                array(
                    'id'       => 'otp-video-local',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Local Video', 'wp-elementy' ),
                    'subtitle' => esc_html__( 'Upload video media using the WordPress native uploader', 'wp-elementy' ),
                    'required' => array( 'opt-video-type', '=', 'local' )
                ),
                array(
                    'id'       => 'opt-video-youtube',
                    'type'     => 'text',
                    'title'    => esc_html__('Youtube', 'wp-elementy'),
                    'subtitle' => esc_html__('Load video from Youtube.', 'wp-elementy'),
                    'placeholder' => esc_html__('https://youtu.be/iNJdPyoqt8U', 'wp-elementy'),
                    'required' => array( 'opt-video-type', '=', 'youtube' )
                ),
                array(
                    'id'       => 'opt-video-vimeo',
                    'type'     => 'text',
                    'title'    => esc_html__('Vimeo', 'wp-elementy'),
                    'subtitle' => esc_html__('Load video from Vimeo.', 'wp-elementy'),
                    'placeholder' => esc_html__('https://vimeo.com/155673893', 'wp-elementy'),
                    'required' => array( 'opt-video-type', '=', 'vimeo' )
                ),
                array(
                    'id'       => 'otp-video-thumb',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Video Thumb', 'wp-elementy' ),
                    'subtitle' => esc_html__( 'Upload thumb media using the WordPress native uploader', 'wp-elementy' ),
                    'required' => array( 'opt-video-type', '=', 'local' )
                ),
                array(
                    'id'       => 'otp-audio',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Audio Media', 'wp-elementy' ),
                    'subtitle' => esc_html__( 'Upload audio media using the WordPress native uploader', 'wp-elementy' ),
                ),
                array(
                    'id'       => 'opt-gallery',
                    'type'     => 'gallery',
                    'title'    => esc_html__( 'Add/Edit Gallery', 'wp-elementy' ),
                    'subtitle' => esc_html__( 'Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'wp-elementy' ),
                ),
                array(
                    'id'       => 'opt-quote-title',
                    'type'     => 'text',
                    'title'    => esc_html__('Quote Title', 'wp-elementy'),
                    'subtitle' => esc_html__('Quote title or quote name...', 'wp-elementy'),
                ),
                array(
                    'id'       => 'opt-quote-content',
                    'type'     => 'textarea',
                    'title'    => esc_html__('Quote Content', 'wp-elementy'),
                ),
            )
        ),
    )
));

/** Post Layout */
/*MetaFramework::setMetabox(array(
    'id' => '_page_post_layout_options',
    'label' => esc_html__('Post Layout', 'wp-elementy'),
    'post_type' => 'post',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => esc_html__('Select Post Title Layout', 'wp-elementy'),
            'id' => 'post-custom-general',
            'icon' => 'el el-adjust-alt',
            'fields' => array(
                array(
                    'id' => 'cms_post_layout',
                    'title' => esc_html__('Select post title layout for this post', 'wp-elementy'),
                    'subtitle' => esc_html__('Layout 2 only appear for post have image featured', 'wp-elementy'),
                    'default' => '1',
                    'type' => 'image_select',
                    'options' => array(
                        '1' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image-2.png',
                        '2' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image-3.png'
                    ),
                ),
                array(
                    'subtitle' => esc_html__('Enable custom Page title & BC.', 'wp-elementy'),
                    'id' => 'custom_custom_pagetitle',
                    'type' => 'switch',
                    'title' => esc_html__('Enable', 'wp-elementy'),
                    'default' => false,
                ),
                array(
                    'id' => 'post_title_padding',
                    'type' => 'spacing',
                    'mode' => 'padding',
                    'units' => array('px'),
                    'title' => esc_html__('Post Title Padding', 'wp-elementy'),
                    'right' => false,
                    'left' => false,
                    'default'            => array(
                        'padding-top'     => '310', 
                        'padding-bottom'  => '300',
                    ),
                    'required' => array( 'custom_custom_pagetitle', '=', '1' )
                ),
                array(
                    'id' => 'post_title_color',
                    'type' => 'color',
                    'title' => esc_html__('Post Title Color', 'wp-elementy'),
                    'subtitle' => '',
                    'default' => '#fff',
                    'required' => array( 'custom_custom_pagetitle', '=', '1' )
                ),

            )
        ),
    )
));*/

/** testimonial options */
MetaFramework::setMetabox(array(
    'id' => '_page_testimonial_options',
    'label' => esc_html__('Testimonial Options', 'wp-elementy'),
    'post_type' => 'testimonial',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'testimonial_options',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id'       => 'page_testimonial_position',
                    'type'     => 'text',
                    'title'    => esc_html__('Role','wp-elementy'),
                ),
            )
        ),
    )
));

/** Team options */
MetaFramework::setMetabox(array(
    'id' => '_page_team_options',
    'label' => esc_html__('Team Options', 'wp-elementy'),
    'post_type' => 'team',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'team_options',
            'icon' => 'el el-user',
            'fields' => array(
                array(
                    'id'       => 'page_team_role',
                    'type'     => 'text',
                    'title'    => esc_html__('Role','wp-elementy'),
                ),
                array(
                    'id'       => 'page_team_fb',
                    'type'     => 'text',
                    'title'    => esc_html__('Facebook Url','wp-elementy'),
                ),
                array(
                    'id'       => 'page_team_twitter',
                    'type'     => 'text',
                    'title'    => esc_html__('Twitter Url','wp-elementy'),
                ),
                array(
                    'id'       => 'page_team_dribbble',
                    'type'     => 'text',
                    'title'    => esc_html__('Dribbble Url','wp-elementy'),
                ),
                array(
                    'id'       => 'page_team_linkedin',
                    'type'     => 'text',
                    'title'    => esc_html__('Linkedin Url','wp-elementy'),
                ),
            )
        ),
    )
));

/** Portfolio options */
MetaFramework::setMetabox(array(
    'id' => '_page_portfolio_options',
    'label' => esc_html__('Portfolio Metadata', 'wp-elementy'),
    'post_type' => 'portfolio',
    'context' => 'side', /* normal, advanced, side */
    'priority' => 'core',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'portfolio_options',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id'       => 'page_portfolio_date',
                    'type'     => 'date',
                    'title'    => esc_html__('Date: ','wp-elementy'),
                    'placeholder' => 'Click to enter a date'
                ),
                array(
                    'id'       => 'page_portfolio_client',
                    'type'     => 'text',
                    'title'    => esc_html__('Client: ','wp-elementy'),
                ),
                array(
                    'id'       => 'page_portfolio_url',
                    'type'     => 'text',
                    'title'    => esc_html__('Demo: ','wp-elementy'),
                ),
                array(
                    'id'       => 'page_portfolio_skill',
                    'type'     => 'text',
                    'title'    => esc_html__('Skills: ','wp-elementy'),
                ),
            )
        ),
    )
));

/** Portfolio options */
/*MetaFramework::setMetabox(array(
    'id' => '_page_portfolio_options',
    'label' => esc_html__('Portfolio Page Setting', 'wp-elementy'),
    'post_type' => 'portfolio',
    'context' => 'normal',
    'priority' => 'high',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'portfolio_options',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id'       => 'page_portfolio_setting_info',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => 'Portfolio Page Setting'
                ),
                array(
                    'id' => 'port_pagetitle_layout',
                    'type' => 'image_select',
                    'title' => 'Portfolio Page Title',
                    'options' => array(
                        '1' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image-2.png',
                        '2' => get_template_directory_uri().'/inc/options/images/pagetitle/large-image-3.png'
                    ),
                    'default' => '1'
                )
            )
        ),
    )
));*/

/** pricing options */
MetaFramework::setMetabox(array(
    'id' => '_page_pricing_options',
    'label' => esc_html__('Pricing Options', 'wp-elementy'),
    'post_type' => 'pricing',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'pricing_options',
            'icon' => 'el el-credit-card',
            'fields' => array(
                array(
                    'id'       => 'pricing_value',
                    'type'     => 'text',
                    'title'    => esc_html__('Value','wp-elementy'),
                    'default'  => ''
                ),
                array(
                    'id'       => 'pricing_price',
                    'type'     => 'text',
                    'title'    => esc_html__('Currency','wp-elementy'),
                    'default'  => ''
                ),
                array(
                    'id'       => 'pricing_time',
                    'type'     => 'text',
                    'title'    => esc_html__('Time','wp-elementy'),
                    'default'  => ''
                ),
                array(
                    'id'       => 'pricing_button_url',
                    'type'     => 'text',
                    'title'    => esc_html__('Button Url','wp-elementy'),
                    'default'  => ''
                ),
                array(
                    'id'       => 'pricing_button_text',
                    'type'     => 'text',
                    'title'    => esc_html__('Button Text','wp-elementy'),
                    'default'  => ''
                ),
                array(
                    'id'       => 'pricing_is_feature',
                    'title'    => esc_html__('Is feature','wp-elementy'),
                    'type' => 'checkbox',
                    'default'  => '0'// 1 = on | 0 = off
                ),
            )
        ),
    )
));


MetaFramework::init();