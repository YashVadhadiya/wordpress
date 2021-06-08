<?php
class deep_subscribe_widget extends WP_Widget {

	public $sidebar_type;

	function __construct() {
		$params = array(
			'name'        => 'Webnus - Subscribe',
			'description' => 'Email Subscribe',
		);
		parent::__construct( 'deep_subscribe_widget', '', $params );

		$this->sidebar_type = deep_options()['deep_sidebar_blog_options'];

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Widget Form.
	 *
	 * @author Webnus
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		extract( $instance );
		$defaults = array(
			'type'    => 'FeedBurner',
			'display' => 'one',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"><?php esc_html_e( 'Display Type:', 'deep' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>" class="widefat" style="width:100%;">
			<option <?php echo 'one' == $instance['display'] ? 'selected="selected"' : ''; ?> >one</option>
			<option <?php echo 'two' == $instance['display'] ? 'selected="selected"' : ''; ?> >two</option>
		</select>
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'deep' ); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="
								  <?php
									if ( isset( $title ) ) {
										echo esc_attr( $title );}
									?>
		"/></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Subscribe Service:', 'deep' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" class="widefat" style="width:100%;">
		<option 
		<?php
		if ( 'FeedBurner' == $instance['type'] ) {
			echo 'selected="selected"';}
		?>
		>FeedBurner</option>
		<option 
		<?php
		if ( 'MailChimp' == $instance['type'] ) {
			echo 'selected="selected"';}
		?>
		>MailChimp</option>
		</select></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php esc_html_e( 'Feedburner ID:', 'deep' ); ?></label>	<input type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>" value="
								  <?php
									if ( isset( $id ) ) {
										echo esc_attr( $id );}
									?>
		"/></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'Mailchimp form action URL:', 'deep' ); ?></label>	<input type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" value="
								  <?php
									if ( isset( $url ) ) {
										echo esc_attr( $url );}
									?>
		"/></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Custom text:', 'deep' ); ?></label><textarea class="widefat"	id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"
		>
		<?php
		if ( isset( $text ) ) {
			echo esc_attr( $text );}
		?>
		</textarea></p>
		<?php
	}

	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		echo '' . $before_widget;
		if ( ! empty( $title ) ) {
			echo '' . $before_title . esc_html( $title ) . $after_title;
		}

		$display_type_id = 'type-' . $display;
		$feedburner_id   = esc_html( $id );
		$mailchimp_url   = esc_url( $url );
		$subscribe_text  = esc_html( $text );

		if ( $type == 'feedburner' ) {
			$email_name = 'email';
			echo '<form class="widget-subscribe-form ' . $display_type_id . '" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onSubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri=' . $feedburner_id . '\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true"><input type="hidden" value="' . $feedburner_id . '" name="uri"/><input type="hidden" name="loc" value="en_US"/>';
		} else {
			$email_name = 'MERGE0';
			echo '<form class="widget-subscribe-form ' . $display_type_id . '" action="' . $mailchimp_url . '" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">';
		}
		echo $subscribe_text ? '<p>' . $subscribe_text . '</p>' : '';
		echo '<div class="wn-form-wrap"><input class="widget-subscribe-email" type="text" name="' . $email_name . '" placeholder="' . esc_html__( 'Enter your email', 'deep' ) . '"/><button class="widget-subscribe-submit" type="submit">' . esc_html__( 'Go ', 'deep' ) . '</button></div></form>';
		echo '' . $after_widget;
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'deep_subscribe_widget', true) ) {
			if ( $this->sidebar_type == 'default' ) {
				wp_enqueue_style( 'deep-subscribe-default-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/subscribe-default.css', false, DEEP_VERSION );
			} elseif ( $this->sidebar_type == 'personal-sidebar' ) {
				wp_enqueue_style( 'deep-subscribe-personal-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/subscribe-personal.css', false, DEEP_VERSION );
			}
		}
	}
}

add_action( 'widgets_init', 'register_deep_subscribe' );
function register_deep_subscribe() {
	register_widget( 'deep_subscribe_widget' );
}
