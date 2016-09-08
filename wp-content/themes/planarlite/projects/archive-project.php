<?php
/**
 * The Template for displaying project archives, including the main showcase page which is a post type archive.
 */

get_header(); ?>
		<?php if ( have_posts() ) : ?>

	<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title"><?php projects_page_title(); ?></h1>
			<?php do_action( 'projects_archive_description' ); ?>

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->

<div id="project" class="clearfix" style="background: #<?php echo esc_attr( get_theme_mod( 'background_color','FFFFFF' ) ); ?>;">

		<?php do_action( 'projects_before_loop' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'planar-featured' ); ?>

<div class="box large childpage" style="background: <?php echo esc_attr( get_theme_mod( 'planar_additional_color','398ece' ) ); ?>;">
<a href="<?php the_permalink(); ?>">
	<div class="innerBox" <?php if  ( $thumbnail ) { ?>style="background: url(<?php echo $thumbnail[0]; ?>) no-repeat; background-position: 50%; background-size: cover;"<?php } ?>>

		<div class="titleBox">
		 	<div>
				<h1><?php the_title(); ?></h1>
<?php
	$terms = get_the_terms( get_the_ID(), 'project-category' );
	$first_term = array_shift( $terms );
	$project_cat = $first_term->slug; // name
	
	echo $project_cat;
?>

			</div>
		</div>

	</div><!-- .innerBox -->
</a>
</div><!-- .box -->

				<?php endwhile; // end of the loop. ?>

<?php
	planar_content_nav( 'nav-below' );
?>

</div><!-- .clearfix -->

		<?php else : ?>

			<?php projects_get_template( 'loop/no-projects-found.php' ); ?>

		<?php endif; ?>

<?php get_footer(); ?>