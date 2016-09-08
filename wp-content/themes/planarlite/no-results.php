<?php
/**
 * @package Planar
 */
?>

		<?php if ( is_search() ) : ?>

<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title"><?php _e( 'Nothing Found', 'planar-lite' ); ?></h1>

		</div><!-- .wrap-inner -->
</header><!-- .entry-header -->

	<div id="content" class="site-content clearfix" style="background: #<?php echo esc_attr( get_theme_mod( 'background_color','FFF' ) ); ?> url(<?php echo esc_url( get_theme_mod( 'background_image' ) ); ?>);">

	<div class="wrap-inner">
		<article id="post-0" class="post no-results not-found">

			<h3><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'planar-lite' ); ?></h3>
			<?php get_search_form(); ?>

		<?php else : ?>

	<div id="content" class="site-content clearfix" style="background: #<?php echo esc_attr( get_theme_mod( 'background_color','FFF' ) ); ?> url(<?php echo esc_url( get_theme_mod( 'background_image' ) ); ?>);">

	<div class="wrap-inner">
		<article id="post-0" class="post no-results not-found">

			<h3><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'planar-lite' ); ?></h3>
			<?php get_search_form(); ?>

		<?php endif; ?>
</article><!-- #post-0 .post .no-results .not-found -->

	</div><!-- .wrap-inner -->
	</div><!-- #content -->
