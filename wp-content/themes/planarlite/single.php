<?php
/**
 * @package Planar
 */

get_header(); ?>

<?php get_template_part( 'template-parts/single', 'header' ); ?>

	<div id="content" class="site-content clearfix" <?php do_action( 'background_content' ); ?>>

			<?php
			while ( have_posts() ) : the_post(); ?>

	<?php if( false === get_theme_mod( 'top_single_display' ) ) { ?>
		<div class="top-single">

			<?php _e( 'by ', 'planar-lite'); ?><?php the_author(); ?>

			<?php
			$avatar = get_theme_mod( 'avatar_upload' );
			if( !empty($avatar) ) { ?>
				<img src="<?php echo esc_url( get_theme_mod( 'avatar_upload' ) ); ?>" class="avatar" />
			<?php } else { ?>
				<?php echo get_avatar( get_the_author_meta('ID'), 60 ); ?>
			<?php } ?>

			<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('M d, Y'); ?></time>

		</div><!-- .top-single -->
	<?php } ?>

	<div class="wrap-inner">

			<?php if ( has_post_format() ) : // array('aside', 'quote', 'link', 'status', 'gallery') ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'single' ); ?>

			<?php endif; ?>

			<?php
			endwhile; ?>

<?php if ( is_active_sidebar( 'sidebar-blog' ) ) { get_sidebar(); } ?>

	</div><!-- .wrap-inner -->

	</div><!-- #content -->


<?php get_footer(); ?>