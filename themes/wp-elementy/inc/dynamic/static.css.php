<?php

/**
 * Auto create .css file from Theme Options
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_StaticCss
{

    public $scss;
    
    function __construct()
    {
        if(!class_exists('scssc'))
            return;

        /* scss */
        $this->scss = new scssc();
        
        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');
             
        /* generate css over time */
		add_action('wp', array($this, 'generate_over_time'));
        
        /* save option generate css */
       	add_action("redux/options/smof_data/saved", array($this,'generate_file'));
    }
	
    public function generate_over_time(){
    	
    	global $opt_theme_options;

    	if (isset($opt_theme_options) && $opt_theme_options['dev_mode']){
    	    $this->generate_file();
    	}
    }
    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $opt_theme_options, $wp_filesystem;
        
        if (empty($wp_filesystem) || !isset($opt_theme_options))
            return;
            
        $options_scss = get_template_directory() . '/assets/scss/options.scss';

        /* delete files options.scss */
        $wp_filesystem->delete($options_scss);

        /* write options to scss file */
        $wp_filesystem->put_contents($options_scss, $this->css_render(), FS_CHMOD_FILE); // Save it

        /* minimize CSS styles */
        if (!$opt_theme_options['dev_mode'])
            $this->scss->setFormatter('scss_formatter_compressed');

        /* compile scss to css */
        $css = $this->scss_render();

        $file = "static.css";

        $file = get_template_directory() . '/assets/css/' . $file;

        /* delete files static.css */
        $wp_filesystem->delete($file);

        /* write static.css file */
        $wp_filesystem->put_contents($file, $css, FS_CHMOD_FILE); // Save it
    }
    
    /**
     * scss compile
     * 
     * @since 1.0.0
     * @return string
     */
    public function scss_render(){
        /* compile scss to css */
        return $this->scss->compile('@import "master.scss"');
    }
    
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options, $opt_meta_options;
        
        ob_start();

        /* forward options to scss. */
        if(!empty($opt_theme_options['primary_color'])){
            echo '$primary_color:'.esc_attr($opt_theme_options['primary_color']).';';
        }

        if(!empty($opt_theme_options['secondary_color'])){
            echo '$secondary_color:'.esc_attr($opt_theme_options['secondary_color']).';';
        }

        if(!empty($opt_theme_options['link_color'])){
            echo '$link_color:'.esc_attr($opt_theme_options['link_color']).';';
        }

        if(!empty($opt_theme_options['link_color_hover'])){
            echo '$link_color_hover:'.esc_attr($opt_theme_options['link_color_hover']).';';
        }

        if ( !empty($opt_theme_options['header_height']['height']) ) {
            echo '$header_height:'.esc_attr($opt_theme_options['header_height']['height']).';';
        }

        if ( !empty($opt_theme_options['header_height_fixed']['height']) ) {
            echo '$header_height_fixed:'.esc_attr($opt_theme_options['header_height_fixed']['height']).';';
        }

        /* Header sticky option */
        if ( !empty($opt_theme_options['sticky_header_link_color']) ) {
            echo '$sticky_header_link_color:'.esc_attr($opt_theme_options['sticky_header_link_color']).';';
        }
        /* Header sticky scroll down option */
        if ( !empty($opt_theme_options['sticky_header_link_color_scroll']) ) {
            echo '$sticky_header_link_color_scroll:'.esc_attr($opt_theme_options['sticky_header_link_color_scroll']).';';
        }

        /* Header sticky option from Page Option */
        /*if ( !empty($opt_meta_options['sticky_header_link_color']) ) {
            echo '$page_sticky_header_link_color:'.esc_attr($opt_meta_options['sticky_header_link_color']).';';
        }
        if ( !empty($opt_meta_options['sticky_header_link_color_scroll']) ) {
            echo '$page_sticky_header_link_color_scroll:'.esc_attr($opt_meta_options['sticky_header_link_color_scroll']).';';
        }*/

        return ob_get_clean();
    }
}

new CMSSuperHeroes_StaticCss();