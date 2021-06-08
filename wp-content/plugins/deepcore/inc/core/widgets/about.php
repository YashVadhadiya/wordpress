<?php class WebnusAboutWidget extends WP_Widget {
	function __construct() {
		$params = array('description'=> 'Webnus About Widget','name'=> 'Webnus-About');
		parent::__construct('WebnusAboutWidget', '', $params);

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function form($instance) {
		extract($instance);	?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:','deep'); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>"	/></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('Name') ); ?>"><?php esc_html_e('Name:','deep'); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('name') ); ?>" value="<?php if( isset($name) )  echo esc_attr($name); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('imageurl') ); ?>"><?php esc_html_e('Image URL:','deep'); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('imageurl') ); ?>" name="<?php echo esc_attr( $this->get_field_name('imageurl') ); ?>" value="<?php if( isset($imageurl) )  echo esc_attr($imageurl); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('description') ); ?>"><?php esc_html_e('Description:','deep'); ?></label><textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('description') ); ?>"><?php if( isset($description) )  echo esc_attr($description); ?></textarea></p>
		<?php
	}

	public function widget($args, $instance) {
		extract($args);
		extract($instance);
		echo '' . $before_widget;
		if(!empty($title))
			echo '' . $before_title.esc_html($title).$after_title;
		?>
		<div class="webnus-about">
		<?php
		if(!empty($imageurl))
			echo '<img alt="" src="'.$imageurl.'" />';
		if(!empty($name))
			echo '<h4>'.$name.'</h4>';
		if(!empty($description))
			echo '<p>'.$description.'</p>';
		?>
		<div class="clear"></div>
		</div>
		<?php echo '' . $after_widget;
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'webnusaboutwidget', true) ) {
			wp_enqueue_style( 'deep-about-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/about.css', false, DEEP_VERSION );
		}
	}

}

add_action('widgets_init','register_deep_about_widget');
function register_deep_about_widget(){
	register_widget('WebnusAboutWidget');
}
