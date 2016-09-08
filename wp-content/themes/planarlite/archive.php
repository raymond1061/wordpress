<?php
/**
 * @package Planar
 */
get_header(); ?>


	<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title">
				<?php do_action( 'arhives_title' ); ?>
			</h1>

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->

<div id="content" class="site-content clearfix" role="main" <?php do_action( 'background_content' ); ?>>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

<div class="wrap-inner">
	<article id="post-<?php the_ID(); ?>" class="archive-post">
		<div class="entry-content">
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php the_excerpt(); ?>

			<?php $comments = get_comments_number();
			if ( $comments > 0 ) : ?>
<span><a href="<?php the_permalink(); ?>#comments"><?php printf( _nx( '1 Comment', '%1$s Comments', $comments, 'comments title', 'planar-lite' ), number_format_i18n( $comments ) ); ?></a></span>
			<?php endif; ?>
		</div>
	</article>
</div><!-- .wrap-inner -->

			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'no-results' ); ?>
		<?php endif; ?>

<?php
	planar_content_nav( 'nav-below' );
?>
</div><!-- #content -->

<?php get_footer(); ?>