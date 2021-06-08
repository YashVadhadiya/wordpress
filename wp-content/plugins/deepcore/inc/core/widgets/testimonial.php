<?php
class WebnusTestimonialWidget extends WP_Widget {

	function __construct(){
		$params = array(
			'description'	=> 'Webnus Testimonial Widget',
			'name'			=> 'Webnus-Testimonial'
		);
		parent::__construct( 'WebnusTestimonialWidget', '', $params );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Widget Form.
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		extract( $instance );
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>"><?php esc_html_e('Title:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ) ?>" name="<?php echo esc_attr( $this->get_field_name('title') ) ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('image') ) ?>"><?php esc_html_e('Image URL:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('image') ) ?>" name="<?php echo esc_attr( $this->get_field_name('image') ) ?>" value="<?php if( isset($image) )  echo esc_attr($image); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('name') ) ?>"><?php esc_html_e('Name:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('name') ) ?>" name="<?php echo esc_attr( $this->get_field_name('name') ) ?>" value="<?php if( isset($name) )  echo esc_attr($name); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('subtitle') ) ?>"><?php esc_html_e('Subtitle:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('subtitle') ) ?>" name="<?php echo esc_attr( $this->get_field_name('subtitle') ) ?>" value="<?php if( isset($subtitle) )  echo esc_attr($subtitle); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('text') ) ?>"><?php esc_html_e('Text:','deep') ?></label><textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('text') ) ?>" name="<?php echo esc_attr( $this->get_field_name('text') ) ?>"><?php if( isset($text) )  echo esc_attr($text); ?></textarea></p>
		<?php
	}

	/**
	 * Widget Output.
	 *
	 * @since 1.0.0
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		echo wp_kses($before_widget, wp_kses_allowed_html( 'post' ) );
		if ( ! empty( $title ) ) {
			echo wp_kses( $before_title, wp_kses_allowed_html( 'text' ) );
			echo wp_kses( $title, wp_kses_allowed_html( 'text' ) );
			echo wp_kses( $after_title, wp_kses_allowed_html( 'text' ) );
		}

		$image		= ( isset( $image ) ) ? $image : '' ;
		$name		= ( isset( $name ) ) ? $name : '' ;
		$subtitle	= ( isset( $subtitle ) ) ? $subtitle : '' ;
		$text		= ( isset( $text ) ) ? $text : '' ;
		$out		= '';
		?>
		<div class="testimonial testimonial1">
			<div class="testimonial-content content">
				<?php if ( $text ) { ?>
					<h4><q><?php echo wp_kses( $text, wp_kses_allowed_html( 'post' ) ); ?></q></h4>
				<?php } ?>
			</div>
			<div class="testimonial-brand">
				<?php if( $name ) { ?>
					<h5><strong><?php echo wp_kses( $name, wp_kses_allowed_html( 'post' ) ); ?></strong><br>
				<?php } ?>
				<?php if( $subtitle ) { ?>
					<em><?php echo wp_kses( $subtitle, wp_kses_allowed_html( 'post' ) ); ?></em></h5>
				<?php } ?>
				<?php if( $image ) { ?>
					<img src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr( $name ); ?>">
				<?php } ?>
			</div>
		</div>
		<?php
		echo wp_kses( $after_widget, wp_kses_allowed_html( 'text' ) );
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'webnustestimonialwidget', true) ) {
			wp_enqueue_style( 'deep-testimonial-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/testimonial.css', false, DEEP_VERSION );
		}
	}

}

function register_deep_testimonial_widget(){
	register_widget('WebnusTestimonialWidget');
}
add_action('widgets_init','register_deep_testimonial_widget');
