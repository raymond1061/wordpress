<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Planar
 */

/**
 * Add theme support for infinity scroll
 */
function planar_infinite_scroll_init() {
	add_theme_support( 'infinite-scroll', array(
				'container' => 'planar-scroll',
				'render'	=> 'planar_infinite_scroll_render',
				'footer'	=> false,
				'type'	=> 'scroll'
			) );
}
add_action( 'after_setup_theme', 'planar_infinite_scroll_init' );

/**
 * Set the code to be rendered on for calling posts for infinity scroll
 */
function planar_infinite_scroll_render() {
    get_template_part('content', 'blog-tiles');
}

/**
 * Jetpack Sharing display
 */
add_action( 'get_header', 'planar_tweak_share' );
function planar_tweak_share() {
	if ( is_front_page() || is_page_template( 'page-templates/homepage-one.php' ) || is_page_template( 'page-templates/page-childgrid.php' ) ) {
    		remove_filter( 'the_content', 'sharing_display',19 );
    		remove_filter( 'the_excerpt', 'sharing_display',19 );
	}
}