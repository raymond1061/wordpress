<?php
/**
 * @package Planar
 * Display Default Page
 */
?>

	<div id="content" class="site-content clearfix" <?php do_action( 'background_content' ); ?>>

	<div class="wrap-inner">
		<div class="content-primary<?php if ( ! is_active_sidebar( 'sidebar-page' ) ) { echo '-nosidebar'; } ?>" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

	<?php
		if ( comments_open() || '0' != get_comments_number() )
			comments_template();
	?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- .content-primary -->

	<?php if ( is_active_sidebar( 'sidebar-page' ) ) { get_sidebar( 'page' ); } ?>

	</div><!-- .wrap-inner -->
	</div><!-- #content -->