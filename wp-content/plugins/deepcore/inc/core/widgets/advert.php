<?php class WebnusAdvertisementWidget extends WP_Widget {
	function __construct(){
		$params = array('description'=> 'Webnus Advertisement Widget','name'=> 'Webnus-Ad');
		parent::__construct('WebnusAdvertisementWidget', '', $params);
	}

	public function form($instance) {
		extract($instance); ?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>"><?php esc_html_e('Title:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ) ?>" name="<?php echo esc_attr( $this->get_field_name('title') ) ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('link') ) ?>"><?php esc_html_e('Ad link URL:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('link') ) ?>" name="<?php echo esc_attr( $this->get_field_name('link') ) ?>" value="<?php if( isset($link) )  echo esc_attr($link); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('imageurl') ) ?>"><?php esc_html_e('Image URL:','deep') ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('imageurl') ) ?>" name="<?php echo esc_attr( $this->get_field_name('imageurl') ) ?>" value="<?php if( isset($imageurl) )  echo esc_attr($imageurl); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('html_content') ) ?>"><?php esc_html_e('Html content:','deep') ?></label><textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('html_content') ) ?>" name="<?php echo esc_attr( $this->get_field_name('html_content') ) ?>"><?php if( isset($html_content) )  echo esc_attr($html_content); ?></textarea></p>
		<?php
	}

	public function widget($args, $instance) {
		extract($args);
		extract($instance);
		echo '' . $before_widget;
		if(!empty($title))
			echo '' . $before_title.esc_html($title).$after_title;
		?>
		<div class="webnus-ad">
		<?php
		if(empty($link)) $link = '';
		if(empty($imageurl)) $imageurl = '';
		if(empty($html_content)) $html_content = '';
		if(!empty($imageurl))
		{
			if(!empty($link)) echo '<a href="'.esc_url($link).'">';
				echo '<img src="'.$imageurl.'" alt="Advertisement" />';
			if(!empty($link)) echo '</a>';
		}else
			echo '' . $html_content;
		?>
		<div class="clear"></div>
		</div>
	  <?php echo '' . $after_widget;
	}
}

add_action('widgets_init','register_deep_advertisement_widget');
function register_deep_advertisement_widget(){
	register_widget('WebnusAdvertisementWidget');
}
