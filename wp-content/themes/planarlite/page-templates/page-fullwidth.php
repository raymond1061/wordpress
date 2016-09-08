<?php
/**
 * Template Name: Page Full Width
 *
 * @package Planar
 */

get_header(); ?>

<?php get_template_part( 'template-parts/page', 'header' ); ?>

	<div id="content" class="site-content clearfix" <?php do_action( 'background_content' ); ?>>
	<div class="wrap-inner">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

	</div><!-- .wrap-inner -->
	</div><!-- #content -->

<?php get_footer(); ?>
