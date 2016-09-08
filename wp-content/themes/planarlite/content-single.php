<?php
/**
 * @package Planar
 */
?>

<div class="content-primary<?php if ( ! is_active_sidebar( 'sidebar-blog' ) ) { echo '-nosidebar'; } ?>" role="main">

<?php if ( has_post_thumbnail() && false === get_theme_mod( 'planar_header_single' ) ) { ?>
	<div class="post-thumb">
	<?php the_post_thumbnail( 'planar-featured-small' ); ?>
	</div>
<?php } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'planar-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-meta">

<?php if ( true === get_theme_mod( 'top_single_display' ) && false === get_theme_mod( 'meta_single_display' ) ) { ?>
		<div id="author" class="author-area">
<?php
$avatar = get_theme_mod( 'avatar_upload' );

	if( !empty($avatar) ) { ?>
			<img src="<?php echo esc_url( get_theme_mod( 'avatar_upload' ) ); ?>" class="avatar" />
	<?php } else { ?>
			<?php echo get_avatar( get_the_author_meta('ID'), 90 ); ?>
	<?php } ?>
		<div class="author-meta">
			<?php _e( 'Published by ', 'planar-lite'); ?><?php the_author_posts_link(); ?>
			<?php _e( 'on ', 'planar-lite'); ?><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('M d, Y'); ?></time>
		</div>
		</div><!-- #author -->

<?php } // ! is_active_sidebar( 'sidebar-blog' ) ?>

		<?php
			$category_list = get_the_category_list( __( ', ', 'planar-lite' ) );
			$tag_list = get_the_tag_list( '#', ' #' );

			if ( ! planar_categorized_blog() ) {
				if ( '' != $tag_list ) {
					$meta_text = __( '%2$s.', 'planar-lite' );
				} else {
					$meta_text = '';
				}

			} else {
				if ( '' != $tag_list ) {
					$meta_text = '<p>' . __( 'in %1$s.', 'planar-lite' ) . '<br />tags<br />' . __( '%2$s.', 'planar-lite' ) . '</p>';
				} else {
					$meta_text = '<p>' . __( 'in %1$s', 'planar-lite' ) . '</p>';
				}

			} // end check for categories

			printf(
				$meta_text,
				$category_list,
				$tag_list
			);
		?>
	</div><!-- .entry-meta -->

</article><!-- #post-## -->

<?php planar_content_nav( 'nav-below' ); ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() )
			comments_template();
	?>

</div><!-- .content-primary -->