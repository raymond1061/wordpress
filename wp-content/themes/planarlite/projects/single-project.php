<?php
/**
 * The Template for displaying all single projects.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

	<header class="headline">
		<div class="wrap-inner">
			<h1 class="entry-title"><?php the_title(); ?></h1>
<?php 
	global $post;
	$subtitle = esc_attr( get_post_meta( $post->ID, '_subtitle', true ) );

	echo '<p>' . $subtitle . '</p>';
?>

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->

	<div id="content" class="site-content clearfix" style="background: #<?php echo esc_attr( get_theme_mod( 'background_color','FFFFFF' ) ); ?> url(<?php echo esc_url( get_theme_mod( 'background_image' ) ); ?>);">

		<?php do_action( 'projects_before_loop' ); ?>

	<div class="wrap-inner">
		<div class="content-primary<?php if ( ! is_active_sidebar( 'project' ) ) { echo '-nosidebar'; } ?>" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php projects_get_template_part( 'content', 'single-project' ); ?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- .content-primary -->

	<?php if ( is_active_sidebar( 'project' ) ) { get_sidebar( 'project' ); } ?>

	</div><!-- .wrap-inner -->

	</div><!-- #content -->

<?php get_footer();