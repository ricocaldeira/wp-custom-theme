<?php
vc_map(array(
    'name' => esc_html__( 'CMS Separator', 'wp-elementy' ),
    'base' => 'cms_separator',
    'icon' => 'cs_icon_for_vc',
    'show_settings_on_create' => true,
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-elementy' ),
    'description' => esc_html__( 'Horizontal separator line', 'wp-elementy' ),
    'params' => array(
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Border Color', 'wp-elementy' ),
            'param_name' => 'color',
            'description' => esc_html__( 'Select border color for your element.', 'wp-elementy' ),
        ),
        array(
            /* Start Icon */
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon library', 'wp-elementy' ),
            'value' => array(
                esc_html__( 'Font Awesome', 'wp-elementy' ) => 'fontawesome',
            ),
            'param_name' => 'icon_type',
            'description' => esc_html__( 'Select icon library.', 'wp-elementy' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'wp-elementy' ),
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
            /* End Icon */
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Alignment', 'wp-elementy' ),
            'param_name' => 'align',
            'value' => array(
                esc_html__( 'Center', 'wp-elementy' ) => 'align_center',
                esc_html__( 'Left', 'wp-elementy' ) => 'align_left',
                esc_html__( 'Right', 'wp-elementy' ) => 'align_right',
            ),
            'description' => esc_html__( 'Select separator alignment.', 'wp-elementy' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Custom Border Color', 'wp-elementy' ),
            'param_name' => 'accent_color',
            'description' => esc_html__( 'Select border color for your element.', 'wp-elementy' ),
            'dependency' => array(
                'element' => 'color',
                'value' => array( 'custom' ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', 'wp-elementy' ),
            'param_name' => 'style',
            'value' => getVcShared( 'separator styles' ),
            'description' => esc_html__( 'Separator display style.', 'wp-elementy' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Border width', 'wp-elementy' ),
            'param_name' => 'border_width',
            'value' => getVcShared( 'separator border widths' ),
            'description' => esc_html__( 'Select border width (pixels).', 'wp-elementy' ),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'wp-elementy' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-elementy' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-elementy' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-elementy' ),
        ),
    ),
));

class WPBakeryShortCode_cms_separator extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}