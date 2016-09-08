<?php
/**
 * @package Planar
 */

if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<div class="comments-header">
			
		<h2 class="comments-title"><?php comments_number(__('0', 'planar-lite'), __('1', 'planar-lite'), __('%', 'planar-lite') );?> <?php _e('Comments', 'planar-lite'); ?></h2>

		</div>

		<div class="comments-wrapper">

			<ol class="comment-list">
				<?php
					wp_list_comments( array( 'callback' => 'planar_comment' ) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation-comment" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'planar-lite' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( 'Older', 'planar-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer', 'planar-lite' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
			<?php endif; //comment navigation ?>

		</div><!-- .comments-content -->

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'planar-lite' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
