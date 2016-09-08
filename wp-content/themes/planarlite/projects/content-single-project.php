<?php
/**
 * The template for displaying project content in the single-project.php template
 */
?>


<div id="project-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

	<?php
		/**
		 * projects_before_single_project_summary hook
		 * see theme functions
		 * @hooked projects_template_single_short_description - 20
	 	 * @hooked projects_template_single_meta - 30
		 */
		do_action( 'projects_before_single_project_summary' );
	?>

		<?php
			/**
			 * projects_single_project_summary hook
		 	 * see theme functions
			 * @hooked projects_template_single_gallery - 10
			 * @hooked projects_template_single_description - 20
			 */
			do_action( 'projects_single_project_summary' );

		?>

	<?php
		/**
		 * projects_after_single_project_summary hook
		 * projects_after_single_project hook
		 */
		//do_action( 'projects_after_single_project_summary' );
		//do_action( 'projects_after_single_project' );
projects_output_testimonial( array( 'limit' => 10, 'size' => 100 ) );
	?>

	</div><!-- .entry-content -->

</div><!-- #project-<?php the_ID(); ?> -->

<?php planar_content_nav( 'nav-below' ); ?>