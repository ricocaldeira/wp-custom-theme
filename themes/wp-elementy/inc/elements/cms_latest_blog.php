<?php
vc_map(array(
    "name" => 'CMS Latest Blog',
    "base" => "cms_latest_blog",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-elementy'),
    "description" => esc_html__('show latest blog with awesome layout', 'wp-elementy'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Categories post name",'wp-elementy'),
            "param_name" => "latest_categories_name",
            "value" => wp_elementy_get_category(),
            "description" => esc_html__("Select categories post name (ex: Design)",'wp-elementy'),
            "group" => esc_html__("Template", 'wp-elementy')
        ),
        array(
            'type' => 'img',
            'admin_label' => true,
            'heading' => esc_html__( 'Latest blog layout', 'wp-elementy' ),
            'value' => array(
                'layout1' => get_template_directory_uri().'/vc_params/latest-blog/blog-layout1.png',
                'layout2' => get_template_directory_uri().'/vc_params/latest-blog/latest-blog-2.png',
                'layout3' => get_template_directory_uri().'/vc_params/latest-blog/latest-blog-3.png',
                'layout4' => get_template_directory_uri().'/vc_params/latest-blog/latest-blog-4.png',
            ),
            'param_name' => 'latest_blog_layout',
            'description' => esc_html__( 'Select a latest blog layout.', 'wp-elementy' ),
            "group" => esc_html__("Template", 'wp-elementy'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Number post to show', 'wp-elementy' ),
            'param_name' => 'latest_number_post_to_show',
            'description' => esc_html__( 'Default is 2', 'wp-elementy' ),
            "group" => esc_html__("General", 'wp-elementy')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Exclude post', 'wp-elementy' ),
            'param_name' => 'latest_exclude_post',
            'description' => esc_html__( 'Exclude post: (Enter post IDs, separated by commas)', 'wp-elementy' ),
            "group" => esc_html__("General", 'wp-elementy')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Number columns in row",'wp-elementy'),
            "param_name" => "latest_number_cols",
            "value" => array(
                2 => esc_html__('2 Columns', 'wp-elementy'),
                3 => esc_html__('3 Columns', 'wp-elementy'),
                4 => esc_html__('4 Columns', 'wp-elementy'),
                6 => esc_html__('6 Columns', 'wp-elementy'),
            ),
            "description" => esc_html__("Number product in row",'wp-elementy'),
            'dependency' => array(
                'element' => 'latest_blog_layout',
                'value' => 'layout1',
            ),
            "group" => esc_html__("General", 'wp-elementy'),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show excerpt', 'wp-elementy' ),
            'param_name' => 'latest_excerpt',
            'description' => '',
            "group" => esc_html__("General", 'wp-elementy'),
            'std' => "false",
            'dependency' => array(
                'element' => 'latest_blog_layout',
                'value' => array('layout1', 'layout2'),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Blog Heading', 'wp-elementy' ),
            'param_name' => 'blog_heading',
            'description' => esc_html__( 'Blog heading', 'wp-elementy' ),
            "group" => esc_html__("General", 'wp-elementy'),
            'dependency' => array(
                'element' => 'latest_blog_layout',
                'value' => array('layout1', 'layout2', 'layout4'),
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use view all link ?', 'wp-elementy' ),
            'param_name' => 'latest_viewall',
            'description' => esc_html__( 'Use view all link', 'wp-elementy' ),
            "group" => esc_html__("General", 'wp-elementy'),
            'dependency' => array(
                'element' => 'latest_blog_layout',
                'value' => array('layout1', 'layout2', 'layout4'),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'View all text', 'wp-elementy' ),
            'param_name' => 'latest_viewall_text',
            'description' => esc_html__( 'View all text, default is "Our blog"', 'wp-elementy' ),
            'dependency' => array(
                'element' => 'latest_viewall',
                'value' => 'true',
            ),
            "group" => esc_html__("General", 'wp-elementy')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Font Heading','wp-elementy'),
            "param_name" => "latest_heading_font",
            "value" => array(
                'Default - Montserrat' => 'font-montserrat',
                'Font Poppins' => 'font-poppins'
            ),
            "description" => esc_html__("Number product in row",'wp-elementy'),
            'dependency' => array(
                'element' => 'latest_blog_layout',
                'value' => 'layout2',
            ),
            "group" => esc_html__("Custom Font", 'wp-elementy'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Font Weight',
            'param_name' => 'latest_heading_fw',
            'value' => array(
                'Font Bold' => 'font-bold',
                'Font Normal' => 'font-normal'
            ),
            'dependency' => array(
                'element' => 'latest_blog_layout',
                'value' => 'layout2',
            ),
            "group" => esc_html__("Custom Font", 'wp-elementy'),
        ),
    )
));
class WPBakeryShortCode_cms_latest_blog extends CmsShortCode
{
    protected function content($atts, $content = null) {
        //default value
        $atts_extra = shortcode_atts(array(
            'post_in_page' => '2',  
            ), $atts);
        $atts = array_merge($atts_extra,$atts);
        $html_id = cmsHtmlID('cms-latest-blog');

        return parent::content($atts, $content);
    }
}