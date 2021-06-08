<?php
class WebnusLoginWidget extends WP_Widget {

	function __construct(){
		$params = array(
			'description'	=> 'Webnus Login Widget',
			'name'			=> 'Webnus-Login'
		);
		parent::__construct('WebnusLoginWidget', '', $params);

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Widget Form.
	 *
	 * @author Webnus
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		extract( $instance ); ?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>"><?php esc_html_e('Title:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ) ?>" name="<?php echo esc_attr( $this->get_field_name('title') ) ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
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
		if( ! empty( $title ) ) {
			echo wp_kses( $before_title, wp_kses_allowed_html( 'post' ) );
			echo wp_kses( $title, wp_kses_allowed_html( 'post' ) );
			echo wp_kses( $after_title, wp_kses_allowed_html( 'post' ) );
		}
		?>
		<div class="webnus-login">
			<?php deep_login(); ?>
			<div class="clear"></div>
		</div>
		<?php
		echo wp_kses( $after_widget, wp_kses_allowed_html( 'post' ) );
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'webnusloginwidget', true) ) {
			wp_enqueue_style( 'deep-login-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/login.css', false, DEEP_VERSION );
		}
	}
}

/**
 * Register Widget.
 *
 * @author Webnus
 * @since 1.0.0
 */
function register_deep_login_widget() {
	register_widget( 'WebnusLoginWidget' );
}
add_action( 'widgets_init','register_deep_login_widget' );
