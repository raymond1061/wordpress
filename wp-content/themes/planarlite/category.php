<?php
/**
 * @package Planar
 */
get_header(); ?>


	<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title">
				<?php single_cat_title(); ?>
			</h1>

			<?php
				$category_description = category_description();

				if ( ! empty( $category_description ) ) :
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
				endif;
			?>	

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->

		<div id="planar-scroll" class="clearfix" <?php do_action( 'background_content' ); ?>>

	<div id="content" class="site-content" role="main">

				<?php get_template_part( 'content', 'blog-tiles' ); //get_post_format() ?>

	</div><!-- #content -->

<?php
	if ( !class_exists( 'Jetpack' ) || class_exists( 'Jetpack' ) && ! Jetpack::is_module_active( 'infinite-scroll' ) ) {
planar_content_nav( 'nav-below' );
	}
?>
		</div><!-- #planar-scroll -->

<?php get_footer(); ?>