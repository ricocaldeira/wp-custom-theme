<?php
vc_map(array(
    "name" => 'CMS Progress',
    "base" => "cms_progress",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('show 4 steps in your plan', 'wp-elementy'),
    "params" => array(
        //Step 1
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Heading 1', 'wp-elementy' ),
            'description' => esc_html__( 'Enter text of heading step 1.', 'wp-elementy' ),
            'param_name' => 'step_heading_1',
            'value' => '',
            'std' => 'Planning',
            'admin_label' => true
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description 1', 'wp-elementy' ),
            'description' => esc_html__( 'Enter text for description of step 1.', 'wp-elementy' ),
            'param_name' => 'step_desc_1',
            'value' => '',
        ),

        //Step 2
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Heading 2', 'wp-elementy' ),
            'description' => esc_html__( 'Enter text of heading step 2.', 'wp-elementy' ),
            'param_name' => 'step_heading_2',
            'value' => '',
            'std' => 'Development',
            'admin_label' => true
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description 2', 'wp-elementy' ),
            'description' => esc_html__( 'Enter text for description of step 2.', 'wp-elementy' ),
            'param_name' => 'step_desc_2',
            'value' => '',
        ),

        //Step 3
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Heading 3', 'wp-elementy' ),
            'description' => esc_html__( 'Enter text of heading step 3.', 'wp-elementy' ),
            'param_name' => 'step_heading_3',
            'admin_label' => true,
            'value' => '',
            'std' => 'Launch',
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description 3', 'wp-elementy' ),
            'description' => esc_html__( 'Enter text for description of step 3.', 'wp-elementy' ),
            'param_name' => 'step_desc_3',
            'value' => '',
        ),

        //Step 4
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Final Heading', 'wp-elementy' ),
            'description' => esc_html__( 'Enter text of final heading. Use <br /> for break to new line', 'wp-elementy' ),
            'param_name' => 'final_heading',
            'value' => '',
            'std' => 'Let\'s work<br />together',
            'admin_label' => true
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'wp-elementy' ),
            'param_name' => 'link',
            'description' => esc_html__( 'Add link to final step.', 'wp-elementy' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background color', 'wp-elementy' ),
            'param_name' => 'bg_color',
            'description' => esc_html__( 'Select background color for final step.', 'wp-elementy' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background color hover', 'wp-elementy' ),
            'param_name' => 'bg_color_hover',
            'description' => esc_html__( 'Select background color hover for final step.', 'wp-elementy' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Heading Font',
            'param_name' => 'set_monserrat_font',
            'value' => array('Default' => 'font-default') + wp_elementy_font_family_for_heading(),
            'group' => 'Custom Font'
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Content Font',
            'param_name' => 'content_font',
            'value' => array('Default' => 'font-default') + wp_elementy_font_family_for_heading(),
            'group' => 'Custom Font'
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Font weight of Number',
            'param_name' => 'font_weight_number',
            'value' => array(
                'Default - Bold' => 'font-bold',
                'Font Normal' => 'font-normal',
            ),
            'group' => 'Custom Font'
        ),
    )
));
class WPBakeryShortCode_cms_progress extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}