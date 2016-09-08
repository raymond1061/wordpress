<?php
/**
 * @package Planar
 */
?>
	<div id="sidebar" class="content-left widget-area" role="complementary">

	<?php if ( has_excerpt() ) : ?>
		<?php the_excerpt(); ?>
	<?php endif; //has_excerpt() ?>	

		<?php do_action( 'before_sidebar' ); ?>

		<?php if ( ! dynamic_sidebar( 'sidebar-archive' ) ) : ?>

			<p><?php _e( 'Archive sidebar.', 'planar-lite' ) ?></p>

		<?php endif; // ! dynamic_sidebar ?>

	</div><!-- #sidebar -->