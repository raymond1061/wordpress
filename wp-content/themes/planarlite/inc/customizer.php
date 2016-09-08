<?php
/**
 * Theme Customizer General
 * @package Planar
 */

function planar_customizer( $wp_customize ) {

	/**
	 * Rename Sections Titles
	 */
	$wp_customize->get_section('colors')->title = __( 'Theme Colors', 'planar-lite' );

	/**
	 * Set transports for the Customizer.
	 */
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';


	/**
	 * Add custom controls.
	 */
	require get_template_directory() . '/inc/customizer-class/textarea.php';


	/**
	 * Helper functions
	 */
	function is_homepage_template(){
    		// Get the page's template
    		$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
    		$is_template = preg_match( '%homepage-one.php%', $template );
    			if ( $is_template == 0 ){
        				return false;
    			} else {
        				return true;
    			}
	}
	function is_headline_page(){
    			if ( is_front_page() || is_home() ){
        				return true;
    			} else {
        				return false;
    			}
	}
	function is_single_post(){
    			if ( is_singular( 'post' ) ){
        				return true;
    			} else {
        				return false;
    			}
	}
	function is_puper_plugin_active(){
    		// Check for the slider plugin class
    		if( !class_exists( 'PuperSuperPlugin' ) ){
    			// If it doesn't exist it won't show the section/panel/control
        			return false;
    		} else {
    			// If it does, we do show it
        			return true;
    		}
	}

	/**
	 * Settings & Controls
	 */
	
	// Add color settings
	$body_colors = array();
	$body_colors[] = array(
		'slug'=>'header_bgcolor', 
		'default' => '#3767c6',
		'label' => __('Header Background Color', 'planar-lite'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'main_color', 
		'default' => '#2E3138',
		'label' => __('Main Color', 'planar-lite'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'secondary_color', 
		'default' => '#dedede',
		'label' => __('Secondary Color', 'planar-lite'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'additional_color', 
		'default' => '#3767c6',
		'label' => __('Additional Color', 'planar-lite'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'menu_color', 
		'default' => '#ffffff',
		'label' => __('Main Menu Color', 'planar-lite'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'submenu_color', 
		'default' => '#ffffff',
		'label' => __('SubMenu Color', 'planar-lite'),
		'transport' => 'refresh'
	);
	$body_colors[] = array(
		'slug'=>'submenu_bgcolor', 
		'default' => '#2E3138',
		'label' => __('SubMenu BG color', 'planar-lite'),
		'transport' => 'refresh'
	);
	$body_colors[] = array(
		'slug'=>'topbar_bgcolor', 
		'default' => '#2e3138',
		'label' => __('Top Menu BG color', 'planar-lite'),
		'transport' => 'refresh'
	);
	$body_colors[] = array(
		'slug'=>'topmenu_color', 
		'default' => '#dedede',
		'label' => __('Top Menu color', 'planar-lite'),
		'transport' => 'refresh'
	);
	$body_colors[] = array(
		'slug'=>'footer_bgcolor', 
		'default' => '#2E3138',
		'label' => __('Footer Background Color', 'planar-lite'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'footer_color', 
		'default' => '#dedede',
		'label' => __('Footer Color', 'planar-lite'),
		'transport' => 'postMessage'
	);

	foreach( $body_colors as $color ) {
		$wp_customize->add_setting(
			'planar_' . $color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				//'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport' => $color['transport']
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array(
					'label' => $color['label'], 
					'section' => 'colors', // 'body_section' - if separated section
					'settings' => 'planar_' . $color['slug']
				)
			)
		);
	}


	/*-----------------------------------------------------------
	 * Headline section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'planar_headline',
		array(
			'title'     => __( 'Headline', 'planar-lite' ),
      			'description' => __( 'Enter text using the tags, sample: &#60;h1&#62;Headline&#60;/h1&#62;. You can also use shortcode to insert into the Home Headline.', 'planar-lite' ),
			'priority'  => 100,
			'active_callback' => 'is_headline_page',
		)
	);
		$wp_customize->add_setting(
			'planar_home_headline',
			array(
			'default' => __( '<h1>Home Tagline</h1>', 'planar-lite' ),
			'sanitize_callback' => 'planar_sanitize_textarea',
			'transport'   => 'postMessage'
			)
		);
		$wp_customize->add_setting(
			'planar_blog_headline',
			array(
			'default' => __( '<h1>Blog Tagline</h1>', 'planar-lite' ),
			'sanitize_callback' => 'planar_sanitize_textarea',
			'transport'   => 'postMessage'
			)
		);

		// Headline CONTROL
		$wp_customize->add_control( new planar_Textarea_Control( $wp_customize, 'planar_home_headline', array(
			'label' => __( 'Home Headline', 'planar-lite' ),
			'section' => 'planar_headline',
			'settings' => 'planar_home_headline',
			'type' => 'text',
		) ) );
		$wp_customize->add_control( new planar_Textarea_Control( $wp_customize, 'planar_blog_headline', array(
			'label' => __( 'Blog Headline', 'planar-lite' ),
			'section' => 'planar_headline',
			'settings' => 'planar_blog_headline',
			'type' => 'text',
		) ) );

	/*-----------------------------------------------------------*
	 * Post Options
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'planar_single_options',
		array(
			'title'     => __( 'Single Post Options', 'planar-lite' ),
			'priority'  => 300,
			'active_callback' => 'is_single_post',
		)
	);

	/* Header Image Single */

	$wp_customize->add_setting( 
		'planar_header_single',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'planar_header_single',
		array(
			'section'   => 'planar_single_options',
			'label'     => __( 'Hide Header Image', 'planar-lite' ),
			'description' => __( 'Featured Image above post content', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);

	/* Meta info on top single post */

	$wp_customize->add_setting( 
		'top_single_display',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'top_single_display',
		array(
			'section'   => 'planar_single_options',
			'label'     => __( 'Hide author/date meta top', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);
	$wp_customize->add_setting( 
		'meta_single_display',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'meta_single_display',
		array(
			'section'   => 'planar_single_options',
			'label'     => __( 'Hide author/date meta bottom', 'planar-lite' ),
			'description' => __( 'If checked hide author/date meta top', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);

	/*-----------------------------------------------------------*
	 * General Options
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'planar_display_options',
		array(
			'title'     => __( 'General Options', 'planar-lite' ),
			'priority'  => 310
		)
	);

	/* Header */

	$wp_customize->add_setting( 
		'planar_display_title',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			//'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'planar_display_title',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Site Title', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);
	$wp_customize->add_setting( 
		'planar_display_subtitle',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			//'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'planar_display_subtitle',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Site SubTitle', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);

	/* Hide Home Headline */

	$wp_customize->add_setting( 
		'planar_display_headline',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'planar_display_headline',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Home Headline', 'planar-lite' ),
			'description' => __( 'Header Image and Header Front Page will be hidden', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);

	/* Right Align Sidebar */

	$wp_customize->add_setting( 
		'right_align_sidebar',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
            			'transport'   => 'refresh'
		)
	);
	$wp_customize->add_control(
		'right_align_sidebar',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Right aligned sidebar', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);

	/* Sub Menu Page */

	$wp_customize->add_setting( 
		'planar_submenu_pages',
		array(
			'default' => FALSE,
			'sanitize_callback' => 'planar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'planar_submenu_pages',
		array(
			'section'   => 'planar_display_options',
			'label'     => __( 'Hide Submenu pages', 'planar-lite' ),
			'type'      => 'checkbox'
		)
	);

	/* Logo Image */

	$wp_customize->add_setting(
		'logo_upload',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
		'label' => __( 'Logo Image', 'planar-lite' ),
		'section' =>  'planar_display_options',
		'settings' => 'logo_upload'
	) ) );

	/* Custom Avatar Image */

	$wp_customize->add_setting(
		'avatar_upload',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'avatar_upload', array(
		'label' => __( 'Avatar Image', 'planar-lite' ),
		'section' =>  'planar_display_options',
		'settings' => 'avatar_upload'
	) ) );

	/* Copyright */

	$wp_customize->add_setting(
		'planar_footer_copyright_text',
		array(
			'default'            => 'All Rights Reserved',
			'sanitize_callback'  => 'planar_sanitize_txt',
			'transport'          => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'planar_footer_copyright_text',
		array(
			'section'  => 'planar_display_options',
			'label'    => __( 'Copyright Message', 'planar-lite' ),
			'type'     => 'text'
		)
	);


}

add_action( 'customize_register', 'planar_customizer', 11 );

	/*-----------------------------------------------------------*
	 * Sanitize
	 *-----------------------------------------------------------*/
	function planar_sanitize_textarea( $input ) {
		return wp_kses_post( force_balance_tags($input) );
	}
	function planar_sanitize_txt( $input ) {
		return strip_tags( stripslashes( $input ) );
	}
	function planar_sanitize_checkbox( $value ) {
        		if ( 'on' != $value )
        			    $value = false;

        		return $value;
    	}
	function planar_sanitize_css( $input ) {
		return wp_strip_all_tags( $input );
	}
	function planar_sanitize_image( $image, $setting ) {

		// Array of valid image file types.
    		$mimes = array(
    		    'jpg|jpeg|jpe' => 'image/jpeg',
    		    'gif'          => 'image/gif',
    		    'png'          => 'image/png',
    		    'bmp'          => 'image/bmp',
    		    'tif|tiff'     => 'image/tiff',
    		    'ico'          => 'image/x-icon'
    		);

		// Return an array with file extension and mime_type.
    		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return it
    		return ( $file['ext'] ? $image : $setting->default );
	}
	function planar_sanitize_nohtml( $nohtml ) {
		return wp_filter_nohtml_kses( $nohtml );
	}
	function planar_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );
	
		// If the input is an absolute integer, return it
		return ( $number ? $number : $setting->default );
	}

	/*-----------------------------------------------------------*
	 * Styles print
	 *-----------------------------------------------------------*/
	function planar_customizer_css() { ?>
<!--Customize CSS -->
<style type="text/css">
#menu-top a, #menu-top .fa { color: <?php echo esc_attr( get_option( 'planar_topmenu_color', '#dedede' ) ); ?>; }
.top-bar { background-color: <?php echo esc_attr( get_option( 'planar_topbar_bgcolor', '#2e3138' ) ); ?>; }
.site-content, .entry-content, .archive .entry-title a, .search-results .entry-title a, #menu-topic a, #respond, .comment #respond,
#contactform, .wp-caption-text { color: <?php echo esc_attr( get_option( 'planar_main_color', '#2E3138' ) ); ?>; }
figure.tile, input[type="submit"], input[type="reset"], input[type="button"], button, .btn, tfoot, .widget_calendar tbody, #wp-calendar tbody, .widget_calendar tbody, #infinite-handle span { background: <?php echo esc_attr( get_option( 'planar_additional_color', '#3767c6' ) ); ?>; }
.navigation-main-mobile ul, .navigation-main-mobile ul li ul, .navigation-main-mobile ul li ul ul, tfoot, .navigation-main ul ul, .navigation-main ul ul ul { background: <?php echo esc_attr( get_option( 'planar_submenu_bgcolor', '#398ece' ) ); ?>; }
.widget_calendar thead, #wp-calendar thead, #wp-calendar tfoot tr { background: <?php echo esc_attr( get_option( 'planar_main_color', '#2E3138' ) ); ?>; }
.site-footer { background: <?php echo esc_attr( get_option( 'planar_footer_bgcolor', '#2e3138' ) ); ?>; }
a, .content-left .entry-meta p, .sticky-post-content .entry-title a, .sticky-post-content-2 .entry-title a, .brick-post-content .entry-title a, .brick-post-content-2 .entry-title a, .fa-reply:before { color: <?php echo esc_attr( get_option( 'planar_additional_color', '#3767c6' ) ); ?>; }
#header-title, #header-title a, .navigation-main li a, .navigation-main-mobile ul li a, .menu-toggle::before, #menu-topic a:hover, .toggle-top::before, .tagline-txt h1, .headline .entry-title, .headline p { color: <?php echo esc_attr( get_option( 'planar_menu_color', '#ffffff' ) ); ?>; }
.navigation-main-mobile ul li a, .navigation-main li ul a { color: <?php echo esc_attr( get_option( 'planar_submenu_color', '#ffffff' ) ); ?>; }
.navigation-main-mobile ul li a, .navigation-main li ul a { background-color: <?php echo esc_attr( get_option( 'planar_submenu_bgcolor', '#2E3138' ) ); ?>; }
.navigation-main ul li:hover > a,.navigation-main ul li.current_page_item > a,.navigation-main ul li.current-menu-item > a,.navigation-main ul li.current-menu-ancestor > a,.navigation-main ul li.current_page_ancestor > a,.navigation-main-mobile ul li:hover > a,.navigation-main-mobile ul li.current_page_item > a,.navigation-main-mobile ul li.current-menu-item > a,.navigation-main-mobile ul li.current-menu-ancestor > a,.navigation-main-mobile ul li.current_page_ancestor > a, .footer-widget a, .site-footer, #menu-social li a::before { color: <?php echo esc_attr( get_option( 'planar_secondary_color', '#dedede' ) ); ?>; }
.footer-widget a, .site-footer{ color: <?php echo esc_attr( get_option( 'planar_footer_color', '#dedede' ) ); ?>; }
.top-wrapper, #wp-calendar td a, .widget_calendar td a { background: <?php echo esc_attr( get_option( 'planar_main_color', '#2E3138' ) ); ?>; }

<?php if( true === get_theme_mod( 'right_align_sidebar' ) ) { ?>
	.content-primary { float: left; }
	.content-secondary .widget-area { margin-right: 0; margin-left: 72px; }
<?php } ?>
</style>

<?php
	} // planar_customizer_css
	add_action( 'wp_head', 'planar_customizer_css', 999 );

	/*-----------------------------------------------------------*
	 * Live Preview JS handlers
	 *-----------------------------------------------------------*/
	function planar_customizer_live_preview() {

		wp_enqueue_script(
			'theme-customizer',
			get_template_directory_uri() . '/js/theme-customizer.js',
			array( 'jquery', 'customize-preview' ),
			'15092015',
			true
		);

	}
	add_action( 'customize_preview_init', 'planar_customizer_live_preview' );