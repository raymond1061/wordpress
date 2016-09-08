<?php
/**
 * @package Planar
 */
?>
<div class="content-secondary" role="complementary">

<?php do_action( 'before_sidebar' ); ?>

	<div id="sidebar" class="widget-area">

<?php
	if ( has_nav_menu( 'primary' ) && false === get_theme_mod( 'planar_submenu_pages' ) ) {
		do_action( 'display_submenu_sidebar' );	
	}
?>
		<?php if ( ! dynamic_sidebar( 'sidebar-page' ) ) : ?>
		<?php endif; // ! dynamic_sidebar ?>

	</div><!-- #sidebar -->
</div><!-- .content-secondary -->