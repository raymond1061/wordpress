<?php
/**
 * The template for displaying image attachments.
 * @package Planar
 */

get_header(); ?>


	<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title"><?php the_title(); ?></h1>

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->


	<div id="content" class="site-content clearfix" <?php do_action( 'background_content' ); ?>>
	<div class="wrap-inner">

			<?php while ( have_posts() ) : the_post(); ?>

		<div class="entry-meta">
			<?php
				$metadata = wp_get_attachment_metadata();
				printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%7$s</a>', 'planar-lite' ),
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() ),
						esc_url( wp_get_attachment_url() ),
						$metadata['width'],
						$metadata['height'],
						esc_url( get_permalink( $post->post_parent ) ),
						get_the_title( $post->post_parent )
						);
			?>
		</div><!-- .entry-meta -->

		<div class="entry-content">
			<div class="entry-attachment">
				<div class="attachment">
					<?php planar_the_attached_image(); ?>
				</div><!-- .attachment -->
			</div><!-- .entry-attachment -->
		</div><!-- .entry-content -->

			<?php endwhile; // end of the loop. ?>

	</div><!-- .wrap-inner -->
	</div><!-- #content -->

<?php get_footer(); ?>
