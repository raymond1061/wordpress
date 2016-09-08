<?php
/**
 * @package Planar
 */
?>
	<header class="headline">
		<div class="wrap-inner">

			<h1 class="entry-title"><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>	

		</div><!-- .wrap-inner -->
	</header><!-- .entry-header -->