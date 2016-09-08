<?php
/**
 * Template Name: Page Child Grid
 *
 * @package Planar
 */

get_header(); ?>

	<div id="content" class="site-content">
		<div class="wrap-inner">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div><!-- .wrap-inner -->

<!-- ChildGrid -->
	<?php
		$child_pages = new WP_Query( array(
			'post_type'      => 'page',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => $post->ID,
			'posts_per_page' => 999,
			'no_found_rows'  => true,
		) );
	?>

	<?php if ( $child_pages->have_posts() ) : ?>
		<div class="wrap-inner" <?php do_action( 'background_content' ); ?>>
			<div class="grid2 clearfix">
				<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>

					<div class="col">
						<?php get_template_part( 'content', 'childpage' ); ?>
					</div>

				<?php endwhile; ?>
			</div>
		</div><!-- .wrap-inner -->
	<?php
		endif;
		wp_reset_postdata();
	?>
<!-- ChildGrid -->

	</div><!-- #content -->

<?php get_footer(); ?>
