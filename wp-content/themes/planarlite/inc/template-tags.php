<?php
/**
 * @package Planar
 */

/**
 * Post navigation
 */

if ( ! function_exists( 'planar_content_nav' ) ) :

function planar_content_nav( $nav_id ) {
	global $wp_query, $post;

	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'planar-lite' ); ?></h1>

	<?php if ( is_single() ) : ?>

		<?php previous_post_link( '<div class="nav-previous"><span>previous</span>%link</div>', '%title' ); ?>
		<?php next_post_link( '<div class="nav-next"><span>next</span>%link</div>', '%title' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<i class="fa fa-arrow-left"></i>', 'planar-lite' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( '<i class="fa fa-arrow-right"></i>', 'planar-lite' ) ); ?></div>
		<?php endif; ?>

	<?php endif; //is_single() ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; //planar_content_nav

/**
 * Template for comments and pingbacks.
 */

if ( ! function_exists( 'planar_comment' ) ) :

function planar_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'planar-lite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'planar-lite' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>

	<?php $admincomment = ( user_can( $comment->user_id, 'manage_options' ) ? 'byadmin' : '' ); ?>

	<li <?php comment_class( $admincomment ) ?> id="li-comment-<?php comment_ID(); ?>">

		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<figure class="comment-author-avatar">
				<?php echo get_avatar( $comment ); ?>
			</figure>

			<div class="comment-box">

				<div class="comment-author-vcard">

					<?php comment_author_link(); ?>

					<?php if ( user_can( $comment->user_id, 'manage_options' ) ) : ?>

						<span><?php _e( 'Author', 'planar-lite' ); ?></span>

					<?php endif; ?>

				</div><!-- .comment-author-vcard -->

				<div class="comment-content">

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'planar-lite' ); ?></em>
						<br />
					<?php endif; ?>

					<?php comment_text(); ?>
<time datetime="<?php comment_time( 'c' ); ?>">
	<?php printf( _x( '%1$s &middot; %2$s', '1: date, 2: time', 'planar-lite' ), get_comment_date(), get_comment_time() ); ?>
				</time>
				</div><!-- .comment-content -->

				<div class="comment-meta">
					<?php
						comment_reply_link( array_merge( $args,array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before' => ' <i class="fa fa-reply"></i> '
						) ) );
					?>
					<?php edit_comment_link( __( 'Edit', 'planar-lite' ), '<span class="edit-link">', '<span>' ); ?>
				</div><!-- .comment-meta -->



			</div><!-- .comment-box -->

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for planar_comment()

/**
 * Prints Meta information for the current post
 */
if ( ! function_exists( 'planar_posted_on' ) ) :

function planar_posted_on() {
	printf( __( '<span class="byline">by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span> on <time class="entry-date" datetime="%4$s">%5$s</time>', 'planar-lite' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'All posts by %s', 'planar-lite' ), get_the_author() ) ),
		get_the_author(),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function planar_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so planar_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so planar_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in planar_categorized_blog
 */
function planar_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'planar_category_transient_flusher' );
add_action( 'save_post', 'planar_category_transient_flusher' );

/**
 * Prints the attached image with a link to the next attached image.
 */
if ( ! function_exists( 'planar_the_attached_image' ) ) :

function planar_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'planar_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Background for #content
 */
if ( ! function_exists( 'planar_bg_content' ) ) {
function planar_bg_content() {
	$bg = esc_url( get_theme_mod( 'background_image' ) );
	echo 'style="background: #';
	echo esc_attr( get_theme_mod( 'background_color','FFF' ) );
		if  ( $bg) {
			echo ' url(';
			echo $bg;
			echo ')';
		}
	echo ';"';
}
}

/**
 * The page submenu into sidebar
 * @author Oleg Murashov
 */
if ( ! function_exists( 'planar_get_submenu' ) ) {
  function planar_get_submenu($args) {
    $defaults = array(
    	'container_id' => '',
    	'container' => 'div',
    	'container_class' => 'submenu',
    	'submenu_id' => 'sidemenu',
    	'submenu_class' => '',
    	'theme_location' => 'primary',
    	'xpath' => "./li[contains(@class,'current-menu-item') or contains(@class,'current-menu-ancestor')]/ul",
    	'echo' => true
    );

    $args = wp_parse_args( $args, $defaults );
    $args = (object) $args;
 
    $menu = wp_nav_menu(
        array(
            'theme_location' => $args->theme_location,
            'container' => '',
            'echo' => false
        )
    );

    $menu = simplexml_load_string($menu);
    $submenu = $menu->xpath($args->xpath);

    if (empty($submenu)) {
        return;
    }

    // Set value of class attribute
    $submenu[0]['class'] = $args->submenu_class;

    // Add "id" attribute
    if ($args->submenu_id) {
        $submenu[0]->addAttribute('id', $args->submenu_id);
    }

    if ($args->container) {
        $submenu_sxe = simplexml_load_string($submenu[0]->saveXML());
        $sdm = dom_import_simplexml($submenu_sxe);

        if ($sdm) {
            $xmlDoc = new DOMDocument('1.0', 'utf-8');
            $container = $xmlDoc->createElement($args->container);

            // Add "class" attribute for container
            if ($args->container_class) {
                $container->setAttribute('class', $args->container_class);
            }

            // Add "id" attribute for container
            if ($args->container_id) {
                $container->setAttribute('id', $args->container_id);
            }
    
            $smsx = $xmlDoc->importNode($sdm, true);
            $container->appendChild($smsx);
            $xmlDoc->appendChild($container);
        }
    }

    if (isset($xmlDoc)) {
        $output = $xmlDoc->saveXML();
    } else {
        $output = $submenu[0]->saveXML();
    }

    if (!$args->echo) {
        return $output;
    }

    echo $output;
  }
}


/**
 * Footer credits.
 */
if ( ! function_exists( 'planar_txt_credits' ) ) {
	function planar_txt_credits() {
		$text = sprintf( __( 'Powered by %s', 'planar-lite' ), '<a href="http://wordpress.org/">WordPress</a>' );
		$text .= '<span class="sep"> &middot; </span>';
		$text .= sprintf( __( 'Theme by %s', 'planar-lite' ), '<a href="http://dinevthemes.com/">DinevThemes</a>' );
		echo apply_filters( 'planar_txt_credits', $text );
	}
}

/**
 * Posts Archive Title
 */
if ( ! function_exists( 'planar_arhives_title' ) ) {
	function planar_arhives_title() {
		if ( is_category() ) :
			printf( __( 'Category %s', 'planar-lite' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		elseif ( is_tag() ) :
			printf( __( 'Tag %s', 'planar-lite' ), '<span>' . single_tag_title( '', false ) . '</span>' );
		elseif ( is_author() ) :
			printf( __( 'Author %s', 'planar-lite' ), get_the_author() );
		elseif ( is_day() ) :
			printf( __( 'Day %s', 'planar-lite' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() ) :
			printf( __( 'Month %s', 'planar-lite' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
		elseif ( is_year() ) :
			printf( __( 'Year %s', 'planar-lite' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		else :
			_e( 'Archive', 'planar-lite' );
		endif;
	}
}

/**
 * Header top bar menu
 */
add_action( 'before_header', 'planar_top_menu' );

if ( ! function_exists( 'planar_top_menu' ) ) {
	function planar_top_menu() {

		if ( has_nav_menu( 'top' ) ) { ?>
	<div class="top-bar">
		<div class="wrap-inner clearfix">
<?php
	wp_nav_menu(
		array(
		'theme_location'  => 'top',
		'menu_id'         => 'menu-top',
		'depth'           => 1,
		'link_before'     => '<span>',
		'link_after'      => '</span>',
		'fallback_cb'     => '',
		)
	); ?>
		</div>
	</div>
<?php
		}

	}
}

/**
 * Search form in the top panel hide/show switching 
 */
add_action( 'hidden_headers', 'planar_hidden_headers' );

if ( ! function_exists( 'planar_hidden_headers' ) ) {
	function planar_hidden_headers() {
		get_search_form();
	}
}

/**
 * Headline content 
 */
add_action( 'headline_container', 'planar_headline_content' );

if ( ! function_exists( 'planar_headline_content' ) ) {
	function planar_headline_content() {
		echo '<div class="tagline-txt wrap-inner">';
		echo do_shortcode( wp_kses_post( get_theme_mod( 'planar_home_headline', '<h1>Home Tagline</h1>' ) ) );
		echo '</div>';
	}
}