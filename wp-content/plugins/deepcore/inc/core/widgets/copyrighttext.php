<?php
class crtext extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Your copyright will be displayed','name'=> 'Webnus-Footer Copyright');
		parent::__construct('crtext', '', $params);
	}
	public function form($instance){
		extract($instance);	?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>"/></p>		
		<p><label for="<?php echo esc_attr( $this->get_field_id('copyright') ); ?>"><?php esc_html_e('Copyright Text:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('copyright') ); ?>" name="<?php echo esc_attr( $this->get_field_name('copyright') ); ?>" value="<?php if( isset($copyright) )  echo esc_attr($copyright); ?>" /></p>
		<?php 
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		if(!isset($title)) $title='';
		echo '' . $before_widget;
		if(!empty($title))
			echo '' . $before_title.esc_html($title).$after_title;	?>
		<p>
		<?php echo  $copyright; ?>
		</p>
		<?php echo '' . $after_widget;
	} 
}
add_action('widgets_init', 'register_deep_crtext');
function register_deep_crtext(){
	register_widget('crtext');
}