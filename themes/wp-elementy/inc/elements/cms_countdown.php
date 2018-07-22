<?php
vc_map(
	array(
		"name" => esc_html__("CMS Countdown",  'wp-elementy'),
	    "base" => "cms_countdown",
	    "class" => "vc-cms-countdown",
	    "category" => esc_html__("CmsSuperheroes Shortcodes",  'wp-elementy'),
	    "params" => array(
	        array(
	            "type" => "textfield",
	            "heading" => esc_html__("Date count down", 'wp-elementy'),
	            "param_name" => "date_count_down",
	            "value" => "",
	            'admin_label' => true,
	            "description" => "Please enter date e.g 08/18/2018 17:00",   
	        )
	    )
	)
);
class WPBakeryShortCode_cms_countdown extends CmsShortCode{ 
	protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}