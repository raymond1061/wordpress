<?php
/**
 * @package Planar
 */
?>
<div class="clearfix"></div>
<article id="post-0" class="no-tiles">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

			<h1 class="entry-title"><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'planar-lite' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></h1>

<?php } else { ?>

	<h1 class="entry-title"><?php _e( 'No posts', 'planar-lite' ); ?></h1>

<?php } ?>

</article><!-- #post-0 -->
