<?php
/**
 * @package Planar
 */
get_header(); ?>


		<?php
			$headline = get_theme_mod( 'planar_blog_headline' );
		if( $headline ) { ?>
<!-- Blog Headline -->
<div id="blog-tagline">
	<div class="tagline-txt wrap-inner">
		<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'planar_blog_headline', '<h1>Headline</h1>' ) ) ); ?>
	</div>
</div><!--#home-tagline-->
		<?php } ?>

		<div id="planar-scroll" class="clearfix" <?php do_action( 'background_content' ); ?>>

	<div id="content" class="site-content" role="main">

		<?php get_template_part( 'content', 'blog-tiles' ); ?>

	</div><!-- #content -->

<?php
	if ( !class_exists( 'Jetpack' ) || class_exists( 'Jetpack' ) && ! Jetpack::is_module_active( 'infinite-scroll' ) ) {
planar_content_nav( 'nav-below' );
	}
?>
		</div><!-- #planar-scroll -->

<?php get_footer(); ?>

<h1 id="mainheader">Raymond<br/>Heinzelman's<br/>Portfolio</h1>