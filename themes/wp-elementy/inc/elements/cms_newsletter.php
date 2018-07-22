<?php
vc_map(array(
    "name" => 'CMS Newsletter',
    "base" => "cms_newsletter",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('Newsletter', 'wp-elementy'),
    "params" => array(
    	array(
    		'type' => 'dropdown',
	        'heading' => esc_html__( 'Newsletter Layout', 'wp-elementy' ),
	        'admin_label' => true,
	        'param_name' => 'layout',
	        'value' => array(
                'Default' => 'default',
                'Custom' => 'custom'
            ),
	        'description' => esc_html__( 'You need install Newsletter plugin before', 'wp-elementy' ),
    	),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Custom layout', 'wp-elementy' ),
            'param_name' => 'custom_layout',
            'admin_label' => true,
            'value' => '',
            'description' => 'Use the tag {subscription_form} to place the subscription form within your personal text.',
            'dependency' => array(
                'element' => 'layout',
                'value' => 'custom',
            ),
        ),
    )
));

class WPBakeryShortCode_cms_newsletter extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}