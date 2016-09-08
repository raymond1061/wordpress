<?php
/**
 * @package Planar
 * Display Default Page
 */
?>

	<div id="content" class="site-content" <?php planar_bg_content(); ?>>

		<div class="wrap-inner clearfix">

		<?php if ( is_active_sidebar( 'front-page-before' ) ) { ?>
			<div class="widgets-page-section clearfix">
				<?php dynamic_sidebar( 'front-page-before' ); ?>
			</div>
		<?php } ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( '' != get_the_content() ) : ?>
					<?php get_template_part( 'content', 'page' ); ?>
				<?php endif; ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- .wrap-inner -->

		<div class="wrap-inner clearfix">

		<?php if ( is_active_sidebar( 'front-page-after' ) ) { ?>
			<div class="widgets-page-section clearfix">
				<?php dynamic_sidebar( 'front-page-after' ); ?>
			</div>
		<?php } ?>

		</div><!-- .wrap-inner -->

	</div><!-- #content -->