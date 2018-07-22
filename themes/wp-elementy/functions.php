<?php
/**
 * Theme Framework functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 1170;
	
/**
 * CMS Theme setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * CMS Theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */

function wp_elementy_setup() {

	// load language.
	load_theme_textdomain( 'wp-elementy' , get_template_directory() . '/languages' );

	// Adds title tag
	add_theme_support( "title-tag" );
	
	// Add woocommerce
	add_theme_support('woocommerce');
	
	// Adds custom header
	add_theme_support( 'custom-header' );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'quote') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'wp-elementy' ) );
	register_nav_menu( 'footer-menu-1', esc_html__( 'Footer menu 1', 'wp-elementy' ) );
	register_nav_menu( 'footer-menu-2', esc_html__( 'Footer menu 2', 'wp-elementy' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array('default-color' => 'e6e6e6',) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1170, 9999 ); // Unlimited height, soft crop
	add_image_size('elementy-thumbnail-masonry', 500);
	add_image_size('elementy-thumbnail-square', 500, 500, true);
	add_image_size('elementy-thumbnail-wide', 634, 405, true);
	add_image_size('elementy-related', 650, 415, true);

	/* Change default image thumbnail sizes in wordpress */
	update_option( 'medium_size_w', 584);
	update_option( 'medium_size_h', 407);
	update_option( 'medium_crop', 1);
	update_option( 'large_size_w', 770); 
	update_option( 'large_size_h', 434);
	update_option( 'large_crop', 1);

	/* WooCommerce Thumbnail */
	$catalog = array(
        'width'     => '350',
        'height'    => '447',
        'crop'      => 1
    );
    $single = array(
        'width'     => '470',
        'height'    => '600',
        'crop'      => 1 
    );
    $thumbnail = array(
        'width'     => '200',
        'height'    => '255',
        'crop'      => 1
    );
    /* Image sizes */
    update_option( 'shop_catalog_image_size', $catalog );
    update_option( 'shop_single_image_size', $single );
    update_option( 'shop_thumbnail_image_size', $thumbnail );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

add_action( 'after_setup_theme', 'wp_elementy_setup' );

/**
 * Add new elements for VC
 * 
 * @author FOX
 */
add_action('vc_before_init', 'wp_elementy_vc_before');

function wp_elementy_vc_before() {
    
    if(!class_exists('CmsShortCode'))
        return ;
    
    require( get_template_directory() . '/inc/elements/cms_separator.php' );
    require( get_template_directory() . '/inc/elements/cms_dropcaps.php' );
    require( get_template_directory() . '/inc/elements/cms_modals.php' );
    require( get_template_directory() . '/inc/elements/cms_lightboxmap.php' );
    require( get_template_directory() . '/inc/elements/cms_newsletter.php' );
    require( get_template_directory() . '/inc/elements/cms_latest_blog.php' );
    require( get_template_directory() . '/inc/elements/cms_bgimage.php' );
    require( get_template_directory() . '/inc/elements/cms_progress.php' );
    require( get_template_directory() . '/inc/elements/cms_countdown.php' );
    require( get_template_directory() . '/inc/elements/cms_individual_socials.php' );
    require( get_template_directory() . '/inc/elements/cms_landing_item.php' );
    require( get_template_directory() . '/inc/elements/cms_pricing.php' );
}
/* Add Quote Editer */
require( get_template_directory() . '/inc/tinymce/button.php' );

/* core functions. */
require_once( get_template_directory() . '/inc/functions.php' );

/**
 * Custom params & remove VC Elements.
 * 
 * @author FOX
 */
add_action('vc_after_init', 'wp_elementy_vc_after');

function wp_elementy_vc_after() {
    require( get_template_directory() . '/vc_params/vc_custom_heading.php' );
    require( get_template_directory() . '/vc_params/vc_btn.php' );
    require( get_template_directory() . '/vc_params/vc_row.php' );
    require( get_template_directory() . '/vc_params/vc_column.php' );
    require( get_template_directory() . '/vc_params/vc_tta_accordion.php' );
    require( get_template_directory() . '/vc_params/vc_tta_tabs.php' );
    require( get_template_directory() . '/vc_params/vc_tour.php' );
    require( get_template_directory() . '/vc_params/vc_toggle.php' );
    require( get_template_directory() . '/vc_params/vc_message.php' );
    require( get_template_directory() . '/vc_params/vc_images_carousel.php' );
    require( get_template_directory() . '/vc_params/vc_single_image.php' );
    require( get_template_directory() . '/vc_params/vc_gallery.php' );
    require( get_template_directory() . '/vc_params/vc_video.php' );
    require( get_template_directory() . '/vc_params/vc_pie.php' );
    require( get_template_directory() . '/vc_params/vc_wp_custommenu.php' );
    require( get_template_directory() . '/vc_params/cms_carousel.php' );
    require( get_template_directory() . '/vc_params/cms_grid.php' );
    require( get_template_directory() . '/vc_params/cms_counter_single.php' );
    require( get_template_directory() . '/vc_params/cms_fancybox_single.php' );

    /*  Riquire font icon */
	require( get_template_directory() . '/inc/libs/font-icons/lineaicon.php' );
	require( get_template_directory() . '/inc/libs/font-icons/elegant.php' );
}

/* Add widgets */
require( get_template_directory() . '/inc/widgets/cms-recentposts.php' );
require( get_template_directory() . '/inc/widgets/cms-social.php' );

/**
 * Add theme elements
 */
function wp_elementy_vc_elements() {
	if(class_exists('CmsShortCode')){

		/* Include CMS shortcode */
		add_filter('cms-shorcode-list', 'wp_elementy_shortcodes_list');
    }
}
add_action('vc_before_init', 'wp_elementy_vc_elements');

function wp_elementy_shortcodes_list() {
	$elementy_shortcodes_list = array(
		'cms_carousel',
		'cms_grid',
		'cms_fancybox_single',
		'cms_counter_single',
		'cms_progressbar'
	);
	return $elementy_shortcodes_list;
}

/* Remove CMS Fancy box */
if (class_exists('CmssuperheroesCore')) {
	add_action('vc_after_init', 'wp_elementy_remove_some_element');
	function wp_elementy_remove_some_element(){
	 	vc_remove_element('cms_fancybox');
	 	vc_remove_element('cms_counter');
	}
}

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since CMS SuperHeroes 1.0
 */
function wp_elementy_front_end_scripts() {
    
	global $wp_styles, $opt_theme_options, $opt_meta_options;

	$script_options = array(
	    'headder_height_normal' => intval($opt_theme_options['header_height']['height']),
	    'header_height_fixed' => intval($opt_theme_options['header_height_fixed']['height']),
	);

	/* Add 3rd plugins */
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_script('plugins.min.js', get_template_directory_uri() . '/assets/js/plugins.min.js', array('jquery'), '1.0.0');
	wp_enqueue_script('wp-elementy-simplelikes', get_template_directory_uri() . '/assets/js/simple.likes.js', array(), '1.0.0', true);

    /* Add One Page plugin. */
	if(is_page() && isset($opt_meta_options['page_one_page']) && $opt_meta_options['page_one_page']) {
	    wp_enqueue_script('jquery.singlePageNav', get_template_directory_uri() . '/assets/js/jquery.singlePageNav.js', array( 'jquery' ), '1.0.0', true);

	    if(!empty($opt_meta_options['one_page_easing'])) {
	        wp_enqueue_script('jquery-effects-core');
	        $script_options['one_page_easing'] = !empty($opt_meta_options['one_page_easing']) ? $opt_meta_options['one_page_easing'] : 'swing';
	    }

	    $script_options['one_page'] = true;
	    $script_options['one_page_speed'] = !empty($opt_meta_options['one_page_speed']) ? $opt_meta_options['one_page_speed'] : 1000;
	}

    if ( !wp_script_is('', 'owl-carousel')) {
		wp_enqueue_script('wp-elementy-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2.0.0', true);
	}

	/* Add main.js */
	wp_register_script('wp-elementy-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
	wp_localize_script('wp-elementy-main', 'CMSOptions', $script_options);
	wp_enqueue_script('wp-elementy-main');
	
	/* Add menu.js */
	wp_enqueue_script('wp-elementy-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), '1.0.0', true);

	/* Comment */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/** ----------------------------------------------------------------------------------- */
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.2');
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');
	
	wp_enqueue_style( 'elementy-font-icon', get_template_directory_uri() . '/assets/css/fonts-icon.css', '', '20121010' );
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', '', '2.0.0');
	wp_enqueue_style('wp-elementy-animate', get_template_directory_uri() . '/assets/css/animate.min.css', '', '1.0.0');
	wp_enqueue_style('text-rotator', get_template_directory_uri() . '/assets/css/text-rotator.css', '', '1.0.0');
	/* Loads our main stylesheet. */
	wp_enqueue_style( 'wp-elementy-style', get_stylesheet_uri(), array( 'bootstrap' ));

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'wp-elementy-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'wp-elementy-style' ), '20121010' );
	
	/* ie */
	$wp_styles->add_data( 'wp-elementy-ie', 'conditional', 'lt IE 9' );
	
	/* Load static css*/
	wp_enqueue_style('wp-elementy-static', get_template_directory_uri() . '/assets/css/static.css', array( 'wp-elementy-style' ), '1.0.0');
    wp_enqueue_style( 'wp-elementy-child', get_stylesheet_uri() );

	/* Load option default */
	wp_enqueue_style('wp-elementy-option-default', get_template_directory_uri() . '/assets/css/option-default.css', array(), '1.0.0');
}

add_action( 'wp_enqueue_scripts', 'wp_elementy_front_end_scripts' );

/**
 * load admin scripts.
 * 
 * @author FOX
 */
function wp_elementy_admin_scripts(){
	global $pagenow;

	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');
	wp_enqueue_style('wp-elementy-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0.0');

	$screen = get_current_screen();

	/* load js for edit post. */
	if($screen->post_type == 'post'){
		/* post format select. */
		wp_enqueue_script('post-format', get_template_directory_uri() . '/assets/js/post-format.js', array(), '1.0.0', true);
	}

	if($pagenow == 'post.php' || $pagenow == 'post-new.php' || $screen->base == 'toplevel_page_revslider'){
		wp_enqueue_style('amilia-enque-admin-elegantIcons', get_template_directory_uri() . '/assets/css/fonts-icon.css', array(), '1.0.1');
	}

	wp_register_style('jquery-datetimepicker', get_template_directory_uri().'/assets/css/jquery.datetimepicker.css');
    wp_enqueue_style('jquery-datetimepicker');
    wp_enqueue_script('wp-elementy-time', get_template_directory_uri() . '/assets/js/datetime-element.js');
}

add_action( 'admin_enqueue_scripts', 'wp_elementy_admin_scripts' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function wp_elementy_widgets_init() {

	global $opt_theme_options;

	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'wp-elementy' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wp-elementy' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Top Left Sidebar', 'wp-elementy' ),
		'id' => 'topbar-left-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Top Right Sidebar', 'wp-elementy' ),
		'id' => 'topbar-right-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Side Menu Area', 'wp-elementy' ),
    	'id' => 'side-menu-area',
    	'description' => esc_html__( 'Only appear for custom header is side-menu', 'wp-elementy' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Fullscreen Menu Area', 'wp-elementy' ),
    	'id' => 'fullscreen-area',
    	'description' => esc_html__( 'Only appear for custom header is fullscreen-menu', 'wp-elementy' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Left Menu Area', 'wp-elementy' ),
    	'id' => 'left-menu-area',
    	'description' => esc_html__( 'Only appear for custom header is left menu', 'wp-elementy' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	/* footer-top 1 */
	if(!empty($opt_theme_options['footer-top-column-1'])) {
		for($i = 1 ; $i <= $opt_theme_options['footer-top-column-1'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Top 1: Col %s', 'wp-elementy'), $i),
				'id' => 'sidebar-footer-top-1-' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wp-elementy'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}

	if(!empty($opt_theme_options['footer-top-column-2'])) {
		for($i = 1 ; $i <= $opt_theme_options['footer-top-column-2'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Top 2: Col %s', 'wp-elementy'), $i),
				'id' => 'sidebar-footer-top-2-' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wp-elementy'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}

	register_sidebar( array(
    	'name' => esc_html__( 'Footer Bottom Right', 'wp-elementy' ),
    	'id' => 'sidebar-10',
    	'description' => esc_html__( 'Appears when using the optional Footer Bottom with a page set as Footer Bottom right', 'wp-elementy' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'WooCommerce Widget Area', 'wp-elementy' ),
    	'id' => 'woocommerce_sidebar',
    	'description' => esc_html__( 'Appers for WooCommerce Archive Page', 'wp-elementy' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Newsletter Area', 'wp-elementy' ),
    	'id' => 'bottom-area',
    	'description' => esc_html__( 'Only suitable for Newsletter widget, appears when using the optional Bottom with a page set as Bottom Area', 'wp-elementy' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Menu Widget Area', 'wp-elementy' ),
    	'id' => 'menu-widget-area',
    	'description' => esc_html__( 'Only suitable for Contact Menu Item', 'wp-elementy' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Shortcodes Sidebar', 'wp-elementy' ),
		'id' => 'shortcodes-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Typography Sidebar', 'wp-elementy' ),
		'id' => 'typography-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'wp_elementy_widgets_init' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function wp_elementy_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}

add_filter( 'wp_page_menu_args', 'wp_elementy_page_menu_args' );

/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 */
function wp_elementy_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wp-elementy' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'wp-elementy' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'wp-elementy' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 */
function wp_elementy_paging_nav() {
    // Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
			<div class="loop-pagination">
				<?php echo wp_kses_post($links); ?>
			</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

/**
* Display navigation to next/previous post when applicable.
*
* @since 1.0.0
*/
function wp_elementy_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			  	<a class="post-prev text-left" href="<?php echo get_permalink( $prev_post->ID ); ?>">
			  		<span>
			  			<span class="icon icon-arrows-left"></span>
			  			<?php esc_html_e('Prev', 'wp-elementy'); ?>
			  		</span>
			  	</a>
			<?php endif; ?>

			<a class="work-all to-archive text-center" href="<?php echo get_post_type_archive_link('post');?>">
				<?php esc_html_e('All post', 'wp-elementy'); ?>
			</a>

			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { ?>
			  	<a class="post-next text-right" href="<?php echo get_permalink( $next_post->ID ); ?>">
			  		<span>
			  			<?php esc_html_e('Next', 'wp-elementy'); ?>
			  			<span class="icon icon-arrows-right"></span>
			  		</span>
			  	</a>
			<?php } ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
* Display navigation to next/previous post when applicable.
*
* @since 1.0.0
*/
function wp_elementy_portfolio_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			  	<a class="post-prev text-left" href="<?php echo get_permalink( $prev_post->ID ); ?>">
			  		<span>
			  			<span class="icon icon-arrows-left"></span>
			  			<?php esc_html_e('Prev', 'wp-elementy'); ?>
			  		</span>
			  	</a>
			<?php endif; ?>

			<a class="work-all to-archive text-center" href="<?php echo get_post_type_archive_link('portfolio');?>">
				<?php esc_html_e('All', 'wp-elementy'); ?>
			</a>

			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { ?>
			  	<a class="post-next text-right" href="<?php echo get_permalink( $next_post->ID ); ?>">
			  		<span>
			  			<?php esc_html_e('Next', 'wp-elementy'); ?>
			  			<span class="icon icon-arrows-right"></span>
			  		</span>
			  	</a>
			<?php } ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/* Add Custom Comment */
function wp_elementy_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
    ?>
    <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
    <?php endif; ?>
    <div class="comment-author-image vcard pull-left">
    	<?php echo get_avatar( $comment, 100 ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
    	<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'wp-elementy'); ?></em>
    <?php endif; ?>
    <div class="comment-main">
		<div class="comment-meta commentmetadata">
    		<span class="comment-author"><?php echo get_comment_author_link(); ?></span>
    		<span class="comment-date">
    			<?php echo get_the_date('M j, Y, \a\t G:i'); ?>
    		</span>
    		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    	</div>
    	<div class="comment-content">
    		<?php comment_text(); ?>
    	</div>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

/**
 * get header layout.
 */
function wp_elementy_header(){
    global $opt_theme_options, $opt_meta_options;

    if(!isset($opt_theme_options)){
        get_template_part('inc/header/header', 'default');
        return;
    }

    if(is_page() && !empty($opt_meta_options['header_layout']))
        $opt_theme_options['header_layout'] = $opt_meta_options['header_layout'];

    /* load custom header template. */
    get_template_part('inc/header/header', $opt_theme_options['header_layout']);
}

/**
 * footer layout
 */
function wp_elementy_footer() {
    global $opt_theme_options, $opt_meta_options;
    
    if ( empty($opt_theme_options['footer_layout']) ) {
    	return false;
    } else {
    	$footer_layout = $opt_theme_options['footer_layout'];
    	$footer_layout = (!empty($opt_meta_options['page_footer_options']) && !empty($opt_meta_options['footer_layout'])) ? $opt_meta_options['footer_layout'] : $footer_layout;


    	switch ($footer_layout) {
    		case '1':
    			$_class = "";
			    switch ($opt_theme_options['footer-top-column-1']) {
			        case '2':
			            $_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
			            break;
			        case '3':
			            $_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
			            break;
			        case '4':
			            $_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
			            break;
			    }
			    if ( !empty($opt_meta_options['page_footer_options'])) {
			    echo '<div class="cshero-footer-top-1"><div id="footer-top" class="cshero-footer-top">
			            <div class="container">
			                <div class="row">';
			    for($i = 1 ; $i <= $opt_theme_options['footer-top-column-1'] ; $i++) {
			        if ( is_active_sidebar( 'sidebar-footer-top-1-' . $i ) ){
			            echo '<div class="'.esc_html($_class).' footer-top-1-'.$i.'">';
			                dynamic_sidebar( 'sidebar-footer-top-1-' . $i );
			            echo "</div>";
			        }
			    }
		        ?>			</div>
		            	</div>
		        	</div>
		        <?php } ?>
				        <div id="footer-bottom" class="cshero-footer-bottom <?php echo (!empty($footer_layout)) ? 'footer-bottom-'.esc_attr($footer_layout) : ''; ?>">
				            <div class="container">
				                <div class="footer-bottom-wrap clearfix">
				                    <?php
				                    	if(empty($opt_theme_options['footer-bottom-copyright'])) {
									        echo balanceTags('<p>&copy; Elementy 2016 </p>');
									    } else {
									    	?>
								    			<div class="copyright-wrap pull-left">
								    				<?php echo wp_kses($opt_theme_options['footer-bottom-copyright'], array('a' => array('href' => array(), 'title' => array() ), 'p' => array(), 'br' => array(), 'em' => array(), 'strong' => array())); ?>
								    			</div>
								    			<?php if (is_active_sidebar('sidebar-10')) : ?>
									    			<div class="footer-bottom-widget pull-right">
									    				<?php dynamic_sidebar('sidebar-10'); ?>
									    			</div>
								    			<?php endif; ?>
									    	<?php
									    }
				                    ?>
				                </div>
				            </div>
				        </div>
				    </div>
		        <?php
    			break;

    		case '2':
    			$_class = "";
			    switch ($opt_theme_options['footer-top-column-2']) {
			        case '2':
			            $_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
			            break;
			        case '3':
			            $_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
			            break;
			        case '4':
			            $_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
			            break;
			    }
			    echo '<div class="cshero-footer-top-2"><div id="footer-top" class="cshero-footer-top">
			            <div class="container">
			                <div class="row">';
			    for($i = 1 ; $i <= $opt_theme_options['footer-top-column-2'] ; $i++) {
			        if ( is_active_sidebar( 'sidebar-footer-top-2-' . $i ) ){
			            echo '<div class="'.esc_html($_class).' footer-top-2-'.$i.'">';
			                dynamic_sidebar( 'sidebar-footer-top-2-' . $i );
			            echo "</div>";
			        }
			    }
			    ?>			</div>
		            	</div>
		        	</div>
				        <div id="footer-bottom" class="cshero-footer-bottom <?php echo (!empty($footer_layout)) ? 'footer-bottom-'.esc_attr($footer_layout) : ''; ?>">
				            <div class="container">
				                <div class="footer-bottom-wrap clearfix">
				                    <?php
				                    	if(empty($opt_theme_options['footer-bottom-copyright'])) {
									        echo balanceTags('<p>&copy; Elementy 2016 </p>');
									    } else {
									    	?>
								    			<div class="copyright-wrap pull-left">
								    				<?php echo wp_kses($opt_theme_options['footer-bottom-copyright'], array('a' => array('href' => array(), 'title' => array() ), 'p' => array(), 'br' => array(), 'em' => array(), 'strong' => array())); ?>
								    			</div>
								    			<?php if (is_active_sidebar('sidebar-10')) : ?>
									    			<div class="footer-bottom-widget pull-right">
									    				<?php dynamic_sidebar('sidebar-10'); ?>
									    			</div>
								    			<?php endif; ?>
									    	<?php
									    }
				                    ?>
				                </div>
				            </div>
				        </div>
				    </div>
				    <?php
    			break;
    		case '4' :
    			?>
    				<div id="footer-bottom" class="cshero-footer-bottom <?php echo (!empty($footer_layout)) ? 'footer-bottom-'.esc_attr($footer_layout) : ''; ?>">
			            <div class="container">
			                <div class="footer-bottom-wrap clearfix">
			                    <?php
			                    	if(empty($opt_theme_options['footer-bottom-copyright'])) {
								        echo balanceTags('<p>&copy; Elementy 2016 </p>');
								    } else {
								    	?>
							    			<div class="copyright-wrap pull-left">
							    				<?php echo wp_kses($opt_theme_options['footer-bottom-copyright'], array('a' => array('href' => array(), 'title' => array() ), 'p' => array(), 'br' => array(), 'em' => array(), 'strong' => array())); ?>
							    			</div>
							    			<div class="footer-bottom-widget pull-right">
							    				<?php wp_elementy_social_from_themeoption('footer'); ?>
							    			</div>
								    	<?php
								    }
			                    ?>
			                </div>
			            </div>
			        </div>
    			<?php
    		break;
    		
    		case '5' :
    			return '';
    		break;

    		default:
    			?>
    				<div id="footer-top" class="cshero-footer-top cshero-footer-top-3 text-center">
    					<div class="container">
    						<?php wp_elementy_social_from_themeoption('footer', 'text-center icon-large'); ?>
    					</div>
    				</div>
    			<?php
    			break;
    	}
    }
}

/* RevSlider */
function wp_elementy_get_list_rev_slider() {
    if (class_exists('RevSlider')) {

        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();

        $revsliders = array(''=>'');
        if ($arrSliders) {
            foreach ($arrSliders as $slider) {
                /* @var $slider RevSlider */
                $revsliders[$slider->getAlias()] = $slider->getTitle();
            }
        } else {
            $revsliders[esc_html__('No sliders found', 'wp-elementy')] = 0;
        }
    return $revsliders;
    }
}

function wp_elementy_footer_bottom() {
    global $opt_theme_options, $opt_meta_options;
    $footer_layout = '';
    $footer_layout = $opt_theme_options['footer_layout'];
    $footer_layout = (!empty($opt_meta_options['page_footer_options']) && !empty($opt_meta_options['footer_layout'])) ? $opt_meta_options['footer_layout'] : $footer_layout;
    ?>
    	
    <?php
}

/* convert dates to readable format */
function wp_elementy_relative_time($a) {
    //get current timestampt
    $b = strtotime("now");
    //get timestamp when tweet created
    $c = strtotime($a);
    //get difference
    $d = $b - $c;
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;

    if (is_numeric($d) && $d > 0) {
        //if less then 3 seconds
        if ($d < 3)
            return esc_html__('right now','wp-elementy');
        //if less then minute
        if ($d < $minute)
            return floor($d) . esc_html__(' seconds ago','wp-elementy');
        //if less then 2 minutes
        if ($d < $minute * 2)
            return esc_html__('about 1 minute ago','wp-elementy');
        //if less then hour
        if ($d < $hour)
            return floor($d / $minute) . esc_html__(' minutes ago','wp-elementy');
        //if less then 2 hours
        if ($d < $hour * 2)
            return esc_html__('about 1 hour ago','wp-elementy');
        //if less then day
        if ($d < $day)
            return floor($d / $hour) . esc_html__(' hours ago','wp-elementy');
        //if more then day, but less then 2 days
        if ($d > $day && $d < $day * 2)
            return esc_html__('yesterday','wp-elementy');
        //if less then year
        if ($d < $day * 365)
            return esc_html__('about ','wp-elementy'). floor($d / $day) . esc_html__(' days ago','wp-elementy');
        //else return more than a year
        return esc_html__('over a year ago','wp-elementy');
    }
}

