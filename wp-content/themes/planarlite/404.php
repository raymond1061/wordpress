<?php
/**
 * @package Planar
 */
get_header(); ?>

	<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'planar-lite' ); ?></h1>

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->

	<div id="content" class="site-content clearfix" <?php planar_bg_content(); ?>>
	<div class="wrap-inner">

			<article id="post-0" class="post error404 not-found">

	<h3><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'planar-lite' ); ?></h3>
	<?php get_search_form(); ?>

			</article><!-- #post-0 .post .error404 .not-found -->

	</div><!-- .wrap-inner -->
	</div><!-- #content -->

<?php get_footer(); ?>
