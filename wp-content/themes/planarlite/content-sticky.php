<?php
/**
 * @package Planar
 */
?>

<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'planar-featured' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<a href="<?php the_permalink(); ?>" class="sticky-frame">
<div class="home-sticky" style="background: <?php echo esc_attr( get_theme_mod( 'planar_additional_color', '#398ece' ) ); if( !empty($thumbnail) ) { ?> url(<?php echo $thumbnail[0]; ?>) no-repeat; background-position: 50%; background-size: cover<?php } ?>;">

		<header class="entry-header">
	<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-summary">

	<?php if ( has_excerpt() ) : ?>
		<?php the_excerpt(); ?>
	<?php endif; ?>	

		<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_date('j F Y', '<em>', '</em>'); ?></time>

		</div><!-- .entry-summary -->

</div><!-- .home-sticky-->
</a>


</article><!-- #post-<?php the_ID(); ?> -->