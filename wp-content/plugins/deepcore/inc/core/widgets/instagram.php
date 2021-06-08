<?php
class WebnusInstagramWidget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Your recent posts from instagram will be displayed','name'=> 'Webnus-Instagram');
		parent::__construct('WebnusInstagramWidget', '', $params);

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function form($instance){
		$instance = wp_parse_args( (array) $instance, array(
			'title' => __( 'Instagram', 'deep' ),
			'token' => '',
			'number' => 3,
		) );
		$title = $instance['title'];
		$token = $instance['token'];
		$number = absint( $instance['number'] );
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'deep' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'token' ) ); ?>"><?php esc_html_e( 'Token', 'deep' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'token' ) ); ?>" type="text" value="<?php echo esc_attr( $token ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts', 'deep' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /></label></p>
		<?php
	}

	public function widget($args, $instance){
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$token = empty( $instance['token'] ) ? '' : $instance['token'];
		$limit = empty( $instance['number'] ) ? 3 : $instance['number'];
		$image_count = 0;
		echo $args['before_widget'];

		if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };


		if ( $token ) {
			$img_data = deep_theme_instagram($token);
			$images = json_decode($img_data['body']);

			echo '<ul class="instagram-pics">';

			foreach($images->data as $content) {
				$image_count++;

				echo '<li><a href="'. esc_url( $content->permalink ) .'"><img src="' . esc_url( $content->media_url ) .'"/></a></li>';

				if ( $image_count >= $limit) {
					break;
				}

			}
			echo '</ul>';


		}
		?>


		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['token'] = trim( strip_tags( $new_instance['token'] ) );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		return $instance;
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'webnusinstagramwidget', true) ) {
			wp_enqueue_style( 'deep-instagram-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/instagram.css', false, DEEP_VERSION );
		}
	}

}

add_action('widgets_init','register_deep_instagram_widget');
function register_deep_instagram_widget(){
	register_widget('WebnusInstagramWidget');
}
