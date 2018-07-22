<?php

/**
 * Auto create css from Meta Options.
 * 
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_DynamicCss
{

    function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'generate_css'));
    }
    
    public function generate_css()
    {
        wp_enqueue_style('custom-dynamic',get_template_directory_uri() . '/assets/css/custom-dynamic.css');
        $_dynamic_css = $this->css_render();

        wp_add_inline_style('custom-dynamic', $_dynamic_css);
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $opt_theme_options, $opt_meta_options;
        ob_start();

        /* From Page Options */
        if (!empty($opt_meta_options)) {

            /* Header options */
            if (!empty($opt_meta_options['menu_sticky'])) {
                
                if (!empty($opt_meta_options['sticky_header_bg'])) {
                    echo '.opt-page-sticky.cshero-main-header {background-color: '.$opt_meta_options['sticky_header_bg'].'}';
                }
                echo '@media screen and (min-width: 1025px) {';
                    if (!empty($opt_meta_options['sticky_header_bg_scroll'])) {
                        echo '.opt-page-sticky.cshero-main-header.affix {background-color: '.$opt_meta_options['sticky_header_bg_scroll']['rgba'].'}';
                    }
                echo '}';
            }

            if ( !empty($opt_meta_options['page_title_color']) ) {
                echo '.page-title .page-title-text h1, .page-title .breadcrumb-text li {
                    color: '.$opt_meta_options['page_title_color'].';
                }';
            }
            if ( !empty($opt_meta_options['page_title_bc_color']) ) {
                echo '.page-title .breadcrumb-text li a {
                    color: '.$opt_meta_options['page_title_bc_color'].';
                }';
            }
            if ( !empty($opt_meta_options['page_title_bc_color_hover']) ) {
                echo '.page-title .breadcrumb-text li a:hover, .page-title .breadcrumb-text li a:focus {
                    color: '.$opt_meta_options['page_title_bc_color_hover'].';
                }';
            }

            if ( !empty($opt_meta_options['sticky_logo_height']) ) {
                echo '.opt-page-sticky .cshero-header-logo img { height: '. $opt_meta_options['sticky_logo_height']['height'] .' }';
            }

            if ( !empty($opt_meta_options['scroll_logo_height']) ) {
                $scroll_logo_height = $opt_meta_options['scroll_logo_height']['height'];
            } elseif ( !empty($opt_meta_options['sticky_logo_height']) ) {
                $scroll_logo_height = $opt_meta_options['sticky_logo_height']['height'];
            }
            if ( isset($scroll_logo_height) && !empty($scroll_logo_height) ) {
                echo '.opt-page-sticky.affix .cshero-header-logo img { height: '. $scroll_logo_height .' }';
            }

            /* Header sticky option from Page Option */
            if ( !empty($opt_meta_options['sticky_header_link_color']) ) {
                echo '.opt-page-sticky.cshero-main-header #cshero-menu-mobile,
                      .opt-page-sticky.cshero-main-header .main-navigation .menu-main-menu > li > a,
                      .opt-page-sticky.cshero-main-header .cshero-header-cart-search .icon-wishlist,
                      .opt-page-sticky.cshero-main-header .cshero-header-cart-search .icon_cart_wrap {
                        color: '.$opt_meta_options['sticky_header_link_color'].';
                      }
                    
                    .opt-page-sticky.cshero-main-header .main-navigation .menu-main-menu > li.current-menu-item > a,
                      .opt-page-sticky.cshero-main-header .main-navigation .menu-main-menu > li.current-menu-ancestor > a {
                        border-color: '.$opt_meta_options['sticky_header_link_color'].';
                      }
                    .opt-page-sticky.cshero-main-header .cd-search-trigger:before {border-color: '.$opt_meta_options['sticky_header_link_color'].';}
                    .opt-page-sticky.cshero-main-header .cd-search-trigger:after {background-color: '.$opt_meta_options['sticky_header_link_color'].';}
                    
                    .opt-page-sticky.cshero-main-header #elementy-fullscreen-trigger .elementy-menu-icon,
                    .opt-page-sticky.cshero-main-header #elementy-fullscreen-trigger .elementy-menu-icon:before,
                    .opt-page-sticky.cshero-main-header #elementy-fullscreen-trigger .elementy-menu-icon:after {
                        background-color: '.$opt_meta_options['sticky_header_link_color'].';
                      }

                    .opt-page-sticky.cshero-main-header.affix .main-navigation .menu-main-menu > li > a,
                    .opt-page-sticky.cshero-main-header.affix .cshero-header-cart-search .icon-wishlist, 
                    .opt-page-sticky.cshero-main-header.affix .cshero-header-cart-search .icon_cart_wrap {
                        color: '.$opt_meta_options['sticky_header_link_color_scroll'].';
                    }

                    .opt-page-sticky.cshero-main-header.affix .main-navigation .menu-main-menu > li.current-menu-item > a,
                    .opt-page-sticky.cshero-main-header.affix .main-navigation .menu-main-menu > li.current-menu-ancestor > a {
                        border-color: '.$opt_meta_options['sticky_header_link_color_scroll'].';
                        color: '.$opt_meta_options['sticky_header_link_color_scroll'].';
                        opacity: 1 !important;
                    }
                    .opt-page-sticky.cshero-main-header.affix .cd-search-trigger:before {border-color: '.$opt_meta_options['sticky_header_link_color_scroll'].';}
                    .opt-page-sticky.cshero-main-header.affix .cd-search-trigger:after {background-color: '.$opt_meta_options['sticky_header_link_color_scroll'].';}
                ';
            }

            /*if ( !empty($opt_meta_options['sticky_header_link_color_scroll']) ) {
                echo '$page_sticky_header_link_color_scroll:'.esc_attr($opt_meta_options['sticky_header_link_color_scroll']).';';
            }*/

            /* Footer */
            if ( !empty($opt_meta_options['page_footer_options']) ) {
                if ( !empty($opt_meta_options['footer-bg']) ) {
                    echo '#footer-top.cshero-footer-top-3 {background-color: '.$opt_meta_options['footer-bg'].'}';
                }

                if ( !empty($opt_meta_options['footer-link-color']) ) {
                    echo '#footer-top.cshero-footer-top-3 a {color: '.$opt_meta_options['footer-link-color']['regular'].'}';
                    echo '#footer-top.cshero-footer-top-3 a:hover, #footer-top.cshero-footer-top-3 a:focus {color: '.$opt_meta_options['footer-link-color']['hover'].'}';
                }


                /* Footer layout 4 */
                if ( $opt_meta_options['footer_layout'] == 4 ) {
                    if ( !empty($opt_meta_options['footer_background_4'])) {
                        echo '.cshero-footer-bottom.footer-bottom-4 {';
                            echo ( !empty($opt_meta_options['footer_background_4']['background-color']) ) ? 'background-color: '.$opt_meta_options['footer_background_4']['background-color'].';' : '';
                            echo ( !empty($opt_meta_options['footer_background_4']['background-image']) ) ? 'background-image: url('.$opt_meta_options['footer_background_4']['background-image'].');' : '';
                            echo ( !empty($opt_meta_options['footer_background_4']['background-size']) ) ? 'background-size: '.$opt_meta_options['footer_background_4']['background-size'].';' : '';
                            echo ( !empty($opt_meta_options['footer_background_4']['background-repeat']) ) ? 'background-repeat: '.$opt_meta_options['footer_background_4']['background-repeat'].';' : '';
                            echo ( !empty($opt_meta_options['footer_background_4']['background-position']) ) ? 'background-position: '.$opt_meta_options['footer_background_4']['background-position'].';' : '';
                            echo ( !empty($opt_meta_options['footer_background_4']['background-attachment']) ) ? 'background-attachment: '.$opt_meta_options['footer_background_4']['background-attachment'].';' : '';
                        echo '}';
                    }

                    if ( !empty($opt_meta_options['footer_padding_4']) ) {
                        echo '.cshero-footer-bottom.footer-bottom-4 .footer-bottom-wrap {';
                            echo ( !empty($opt_meta_options['footer_padding_4']['padding-top']) ) ? 'padding-top: '.$opt_meta_options['footer_padding_4']['padding-top'].';' : '';
                            echo ( !empty($opt_meta_options['footer_padding_4']['padding-bottom']) ) ? 'padding-bottom: '.$opt_meta_options['footer_padding_4']['padding-bottom'].';' : '';
                        echo '}';
                    }

                    if ( !empty($opt_meta_options['footer_bottom_border_4']) ) {
                        echo '.cshero-footer-bottom.footer-bottom-4 .footer-bottom-wrap {';
                            echo ( !empty($opt_meta_options['footer_bottom_border_4']['border-color']) ) ? 'border-top-color: '.$opt_meta_options['footer_bottom_border_4']['border-color'].';' : '';
                            echo ( !empty($opt_meta_options['footer_bottom_border_4']['border-style']) ) ? 'border-top-style: '.$opt_meta_options['footer_bottom_border_4']['border-style'].';' : '';
                            echo ( !empty($opt_meta_options['footer_bottom_border_4']['border-top']) ) ? 'border-top-width: '.$opt_meta_options['footer_bottom_border_4']['border-top'].';' : '';
                        echo '}';
                    }

                    if ( !empty($opt_meta_options['footer-color-4']) ) {
                        echo '.cshero-footer-bottom.footer-bottom-4 .footer-bottom-wrap, .footer-bottom-4 .footer-bottom-wrap a {';
                            echo 'color: '. $opt_meta_options['footer-color-4']['rgba'].'';
                        echo '}';
                    }

                    if ( !empty($opt_meta_options['footer-color-hover-4']) ) {
                        echo '.cshero-footer-bottom.footer-bottom-4 .footer-bottom-wrap a:hover, .footer-bottom-4 .footer-bottom-wrap a:focus {';
                            echo 'color: '. $opt_meta_options['footer-color-hover-4']['rgba'].'';
                        echo '}';
                    }
                }
                /* ENd Footer layout 4 */
            }
        }

        if ( !empty($opt_theme_options) ) {
            /* Footer */
            if ( !empty($opt_theme_options['footer_bottom_border_2']) ) {
                echo '.footer-bottom-2 .footer-bottom-wrap {';
                    echo ( !empty($opt_theme_options['footer_bottom_border_2']['border-color']) ) ? 'border-top-color: '.$opt_theme_options['footer_bottom_border_2']['border-color'].';' : '';
                    echo ( !empty($opt_theme_options['footer_bottom_border_2']['border-style']) ) ? 'border-top-style: '.$opt_theme_options['footer_bottom_border_2']['border-style'].';' : '';
                    echo ( !empty($opt_theme_options['footer_bottom_border_2']['border-top']) ) ? 'border-top-width: '.$opt_theme_options['footer_bottom_border_2']['border-top'].';' : '';
                echo '}';
            }

        }
        
        /* page title */
        if( !empty($opt_meta_options['page_title_layout']) && $opt_meta_options['page_title_layout'] == 2 && !empty($opt_meta_options['page-title-color'])) {
            echo '#page-title.page-title-large-3 .page-title-text h1 {color: '. $opt_meta_options['page-title-color'] .';}';
        }

        return ob_get_clean();
    }
}

new CMSSuperHeroes_DynamicCss();