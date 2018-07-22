<?php
/**
 * get option from meta option
 */
function wp_elementy_get_meta_option($param_name) {
    global $opt_meta_options;

    if (!empty($opt_meta_options[$param_name])) {
        return $opt_meta_options[$param_name];
    } else {
        return '';
    }
}

/**
 * get option from theme option
 */
function wp_elementy_get_theme_option($param_name) {
    global $opt_theme_options;

    if (!empty($opt_theme_options[$param_name])) {
        return $opt_theme_options[$param_name];
    } else {
        return '';
    }
}

/**
 * get theme logo.
 */
function wp_elementy_header_logo() {
    global $opt_theme_options, $opt_meta_options;
    $logo_sticky = $logo_sticky_scroll = '';

    if ( !empty($opt_meta_options['menu_sticky']) && !empty($opt_meta_options['sticky_header_logo']['url']) ) {
        $logo_sticky = $opt_meta_options['sticky_header_logo']['url'];
    } elseif ( !empty($opt_theme_options['sticky_header_logo']['url']) ) {
        $logo_sticky = $opt_theme_options['sticky_header_logo']['url'];
    } else {
        $logo_sticky = $opt_theme_options['main_logo']['url'];
    }

    if ( !empty($opt_meta_options['menu_sticky']) ) {
        if ( $opt_meta_options['sticky_header_logo_scroll']['url'] ) {
            $logo_sticky_scroll = $opt_meta_options['sticky_header_logo_scroll']['url'];
        } else {

            $logo_sticky_scroll = $opt_meta_options['sticky_header_logo']['url'];
        }
    } elseif ( !empty($opt_theme_options['sticky_header_logo_scroll']['url']) ) {
        $logo_sticky_scroll = $opt_theme_options['sticky_header_logo_scroll']['url'];
    } else {
        $logo_sticky_scroll = $opt_theme_options['main_logo']['url'];
    }

    if(isset($opt_theme_options)) {
        ?>
            <a class="main-logo-wrap" href="<?php echo esc_url(home_url('/')); ?>">
                <img class="main-logo" src="<?php echo esc_url($opt_theme_options['main_logo']['url']); ?>" alt="">
                <img class="sticky-logo hidden" src="<?php echo esc_url($logo_sticky); ?>" alt="">
                <img class="sticky-scroll-logo hidden" src="<?php echo esc_url($logo_sticky_scroll); ?>" alt="">
            </a>
        <?php
    } else {
        echo '<h1><a href="' . esc_url( home_url( '/' )) . '" rel="home">';
            bloginfo( 'name' );
        echo '</a></h1>';
    }
}

/**
 * get header class.
 */
function wp_elementy_header_class($class = ''){
    global $opt_theme_options, $opt_meta_options;
    $custom_class = array();

    if(empty($opt_theme_options)){
        echo esc_attr($class);
        return;
    }

    $_class = array($class);

    if(!empty($opt_theme_options['menu_sticky'])) {
        $_class[] = 'header-sticky';
    }

    if(!empty($opt_meta_options['menu_sticky'])) {
        $_class[] = 'opt-page-sticky';
    }

    if(!empty($opt_meta_options['menu_sticky_fixed'])) {
        $_class[] = 'opt-page-fixed';
    }

    $page_title_layout = '';
    $page_title_layout = wp_elementy_get_pagetitle_layout();

    if ( in_array($page_title_layout, array('2', '5')) ) {
        $_class[] = 'has-border-bottom';
    }

    echo esc_attr(implode(' ', $_class));
}

/**
 * main navigation.
 */
function wp_elementy_header_navigation(){

    global $opt_meta_options;

    $attr = array(
        'menu_class' => 'nav-menu menu-main-menu',
        'theme_location' => 'primary',
        'menu_id' => 'menu-main-menu'
    );

    if(is_page() && !empty($opt_meta_options['header_menu']))
        $attr['menu'] = $opt_meta_options['header_menu'];

    /* enable mega menu. */
    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }

    /* main nav. */
    wp_nav_menu( $attr );
}

function wp_elementy_singular_pagetitle() {
    global $opt_meta_options;
    $thumbnail_url = '';

    if ( $opt_meta_options['port_pagetitle_layout'] == 2 ) {
        if (has_post_thumbnail(get_the_ID())) {
            $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        }
    }

    echo $thumbnail_url;
}

/**
 * get page title layout
 */
function wp_elementy_page_title(){
    global $opt_theme_options, $opt_meta_options;

    /* default. */
    $layout = $page_bg_url = $port_thumbnail_url = $thumbnail_url = '';

    /* get layout */
    if(isset($opt_theme_options['page_title_layout']))
        $layout = $opt_theme_options['page_title_layout'];

    if ( !empty($opt_meta_options['page_title_layout']) ) {
        $layout = $opt_meta_options['page_title_layout'];
    }

    if ($layout == '1') return;

    if ( $layout == '3' && !empty($opt_meta_options['pagetitle_slider'])) {
        ?>
            <div class="pagetitle-rev-wrap indent-header">
                <?php echo do_shortcode('[rev_slider_vc alias="'.$opt_meta_options['pagetitle_slider'].'"]'); ?>
            </div>
        <?php
        return;
    }

    /* custom layout from page. */
    /*if (is_single()) {
        $post_layout = 'single-post-title single-layout-1';
        if (has_post_thumbnail(get_the_ID())) {
            $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        }
    }*/

    $cms_get_page_title = wp_elementy_get_pagetitle_layout();

    /* Portfolio page title */
    if ( (is_single() && !empty($opt_theme_options['single_layout'])) || is_singular( 'portfolio' )) {
        add_filter( 'custom_pagetitle_layout', 'wp_elementy_set_pagetitle_layout');
        function wp_elementy_set_pagetitle_layout() {
            return 'page-title-large page-title-large-2 page-title-img';
        }
    }
    ?>
    <div id="page-title" class="page-title 
        <?php wp_elementy_custom_pagetitle_layout(); ?>">
        <?php
        $sub_pagetitle = wp_elementy_get_sub_pagetitle();
        if ( $cms_get_page_title < 10 ) : ?>
            <div class="container">
                <div class="row">
                    <div class="page-title-inner">
                        <div id="page-title-text" class="page-title-text col-xs-12 col-sm-12 col-md-6">
                            <h1><?php wp_elementy_get_page_title(); ?></h1>
                            <?php if ( $cms_get_page_title > 3 && $cms_get_page_title < 9 ) : ?>
                                <?php echo balancetags($sub_pagetitle); ?>
                            <?php endif; ?>
                        </div>
                        <div id="breadcrumb-text" class="breadcrumb-text col-xs-12 col-sm-12 col-md-6 <?php echo (!empty($sub_pagetitle) && $cms_get_page_title < 9) ? 'has-sub' : ''; ?>">
                            <?php wp_elementy_get_bread_crumb(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( $cms_get_page_title == 11 ) : ?>
            <div class="container">
                <div class="row">
                    <div class="page-title-inner">
                        <div id="page-title-text" class="page-title-text col-xs-12 col-sm-12 col-md-12">
                            <h1><?php wp_elementy_get_page_title(); ?></h1>
                        </div>
                        <div id="breadcrumb-text" class="breadcrumb-text col-xs-12 col-sm-12 col-md-12">
                            <?php wp_elementy_get_bread_crumb(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ( $cms_get_page_title == 10 ) : ?>
            <div class="container pos-rev">
                <div id="page-title-text" class="page-title-text">
                    <h1><?php wp_elementy_get_page_title(); ?></h1>
                </div>
            </div>
        <?php endif; ?>
    </div><!-- #page-title -->
    <?php
}

/**
 * Get page title layout
 * @return [type] [description]
 */
function wp_elementy_get_pagetitle_layout() {
    global $opt_theme_options, $opt_meta_options;

    $cms_get_page_title = 1;

    if(!empty( $opt_theme_options['page_title_style'])) {
        $cms_get_page_title =  $opt_theme_options['page_title_style'];
    } 
    if (!empty($opt_meta_options['enable_custom_pagetitle']) && $opt_meta_options['page_title_layout'] == 2 && !empty($opt_meta_options['page_title_style'])) {
        $cms_get_page_title =  $opt_meta_options['page_title_style'];
    }

    if ( class_exists('Woocommerce') && (is_shop() || is_woocommerce() ) ) {
        $post_id = wc_get_page_id('shop');
        $_page_meta_enable = get_post_meta($post_id, 'ef3-enable_custom_pagetitle', true);
        $_page_title_layout = get_post_meta($post_id, 'ef3-page_title_layout', true);

        if ( $_page_meta_enable && $_page_title_layout == 2) {
            $cms_get_page_title = get_post_meta($post_id, 'ef3-page_title_style', true);
        }
    }

    if ( class_exists('Woocommerce') && is_cart()) {
        $post_id = wc_get_page_id('cart');
        $_page_meta_enable = get_post_meta($post_id, 'ef3-enable_custom_pagetitle', true);
        $_page_title_layout = get_post_meta($post_id, 'ef3-page_title_layout', true);

        if ( $_page_meta_enable && $_page_title_layout == 2) {
            $cms_get_page_title = get_post_meta($post_id, 'ef3-page_title_style', true);
        }
    }

    if ( class_exists('Woocommerce') && is_checkout()) {
        $post_id = wc_get_page_id('checkout');
        $_page_meta_enable = get_post_meta($post_id, 'ef3-enable_custom_pagetitle', true);
        $_page_title_layout = get_post_meta($post_id, 'ef3-page_title_layout', true);

        if ( $_page_meta_enable && $_page_title_layout == 2) {
            $cms_get_page_title = get_post_meta($post_id, 'ef3-page_title_style', true);
        }
    }

    return $cms_get_page_title;
}

function wp_elementy_get_sub_pagetitle() {
    global $opt_theme_options, $opt_meta_options;
    $html = '';

    if ( !empty($opt_theme_options['sub-page-title']) ) {
        $html.= '<div class="sub-pagetitle">';
        $html.= wp_kses( $opt_theme_options['sub-page-title'], array('a' => array('href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array() ));
        $html.= '</div>';
    }

    return $html;
}

function wp_elementy_set_pagetitle_overlay() {
    global $opt_theme_options, $opt_meta_options;
    $pagetitle_css = $overlay = '';

    if ( !empty($opt_theme_options['page-title-overlay']) ) {
        $overlay = $opt_theme_options['page-title-overlay'];
    }

    if ( !empty($opt_meta_options['enable_custom_pagetitle']) && $opt_meta_options['page_title_layout'] == 2 && !empty($opt_meta_options['page-title-overlay']) ) {
        $overlay = $opt_meta_options['page-title-overlay'];
    }
    if ( !empty($overlay['color']) ) {
        $pagetitle_css = '.page-title:before {
            content: "";
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: '.$overlay['rgba'].';
        }';
    }

    if ( !empty($opt_meta_options['enable_custom_pagetitle']) && $opt_meta_options['page_title_layout'] == 2 && !empty($opt_meta_options['page_title_background']) ) {
        $pagetitle_css .= '#page-title.page-title-img {';
            $pagetitle_css.= 'background-repeat:'.$opt_meta_options['page_title_background']['background-repeat'].';';
            $pagetitle_css.= 'background-size:'.$opt_meta_options['page_title_background']['background-size'].';';
            $pagetitle_css.= 'background-attachment:'.$opt_meta_options['page_title_background']['background-attachment'].';';
            $pagetitle_css.= 'background-position:'.$opt_meta_options['page_title_background']['background-position'].';';
            $pagetitle_css.= 'background-color:'.$opt_meta_options['page_title_background']['background-color'].';';
            $pagetitle_css.= 'background-image: url('.$opt_meta_options['page_title_background']['background-image'].');';
        $pagetitle_css .= '}';
    }

    echo '<style type="text/css">'.$pagetitle_css.'</style>';
}
add_action( 'wp_head', 'wp_elementy_set_pagetitle_overlay' );

/**
 * Custom Page title layout
 * 
 * @author Duong Tung
 * @since 1.0.0
 */
function wp_elementy_custom_pagetitle_layout() {
    $cms_get_page_title = wp_elementy_get_pagetitle_layout();

    switch ( $cms_get_page_title ) {
        case 1:
            $page_title_class = 'page-title-small bg-gray';
            break; 
        case 2:
            $page_title_class = 'page-title-small white has-border';
            break; 
        case 3:
            $page_title_class = 'page-title-small grey-dark-bg';
            break; 
        case 4:
            $page_title_class = 'page-title-big bg-gray';
            break; 
        case 5:
            $page_title_class = 'page-title-big white has-border';
            break;
        case 6:
            $page_title_class = 'page-title-big grey-dark-bg';
            break;
        case 7:
            $page_title_class = 'page-title-big page-title-img grey-dark-bg';
            break;
        case 8:
            $page_title_class = 'page-title-large page-title-img';
            break;
        case 9:
            $page_title_class = 'page-title-large page-title-large-2 page-title-img';
            break;
        case 10:
            $page_title_class = 'page-title-large page-title-large-3 page-title-img';
            break;
        case 11:
            $page_title_class = 'page-title-large page-title-large-4 page-title-img';
            break;
        case 'none':
            $page_title_class = 'page-title-hidden hidden';
            break;
        default:
            $page_title_class = '';
            break;
    }

    echo apply_filters('custom_pagetitle_layout', $page_title_class);
}

/**
 * page title
 */
function wp_elementy_get_page_title(){
    global $opt_theme_options, $opt_meta_options;

    $single_layout = '';
    $single_layout = $opt_theme_options['single_layout'];
    if ( isset($_GET['single-layout']) && !empty($_GET['single-layout']) ) {
        $single_layout = trim($_GET['single-layout']);
    }

    if (is_page() && !empty($opt_meta_options['custom-page-title']) ) {
        echo esc_html($opt_meta_options['custom-page-title']);

        return;
    }

    if (!is_archive()){
        /* page. */
        if(is_page()) :
            /* custom title. */
            if(!empty($opt_meta_options['page_title_text'])):
                echo esc_html($opt_meta_options['page_title_text']);
            else :
                the_title();
            endif;
        elseif (is_home()):
            esc_html_e('Blog', 'wp-elementy');
        /* search */
        elseif (is_search()):
            printf( esc_html__( 'Search Results for: %s', 'wp-elementy' ), '<span>' . get_search_query() . '</span>' );
        /* 404 */
        elseif (is_404()):
            esc_html_e( '404', 'wp-elementy');

        elseif ( is_single() && !empty($single_layout) && $single_layout != 'full-width' ) :
            esc_html_e('Blog Single', 'wp-elementy');

        /* other */
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if ( is_category() ) :
            single_cat_title();
        elseif ( is_tag() ) :
            /* tag. */
            single_tag_title();
        /* author. */
        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'wp-elementy' ), '<span class="vcard">' . get_the_author() . '</span>' );
        /* date */
        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'wp-elementy' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'wp-elementy' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wp-elementy' ) ) . '</span>' );
        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'wp-elementy' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wp-elementy' ) ) . '</span>' );
        /* portfolio tax */
        elseif (is_tax('category-portfolio')):
            $term = get_term_by( 'slug', get_query_var( 'category-portfolio' ), get_query_var( 'taxonomy' ) );
            echo apply_filters('the_title', $term->name);
        elseif (is_post_type_archive('portfolio')):
            esc_html_e('Projects', 'wp-elementy');
        /* post format */
        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'wp-elementy' );
        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'wp-elementy');
        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'wp-elementy');
        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'wp-elementy' );
        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'wp-elementy' );
        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'wp-elementy' );
        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'wp-elementy' );
        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'wp-elementy' );
        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'wp-elementy' );
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        else :
            /* other */
            the_title();
        endif;
    }
}

/**
 * Breadcrumb
 *
 * @since 1.0.0
 */
function wp_elementy_get_bread_crumb($separator = '') {
    global $opt_theme_options, $post;

    echo '<ul class="breadcrumbs">';
    /* not front_page */
    if ( !is_front_page() ) {
        echo '<li><a href="';
        echo esc_url(home_url('/'));
        echo '">';
        echo isset($opt_theme_options['breacrumb_home_prefix']) ? esc_html($opt_theme_options['breacrumb_home_prefix']) : esc_html__('Home', 'wp-elementy');
        echo "</a></li>";
    }

    $params['link_none'] = '';

    /* category */
    if (is_category()) {
        $category = get_the_category();
        $ID = $category[0]->cat_ID;
        echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>'.wp_kses_post($cat_parents).'</li>';
    }
    /* tax */
    if (is_tax()) {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $link = get_term_link( $term );

        if ( is_wp_error( $link ) ) {
            echo sprintf('<li>%s</li>', $term->name );
        } else {
            echo sprintf('<li><a href="%s" title="%s">%s</a></li>', $link, $term->name, $term->name );
        }
    }
    /* home */

    /* page not front_page */
    if(is_page() && !is_front_page()) {
        $parents = array();
        $parent_id = $post->post_parent;
        while ( $parent_id ) :
            $page = get_page( $parent_id );
            if ( $params["link_none"] )
                $parents[]  = get_the_title( $page->ID );
            else
                $parents[]  = '<li><a href="' . esc_url(get_permalink( $page->ID )) . '" title="' . esc_attr(get_the_title( $page->ID )) . '">' . esc_html(get_the_title( $page->ID )) . '</a></li>' . $separator;
            $parent_id  = $page->post_parent;
        endwhile;
        $parents = array_reverse( $parents );
        echo join( '', $parents );
        echo '<li>'.esc_html(get_the_title()).'</li>';
    }
    /* single */
    if(is_single()) {
        $categories_1 = get_the_category($post->ID);
        if($categories_1):
            foreach($categories_1 as $cat_1):
                $cat_1_ids[] = $cat_1->term_id;
            endforeach;
            $cat_1_line = implode(',', $cat_1_ids);
        endif;
        if( isset( $cat_1_line ) && $cat_1_line ) {
            $categories = get_categories(array(
                'include' => $cat_1_line,
                'orderby' => 'id'
            ));
            if ( $categories ) :
                foreach ( $categories as $cat ) :
                    $cats[] = '<li><a href="' . esc_url(get_category_link( $cat->term_id )) . '" title="' . esc_attr($cat->name) . '">' . esc_html($cat->name) . '</a></li>';
                endforeach;
                echo join( '', $cats );
            endif;
        }
        echo '<li>'.get_the_title().'</li>';
    }
    /* tag */
    if( is_tag() ){ echo '<li>'."Tag: ".single_tag_title('',FALSE).'</li>'; }
    /* search */
    if( is_search() ){ echo '<li>'.esc_html__("Search", 'wp-elementy').'</li>'; }
    /* date */
    if( is_year() ){ echo '<li>'.get_the_time('Y').'</li>'; }
    /* 404 */
    if( is_404() ) {
        echo '<li>'.esc_html__("404 - Page not Found", 'wp-elementy').'</li>';
    }
    /* archive */
    if( is_archive() && is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
        echo '<li>'. esc_html($title) .'</li>';
    }
    echo "</ul>";
}

/**
 * Display entry footer
 */
function wp_elementy_post_readmore() {
    ?>
    <div class="post-meta clearfix">
        <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>" class="blog-more pull-left"><?php esc_html_e('Read More', 'wp-elementy') ?></a>
        <ul class="footer-meta-wrap pull-right">
            <li class="entry-comment">
                <i class="icon_comment_alt"></i>
                <a href="<?php the_permalink(); ?>"><?php echo comments_number('0','1','%'); ?></a>
            </li>
            <li class="entry-like">
                <?php echo wp_elementy_get_like();?>
            </li>
            <li class="entry-share">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                    <i aria-hidden="true" class="social_share"></i>
                </a>
                <ul class="social-menu dropdown-menu dropdown-menu-right" role="menu">
                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><i aria-hidden="true" class="social_facebook"></i></a></li>
                    <li><a target="_blank" href="https://twitter.com/home?status=<?php esc_html_e('Check out this article', 'wp-elementy');?>:%20<?php echo strip_tags(get_the_title());?>%20-%20<?php the_permalink();?>"><i aria-hidden="true" class="social_twitter"></i></a></li>
                    <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>"><i aria-hidden="true" class="social_googleplus"></i></a></li>
                </ul>
            </li>
        </ul>
    </div>
    <?php
}

function wp_elementy_get_like() {
    echo '<i class="icon_heart_alt"></i>';
    $count = get_post_meta( get_the_ID(), "_post_like_count", true );
    $count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
    echo '<span>'.intval($count).'</span>';
}

/**
 * Display an optional post detail.
 */
function wp_elementy_archive_posts_metadata( $post_id = '') {
    ?>
    <div class="post-info">
        <ul>
            <li class="entry-date">
                <?php 
                    $archive_year  = get_the_time('Y'); 
                    $archive_month = get_the_time('m'); 
                    $archive_day   = get_the_time('d'); 
                ?>
                <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date("F j, Y");?></a>
            </li>
            <li class="entry-author">
                <?php if (!empty($post_id)) {
                        $author_id = get_post_field( 'post_author', $post_id );
                        the_author_meta( 'display_name', $author_id );
                    } else {
                        the_author_posts_link();
                    }
                ?>
            </li>
            <?php if (has_category()) : ?>
                <li class="entry-terms">
                    <?php the_terms( get_the_ID(), 'category', '', ', ' ); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}

function wp_elementy_single_post_metadata() {
    ?>
    <div class="entry-meta mb-20 clearfix">
        <ul>
            <li class="entry-date">
                <?php 
                    $archive_year  = get_the_time('Y'); 
                    $archive_month = get_the_time('m'); 
                    $archive_day   = get_the_time('d'); 
                ?>
                <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date("F j");?></a>
            </li>
            <li class="entry-author">
                <?php if (!empty($post_id)) {
                        $author_id = get_post_field( 'post_author', $post_id );
                        the_author_meta( 'display_name', $author_id );
                    } else {
                        the_author_posts_link();
                    }
                ?>
            </li>
            <?php if (has_category()) : ?>
                <li class="entry-terms">
                    <?php the_terms( get_the_ID(), 'category', '', ', ' ); ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}

/**
 * Display an optional post video.
 */
function wp_elementy_post_video() {

    global $opt_meta_options, $wp_embed;

    /* no video. */
    if(empty($opt_meta_options['opt-video-type'])) {
        wp_elementy_post_thumbnail();
        return;
    }

    if($opt_meta_options['opt-video-type'] == 'local' && !empty($opt_meta_options['otp-video-local']['id'])){

        $video = wp_get_attachment_metadata($opt_meta_options['otp-video-local']['id']);

        echo do_shortcode('[video width="'.esc_attr($opt_meta_options['otp-video-local']['width']).'" height="'.esc_attr($opt_meta_options['otp-video-local']['height']).'" '.$video['fileformat'].'="'.esc_url($opt_meta_options['otp-video-local']['url']).'" poster="'.esc_url($opt_meta_options['otp-video-thumb']['url']).'"][/video]');

    } elseif($opt_meta_options['opt-video-type'] == 'youtube' && !empty($opt_meta_options['opt-video-youtube'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-youtube']).'[/embed]'));

    } elseif($opt_meta_options['opt-video-type'] == 'vimeo' && !empty($opt_meta_options['opt-video-vimeo'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta_options['opt-video-vimeo']).'[/embed]'));

    }
}

/**
 * Display an optional post audio.
 */
function wp_elementy_post_audio() {
    global $opt_meta_options;

    /* no audio. */
    if(empty($opt_meta_options['otp-audio']['id'])) {
        wp_elementy_post_thumbnail();
        return;
    }

    $audio = wp_get_attachment_metadata($opt_meta_options['otp-audio']['id']);

    echo do_shortcode('[audio '.$audio['fileformat'].'="'.esc_url($opt_meta_options['otp-audio']['url']).'"][/audio]');
}

/**
 * Display an optional post gallery.
 */
function wp_elementy_post_gallery(){
    global $opt_meta_options;

    /* no audio. */
    if(empty($opt_meta_options['opt-gallery'])) {
        wp_elementy_post_thumbnail();
        return;
    }

    $array_id = explode(",", $opt_meta_options['opt-gallery']);
    ?>
        <div id="entry-gallery-<?php echo uniqid(); ?>" class="cms-carousel-wrapper owl-images-wrap paging_inside mb-30">
            <div class="cms-owl-carousel owl-carousel owl-theme owl-loaded owl-drag" data-loop="false" data-margin="0" data-nav="true" data-pagination="true" data-per-view="1">
                <?php $i = 0; ?>
                <?php foreach ($array_id as $image_id): ?>
                    <?php
                    $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                    if($attachment_image[0] != ''):?>
                        <div class="item">
                            <img src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php
}

/**
 * Display an optional post quote.
 */
function wp_elementy_post_quote() {
    global $opt_meta_options;

    if(empty($opt_meta_options['opt-quote-content'])){
        wp_elementy_post_thumbnail();
        return;
    }

    $opt_meta_options['opt-quote-title'] = !empty($opt_meta_options['opt-quote-title']) ? '<footer>'.esc_html($opt_meta_options['opt-quote-title']).'</footer>' : '' ;

    echo '<blockquote>'.esc_html($opt_meta_options['opt-quote-content']).wp_kses_post($opt_meta_options['opt-quote-title']).'</blockquote>';
}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function wp_elementy_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    echo '<div class="post-thumbnail">';
            the_post_thumbnail();
    echo '</div>';
}

/**
 * 
 */
function wp_elementy_single_metadata() {
    global $opt_theme_options;
    ?>  
        <div class="col-md-9 col-sm-9 col-xs-9">
            <?php if( !empty($opt_theme_options['show_tags_post']) && has_tag()): ?>
                <div class="entry-tags pull-left"><?php the_tags('', '' ); ?></div>    
            <?php endif; ?>
        </div>

        <?php if ( !empty($opt_theme_options['show_social_post']) ) : ?>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <ul class="footer-meta-wrap pull-right <?php echo (has_tag()) ? 'pos-abs' : ''; ?>">
                    <li class="entry-comment">
                        <i class="icon_comment_alt"></i>
                        <a href="<?php the_permalink(); ?>"><?php echo comments_number('0','1','%'); ?></a>
                    </li>
                    <li class="entry-like" >
                        <?php
                            $nonce = wp_create_nonce( 'simple-likes-nonce' ); // Security
                            $count = get_post_meta( get_the_ID(), "_post_like_count", true ); // like count
                            $count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
                            $liked = WpElementy_Simple_Post_Like::already_liked( get_the_ID() );
                            printf(
                                '<a class="post-like%1$s" href="#" data-role="simple-like-button" data-post-id="%2$s" data-nonce="%3$s">%4$s</a>',
                                ( $liked ? ' liked' : '' ),
                                esc_attr( get_the_ID() ),
                                esc_attr( $nonce ),
                                WpElementy_Simple_Post_Like::get_like_count_markup( $count )
                            );
                        ?>
                    </li>
                    <li class="entry-share">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                            <i aria-hidden="true" class="social_share"></i>
                        </a>
                        <ul class="social-menu dropdown-menu dropdown-menu-right" role="menu">
                            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><i aria-hidden="true" class="social_facebook"></i></a></li>
                            <li><a target="_blank" href="https://twitter.com/home?status=<?php esc_html_e('Check out this article', 'wp-elementy');?>:%20<?php echo strip_tags(get_the_title());?>%20-%20<?php the_permalink();?>"><i aria-hidden="true" class="social_twitter"></i></a></li>
                            <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>"><i aria-hidden="true" class="social_googleplus"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    <?php
}

/**
 * custom css.
 */
function wp_elementy_custom_css() {
    global $opt_theme_options;

    if(empty($opt_theme_options['custom_css']))
        return ;
        /* custom css. */
        echo '<style type="text/css">' . $opt_theme_options['custom_css'] . '</style>';
}

add_action('wp_head', 'wp_elementy_custom_css');

/**
 * add font google font to VC param
 */
function wp_elementy_add_poppins_font($fonts_list){
    $poppins->font_family = 'Poppins';
    $poppins->font_types = "300 light:300:light,400 regular:400:normal,500 medium:500:normal,600 semi-bold:600:normal,700 bold regular:700:normal";
    $poppins->font_styles = '';
    $poppins->font_family_description = 'Choose your font name you want';
    $poppins->font_style_description = 'Choose your font style you want';
    $fonts_list[] = $poppins;

    return $fonts_list;
}
add_filter('vc_google_fonts_get_fonts_filter', 'wp_elementy_add_poppins_font');

/**
 * Add google font to theme 
 *
 * Montserrat
 * Poppins
 * Josefin Sans
 */
function wp_elementy_add_google_fonts() {
    wp_enqueue_style( 'wp-elementy-monserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700', false ); 
    wp_enqueue_style( 'wp-elementy-poppins', 'https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700', false ); 
    wp_enqueue_style( 'wp-elementy-josefin', 'https://fonts.googleapis.com/css?family=Josefin+Sans:400,300,300italic,400italic,600,600italic,700,700italic', false ); 
}

add_action( 'wp_enqueue_scripts', 'wp_elementy_add_google_fonts' );

/**
 * Remove 'Edit with VC' from Adminbar
 *
 * @author Duong Tung
 * @since 1.0.0
 */
function wp_elementy_remove_wp_admin_bar_button() {
    remove_action( 'admin_bar_menu', array( vc_frontend_editor(), 'adminBarEditLink' ), 1000 );
}
add_action( 'vc_after_init', 'wp_elementy_remove_wp_admin_bar_button' );

/**
 * Animation lib
 */
function wp_elementy_animate_lib() {
    $animate = array(
        esc_html__( 'None', 'wp-elementy' ) => 'cms_animate',
        esc_html__( 'FadeIn', 'wp-elementy' ) => 'cms_animate fadeIn wow',
        esc_html__( 'FadeOut', 'wp-elementy' ) => 'cms_animate fadeOut wow',
        esc_html__( 'zoomIn', 'wp-elementy' ) => 'cms_animate zoomIn wow',
        esc_html__( 'zoomOut', 'wp-elementy' ) => 'cms_animate zoomOut wow',
        esc_html__( 'FadeInUp', 'wp-elementy' ) => 'cms_animate wow fadeInUp',
        esc_html__( 'FadeInDown', 'wp-elementy' ) => 'cms_animate wow fadeInDown',
        esc_html__( 'FadeInLeft', 'wp-elementy' ) => 'cms_animate wow fadeInLeft',
        esc_html__( 'FadeInRight', 'wp-elementy' ) => 'cms_animate wow fadeInRight',
        esc_html__( 'slideInLeft', 'wp-elementy' ) => 'cms_animate wow slideInLeft',
        esc_html__( 'slideInRight', 'wp-elementy' ) => 'cms_animate wow slideInRight',
        esc_html__( 'bounceIn', 'wp-elementy' ) => 'cms_animate wow bounceIn',
    );

    return $animate;
}

/**
 * Animation time delay lib
 */
function wp_elementy_animate_time_delay_lib() {
    $animate_time = array(
        esc_html__( 'None', 'wp-elementy' ) => '',
        esc_html__( '100ms', 'wp-elementy' ) => '100ms',
        esc_html__( '200ms', 'wp-elementy' ) => '200ms',
        esc_html__( '300ms', 'wp-elementy' ) => '300ms',
        esc_html__( '400ms', 'wp-elementy' ) => '400ms',
        esc_html__( '500ms', 'wp-elementy' ) => '500ms',
        esc_html__( '600ms', 'wp-elementy' ) => '600ms',
        esc_html__( '700ms', 'wp-elementy' ) => '700ms',
        esc_html__( '800ms', 'wp-elementy' ) => '800ms',
        esc_html__( '900ms', 'wp-elementy' ) => '900ms',
        esc_html__( '1s', 'wp-elementy' ) => '1s',
        esc_html__( '1.1s', 'wp-elementy' ) => '1.1s',
        esc_html__( '1.2s', 'wp-elementy' ) => '1.2s',
        esc_html__( '1.3s', 'wp-elementy' ) => '1.3s',
        esc_html__( '1.4s', 'wp-elementy' ) => '1.4s',
        esc_html__( '1.5s', 'wp-elementy' ) => '1.5s',
    );

    return $animate_time;
}

/**
 * Background position
 */
function wp_elementy_background_position() {
    $bg_position = array(
        esc_html__( 'Default', 'wp-elementy' ) => 'center center',
        esc_html__( 'Left Top', 'wp-elementy' ) => 'left top',
        esc_html__( 'Left Center', 'wp-elementy' ) => 'left center',
        esc_html__( 'Left Bottom', 'wp-elementy' ) => 'left bottom',
        esc_html__( 'Right Top', 'wp-elementy' ) => 'right top',
        esc_html__( 'Right Center', 'wp-elementy' ) => 'right center',
        esc_html__( 'Right Bottom', 'wp-elementy' ) => 'right bottom',
    );

    return $bg_position;
}

/**
 * Lists font family for vc param
 * @return [type] [description]
 */
function wp_elementy_font_family_for_heading() {
    $font_family = array(
        'Font Poppins' => 'font-poppins',
        'Font Montserrat' => 'font-montserrat',
        'Font Josefin Sans' => 'font-josefin',
        'Font Raleway' => 'font-raleway',
        'Font Open Sans' => 'font-opensans',
    );

    return $font_family;
}

/**
 * add class for #content
 */
function wp_elementy_set_padding_class() {
    global $opt_meta_options;
    $main_content_class = array();
    $main_content_class[] = 'p-140-cont';

    $main_content_class[] = (!empty($opt_meta_options['page_general_padding_top'])) ? 'pt-0' : '';
    $main_content_class[] = (!empty($opt_meta_options['page_general_padding_bottom'])) ? 'pb-0' : '';

    return implode(' ', $main_content_class);
}

/**
 * Build style
 * @author FOX
 * @since 1.0.0
 */

if(!function_exists('wp_elementy_build_style')){
    function wp_elementy_build_style($arr = array()) {
        $return = '';
        if(count($arr) > 0){
            $return = 'style="';
            $return .= implode(' ', $arr);
            $return .= '"';
        }
        return $return;
    }
}

/**
 * calc padding-top of menu level 1
 */
function wp_elementy_build_pdt() {
    global $opt_theme_options, $opt_meta_options;
    $padding_top = $header_height = $header_height_fixed = '';

    $header_height = intval(rtrim($opt_theme_options['header_height']['height'], 'px'));
    if ($header_height <= 55) $header_height = 93;

    /*$padding_top = ($header_height - 60) / 2;*/
    $padding_top = 21;

    $header_height_fixed = intval(rtrim($opt_theme_options['header_height_fixed']['height'], 'px'));
    if ($header_height_fixed <= 40) $header_height_fixed = 60;
    /*$pt_fixed = ($header_height_fixed - 53) / 2;*/
    $pt_fixed = 7;

    /* Search icon padding-top */
    /*$cart_search_pt = ($header_height - 44) /2 - 2;*/
    $cart_search_pt = 26;



    $fixed_cart_search_pt = ($header_height_fixed - 44) /2 - 2;
    $search_height = $header_height + 7;

    $indent_header_bg = ( !empty($opt_meta_options['sticky_header_bg']) ) ? $opt_meta_options['sticky_header_bg'] : '';

    echo '<style type="text/css">.indent-header {background-color: '.$indent_header_bg.';}

            .main-navigation .menu-main-menu > li > a {padding-top: '.$padding_top.'px;}
             .affix .main-navigation .menu-main-menu > li > a {padding-top: '.$pt_fixed.'px;}
             .header-search-cart {padding-top: '.$cart_search_pt.'px;}
             .affix .header-search-cart {padding-top: '.$fixed_cart_search_pt.'px;}
             .cd-search {height: '.$search_height.'px;}
             .affix .cd-search {height: '.$header_height_fixed.'px;}
            @media screen and (min-width: 1025px) {
                
                .indent-header {padding-top: '.$opt_theme_options['header_height']['height'].';}
                .indent-header.affix-indent {padding-top: '.$opt_theme_options['header_height_fixed']['height'].';}
            }
          </style>';

    /*.header-sticky {height: '.$opt_theme_options['header_height']['height'].';}
    .header-sticky.affix {height: '.$opt_theme_options['header_height_fixed']['height'].';}*/
}
add_action('wp_head', 'wp_elementy_build_pdt');

/**
 * Pre header cart search
 */
function wp_elementy_header_cart_search() {
    global $opt_theme_options;

    $search_id = 'cd-search'.rand(0, 999);
    ?>

    <div class="widget_cart_search_wrap">
        <div class="header-search-cart clearfix">
        
            <?php //if ( class_exists('WC_Widget_Cart') && (!empty($opt_theme_options['mini-cart-icon']))): ?>
                <a href="javascript:void(0)" class="icon_cart_wrap" data-display=".shopping_cart_dropdown" data-no_display=".widget_searchform_content" ><i class="icon icon-ecommerce-bag-check"></i><span class="cart_total">0</span></a>
            <?php //endif; ?>
            <?php if (class_exists( 'YITH_WCWL' ) && (!empty($opt_theme_options['wishlist-icon']))) : ?>
                <?php
                    $wishlist_id = '#';
                    $wishlist_id = (get_option('yith_wcwl_wishlist_page_id')) ? get_option('yith_wcwl_wishlist_page_id') : '#';
                ?>
                <a href="<?php echo get_the_permalink($wishlist_id); ?>" class="icon-wishlist" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php esc_html_e('Wishlist page', 'wp-elementy') ?>">
                    <i class="icon_heart_alt"></i>
                </a>
            <?php endif;?>
            <?php if (!empty($opt_theme_options['search-icon'])) :?>
                <a href="#<?php echo esc_attr($search_id); ?>" class="icon_search_wrap cd-search-trigger" data-display=".widget_searchform_content" data-no_display=".shopping_cart_dropdown"><span></span></a>
            <?php endif; ?>
        </div>

        <?php if ( class_exists( 'WC_Widget_Cart' ) ): ?>
            <div class="shopping_cart_dropdown">
                <div class="shopping_cart_dropdown_inner">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        <?php endif; ?>

        <div id="<?php echo esc_attr($search_id); ?>" class="widget_searchform_content cd-search">
            <form method="get" action="<?php echo esc_url( home_url( '/'  ) );?>">
                <input type="text" class="search-head" value="<?php echo get_search_query();?>" name="s" placeholder="<?php esc_html_e('Search...', 'wp-elementy'); ?>" />
                <?php if ( class_exists('wp-elementy') && is_woocommerce() ) :?> 
                    <input type="hidden" name="post_type" value="product" />
                <?php endif;?>
            </form>
        </div>
    </div>
    <?php
}
add_action('wp_elementy_header_cart_search', 'wp_elementy_header_cart_search');

/**
 * Remove dotted of excerpt more
 */
function wp_elementy_new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'wp_elementy_new_excerpt_more');

function wp_elementy_getall_theme_option() {
    global $opt_theme_options;

    return $opt_theme_options;
}

/**
 * Add social id for author
 */
function wp_elementy_modify_user_contact_methods( $user_contact ) {
    // Add user contact methods
    $user_contact['sub_name']   = esc_html__('Sub Name', 'wp-elementy' );
    $user_contact['facebook']   = esc_html__('Facebook Link', 'wp-elementy' );
    $user_contact['twitter']   = esc_html__('Twiiter Link', 'wp-elementy' );
    $user_contact['linkedin']   = esc_html__('Linkedin Link', 'wp-elementy' );

    // Remove user contact methods
    //unset( $user_contact['aim']    );

    return $user_contact;
}
add_filter( 'user_contactmethods', 'wp_elementy_modify_user_contact_methods' );

/**
 * Added prefix class to body
 */
add_filter( 'body_class', 'wp_elementy_prefix_bodyclass' );
function wp_elementy_prefix_bodyclass( $classes ) {
    global $opt_meta_options, $opt_theme_options;

    if (is_single()) {
        $post_layout = (!empty($opt_meta_options['post_layout'])) ? 'single-layout-'.$opt_meta_options['post_layout'] : 'single-layout-1';
        $classes[] = $post_layout;
    }

    if ( basename( get_page_template() ) == '404-demo.php' ) {
        $classes[] = 'error404';    
    }

    if ( basename( get_page_template() ) == 'maintenance.php' ) {
        $classes[] = 'e-manitenance-page';    
    }

    $header_layout = '';
    if(!isset($opt_theme_options)) {
        $header_layout = 'default';
    }
    $header_layout = (!isset($opt_theme_options)) ? 'default' : $opt_theme_options['header_layout'];
    $header_layout = (is_page() && !empty($opt_meta_options['header_layout'])) ? $opt_meta_options['header_layout'] : $header_layout;

    if ( $header_layout == 'side' ) {
        $classes[] = 'page-has-sidemenu';
    }
    if ( $header_layout == 'fullscreen' ) {
        $classes[] = 'page-has-fullscreenmenu';
    }
    if ( $header_layout == 'leftmenu' ) {
        $classes[] = 'page-has-leftmenu';
    }

    $enable_topbar = '';
    if (!empty($opt_theme_options['topbar-header'])) {
        $enable_topbar = 'block';
    }
    if ( !empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'show' ) {
        $enable_topbar = 'block';
    }
    if ((!empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'inherit') && !empty($opt_theme_options['topbar-header'])) {
        $enable_topbar = 'block';
    }
    if ((!empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'inherit') && empty($opt_theme_options['topbar-header'])) {
        $enable_topbar = 'none';
    }
    if (!empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'none' ) {
        $enable_topbar = 'none';
    }
    $classes[] = ( $enable_topbar == 'block' ) ? 'has-topsidebar' : '';

    /* Header icon */
    if ( !empty($opt_theme_options['wishlist-icon']) ) {
        $classes[] = 'show-wishlist-icon';
    }

    if ( !empty($opt_theme_options['mini-cart-icon']) ) {
        $classes[] = 'show-mini-cart-icon';
    }

    /* One page */
    if ( !empty($opt_meta_options['one_page_rem_border']) ) {
        $classes[] = 'onepage-rem-border';
    }

    /* Header boxed */
    $header_boxed = '';
    if (!empty($opt_theme_options['set_header_boxed'])) $header_boxed = 'opt-header-boxed';
    $classes[] = $header_boxed;

    // return the $classes array
    return $classes;
}

/**
 * Move comment field to bottom of Comment form
 */
function wp_elementy_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;

    return $fields;
}
add_filter( 'comment_form_fields', 'wp_elementy_move_comment_field_to_bottom' );

/**
 * Newsletter widget in bottom
 */
function wp_elementy_newsletter_in_bottom() {
    global $opt_theme_options;

    $footer_newsller_area_en = ( !empty($opt_theme_options['footer_newsller_area_en']) ) ? $opt_theme_options['footer_newsller_area_en'] : '';
    if ( !empty($footer_newsller_area_en) && class_exists('Woocommerce') && (is_shop() || is_product() || is_cart()) ) {
        ?>
            <div class="subs-bottom-wrap clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2 class="mt-0 mb-15"><?php esc_html_e('Newsletter', 'wp-elementy'); ?></h2>
                        </div>
                        <div class="col-sm-4">
                            <?php
                                $custom_layout = '{subscription_form}';

                                if (strpos($custom_layout, "{subscription_form}") !== false) {
                                    $custom_layout = str_replace("{subscription_form}", NewsletterSubscription::instance()->get_form(1), $custom_layout);
                                }
                                echo balancetags( $custom_layout );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
}
add_action('wp_elementy_newsletter_in_bottom', 'wp_elementy_newsletter_in_bottom');

/**
 * Cms get Category for VC query
 * @return array
 */
function wp_elementy_get_category() {
    $cms_categories = array();  

    $cms_categories_obj = get_categories($agrs = array('hide_empty' => 0, 'orderby' => 'ID', 'order' => 'ASC'));
    foreach ($cms_categories_obj as $of_cat) {
        $cms_categories[$of_cat->cat_name] = $of_cat->cat_ID;
    }
    
    return $cms_categories;
}

/**
 * Get portfolio featured
 */
function wp_elementy_port_featured() {
    global $opt_theme_options;

    if ( !empty($opt_theme_options['port_featured_img']) ) :
    ?>
        <div class="entry-feature entry-feature-image mb-55">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php
    endif;
}

/**
 * Get portfolio info
 */
function wp_elementy_get_portfolio_detail() {
    global $opt_meta_options;

    $sid_class = $prim_class = '';
    if ( !empty($opt_meta_options['page_portfolio_client']) || 
         !empty($opt_meta_options['page_portfolio_url']) || 
         !empty($opt_meta_options['page_portfolio_skill']) || 
         !empty($opt_meta_options['page_portfolio_date']) ) {
        $sid_class = 'col-sm-3';
        $prim_class = 'col-sm-9';
    } else {
        $sid_class = 'hidden';
        $prim_class = 'col-sm-12';
    }
    ?>
    <div class="portf-sidebar-wrap <?php echo esc_attr($sid_class); ?>">
        <ul class="portf-info">
            <?php if ( !empty($opt_meta_options['page_portfolio_client']) ) : ?>
                <li class="clients">
                    <label for="client"><?php esc_html_e('Client: ', 'wp-elementy'); ?></label>
                    <?php echo esc_html($opt_meta_options['page_portfolio_client']); ?>
                </li>
            <?php endif; ?>

            <?php if ( !empty($opt_meta_options['page_portfolio_date']) ) : ?>
                <li class="date">
                    <label for="client"><?php esc_html_e('Date: ', 'wp-elementy'); ?></label>
                    <?php echo date('j F, Y', strtotime($opt_meta_options['page_portfolio_date'])); ?>
                </li>
            <?php endif; ?>

            <?php if ( !empty($opt_meta_options['page_portfolio_skill']) ) : ?>
                <li class="skills">
                    <label for="client"><?php esc_html_e('Skills: ', 'wp-elementy'); ?></label>
                    <?php echo esc_html($opt_meta_options['page_portfolio_skill']); ?>
                </li>
            <?php endif; ?>
            
            <?php if ( !empty($opt_meta_options['page_portfolio_url']) ) : ?>
                <li class="demo">
                    <label for="client"><?php esc_html_e('Demo: ', 'wp-elementy'); ?></label>
                    <a href="<?php echo esc_url($opt_meta_options['page_portfolio_url']); ?>"><?php echo esc_html($opt_meta_options['page_portfolio_url']); ?></a>
                    
                </li>
            <?php endif; ?>
        </ul>

        <ul class="social-share mb-15 clearfix">
            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
            <li><a target="_blank" href="https://twitter.com/home?status=<?php esc_html_e('Check out this article', 'wp-elementy');?>:%20<?php echo strip_tags(get_the_title());?>%20-%20<?php the_permalink();?>"><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
            <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>"><i aria-hidden="true" class="fa fa-google-plus"></i></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php echo strip_tags(get_the_title());?>"><i aria-hidden="true" class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>

    <div class="<?php echo esc_attr($prim_class); ?> mb-80">
        <?php the_content(); ?>
    </div>
    <?php
}

function wp_elementy_get_portfolio_related() {
    global $opt_theme_options;

    $portfolio_category = '';
    $terms = get_the_terms(get_the_ID(), 'category-portfolio');

    if( (!empty($opt_theme_options['port_featured_related'])) && !empty($terms)) {
        $portfolio_category = array();
        foreach ($terms as $term){
            $portfolio_category[] = $term->term_id;
        }  
        $portfolio_category = '|tax_query:'.implode(',', $portfolio_category);
        ?>
        <div class="portfolio-related-wrap clearfix">
            <hr class="mt-0 mb-0">
            <h4 class="related-post-heading mt-50"><?php esc_html_e('Related Portfolio', 'wp-elementy'); ?></h4>
            <?php echo apply_filters('the_content','[cms_grid layout="" not__in="true" col_xs="2" col_sm="2" col_md="3" col_lg="3" cms_portfolio_gutter="30px" source="size:3|order_by:date|post_type:portfolio|'.$portfolio_category.'" cms_template="cms_grid--portfolio.php" related_layout="1"]'); ?>
        </div>
    <?php }
}

/**
 * Fixed css of theme option when install Wishlist plugin
 * @param  [type] $src [description]
 * @return [type]      [description]
 */
function wp_elementy_stylesheet($src) {
    global $post_type;

    $excluse_page = array(
        'yith_wcwl_panel',
        'yith_upgrade_premium_version',
        'wc-reports',
        'wc-settings',
        'wc-status',
        'wc-addons',
    );

    $excluse_post_type = array(
        'shop_order',
        'shop_coupon'
    );

    if($post_type == 'product') {
        return $src;
    }

    $get_page = ( isset($_GET['page']) ) ? $_GET['page'] : '';
    if ( strstr($src,'woocommerce_admin_styles-css' )) {
        if (!empty($get_page) && (in_array($get_page, $excluse_page) || in_array($get_page, $excluse_post_type)) ) {
            return $src;
        } else {
            return '';
        }
    } else {
        return $src;
    }
}
add_filter('style_loader_tag', 'wp_elementy_stylesheet');

/**
 * Show social list from theme option
 */
function wp_elementy_social_from_themeoption($layout = '', $align = '') {
    global $opt_theme_options;
    $lists = '';
    if (!empty($layout ) && $layout == 'header') {
        $lists = ( !empty($opt_theme_options['individual_social_on_header']['enabled']) ) ? $opt_theme_options['individual_social_on_header']['enabled'] : '';
    } elseif (!empty($layout ) && $layout == 'footer') {
        $lists = ( !empty($opt_theme_options['individual_social_on_footer']['enabled']) ) ? $opt_theme_options['individual_social_on_footer']['enabled'] : '';
    } elseif (!empty($layout ) && $layout == 'comming-soon') {
        $lists = ( !empty($opt_theme_options['individual_social_on_comming']['enabled']) ) ? $opt_theme_options['individual_social_on_comming']['enabled'] : '';
    }
    
    if ( $lists ) {
        echo '<div class="social-indiv-wrap layout-'.$layout.' '.$align.'"><ul class="social-indiv-inner">';
        foreach ($lists as $key => $value) {
            switch ($key) {
                case 'facebook':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'"><i class="fa fa-facebook"></i></a></li>';
                    break;
                case 'twitter':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
                    break;
                case 'rss':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-rss"></i></a></li>';
                    break;
                case 'instagram':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
                    break;
                case 'google':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
                    break;
                case 'skype':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-skype"></i></a></li>';
                    break;
                case 'pinterest':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
                    break;
                case 'vimeo':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-vimeo"></i></a></li>';
                    break;
                case 'youtube':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-youtube"></i></a></li>';
                    break;
                case 'yelp':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-yelp"></i></a></li>';
                    break;
                case 'tublr':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-tublr"></i></a></li>';
                    break;
                case 'linkedin':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                    break;
                case 'behance':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-behance"></i></a></li>';
                    break;
                case 'dribbble':
                    echo '<li class="'.esc_attr($key).'"><a href="'.esc_url($opt_theme_options[$key]).'" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
                    break;
            }
        }
        echo '</ul></div>';
    }  
}

function wp_elementy_topbar_area() {
    global $opt_theme_options, $opt_meta_options;

    $enable_topbar = '';
    if (!empty($opt_theme_options['topbar-header'])) {
        $enable_topbar = 'block';
    }
    if ( !empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'show' ) {
        $enable_topbar = 'block';
    }
    if ((!empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'inherit') && !empty($opt_theme_options['topbar-header'])) {
        $enable_topbar = 'block';
    }
    if ((!empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'inherit') && empty($opt_theme_options['topbar-header'])) {
        $enable_topbar = 'none';
    }
    if (!empty($opt_meta_options['topbar-header']) && $opt_meta_options['topbar-header'] == 'none' ) {
        $enable_topbar = 'none';
    }

    $bg_topbar = '';
    if ( !empty($opt_theme_options['topbar-header-bg']) ) {
        $bg_topbar = $opt_theme_options['topbar-header-bg'];
    }

    if ( !empty($opt_meta_options['topbar-header-bg']) ) {
        $bg_topbar = $opt_meta_options['topbar-header-bg'];
    }
    ?>
    <?php if ((is_active_sidebar( 'topbar-left-sidebar' ) || is_active_sidebar( 'topbar-right-sidebar' )) && $enable_topbar == 'block') : ?>
        <div class="topbar-wrap clearfix <?php echo esc_attr($bg_topbar); ?>">
            <?php if (is_active_sidebar( 'topbar-left-sidebar' )) : ?>
                <div class="topbar topbar-left text-left pull-left">
                    <?php dynamic_sidebar( 'topbar-left-sidebar' ); ?>  
                </div>
            <?php endif; ?>
            <?php if (is_active_sidebar( 'topbar-right-sidebar' )) : ?>
                <div class="topbar topbar-right text-right pull-right">
                    <?php dynamic_sidebar( 'topbar-right-sidebar' ); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    endif;
}
add_action('wp_elementy_topbar_area', 'wp_elementy_topbar_area');

/**
 * Action After Show Menu
 * 
 * @author Duong Tung
 */
function wp_elementy_after_show_menu() {
    global $opt_theme_options, $opt_meta_options;
    $header_layout = '';

    if(!isset($opt_theme_options)) {
        $header_layout = 'default';
    }
    $header_layout = (!isset($opt_theme_options)) ? 'default' : $opt_theme_options['header_layout'];
    $header_layout = (is_page() && !empty($opt_meta_options['header_layout'])) ? $opt_meta_options['header_layout'] : $header_layout;

    if ( $header_layout == 'side' ) {
        echo '</div>';
        if (is_active_sidebar('side-menu-area')) {
            echo '<nav class="sidemenu-wrap">';
            dynamic_sidebar('side-menu-area');
            echo '</nav>';
        }
    }

    if ( $header_layout == 'fullscreen' ) {
        if (is_active_sidebar('fullscreen-area')) {
            echo '<nav class="fullscreen-menu-wrap"><div class="fullscreen-menu-inner">';
            dynamic_sidebar('fullscreen-area');
            echo '</div></nav>';
        }
    }

    if ( $header_layout == 'leftmenu') {
        echo '</div>';
    }
}
add_action('wp_elementy_after_show_menu', 'wp_elementy_after_show_menu');

function wp_elementy_backtotop() {
    global $opt_theme_options;

    if ( !empty($opt_theme_options['footer_bottom_back_to_top']) ) {
        echo '<a id="back-to-top" class="go-up"><i style="" class="icon icon-arrows-up"></i></a>';
    }

    if ( !empty($opt_theme_options['page-loading']) ) {
        echo '<div id="loader-overflow" style="display: none;">
      <div id="loader3">Please enable JS</div>
    </div>';
    }
}

/**
 * Action Before Show Menu
 * 
 * @author Duong Tung
 */
function wp_elementy_before_show_menu() {
    global $opt_theme_options, $opt_meta_options;
    $header_layout = '';

    if(!isset($opt_theme_options)) {
        $header_layout = 'default';
    }
    $header_layout = (!isset($opt_theme_options)) ? 'default' : $opt_theme_options['header_layout'];
    $header_layout = (is_page() && !empty($opt_meta_options['header_layout'])) ? $opt_meta_options['header_layout'] : $header_layout;

    if ( $header_layout == 'side' || $header_layout == 'leftmenu') {
        echo '<div class="elementy-content-side-wrap">';
    }
}
add_action('wp_elementy_before_show_menu', 'wp_elementy_before_show_menu');

function wp_elementy_mp4_render_video_url($video_path) {
    $info = array();

    if ( !empty($video_path) ) {
        $t = explode('/', $video_path);
        $video_name = $t[count($t) - 1];
        $info['name'] = substr($video_name, 0 , -4);
        $info['path'] = substr($video_path, 0, -strlen($video_name));
    }

    return $info;
}

function wp_elementy_webm_render_video_url($video_path) {
    $info = array();

    if ( !empty($video_path) ) {
        $t = explode('/', $video_path);
        $video_name = $t[count($t) - 1];
        $info['name'] = substr($video_name, 0 , -5);
        $info['path'] = substr($video_path, 0, -strlen($video_name));
    }

    return $info;
}

/**
 * Remove Newsletter required file
 */
remove_action('tgmpa_register', 'newsletter_register_required_plugins');

/**
 * replace css to pass validate w3c
 *
 */
function wp_elementy_validate_stylesheet($src) {
    if(strstr($src,'custom-dynamic-inline-css')) {
        return str_replace('rel', 'property="stylesheet" rel', $src);
    } else {
        return $src;
    }
}
add_filter('style_loader_tag', 'wp_elementy_validate_stylesheet');

function elementy_inline_style( $css_includes ) {
    if ( !empty($css_includes) ) {
        wp_enqueue_style('elementy-inline-style',get_template_directory_uri() . '/assets/css/elementy-inline-style.css');
        wp_add_inline_style('elementy-inline-style', $css_includes);
    }
}
