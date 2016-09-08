<?php
/**
 * Theme Customizer Custom Textarea Control
 * @package Planar
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Planar_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
		public function render_content() {
		?>
	        <label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<textarea rows="5" class="custom-textarea" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
	        </label>
	        <?php
		}
	}
}