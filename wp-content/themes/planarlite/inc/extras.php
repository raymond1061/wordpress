<?php
/**
 * @package Planar
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function planar_page_menu_args( $args ) {
	$args['show_home'] = false;
	return $args;
}
add_filter( 'wp_page_menu_args', 'planar_page_menu_args' );

/**
 * Filters wp_title
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function planar_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'planar-lite' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'planar_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function planar_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'planar_render_title' );
endif;

/**
 * Adds custom classes to the array of body classes.
 */
function planar_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	$classes[] = 'planar-lite';

	return $classes;
}
add_filter( 'body_class', 'planar_body_classes' );

/**
 * Excerpt length
 */
function planar_excerpt_length($length) {
	if ( is_sticky() ) {
		$length = 50;
	} elseif ( is_page() ) {
		$length = 30;
	} elseif ( is_home() || is_category() || is_archive() ) {
		$length = 30;
	} else {
		$length = 20;
	}
	return $length;
}
add_filter('excerpt_length', 'planar_excerpt_length', 999);

/**
 * Replace [...] in excerpts with something new
 */
function planar_excerpt_more($more) {
	return '&hellip;';
}
add_filter('excerpt_more', 'planar_excerpt_more');

/**
 * Add button CSS class
 */
function planar_add_btn_link_class() {
	return 'class="btn"';
}
add_filter('next_posts_link_attributes', 'planar_add_btn_link_class');
add_filter('previous_posts_link_attributes', 'planar_add_btn_link_class');
add_filter('next_comments_link_attributes', 'planar_add_btn_link_class');
add_filter('previous_comments_link_attributes', 'planar_add_btn_link_class');

/**
 * Add lightbox prettyPhoto for link to image
 */
function planar_prettyPhoto( $html, $id, $size, $permalink, $icon, $text ) {
	
    if ( ! $permalink )
        return str_replace( '<a', '<a data-rel="prettyPhoto" ', $html );
    else
        return $html;
}
add_filter( 'wp_get_attachment_link', 'planar_prettyPhoto', 10, 6 );

function planar_addrel_replace ($content) {
global $post;
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox['.$post->ID.']"$6>$7</a>';
	$content = preg_replace($pattern, $replacement, $content);
return $content;
}
add_filter('the_content', 'planar_addrel_replace', 12);