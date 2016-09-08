<?php
/**
 * Custom Widget Section of Posts for Home Page
 * @package Planar
 */
add_action('widgets_init', create_function('', 'register_widget("Planar_Post_HomeWidgets");'));

class Planar_Post_HomeWidgets extends WP_Widget {
	function __construct() {
		parent::__construct(
			'post_home_widgets',
			'Planar ' . __( 'Homepage Recent Posts', 'planar-lite' ),
			array(
				'classname' => 'post_home_widgets', 
				'description' => __( 'Recent posts on the Home Page.', 'planar-lite' ),
			)
		);
 	}

 	function form( $instance ) {
		$planar_defaults[ 'title_section' ] = __( 'Recent Posts', 'planar-lite' );
 		$planar_defaults[ 'text_main' ] = __( 'The widget for displaying recent posts on the Home Page.', 'planar-lite' );
		$planar_defaults[ 'category' ] = '';
 		$planar_defaults[ 'button_text' ] = '';
		$planar_defaults[ 'limit_num' ] = '4';
		$planar_defaults[ 'cols_num' ] = '4';
 		$planar_defaults[ 'button_url' ] = '';
 		$instance = wp_parse_args( (array) $instance, $planar_defaults );
		$title_section = esc_attr( $instance[ 'title_section' ] );
		$text_main = esc_textarea( $instance[ 'text_main' ] );
                                $category = esc_attr( $instance['category'] );
		$button_text = esc_attr( $instance[ 'button_text' ] );
		$limit_num = esc_attr( $instance[ 'limit_num' ] );
		$cols_num = esc_attr( $instance[ 'cols_num' ] );
		$button_url = esc_url( $instance[ 'button_url' ] );
		?>

		<p><?php _e( 'The widget for displaying recent posts on the Home Page.', 'planar-lite' ); ?></p>

		<p>
		<label for="<?php echo $this->get_field_id('title_section'); ?>"><?php _e( 'Title:','planar-lite' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title_section'); ?>" name="<?php echo $this->get_field_name('title_section'); ?>" type="text" value="<?php echo esc_attr($title_section); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( 'Category:', 'planar-lite' ); ?></label>
		<select id="<?php echo $this->get_field_id('category'); ?>"
			name="<?php echo $this->get_field_name('category'); ?>">
			<?php
			echo '<option value="0" ' .('0' == $category ? 'selected="selected"' : ''). '>'. __('All categories', 'planar-lite').'</option>';
			$cats = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'category', 'hierarchical' => 1 ) );
			foreach($cats as $cat) {
				echo '<option value="' . $cat->term_id . '" ' .($cat->term_id == $category ? 'selected="selected"' : ''). '>' . $cat->name . '</option>';
			} ?>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('text_main'); ?>"><?php _e( 'Intro Text:','planar-lite' ); ?></label>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text_main'); ?>" name="<?php echo $this->get_field_name('text_main'); ?>"><?php echo $text_main; ?></textarea>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('limit_num'); ?>"><?php _e( 'Number of posts to show:', 'planar-lite' ); ?></label>
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
		$instance[ 'category' ] = esc_attr( $new_instance[ 'category' ] );
		$instance[ 'limit_num' ] = strip_tags( $new_instance[ 'limit_num' ] );
		$instance[ 'cols_num' ] = strip_tags( $new_instance[ 'cols_num' ] );
		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$text_main = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
 		$title_section = empty( $instance['title_section'] ) ? '' : $instance['title_section'];
 		$limit_num = isset( $instance[ 'limit_num' ] ) ? $instance[ 'limit_num' ] : ''; 
 		$cols_num = isset( $instance[ 'cols_num' ] ) ? $instance[ 'cols_num' ] : ''; 
 		$button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : ''; 		
 		$button_url = isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '#';
		echo $before_widget;
		?>

				<div class="section-page clearfix">
					<?php if( !empty( $title_section ) ) { ?>
						<h1 class="title-section"><?php echo esc_attr( $title_section ); ?></h1>
					<?php } ?>
					<?php if( !empty( $text_main ) ) { ?>
						<p class="intro-section"><?php echo esc_html( $text_main ); ?></p>
					<?php } ?>

<?php
$args = array(
	'posts_per_page' => $limit_num,
	'cat' => $category,
	'post__not_in' => get_option('sticky_posts'),
	'post_status' => 'publish'
);
	$q = new WP_Query( $args );

	if( $q->have_posts() ):
?>
			<div class="grid<?php echo esc_attr( $cols_num ); ?> recent-posts clearfix">
<?php
	while( $q->have_posts() ): $q->the_post(); ?>

			<div class="col">
<?php
	if ( has_post_thumbnail() ) { ?>
				<figure class="recent-blog-thumbnail">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
						<?php the_post_thumbnail( 'planar-rectangulum' ); ?>
					</a>
				</figure>
<?php
	} ?>

<?php if ( ! has_post_thumbnail() ) { ?>
	<div style="min-height: 50px;"></div><!-- no thumbnails -->
<?php } ?>
				<span class="meta-date-post"><?php the_time('M d, Y'); ?></span>
				<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
			</div><!-- .col -->
<?php
	endwhile; ?>
			</div><!-- .recent-posts-->
<?php
		endif;
		wp_reset_postdata();
?>

					<?php if( !empty( $button_url ) ) { ?>		
		<div><a href="<?php echo esc_url( $button_url ); ?>" class="btn"><?php echo esc_html( $button_text ); ?></a></div>
					<?php } ?>
				</div>

		<?php 
		echo $after_widget;
 	}
 }