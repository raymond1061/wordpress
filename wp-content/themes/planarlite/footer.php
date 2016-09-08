<?php
/**
 * @package Planar
 */
?>
</div><!-- #main -->

<footer id="colophon" class="site-footer clearfix" role="contentinfo">
<div class="wrap-inner">

<?php do_action( 'planar_footer' ); ?>

<?php if ( is_active_sidebar( 'footer' ) ) { ?>

	<div class="grid<?php $sidebars_widgets = wp_get_sidebars_widgets(); if ( 1 == count($sidebars_widgets['footer']) ) { echo '2'; }else{ echo count($sidebars_widgets['footer']); } ?> clearfix">
<?php dynamic_sidebar( 'footer' ); ?>
	</div><!-- .grid3 -->

<?php } ?>

	<div class="site-meta">

	<?php if ( has_nav_menu( 'social' ) ) { ?>
		<div id="socialicons">
<?php
wp_nav_menu(
	array(
	'theme_location'  => 'social',
	'menu_id'         => 'menu-social',
	'depth'           => 1,
	'link_before'     => '<span style="display:none;">',
	'link_after'      => '</span>',
	'fallback_cb'     => '',
	)
); ?>
		</div><!--#socialicons-->
	<?php } // has_nav_menu( 'social' ) ?>

		<div class="site-info">
<?php echo '&copy; '.date('Y').' &middot; '; ?><span id="copyright-message"><?php echo esc_html( get_theme_mod( 'planar_footer_copyright_text', 'All Rights Reserved' ) ); ?></span>
<?php do_action( 'planar_credits' ); ?>
		</div><!-- .site-info -->

	</div><!-- .site-meta -->

            <div id="back-to-top">
	<a href="#masthead" id="scroll-up" ><i class="fa fa-chevron-up"></i></a>
            </div>

</div><!-- .wrap-inner -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>