<?php
class deep_facebook_widget extends WP_Widget{
	
	function __construct() {
		$params = array(
			'name'			=> __( 'Webnus - Facebook', 'deep' ),
			'description'	=> __( 'Your recently posts from facebook will be displayed', 'deep' ),
		);
		parent::__construct( 'deep_facebook_widget', '', $params );
	}

	/**
	 * Widget Form.
	 *
	 * @author Webnus
	 * @since 1.0.0
	 */
	public function form($instance){
		extract($instance);
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:','deep') ?></label><input	type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"	name="<?php echo esc_attr( $this->get_field_name('title') ); ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('url') ); ?>"><?php esc_html_e('Page Address:','deep') ?></label><input type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('url') ); ?>"	name="<?php echo esc_attr( $this->get_field_name('url') ); ?>"	value="<?php if( isset($url) )  echo esc_attr($url); ?>" /><small><?php esc_html_e( 'Your Page address', 'deep' ); ?></small></p>			
		<?php 
	}

	/**
	 * Widget Output.
	 *
	 * @author Webnus
	 * @since 1.0.0
	 */
	public function widget($args, $instance){
		extract( $args );
		extract( $instance );
		echo wp_kses( $before_widget, wp_kses_allowed_html( 'post' ) );
		if( ! empty( $title ) ) {
			echo wp_kses( $before_title, wp_kses_allowed_html( 'post' ) );
			echo wp_kses( $title, wp_kses_allowed_html( 'post' ) );
			echo wp_kses( $after_title, wp_kses_allowed_html( 'post' ) );
		} ?>
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=283742071785556&version=v2.0";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<div class="fb-like-box" data-href="<?php echo esc_url( $url ); ?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
		<?php echo wp_kses( $after_widget, wp_kses_allowed_html( 'post' ) );
	} 
}

add_action( 'widgets_init', 'register_deep_facebook' ); 
function register_deep_facebook() {
	register_widget( 'deep_facebook_widget' );
}