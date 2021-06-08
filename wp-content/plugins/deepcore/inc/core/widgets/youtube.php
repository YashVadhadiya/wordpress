<?php
class deep_youtube_widget extends WP_Widget {
	
	function __construct() {
		$params = array(
			'description' => 'Youtube Box',
			'name'        => 'Webnus - Youtube',
		);
		parent::__construct( 'deep_youtube_widget', '', $params );
	}

	/**
	 * Widget Form.
	 *
	 * @author Webnus
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		extract( $instance ); ?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'deep' ); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo isset( $title ) ? esc_attr( $title ) : ''; ?>"></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php esc_html_e( 'Channel ID:', 'deep' ); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>" value="<?php echo isset( $id ) ? esc_attr( $id ) : ''; ?>"><p><?php echo esc_html__( 'Channel ID is in the channel url usually it will start with UC example: https://www.youtube.com/channel/UCmQ-VeVK7nLR3bGpAkSYB1Q', 'deep' ); ?></p></p>
		<?php
	}

	/**
	 * Widget Output.
	 *
	 * @author Webnus
	 * @since 1.0.0
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		echo wp_kses( $before_widget, wp_kses_allowed_html( 'post' ) );
		if ( ! empty( $title ) ) {
			echo wp_kses( $before_title, wp_kses_allowed_html( 'post' ) );
			echo wp_kses( $title, wp_kses_allowed_html( 'post' ) );
			echo wp_kses( $after_title, wp_kses_allowed_html( 'post' ) );
		}
		?>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<div class="g-ytsubscribe" data-channelid="<?php echo esc_attr( $id ); ?>" data-layout="full" data-count="default"></div>
		<?php
		echo wp_kses( $after_widget, wp_kses_allowed_html( 'post' ) );
	}
}

add_action( 'widgets_init', 'register_deep_youtube' );
function register_deep_youtube() {
	register_widget( 'deep_youtube_widget' );
}
