<?php
/**
 * Custom Widget Section of Features for Home Page
 * @package Planar
 */
add_action('widgets_init', create_function('', 'register_widget("Planar_Feature_HomeWidgets");'));

class Planar_Feature_HomeWidgets extends WP_Widget {
	function __construct() {
		parent::__construct(
			'feature_home_widgets',
			'Planar ' . __( 'Homepage Features', 'planar-lite' ),
			array(
				'classname' => 'feature_home_widgets', 
				'description' => __( 'Section of Features on the Home Page.', 'planar-lite' ),
			)
		);
 	}

 	function form( $instance ) {
		$planar_defaults[ 'title_section' ] = __( 'Features', 'planar-lite' );
 		$planar_defaults[ 'text_main' ] = __( 'The widget for displaying Features (Woo Features) on the Home Page.', 'planar-lite' );
 		$planar_defaults[ 'button_text' ] = '';
		$planar_defaults[ 'limit_num' ] = '3';
		$planar_defaults[ 'cols_num' ] = '3';
 		$planar_defaults[ 'button_url' ] = '';
		$planar_defaults[ 'category' ] = '0';

 		$instance = wp_parse_args( (array) $instance, $planar_defaults );

		$title_section = esc_attr( $instance[ 'title_section' ] );
		$text_main = esc_textarea( $instance[ 'text_main' ] );
		$button_text = esc_attr( $instance[ 'button_text' ] );
		$limit_num = esc_attr( $instance[ 'limit_num' ] );
		$cols_num = esc_attr( $instance[ 'cols_num' ] );
		$button_url = esc_url( $instance[ 'button_url' ] );
		$category = intval( $instance['category'] );
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title_section'); ?>"><?php _e( 'Title:','planar-lite' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title_section'); ?>" name="<?php echo $this->get_field_name('title_section'); ?>" type="text" value="<?php echo esc_attr($title_section); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('text_main'); ?>"><?php _e( 'Intro Text:','planar-lite' ); ?></label>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_main'); ?>" name="<?php echo $this->get_field_name('text_main'); ?>"><?php echo $text_main; ?></textarea>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'planar-lite' ); ?></label>
		<?php
			$dropdown_args = array( 'taxonomy' => 'feature-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'planar-lite' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
			wp_dropdown_categories( $dropdown_args );
		?>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('limit_num'); ?>"><?php _e( 'Number to show:', 'planar-lite' ); ?></label>
		<input id="<?php echo $this->get_field_id('limit_num'); ?>" name="<?php echo $this->get_field_name('limit_num'); ?>" type="text" value="<?php echo $limit_num; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('cols_num'); ?>"><?php _e( 'Number of columns:', 'planar-lite' ); ?></label>
		<input id="<?php echo $this->get_field_id('cols_num'); ?>" name="<?php echo $this->get_field_name('cols_num'); ?>" type="text" value="<?php echo $cols_num; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e( 'Button Text:', 'planar-lite' ); ?></label>
		<input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e( 'Button Link:', 'planar-lite' ); ?></label>
		<input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		if ( current_user_can('unfiltered_html') )
			$instance['text_main'] =  $new_instance['text_main'];
		else
			$instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text_main']) ) );

		$instance[ 'title_section' ] = esc_attr( $new_instance[ 'title_section' ] );
		$instance[ 'limit_num' ] = strip_tags( $new_instance[ 'limit_num' ] );
		$instance[ 'cols_num' ] = strip_tags( $new_instance[ 'cols_num' ] );
		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );
		$instance['category'] = intval( $new_instance['category'] );

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$text_main = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
 		$title_section = empty( $instance['title_section'] ) ? '' : $instance['title_section'];
 		$limit_num = isset( $instance[ 'limit_num' ] ) ? $instance[ 'limit_num' ] : ''; 
 		$cols_num = isset( $instance[ 'cols_num' ] ) ? $instance[ 'cols_num' ] : ''; 
 		$button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : ''; 		
 		$button_url = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '';
 		$category = ( isset( $instance['category'] ) ) ? $instance['category'] : '';

		echo $before_widget;
		?>

				<div class="section-page clearfix">
					<?php if( !empty( $title_section ) ) { ?>
						<h1 class="title-section"><?php echo esc_attr( $title_section ); ?></h1>
					<?php } ?>
					<?php if( !empty( $text_main ) ) { ?>
						<p class="intro-section"><?php echo esc_html( $text_main ); ?></p>
					<?php } ?>

<?php echo do_shortcode('[woothemes_features custom_links_only="true" size="175" category="'. $category .'" limit="'. $limit_num .'" per_row="'. $cols_num .'"]'); ?>

					<?php if( !empty( $button_url ) ) { ?>		
		<div><a href="<?php echo esc_url( $button_url ); ?>" class="btn"><?php echo esc_html( $button_text ); ?></a></div>
					<?php } ?>
				</div>

		<?php 
		echo $after_widget;
 	}
 }