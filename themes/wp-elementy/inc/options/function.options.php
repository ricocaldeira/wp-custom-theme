<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (! class_exists('Redux')) {
    return;
}

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('opt_name', 'opt_theme_options');

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => $theme->get('Name'),
    'page_title' => $theme->get('Name'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-smiley',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    // 'open_expanded' => true, // Allow you to start the panel in an expanded way initially.
    // 'disable_save_warn' => true, // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-dashboard',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'dashicons-smiley',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit' => '', // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => ''
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave'
            )
        )
    )
);

Redux::setArgs($opt_name, $args);

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$msg = $disabled = '';
if (!class_exists('WPBakeryVisualComposerAbstract') or !class_exists('CmssuperheroesCore') or !function_exists('cptui_create_custom_post_types')){
    $disabled = ' disabled ';
    $msg='You should be install visual composer, Cmssuperheroes and Custom Post Type UI plugins to import data.';
}

/**
 * Header Options
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'wp-elementy'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'title' => esc_html__('OPTIONS FOR TOPBAR', 'wp-elementy'),
            'id'   => 'header_topbar_info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id' => 'topbar-header',
            'type' => 'switch',
            'title' => esc_html__('Enable Topbar Area', 'wp-elementy'),
            'default' => false,
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
            'required' => array('topbar-header', '=', '1')
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
            'subtitle' => esc_html__('Header height.', 'wp-elementy'),
            'id' => 'header_height',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => 'Header height',
            'default' => array(
                'height' => '93',
            )
        ),
        array(
            'subtitle' => esc_html__('Header height when fixed menu on top.', 'wp-elementy'),
            'id' => 'header_height_fixed',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => 'Header height when fixed',
            'default' => array(
                'height' => '60',
            )
        ),
        array(
            'subtitle' => esc_html__('Set header is boxed, default is fullwidth', 'wp-elementy'),
            'id' => 'set_header_boxed',
            'type' => 'switch',
            'title' => esc_html__('Set Header Boxed', 'wp-elementy'),
            'default' => false,
            'required' => array('header_layout', '=', 'default')
        ),
        array(
            'subtitle' => esc_html__('Enable mega menu.', 'wp-elementy'),
            'id' => 'mega_menu',
            'type' => 'switch',
            'title' => esc_html__('Mega Menu', 'wp-elementy'),
            'default' => false,
        ),

        array(
            'title' => esc_html__('OPTIONS FOR HEADER STICKY', 'wp-elementy'),
            'id'   => 'menu_sticky_info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'subtitle' => esc_html__('enable sticky mode for menu.', 'wp-elementy'),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => esc_html__('Sticky Header', 'wp-elementy'),
            'default' => false,
        ),
        array(
            'title' => esc_html__('Header Bg Color', 'wp-elementy'),
            'subtitle' => esc_html__('Header background color when header sticky', 'wp-elementy'),
            'id' => 'sticky_header_bg',
            'type' => 'color',
            'output' => array(
                'background-color' => '.header-sticky',
            ),
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
            'title' => esc_html__('OPTIONS FOR HEADER STICKY WHEN SCROLL DOWN', 'wp-elementy'),
            'id'   => 'menu_sticky_scroll_info',
            'type' => 'info',
            'style' => 'success',
            'required' => array('menu_sticky', '=', '1')
        ),
        array(
            'title' => esc_html__('Header Bg Color', 'wp-elementy'),
            'subtitle' => esc_html__('Sticky Header background color when scroll down', 'wp-elementy'),
            'id' => 'sticky_header_bg_scroll',
            'type' => 'color_rgba',
            'output' => array(
                'background-color' => '.header-sticky.affix',
            ),
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
            'title' => esc_html__('OPTIONS FOR ICON IN HEADER', 'wp-elementy'),
            'id'   => 'option_for_header_icon_info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'subtitle' => esc_html__('Enable search icon', 'wp-elementy'),
            'id' => 'search-icon',
            'type' => 'switch',
            'title' => esc_html__('Enable search icon', 'wp-elementy'),
            'default' => true,
        ),
        array(
            'subtitle' => esc_html__('Enable wishlist icon', 'wp-elementy'),
            'id' => 'wishlist-icon',
            'type' => 'switch',
            'title' => esc_html__('Enable wishlist icon', 'wp-elementy'),
            'default' => true,
        ),
        array(
            'subtitle' => esc_html__('Enable mini cart icon', 'wp-elementy'),
            'id' => 'mini-cart-icon',
            'type' => 'switch',
            'title' => esc_html__('Enable mini cart icon', 'wp-elementy'),
            'default' => true,
        ),
    )
));

/* Logo */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Logo', 'wp-elementy'),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('Select Logo', 'wp-elementy'),
            'subtitle' => esc_html__('Select an image file for your logo.', 'wp-elementy'),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            )
        ),
        array(
            'subtitle' => esc_html__('in pixels.', 'wp-elementy'),
            'id' => 'main_logo_height',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => 'Logo Height',
            'output' => array('.cshero-header-logo img'),
            'default' => array(
                'height' => '42',
            )
        ),
        array(
            'subtitle' => esc_html__('in pixels.', 'wp-elementy'),
            'id' => 'sticky_logo_height',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => 'Sticky Logo Height',
            'default' => array(
                'height' => '42',
            )
        ),
    )
));

/**
 * Page Title
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Title & BC', 'wp-elementy'),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id' => 'page_title_layout',
            'type' => 'image_select',
            'title' => esc_html__('Layouts', 'wp-elementy'),
            'subtitle' => esc_html__('select a layout for page title', 'wp-elementy'),
            'default' => '2',
            'options' => array(
                '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
            )
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
            'output' => '.page-title.page-title-large-3 .page-title-text h1',
        ),
        array(
            'id' => 'page-title-overlay',
            'type' => 'color_rgba',
            'title' => esc_html__('Page title overlay', 'wp-elementy'),
            'required' => array('page_title_style', '>=', '7'),
        )
    )
));

/* Page Title */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-podcast',
    'title' => esc_html__('Page Title', 'wp-elementy'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => esc_html__('Typography', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with title text.', 'wp-elementy')
        ),
    )
));

/* Breadcrumb */
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-random',
    'title' => esc_html__('Breadcrumb', 'wp-elementy'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('The text before the breadcrumb home.', 'wp-elementy'),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => esc_html__('Breadcrumb Home Prefix', 'wp-elementy'),
            'default' => 'Home'
        ),
    )
));

/**
 * Styling
 * 
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Styling', 'wp-elementy'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => esc_html__('set color main color.', 'wp-elementy'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'wp-elementy'),
            'default' => '#2a2b2f'
        ),
        array(
            'subtitle' => esc_html__('set color main color.', 'wp-elementy'),
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => esc_html__('Secondary color', 'wp-elementy'),
            'default' => '#eee'
        ),
        array(
            'subtitle' => esc_html__('set color for tags <a></a>.', 'wp-elementy'),
            'id' => 'link_color',
            'type' => 'color',
            'title' => esc_html__('Link Color', 'wp-elementy'),
            'output'  => array('a'),
            'default' => '#2a2b2f'
        ),
        array(
            'subtitle' => esc_html__('set color for tags <a></a>.', 'wp-elementy'),
            'id' => 'link_color_hover',
            'type' => 'color',
            'title' => esc_html__('Link Color Hover', 'wp-elementy'),
            'output'  => array('a:hover'),
            'default' => '#97999c'
        )
    )
));

/**
 * Typography
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'wp-elementy'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'wp-elementy'),
            'default' => array(
                'color' => '#6b6d6f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Open Sans',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '25px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h1'),
            'units' => 'px',
            'default' => array(
                'color' => '#2a2b2f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => '',
                'google' => true,
                'font-size' => '32px',
                'line-height' => '44px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h2'),
            'units' => 'px',
            'default' => array(
                'color' => '#2a2b2f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => '',
                'google' => true,
                'font-size' => '28px',
                'line-height' => '32px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h3'),
            'units' => 'px',
            'default' => array(
                'color' => '#2a2b2f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => '',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '33px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h4'),
            'units' => 'px',
            'default' => array(
                'color' => '#2a2b2f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => '',
                'google' => true,
                'font-size' => '18px',
                'line-height' => '25px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h5'),
            'units' => 'px',
            'default' => array(
                'color' => '#2a2b2f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => '',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '25px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h6'),
            'units' => 'px',
            'default' => array(
                'color' => '#2a2b2f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => '',
                'google' => true,
                'font-size' => '12px',
                'line-height' => '18px',
                'text-align' => ''
            ),
        )
    )
));

/* extra font. */
$custom_font_1 = Redux::getOption($opt_name, 'google-font-selector-1');
$custom_font_1 = !empty($custom_font_1) ? explode(',', $custom_font_1) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Extra Fonts', 'wp-elementy'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => esc_html__('Custom Font', 'wp-elementy'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  =>  $custom_font_1,
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'wp-elementy'),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-weight' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => esc_html__('Selector 1', 'wp-elementy'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'wp-elementy'),
            'validate' => 'no_html',
            'default' => '',
        )
    )
));


/**
 * Blog
 * 
 * Archive, Pages, Single, 404, Search, Category, Tags .... 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Blog', 'wp-elementy'),
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'subtitle' => 'Select main content and sidebar alignment.',
            'id' => 'blog_layout',
            'type' => 'image_select',
            'options' => array(
                'full-width' => get_template_directory_uri().'/assets/images/1col.png',
                'right-sidebar' => get_template_directory_uri().'/assets/images/2cr.png',
                'left-sidebar' => get_template_directory_uri().'/assets/images/2cl.png'
            ),
            'title' => 'Blog Layout',
            'default' => 'right-sidebar'
        ),

        array(
            'title' => esc_html__('COMMENT SYSTEM', 'wp-elementy'),
            'id'   => 'comment_system',
            'type' => 'info',
            'style' => 'success',
        ),
        /*array(
            'id' => 'comments_post_type',
            'type' => 'select',
            'title' => 'Comments Type',
            'options' => array(
                'default' => esc_html__('Default Comments', 'wp-elementy'),
                'facebook' => esc_html__('Facebook Comments', 'wp-elementy'),
                'disqus' => esc_html__('Disqus Comments', 'wp-elementy'),
            ),
            'default' => 'default',
        ),
        array(
            'id'       => 'fb_app_id',
            'type'     => 'text',
            'title'    => esc_html__('Facebook App Id', 'wp-elementy'),
            'subtitle' => esc_html__('Facebook App Id, default is my app id: 1621007798158687', 'wp-elementy'),
            'default'  => '',
            'required' => array( 
                array('comments_post_type','=','facebook')
            )
        ),*/
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Blog', 'wp-elementy'),
    'icon' => 'el-icon-livejournal',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Select main content and sidebar alignment.',
            'id' => 'single_layout',
            'type' => 'image_select',
            'options' => array(
                'full-width' => get_template_directory_uri().'/assets/images/1col.png',
                'right-sidebar' => get_template_directory_uri().'/assets/images/2cr.png',
                'left-sidebar' => get_template_directory_uri().'/assets/images/2cl.png'
            ),
            'title' => 'Post Layout',
            'default' => 'right-sidebar'
        ),
        array(
            'subtitle' => 'Show Post Title',
            'id' => 'show_single_title',
            'type' => 'switch',
            'title' => 'Show Post Title',
            'default' => true
        ),
        array(
            'subtitle' => 'Show Tags Post',
            'id' => 'show_tags_post',
            'type' => 'switch',
            'title' => 'Show Tags',
            'default' => true
        ),
        array(
            'subtitle' => 'Show Metadata in Footer',
            'id' => 'show_social_post',
            'type' => 'switch',
            'title' => 'Show Metadata in Footer',
            'default' => true
        ),
        array(
            'subtitle' => 'Previous/Next Pagination',
            'id' => 'show_navigation_post',
            'type' => 'switch',
            'title' => 'Previous/Next Pagination',
            'default' => true
        ),
    )
));

/**
 * Woocommerce
 * 
 * Archive
 * @author Duong Tung
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Woocommerce', 'wp-elementy'),
    'icon' => 'el el-shopping-cart',
    'fields' => array(
        array(
            'title' => esc_html__('OPTIONS FOR SHOP CATALOG', 'wp-elementy'),
            'id'   => 'woo_shop_catalog_intro',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'title' => 'Shop Catalog Layout',
            'subtitle' => 'Shop Catalog Layout, you can choose page left sidebar, right sidebar or full width - no sidebar ',
            'id' => 'woo_archive_layout',
            'type' => 'image_select',
            'default' => 'right-sidebar',
            'options' => array(
                'full-width' => get_template_directory_uri().'/assets/images/1col.png',
                'right-sidebar' => get_template_directory_uri().'/assets/images/2cr.png',
                'left-sidebar' => get_template_directory_uri().'/assets/images/2cl.png'
            ),
        ),
        array(
            'title' => 'Number colums',
            'subtitle' => 'Choose number of columns in Shop Catalog page.',
            'id' => 'woo_columns_layout',
            'options' => array(
                2 => '2 Columns',
                3 => '3 Columns',
                4 => '4 Columns',
            ),
            'type' => 'select',
            'default' => '3',
        ),
        array(
            'title' => esc_html__('Number product', 'wp-elementy'),
            'id' => 'woo_number_per_page',
            'type' => 'slider',
            'subtitle' => esc_html__('Number product to show', 'wp-elementy'),
            'default' => 12,
            'min'  => 6,
            'step' => 1,
            'max' => 50,
        ),
        array(
            'title' => esc_html__('OPTIONS FOR SINGLE PRODUCT', 'wp-elementy'),
            'id'   => 'woo_shop_single_intro',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'subtitle' => esc_html__('Shop info', 'wp-elementy'),
            'id' => 'woo_shop_intro',
            'type' => 'switch',
            'title' => esc_html__('Shop info', 'wp-elementy'),
            'default' => false,
        ),
        array(
            'title' => esc_html__('Tab 1', 'wp-elementy'),
            'subtitle' => esc_html__('tab 1 of shop info', 'wp-elementy'),
            'id' => 'woo_shop_info_1',
            'type' => 'text',
            'default' => 'Free Shipping',
            'required'  => array('woo_shop_intro', 'equals', '1')
        ),
        array(
            'title' => esc_html__('Tab 2', 'wp-elementy'),
            'subtitle' => esc_html__('tab 2 of shop info', 'wp-elementy'),
            'id' => 'woo_shop_info_2',
            'type' => 'text',
            'default' => '24/7 Customer Services',
            'required'  => array('woo_shop_intro', 'equals', '1')
        ),
        array(
            'title' => esc_html__('Tab 3', 'wp-elementy'),
            'subtitle' => esc_html__('tab 3 of shop info', 'wp-elementy'),
            'id' => 'woo_shop_info_3',
            'type' => 'text',
            'default' => 'Payment Options',
            'required'  => array('woo_shop_intro', 'equals', '1')
        ),
        array(
            'title' => esc_html__('Tab 4', 'wp-elementy'),
            'subtitle' => esc_html__('tab 4 of shop info', 'wp-elementy'),
            'id' => 'woo_shop_info_4',
            'type' => 'text',
            'default' => '30 Days Returns',
            'required'  => array('woo_shop_intro', 'equals', '1')
        ),
        array(
            'subtitle' => esc_html__('Shop Clients', 'wp-elementy'),
            'id' => 'woo_shop_clients',
            'type' => 'switch',
            'title' => esc_html__('Shop clients', 'wp-elementy'),
            'default' => false,
        ),
        array(
            'subtitle' => esc_html__('Clients gallery', 'wp-elementy'),
            'id' => 'woo_clients_gallery',
            'type' => 'gallery',
            'title' => esc_html__('Clients gallery', 'wp-elementy'),
            'default' => false,
            'required'  => array('woo_shop_clients', 'equals', '1')
        ),
    )
));

/**
 * Portfolio
 * 
 * @author Duong Tung
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Portfolio', 'wp-elementy'),
    'icon' => 'el el-folder-open',
    'fields' => array(
        array(
            'title' => esc_html__('OPTIONS FOR SINGLE PORTFOLIO', 'wp-elementy'),
            'id'   => 'portfolio_intro',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'title' => esc_html__('Shop Featured Image', 'wp-elementy'),
            'subtitle' => esc_html__('Show featured image on portfolio single', 'wp-elementy'),
            'id' => 'port_featured_img',
            'type' => 'switch',
            'default' => true,
        ),
        array(
            'title' => esc_html__('Shop Related', 'wp-elementy'),
            'subtitle' => esc_html__('Show related portfolio section', 'wp-elementy'),
            'id' => 'port_featured_related',
            'type' => 'switch',
            'default' => true,
        ),
    )
));

/**
 * Footer
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'wp-elementy'),
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'title' => esc_html__('OPTIONS FOR NEWSLETTER AREA', 'wp-elementy'),
            'id'   => 'footer_newsller_area',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'title' => esc_html__('Show Newsletter Area', 'wp-elementy'),
            'id' => 'footer_newsller_area_en',
            'type' => 'switch',
            'subtitle' => esc_html__('Show newsletter area, then you must back to Widgets Manager for active Newsletter widget', 'wp-elementy'),
            'default' => false,
        ),
        array(
            'title' => esc_html__('OPTIONS FOR FOOTER TOP AREA', 'wp-elementy'),
            'id'   => 'footer_primary_area',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id' => 'footer_layout',
            'title' => esc_html__('Layouts', 'wp-elementy'),
            'subtitle' => esc_html__('select a layout for footer', 'wp-elementy'),
            'type' => 'image_select',
            'options' => array(
                '1' => get_template_directory_uri().'/assets/images/footer/footer-1.png',
                '2' => get_template_directory_uri().'/assets/images/footer/footer-2.png',
                '3' => get_template_directory_uri().'/assets/images/footer/footer-3.png',
            ),
            'default' => '1',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top 1', 'wp-elementy'),
    'icon' => 'el el-website',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('OPTIONS FOR FOOTER TOP LAYOUT 1', 'wp-elementy'),
            'id'   => 'footer_footer_layout1',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id'       => 'footer-top-column-1',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer columns', 'wp-elementy' ),
            'subtitle' => esc_html__( 'Select Footer Columns', 'wp-elementy' ),
            'default'    => 4,
            'options'  => array(
                2 => esc_html__('2', 'wp-elementy' ),
                3 => esc_html__('3', 'wp-elementy' ),
                4 => esc_html__('4', 'wp-elementy' ),
            ),
        ),
        array(
            'id'       => 'footer_background_1',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'wp-elementy' ),
            'subtitle' => esc_html__( 'footer background with image, color, etc.', 'wp-elementy' ),
            'output'   => array('.cshero-footer-top-1'),
            'default'  => array(
                'background-color' => '#fff'
            ),
        ),
        array(
            'id' => 'footer_padding_1',
            'type' => 'spacing',
            'mode' => 'padding',
            'units' => array('px'),
            'title' => 'Padding',
            'right' => false,
            'left' => false,
            'output' => '.cshero-footer-top-1 .cshero-footer-top',
            'default'            => array(
                'padding-top'     => '80', 
                'padding-bottom'  => '45',
            ),
        ),
        array(
            'title' => esc_html__('Widget heading color', 'wp-elementy'),
            'subtitle' => 'Color default will inherit from typography',
            'id' => 'footer-heading-color-1',
            'type' => 'color',
            'default' => '',
            'output' => array('.cshero-footer-top-1 .widget .wg-title'),
        ),
        array(
            'title' => esc_html__('Text color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-color-1',
            'type' => 'color',
            'default' => '#6b6d6f',
            'output' => array('.cshero-footer-top-1'),
        ),
        array(
            'title' => esc_html__('Link color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-link-color-1',
            'type' => 'link_color',
            'default' => array(
                'regular'  => '#6b6d6f',
                'hover'    => '#101010',
                'active'   => '#101010',
            ),
            'output' => array('.cshero-footer-top-1 a'),
        ),
        array(
            'title' => esc_html__('OPTIONS FOR FOOTER BOTTOM LAYOUT 1', 'wp-elementy'),
            'id'   => 'footer_footer_layout1',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id' => 'footer_bottom_padding_1',
            'type' => 'spacing',
            'output' => array('.footer-bottom-1 .footer-bottom-wrap'),
            'mode' => 'padding',
            'units' => array('px'),
            'title' => 'Padding',
            'right' => false,
            'left' => false,
            'default'            => array(
                'padding-top'     => '30', 
                'padding-bottom'  => '30',
            ),
        ),
        array(
            'id' => 'footer_bottom_border_1',
            'type' => 'border',
            'output' => array('.footer-bottom-1 .footer-bottom-wrap'),
            'units' => array('px'),
            'title' => 'Border top',
            'right' => false,
            'left' => false,
            'bottom' => false,
            'default'  => array(
                'border-color'  => '#eee', 
                'border-style'  => 'solid', 
                'border-top'    => '1px', 
            ),
        ),
        array(
            'title' => esc_html__('Text color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-bottom-1-color',
            'type' => 'color',
            'default' => '#6b6d6f',
            'output' => array('.footer-bottom-1'),
        ),
        array(
            'title' => esc_html__('Link color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-bottom-1-link-color',
            'type' => 'link_color',
            'default' => array(
                'regular'  => '',
                'hover'    => '',
                'active'   => '',
            ),
            'output' => array('.footer-bottom-1 a'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top 2', 'wp-elementy'),
    'icon' => 'el el-website',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('OPTIONS FOR FOOTER TOP LAYOUT 2', 'wp-elementy'),
            'id'   => 'footer_footer_layout2',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id'       => 'footer-top-column-2',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer columns', 'wp-elementy' ),
            'subtitle' => esc_html__( 'Select Footer Columns', 'wp-elementy' ),
            'default'    => 4,
            'options'  => array(
                2 => esc_html__('2', 'wp-elementy' ),
                3 => esc_html__('3', 'wp-elementy' ),
                4 => esc_html__('4', 'wp-elementy' ),
            ),
        ),
        array(
            'id'       => 'footer_background_2',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'wp-elementy' ),
            'subtitle' => esc_html__( 'footer background with image, color, etc.', 'wp-elementy' ),
            'output'   => array('.cshero-footer-top-2'),
            'default'  => array(
                'background-color' => '#303236'
            ),
        ),
        array(
            'id' => 'footer_padding_2',
            'type' => 'spacing',
            'mode' => 'padding',
            'units' => array('px'),
            'title' => 'Padding',
            'right' => false,
            'left' => false,
            'output' => '.cshero-footer-top-2 .cshero-footer-top',
            'default'            => array(
                'padding-top'     => '80', 
                'padding-bottom'  => '45',
            ),
        ),
        array(
            'title' => esc_html__('Widget heading color', 'wp-elementy'),
            'subtitle' => 'Color default will inherit from typography',
            'id' => 'footer-heading-color-2',
            'type' => 'color',
            'default' => '#fff',
            'output' => array('.cshero-footer-top-2 .widget .wg-title'),
        ),
        array(
            'title' => esc_html__('Text color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-color-2',
            'type' => 'color',
            'output' => array('.cshero-footer-top-2'),
        ),
        array(
            'title' => esc_html__('Link color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-link-color-2',
            'type' => 'link_color',
            'output' => array('.cshero-footer-top-2 a'),
        ),
        array(
            'title' => esc_html__('OPTIONS FOR FOOTER BOTTOM LAYOUT 2', 'wp-elementy'),
            'id'   => 'footer_footer_layout2',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id' => 'footer_bottom_padding_2',
            'type' => 'spacing',
            'output' => array('.footer-bottom-2 .footer-bottom-wrap'),
            'mode' => 'padding',
            'units' => array('px'),
            'title' => 'Padding',
            'right' => false,
            'left' => false,
            'default'            => array(
                'padding-top'     => '30', 
                'padding-bottom'  => '30',
            ),
        ),
        array(
            'id' => 'footer_bottom_border_2',
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
        ),
        array(
            'title' => esc_html__('Text color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-bottom-2-color',
            'type' => 'color',
            'default' => '#6b6d6f',
            'output' => array('.footer-bottom-1'),
        ),
        array(
            'title' => esc_html__('Link color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-bottom-2-link-color',
            'type' => 'link_color',
            'default' => array(
                'regular'  => '#6b6d6f',
                'hover'    => '#fff',
                'active'   => '#fff',
            ),
            'output' => array('.footer-bottom-2 a'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Top 3', 'wp-elementy'),
    'icon' => 'el el-website',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('OPTIONS FOR FOOTER LAYOUT 3', 'wp-elementy'),
            'id'   => 'footer_footer_layout3',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id'       => 'footer_background_3',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'wp-elementy' ),
            'subtitle' => esc_html__( 'footer background with image, color, etc.', 'wp-elementy' ),
            'output'   => array('.cshero-footer-top-3'),
            'default'  => array(
                'background-color' => '#eee'
            ),
        ),
        array(
            'id' => 'footer_padding_3',
            'type' => 'spacing',
            'mode' => 'padding',
            'units' => array('px'),
            'title' => 'Padding',
            'right' => false,
            'left' => false,
            'output' => '.cshero-footer-top-3',
            'default'            => array(
                'padding-top'     => '100', 
                'padding-bottom'  => '100',
            ),
        ),
        array(
            'title' => esc_html__('Text color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-color-3',
            'type' => 'color',
            'default' => '#2a2b2f',
            'output' => array('.cshero-footer-top-3'),
        ),
        array(
            'title' => esc_html__('Link color', 'wp-elementy'),
            'subtitle' => '',
            'id' => 'footer-color-hover-3',
            'type' => 'link_color',
            'default' => array(
                'regular'  => '#2a2b2f',
                'hover'    => '#97999c',
                'active'   => '#97999c',
            ),
            'output' => array('.cshero-footer-top-3 a'),
        ),
    ),
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Bottom', 'wp-elementy'),
    'icon' => 'el el-website',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('enable buttom back to top.', 'wp-elementy'),
            'id' => 'footer_bottom_back_to_top',
            'type' => 'switch',
            'title' => esc_html__('Back To Top', 'wp-elementy'),
            'default' => true,
        ),
        array(
            'id' => 'footer-bottom-copyright',
            'type' => 'textarea',
            'title' => esc_html__('Copyright', 'wp-elementy'),
            'subtitle' => esc_html__('Enter copyright text for footer bottom, some HTML is allowed in here: <a>, <p>, <br>, <em>, <strong>', 'wp-elementy'),
            'validate' => 'html_custom',
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'p' => array(),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            ),
            'default' => '<a href="#">© elementy</a>',
        ),
    )
));

/**
 * Social 
 * 
 * Lists individual social
 * @author Duong Tung
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Individual Socials', 'wp-elementy'),
    'icon' => 'el el-share',
    'fields' => array(
        array(
            'id'    => 'individual_social_info',
            'type'  => 'info',
            'style' => 'success',
            'title' => esc_html__('Individual Socials Lists', 'wp-elementy'),
            'desc'  => esc_html__( 'Set link for social', 'wp-elementy'),
        ),
        array(
            'id' => 'facebook',
            'type' => 'text',
            'title' => esc_html__('Facebook Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'twitter',
            'type' => 'text',
            'title' => esc_html__('Twitter Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'rss',
            'type' => 'text',
            'title' => esc_html__('Rss Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'instagram',
            'type' => 'text',
            'title' => esc_html__('Instagram Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'google',
            'type' => 'text',
            'title' => esc_html__('Google Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'skype',
            'type' => 'text',
            'title' => esc_html__('Skype Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'linkedin',
            'type' => 'text',
            'title' => esc_html__('Linkedin', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'pinterest',
            'type' => 'text',
            'title' => esc_html__('Pinterest Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'vimeo',
            'type' => 'text',
            'title' => esc_html__('Vimeo Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'youtube',
            'type' => 'text',
            'title' => esc_html__('Youtube Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'yelp',
            'type' => 'text',
            'title' => esc_html__('Yelp Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'tumblr',
            'type' => 'text',
            'title' => esc_html__('Tumblr Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'behance',
            'type' => 'text',
            'title' => esc_html__('Behance Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id' => 'dribbble',
            'type' => 'text',
            'title' => esc_html__('Dribbble Url', 'wp-elementy'),
            'subtitle' => '',
        ),
        array(
            'id'    => 'individual_social_on_comming_info',
            'type'  => 'info',
            'style' => 'success',
            'title' => esc_html__('List social will show in comming soon page', 'wp-elementy'),
        ),
        array(
            'id'      => 'individual_social_on_comming',
            'type'    => 'sorter',
            'title'   => 'Social on Comming Soon page',
            'options' => array(
                'enabled'  => array(
                    'facebook' => esc_html__('Facebook', 'wp-elementy'),
                    'twitter'     => esc_html__('Twitter', 'wp-elementy'),
                    'behance'     => esc_html__('Behance', 'wp-elementy'),
                    'linkedin' => esc_html__('Linkedin', 'wp-elementy'),
                    'dribbble' => esc_html__('Dribbble', 'wp-elementy'),
                ),
                'disabled' => array(
                    'instagram' => esc_html__('Rss', 'wp-elementy'),
                    'skype' => esc_html__('Skype', 'wp-elementy'),
                    'vimeo' => esc_html__('Vimeo', 'wp-elementy'),
                    'yelp' => esc_html__('Yelp', 'wp-elementy'),
                    'tumblr' => esc_html__('Tumblr', 'wp-elementy'),
                    'rss' => esc_html__('Rss', 'wp-elementy'),
                    'youtube' => esc_html__('Youtube', 'wp-elementy'),
                    'pinterest' => esc_html__('Pinterest', 'wp-elementy'),
                    'behance' => esc_html__('Behance', 'wp-elementy'),
                )
            ),
        ),

        array(
            'id'    => 'individual_social_on_footer_info',
            'type'  => 'info',
            'style' => 'success',
            'title' => esc_html__('List social will show in footer', 'wp-elementy'),
        ),
        array(
            'id'      => 'individual_social_on_footer',
            'type'    => 'sorter',
            'title'   => 'Footer socials',
            'options' => array(
                'enabled'  => array(
                    'facebook' => esc_html__('Facebook', 'wp-elementy'),
                    'twitter'     => esc_html__('Twitter', 'wp-elementy'),
                    'behance' => esc_html__('Behance', 'wp-elementy'),
                    'linkedin'     => esc_html__('Linkedin', 'wp-elementy'),
                    'dribbble' => esc_html__('Dribbble', 'wp-elementy'),
                ),
                'disabled' => array(
                    'instagram' => esc_html__('Rss', 'wp-elementy'),
                    'skype' => esc_html__('Skype', 'wp-elementy'),
                    'vimeo' => esc_html__('Vimeo', 'wp-elementy'),
                    'yelp' => esc_html__('Yelp', 'wp-elementy'),
                    'tumblr' => esc_html__('Tumblr', 'wp-elementy'),
                    'rss' => esc_html__('Rss', 'wp-elementy'),
                    'youtube' => esc_html__('Youtube', 'wp-elementy'),
                    'pinterest' => esc_html__('Pinterest', 'wp-elementy'),
                    'google' => esc_html__('Google', 'wp-elementy'),
                )
            ),
        ),
    )
));

/**
 * Custom CSS
 * 
 * extra css for customer.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Custom CSS', 'wp-elementy'),
    'icon' => 'el el-puzzle',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code', 'wp-elementy'),
            'subtitle' => esc_html__('create your css code here.', 'wp-elementy'),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
));

/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Optimal Core', 'wp-elementy'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'wp-elementy'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => esc_html__('Dev Mode (not recommended)', 'wp-elementy'),
            'default' => false
        )
    )
));

/**
 * Page loading
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page loading', 'wp-elementy'),
    'icon' => 'el el-adjust',
    'fields' => array(
        array(
            'subtitle' => '',
            'id' => 'page-loading',
            'type' => 'switch',
            'title' => esc_html__('Page loading', 'wp-elementy'),
            'default' => false
        )
    )
));