<?php
/**
 * Page builder support
 *
 * @package Planar
 */

/* Defaults */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );

/* Theme widgets */
function planar_theme_widgets($widgets) {
	$theme_widgets = array(
		'Planar_Feature_HomeWidgets',
		'Planar_Project_HomeWidgets',
		'Planar_Testimonial_HomeWidgets',
		'Planar_Team_HomeWidgets',
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('planar-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'planar_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function planar_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('Planar Theme Widgets', 'planar-lite'),
		'filter' => array(
			'groups' => array('planar-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'planar_theme_widgets_tab', 20);

/* Replace default row options */
function planar_row_styles($fields) {

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'planar-lite'),
		'type' => 'color',
		'priority' => 3,		
	);
	$fields['padding'] = array(
		'name' => __('Top/Bottom padding', 'planar-lite'),
		'type' => 'measurement',
		'description' => __('Top and bottom padding for this row / default: 24px', 'planar-lite'),
		'priority' => 4,
	);
	$fields['align'] = array(
		'name' => __('Center align the content?', 'planar-lite'),
		'type' => 'checkbox',
		'description' => __('This may or may not work. It depends on the widget styles.', 'planar-lite'),
		'priority' => 5,
	);		
	$fields['background'] = array(
		'name' => __('Background Color', 'planar-lite'),
		'type' => 'color',
		'description' => __('Background color of the row.', 'planar-lite'),
		'priority' => 6,
	);
	$fields['color'] = array(
		'name' => __('Color', 'planar-lite'),
		'type' => 'color',
		'description' => __('Color of the row.', 'planar-lite'),
		'priority' => 7,
	);	
	$fields['background_image'] = array(
		'name' => __('Background Image', 'planar-lite'),
		'type' => 'image',
		'description' => __('Background image of the row.', 'planar-lite'),
		'priority' => 8,
	);		
	$fields['row_stretch'] = array(
		'name' 		=> __('Row Layout', 'planar-lite'),
		'type' 		=> 'select',
		'options' 	=> array(
			'' 				 => __('Standard', 'planar-lite'),
			'full' 			 => __('Full Width', 'planar-lite'),
			'full-stretched' => __('Full Width Stretched', 'planar-lite'),
		),
		'priority' => 9,
	);
	$fields['mobile_padding'] = array(
		'name' 		  => __('Mobile padding', 'planar-lite'),
		'type' 		  => 'select',
		'description' => __('Here you can select a top/bottom row padding for screen sizes < 1024px', 'planar-lite'),		
		'options' 	  => array(
			'' 				=> __('Default', 'planar-lite'),
			'mob-pad-0' 	=> __('0', 'planar-lite'),
			'mob-pad-15'    => __('15px', 'planar-lite'),
			'mob-pad-30'    => __('30px', 'planar-lite'),
			'mob-pad-45'    => __('45px', 'planar-lite'),
		),
		'priority'    => 10,
	);
	$fields['class'] = array(
		'name' => __('Row Class', 'planar-lite'),
		'type' => 'text',
		'description' => __('Add your own class for this row', 'planar-lite'),
		'priority' => 11,
	);
	$fields['column_padding'] = array(
		'name'        => __('Columns padding', 'planar-lite'),
		'type'        => 'checkbox',
		'description' => __('Remove padding between columns for this row?', 'planar-lite'),
		'priority'    => 12,
	);	

	return $fields;
}
remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );
add_filter('siteorigin_panels_row_style_fields', 'planar_row_styles');

/* Filter for the styles */
function planar_row_styles_output($attr, $style) {
	$attr['style'] = '';

	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '. esc_attr($style['bottom_border']) . ';';
	if(!empty($style['background'])) $attr['style'] .= 'background-color: ' . esc_attr($style['background']) . ';';
	if(!empty($style['color'])) $attr['style'] .= 'color: ' . esc_attr($style['color']) . ';';
	if(!empty($style['align'])) $attr['style'] .= 'text-align: center;';
	if(!empty( $style['background_image'] )) {
		$url = wp_get_attachment_image_src( $style['background_image'], 'full' );
		if( !empty($url) ) {
			$attr['style'] .= 'background-image: url(' . esc_url($url[0]) . ');';
			$attr['class'][] = 'parallax';
		}
	}
	if(!empty($style['padding'])) {
		$attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
	} else {
		$attr['style'] .= 'padding: 24px 0; ';
	}
	if( !empty( $style['row_stretch'] ) ) {
		$attr['class'][] = 'planar-stretch';
		$attr['data-stretch-type'] = esc_attr($style['row_stretch']);
	}
	if( !empty( $style['mobile_padding'] ) ) {
		$attr['class'][] = esc_attr($style['mobile_padding']);
	}
    if( !empty( $style['column_padding'] ) ) {
       $attr['class'][] = 'no-col-padding';
    }
    
	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'planar_row_styles_output', 10, 2);