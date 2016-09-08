<?php
/**
 * @package Planar
 */
get_header(); ?>

<?php get_template_part( 'template-parts/page', 'header' ); ?>

<?php
if ( !is_front_page() ) :
	get_template_part( 'template-parts/page', 'default-content' );
endif;

if ( is_front_page() ) : 
	get_template_part( 'template-parts/page', 'front-content' );
endif;
?>

<?php get_footer(); ?>
