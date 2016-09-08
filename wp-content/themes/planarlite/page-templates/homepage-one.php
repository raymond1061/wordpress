<?php
/**
 * Template Name: Home Page One
 *
 * @package Planar
 */

get_header(); ?>

		<div id="content" class="site-content clearfix">

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

		<div class="clearfix" style="background: #<?php echo esc_attr( get_theme_mod( 'background_color','FFF' ) ); ?>;">

				<?php if ( is_active_sidebar( 'front-page-before' ) ) { ?>
			<div class="wrap-inner">
				<div class="widgets-page-section clearfix">
					<?php dynamic_sidebar( 'front-page-before' ); ?>
				</div>
			</div><!-- .wrap-inner -->
				<?php } ?>

				<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>

<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'planar-featured' ); ?>

<div class="box large childpage" style="background: <?php echo esc_attr( get_theme_mod( 'planar_additional_color','398ece' ) ); ?>;">

	<div class="innerBox" <?php if  ( $thumbnail ) { ?>style="background: url(<?php echo $thumbnail[0]; ?>) no-repeat; background-position: 50%; background-size: cover;"<?php } ?>>

		<div class="titleBox">
		 	<div>
				<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
				<?php if ( has_excerpt() ) : ?>
					<?php the_excerpt(); ?>
				<?php endif; //has_excerpt() ?>	
			</div>
		</div>

	</div><!-- .innerBox -->
</div><!-- .box -->
				<?php endwhile; ?>

	<?php
		endif;
		wp_reset_postdata();
	?>
<!-- ChildGrid -->
		</div><!-- .clearfix -->

<?php
$sticky_posts = get_option('sticky_posts');

		if ( !empty( $sticky_posts ) ) :
			$args = array(
			    'post__in' => get_option('sticky_posts'),
				'post_status' => 'publish'
			);

			$sticky_query = new WP_Query( $args ); ?>

			<?php if ( $sticky_query->have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); ?>

				<?php get_template_part( 'content', 'sticky' ); ?>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php endif; // $sticky_query->have_posts() ?>
				
		<?php endif; // !empty( $sticky_posts ) ?>

	<?php if ( is_active_sidebar( 'front-page-after' ) ) { ?>
		<div class="wrap-inner" style="background: #<?php echo esc_attr( get_theme_mod( 'background_color','FFF' ) ); ?>;">
			<div class="widgets-page-section clearfix">
				<?php dynamic_sidebar( 'front-page-after' ); ?>
			</div>
		</div><!-- .wrap-inner -->
	<?php } ?>

	</div><!-- #content -->

<?php get_footer(); ?>
