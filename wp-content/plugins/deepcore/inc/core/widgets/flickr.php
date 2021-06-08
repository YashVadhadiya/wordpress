<?php
class YFlickr extends WP_Widget {
	function __construct(){
		$params = array('description'=> 'Your recent photos from flickr will be displayed',	'name'=> 'Webnus-Flickr');
		parent::__construct('YFlickr', '', $params);

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function form($instance) {
		extract($instance);
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:','deep') ?></label><input type="text" class="widefat"	id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"	name="<?php echo esc_attr( $this->get_field_name('title') ); ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p><p>
		<label for="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>"><?php esc_html_e('Flickr Script:','deep') ?></label><textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('flickr') ); ?>"><?php if( isset($flickr) )  echo esc_attr($flickr); ?></textarea></p>
		<?php
	}

	public function widget($args, $instance) {
		extract($args);
		extract($instance);
		echo '' . $before_widget;
		if(!empty($title))
			echo '' . $before_title.esc_html($title).$after_title;	?>
		<div class="flickr-feed">
		<?php echo '' . $flickr ?>
		<div class="clear"></div>
		</div>
		<?php echo '' . $after_widget;
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'yflickr', true) ) {
			wp_enqueue_style( 'deep-flickr-feed-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/flickr-feed.css', false, DEEP_VERSION );
		}
	}

}

add_action('widgets_init','register_deep_yflicker');
function register_deep_yflicker(){
	register_widget('YFlickr');
}
