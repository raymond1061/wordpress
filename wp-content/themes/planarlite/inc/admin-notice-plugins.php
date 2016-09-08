<?php
/**
 * @package Planar
 * @see class-tgm-plugin-activation.php
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'planar_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function planar_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	    $plugins = array(
        array(
            'name'               => __('Jetpack by WordPress.com','planar-lite'),
            'slug'               => 'jetpack',
        ),
        array(
            'name'               => __('Projects by WooThemes','planar-lite'),
            'slug'               => 'projects-by-woothemes',
        ),
        array(
            'name'               => __('Features by WooThemes','planar-lite'),
            'slug'               => 'features-by-woothemes',
        ),
        array(
            'name'               => __('Icons For Features','planar-lite'),
            'slug'               => 'icons-for-features',
        ),
        array(
            'name'               => __('Our Team by WooThemes','planar-lite'),
            'slug'               => 'our-team-by-woothemes',
        ),
        array(
            'name'               => __('Testimonials by WooThemes','planar-lite'),
            'slug'               => 'testimonials-by-woothemes',
        ),
        array(
            'name'               => __('Shortcodes Ultimate','planar-lite'),
            'slug'               => 'shortcodes-ultimate',
        ),
        array(
            'name'               => __('Contact Form 7','planar-lite'),
            'slug'               => 'contact-form-7',
        ),
        array(
            'name'               => __('Page Builder by SiteOrigin','planar-lite'),
            'slug'               => 'siteorigin-panels',
        ),
        array(
            'name'               => __('WP Tab Widget','planar-lite'),
            'slug'               => 'wp-tab-widget',
        ),
    );

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'planar-tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '', 
	);

	tgmpa( $plugins, $config );
}
