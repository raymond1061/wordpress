<?php
/**
 * Template for Posts Tiles
 *
 * @package Planar
 */
?>
<?php $count = 0; ?>
<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

<?php $count ++; ?>

<?php if ( $count == 1 || $count == 2 ) { ?>

		<figure class="tile" style="background: <?php echo esc_attr( get_theme_mod( 'planar_additional_color', '#398ece' ) ); ?><?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'planar-quadratum' );  if( !empty($thumbnail) ) { ?> url(<?php echo $thumbnail[0]; ?>) no-repeat; background-size: cover; background-position:50%<?php } ?>;">

			<img src="<?php echo get_template_directory_uri(); ?>/img/blank.png" alt="" width="800" height="800" />	

		</figure>

	<article id="post-<?php the_ID(); ?>" <?php post_class('tile post'); ?>>

			<img src="<?php echo get_template_directory_uri(); ?>/img/blank.png" alt="" width="800" height="800" />

	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="tile-content<?php if ( !has_post_thumbnail())  : ?> no-thumbnail<?php endif; ?>" rel="bookmark">

		<div class="entry-meta">
			<?php
				$category = get_the_category(); 
				echo '<h3>' . $category[0]->cat_name . '</h3>';

 				if ( has_post_format() ) :
					echo get_post_format_string( get_post_format() );
				endif; 
			?>

		<span><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_date('j F Y', '<br />', '<br />'); ?></time></span>

		</div><!-- .entry-meta -->

		<h1 class="entry-title"><?php the_title(); ?></h1>

	</a><!-- .tile-content -->

	</article><!-- #post-<?php the_ID(); ?> -->

<?php }else{ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('tile post'); ?>>

			<img src="<?php echo get_template_directory_uri(); ?>/img/blank.png" alt="" width="800" height="800" />

	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="tile-content<?php if ( !has_post_thumbnail())  : ?> no-thumbnail<?php endif; ?>" rel="bookmark">

		<div class="entry-meta">
			<?php
				$category = get_the_category(); 
				echo '<h3>' . $category[0]->cat_name . '</h3>';

 				if ( has_post_format() ) :
					echo get_post_format_string( get_post_format() );
				endif; 
			?>

		<span><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_date('j F Y', '<br />', '<br />'); ?></time></span>

		</div><!-- .entry-meta -->

		<h1 class="entry-title"><?php the_title(); ?></h1>

	</a><!-- .tile-content -->

	</article><!-- #post-<?php the_ID(); ?> -->

		<figure class="tile" style="background: <?php echo esc_attr( get_theme_mod( 'planar_additional_color', '#398ece' ) ); ?><?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'planar-quadratum' );  if( !empty($thumbnail) ) { ?> url(<?php echo $thumbnail[0]; ?>) no-repeat; background-size: cover; background-position:50%<?php } ?>;">

			<img src="<?php echo get_template_directory_uri(); ?>/img/blank.png" alt="" width="800" height="800" />	

		</figure>
<?php if ( $count == 4 ) : $count = 0; endif; ?>
<?php } ?>

	<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'no-tiles' ); ?>

<?php endif; ?>
