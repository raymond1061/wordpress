<?php
/**
 * @package Planar
 */
?>

<?php if ( is_front_page() ) : ?>

<?php if( false === get_theme_mod( 'planar_display_headline' ) && get_theme_mod( 'planar_home_headline' ) ) { ?>
	<div id="home-tagline">
<?php
	/**
	 * display headline
	 * @hooked planar_headline_content
	 * @see template-tags.php
	 */
	do_action( 'headline_container' );
?>
	</div>
<?php } ?>

<?php if( false === get_theme_mod( 'planar_display_headline' ) && !get_theme_mod( 'planar_home_headline' ) ) { ?>
	<header class="headline">
		<div class="wrap-inner">

				<h1 class="entry-title"><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->
<?php } ?>

<?php endif; // is_front_page() ?>

<?php if ( !is_front_page() ) : ?>

	<header class="headline">
		<div class="wrap-inner">

				<h1 class="entry-title"><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->

<?php endif; ?>