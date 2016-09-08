<?php
/**
 * @package Planar
 */

get_header(); ?>

		<?php if ( have_posts() ) : ?>

<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title"><?php _e( 'Search Result', 'planar-lite' ); ?></h1>

		</div><!-- .wrap-inner -->
</header><!-- .entry-header -->

	<div id="content" class="site-content clearfix" <?php planar_bg_content(); ?>>
		<div class="wrap-inner">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>
		</div><!-- .wrap-inner -->
<?php
	planar_content_nav( 'nav-below' );
?>
	</div><!-- #content -->
		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

<?php get_footer(); ?>