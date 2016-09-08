<?php
/**
 * @package Planar
 */

/**
 * Set the content width for theme design
 */
if ( ! isset( $content_width ) ) {
	$content_width = 790; /* pixels */
}

if ( ! function_exists( 'planar_content_width' ) ) :
	function planar_content_width() {
		global $content_width;

		if ( is_front_page() || is_page_template( 'page-templates/page-fullwidth.php' ) || is_page_template( 'page-templates/homepage-one.php' ) || is_page_template( 'page-templates/page-childgrid.php' ) ) {
			$content_width = 1400;
		}
	}
endif;
add_action( 'template_redirect', 'planar_content_width' );

if ( ! function_exists( 'planar_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function planar_setup() {

	/**
	 * Make theme available for translation
	 */
	load_theme_textdomain( 'planar-lite', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style
	 */
	add_editor_style( array( 'editor-style.css', planar_fonts_url() ) );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress 4.1+ manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Set the Custom Image Sizes
	 */
	add_image_size( 'planar-quadratum', 800, 800, true );
	add_image_size( 'planar-rectangulum', 800, 440, true );
	add_image_size( 'planar-featured-small', 2800, 750, true );
	add_image_size( 'planar-featured', 9999, 1400, true );

	/*
	 * HTML5
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Excerpt on Pages.
	 * See http://codex.wordpress.org/Excerpt
	 */
	add_post_type_support( 'page', 'excerpt' );

	/**
	 * Enable support for Post Formats
	 */
	//add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom header image.
	 */
	add_theme_support( 'custom-header', apply_filters( 'planar_custom_header_args', array(
		'default-image'	=> '',
                                'header-text'	=> false,
		'width'	=> 9999,
		'height'	=> 850,
		'flex-height'	=> true,
                                'flex-width'	=> true,
	) ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'planar_custom_background_args', array(
		'default-color' => 'fff',
		'default-image' => '',
	) ) );

	/**
	 * Custom Menu location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Header Menu', 'planar-lite' ),
		'top' => __( 'Top Menu', 'planar-lite' ),
		'social' => __( 'Social Menu', 'planar-lite' )
	) );

}
endif;
add_action( 'after_setup_theme', 'planar_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function planar_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'planar-lite' ),
		'id'            => 'sidebar-blog',
		'description' => __('If empty (no widgets) the layout of posts will be without sidebar.', 'planar-lite'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'planar-lite' ),
		'id'            => 'sidebar-page',
		'description' => __('If empty (no widgets) the layout of page will be without sidebar.', 'planar-lite'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Home Page - Top', 'planar-lite' ),
		'id'            => 'front-page-before',
		'description' => __('Widget area of the front page above the main content. Use Planar theme widgets.', 'planar-lite'),
		'before_widget' => '<section id="%1$s" class="widget-section %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="section-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Home Page - Bottom', 'planar-lite' ),
		'id'            => 'front-page-after',
		'description' => __('Widget area front page below the main content. Use Planar theme widgets..', 'planar-lite'),
		'before_widget' => '<section id="%1$s" class="widget-section %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="section-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name' => __('Footer', 'planar-lite'),
		'description' => __('Footer Widget area.', 'planar-lite'),
		'id' => 'footer',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
		'before_widget' => '<div class="footer-widget col">',
		'after_widget' => '</div>'
	) );
}
add_action( 'widgets_init', 'planar_widgets_init' );

/**
 * Register Google fonts for Theme
 * Better way
 */
if ( ! function_exists( 'planar_fonts_url' ) ) :

function planar_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'planar-lite' );
 
    if ( 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:300italic,400italic,700italic,400,600,700,300';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,cyrillic' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles
 */
function planar_scripts() {
	
                wp_enqueue_style( 'planar-style', get_stylesheet_uri() );

	wp_enqueue_style( 'planar-fonts', planar_fonts_url(), array(), null );
      
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css?v=4.6.1' );

	wp_enqueue_script( 'planar-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array( 'jquery' ), '27102014', true );

	wp_enqueue_script( 'planar-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '27102014', true );

	wp_enqueue_style('style-prettyPhoto', get_template_directory_uri().'/css/prettyPhoto.min.css?v=25062015' );

	wp_enqueue_script( 'jquery-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.min.js', array(), '1.0', true );

	wp_enqueue_script( 'planar-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '27102014', true );

	wp_enqueue_script( 'planar-html5', get_template_directory_uri() . '/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'planar-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'planar-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '27102014', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'planar_scripts' );

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function planar_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'planar_javascript_detection', 0 );

/**
 * Template functions used throughout the theme
 */
require( get_template_directory() . '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates
 */
require( get_template_directory() . '/inc/extras.php' );

/**
 * Theme hooks
 */
// see template-tags.php
add_action( 'background_content', 'planar_bg_content' );
add_action( 'display_submenu_sidebar', 'planar_get_submenu', 20 );
add_action( 'arhives_title', 'planar_arhives_title' );
add_action( 'planar_credits', 'planar_txt_credits' );

/**
 * Custom Theme Widgets which do not require activation of any plugin
 */
require_once( get_template_directory() . '/inc/widgets/widget-posts-home.php' );

/**
 * Custom Theme Widgets which require the activation of a particular plugin
 */
if ( class_exists( 'Projects' ) ) {
	require_once( get_template_directory() . '/inc/widgets/widget-projects-home.php' );
}
if ( class_exists( 'Woothemes_Features' ) ) {
	require_once( get_template_directory() . '/inc/widgets/widget-features-home.php' );
}
if ( class_exists( 'Woothemes_Testimonials' ) ) {
	require_once( get_template_directory() . '/inc/widgets/widget-testimonials-home.php' );
}
if ( class_exists( 'Woothemes_Our_Team' ) ) {
	require_once( get_template_directory() . '/inc/widgets/widget-team-home.php' );
}

/**
 * Gallery layout
 */
require( get_template_directory() . '/inc/gallery.php');

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Theme Customizer
 **/
require( get_template_directory() .'/inc/customizer.php' );

/**
 * Contextual Help
 */
require_once( get_template_directory() . '/inc/contextual-help.php' );

/**
 * Wellcom Screen & DinevThemes feed
 */
require_once( get_template_directory() . '/inc/welcome.php' );
require_once( get_template_directory() . '/inc/dashboard-feed.php' );

/**
 * TGM-Plugin-Activation
 */
require_once( get_template_directory() . '/inc/admin-notice-plugins.php' );

/**
 * SiteOrigin Page builder integration
 */
if( class_exists( 'SiteOrigin_Panels_Settings' ) ) {
	require( get_template_directory() . '/inc/builder.php' );
}

/**
 * WooProject Hooks&Custom
 */
if( class_exists( 'Projects' ) ) {

	// projects_before_single_project_summary hook
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_title', 10 );
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_short_description', 20 );
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_feature', 30 );
	remove_action( 'projects_before_single_project_summary', 'projects_template_single_gallery', 40 );
	add_action( 'projects_before_single_project_summary', 'projects_template_single_short_description', 20 );

	// projects_single_project_summary hook
	remove_action( 'projects_single_project_summary', 'projects_template_single_meta', 20 );
	remove_action( 'projects_single_project_summary', 'projects_template_single_description', 10 );

	add_action( 'projects_single_project_summary', 'projects_template_single_gallery', 10 );
	add_action( 'projects_single_project_summary', 'projects_template_single_description', 20 );
	add_action( 'projects_single_project_summary', 'projects_template_single_meta', 30 );

	// projects_after_loop_item hook
	remove_action( 'projects_after_loop_item', 'projects_template_short_description', 10 );

    	// remove_shortcode( 'projects' );
	add_filter( 'projects_enqueue_styles', '__return_false' );

	// functions see below
	add_action( 'projects_after_loop_item', 'planar_projects_cat', 10 );
	add_filter( 'projects_custom_fields', 'planar_projects_fields' );
	add_action( 'widgets_init', 'planar_wooproject_sidebar' );
	add_action( 'projects_before_loop', 'planar_projects_cat_menu' );

} // class_exists( 'Projects' )

function planar_projects_cat() {
	global $post;
	$terms_as_text = get_the_term_list( $post->ID, 'project-category', '', ', ', '' );
			echo '<h5 class="shortcode-project-cat">';
			echo $terms_as_text;
			echo '</h5>';

}
function planar_projects_fields( $fields ) {
	$fields['subtitle'] = array(
	    'name' 			=> __( 'Sub Title', 'planar-lite' ),
	    'description' 	=> __( 'Enter a sub title for this project.', 'planar-lite' ),
	    'type' 			=> 'text',
	    'default' 		=> '',
	    'section' 		=> 'info'
	);
	$fields['date'] = array(
	    'name' 			=> __( 'Date', 'planar-lite' ),
	    'description' 	=> __( 'Enter a date for this project.', 'planar-lite' ),
	    'type' 			=> 'text',
	    'default' 		=> '',
	    'section' 		=> 'info'
	);

	return $fields;
}
function planar_wooproject_sidebar() {
	register_sidebar(array(
	'name' => __('Project', 'planar-lite' ),
	'description' => __('Located in the sidebar Project', 'planar-lite' ),
	'id' => 'project',
	'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h1 class="widget-title">',
	'after_title'   => '</h1>',
	));
}
function planar_projects_cat_menu() {
	echo '<div id="project-top">';
		the_widget( 'Woothemes_Widget_Project_Categories', 'title=&hierarchical=0&count=1' );
	echo '</div>';
}