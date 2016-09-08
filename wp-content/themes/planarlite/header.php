<?php
/**
 * @package Planar
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<div id="header-title">
				<?php if ( 1 != get_theme_mod( 'planar_display_title' ) ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><strong><?php bloginfo( 'name' ); ?></strong></a>
				<?php } ?>	
				<?php if ( 1 != get_theme_mod( 'planar_display_subtitle' ) ) { ?>
               					&nbsp;&nbsp;<?php bloginfo( 'description' ); ?>
				<?php } ?>
			</div><!--header-title-->


<ul id="menu-top" class="menu"><li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-23"><a href="http://localhost:8888/heinzelman_portfolio"><span>Home</span></a></li>
<li id="menu-item-28" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-28"><a href="#planar-scroll"><span>Projects</span></a></li>
<li id="menu-item-18" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-18"><a href="http://localhost:8888/heinzelman_portfolio/about-me/"><span>About Me</span></a></li>
<li id="menu-item-19" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19"><a href="http://localhost:8888/heinzelman_portfolio/contact/"><span>Contact</span></a></li>
</ul>

<?php
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'planar-featured' );

	if( !empty($thumbnail) && !is_front_page() && !is_archive() && !is_search() ) {
		$bgimage = $thumbnail[0];
	} else {
		$bgimage = get_header_image();
	}
	if ( $bgimage && true === get_theme_mod( 'planar_display_headline' ) && is_front_page() ) {
		$bgimage = '';
	}
?>

<body <?php body_class(); ?> style="background-color: <?php echo esc_attr( get_option( 'planar_header_bgcolor', '#3767c6' ) ); ?>;<?php if( !empty( $bgimage ) ) { ?> background-image: url(<?php echo esc_url( $bgimage ); ?>);<?php } ?>">

<div id="page" class="hfeed site">

<header id="masthead" class="site-header" role="banner">

<?php
	/**
	 * display top bar menu
	 * @hooked planar_top_menu
	 * @see template-tags.php
	 */
	do_action( 'before_header' );
?>

<div class="wrap-inner clearfix">

		<div class="site-branding">

<?php $logo = get_theme_mod( 'logo_upload' );
	if ( !empty($logo) ) : ?>

<?php if ( !is_front_page() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<img src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo alignleft" />
	</a>
<?php else : ?>
	<img src="<?php echo esc_url( get_theme_mod( 'logo_upload' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo alignleft" />
<?php endif; //!is_front_page() ?>

	<?php endif; //!empty ?>

			
		</div><!--.site-branding-->

		<div class="site-menu">
			<a href="#" class="toggle-top"></a>
			<nav id="site-navigation" class="navigation-main" role="navigation">
				<?php if ( has_nav_menu('primary') ) { wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 3 ) ); } ?>
			</nav><!-- #site-navigation -->
		</div><!--site-menu-->

</div><!--wrap-inner-->

<?php if( !empty( $bgimage ) ) { ?>
	<span class="overlay"></span>
<?php } ?>

</header><!-- #masthead -->

<div class="top-wrapper wrap-inner">

<?php
	/**
	 * display search form
	 * @hooked planar_hidden_headers
	 * @see template-tags.php
	 */
	do_action( 'hidden_headers' );
?>



</div><!--.top-wrapper-->

	<div id="main" class="site-main clearfix">



