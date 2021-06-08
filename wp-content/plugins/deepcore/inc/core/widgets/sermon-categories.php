<?php

if ( ! defined('SERMONS_DIR') )
return;

class WebnusSermonCategoriesWidget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Webnus Sermon Categories Widget','name'=> 'Webnus-Sermon Categories');
		parent::__construct('WebnusSermonCategoriesWidget', '', $params);
	}
	public function form($instance){
		extract($instance);	?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:','deep'); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>"	/></p>
		<?php 
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		echo '' . $before_widget;
		if(!empty($title))
			echo '' . $before_title.esc_html($title).$after_title;
		?>
		<div class="webnus-sermon-categories">
            <ul>
                <?php
                    // Shown Sermon Category Lists
                    $wn_sermon_cat = get_object_taxonomies('sermon');
                    if(count($wn_sermon_cat) > 0) {
						$sermon_widget = array(
								'orderby'       => '',
								'show_count'    => 0,
								'pad_counts'    => 0,
								'numberposts' => 1,
								'taxonomy'      => 'sermon_category',
								'title_li'      => ''
							);
						wp_list_categories( $sermon_widget );
                    }
                ?>
            </ul>
            <div class="clear"></div>
		</div>	 
		<?php echo '' . $after_widget;
	} 
}
add_action('widgets_init','deep_widget_sermon_category'); 
function deep_widget_sermon_category(){
	register_widget('WebnusSermonCategoriesWidget');
}