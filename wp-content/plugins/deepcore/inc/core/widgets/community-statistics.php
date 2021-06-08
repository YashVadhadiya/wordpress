<?php
if ( ! is_plugin_active( 'buddypress/bp-loader.php' ) ) {
    return;
}
// unregister community stats widget
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'buddy-community-stats/bp-community-stats.php' ) ) {
	unregister_widget('etivite_bp_community_stats_Widget');
}

add_action( 'widgets_init', function(){
     register_widget( 'deep_etivite_bp_community_stats_Widget' );
});

class deep_etivite_bp_community_stats_Widget extends WP_Widget {

	/**
	 * Register the widget
	 */
	public function __construct() {
	
		parent::__construct( 
			'community_stats_widget', // Base ID
			__( 'Webnus Community Stats', 'deep' ), // Name
			array( 'description' => __( 'Display your community total counts', 'deep' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
     * since 2.0
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		
		echo '' . $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo '' . $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		// don't load the widget on these pages
		if ( bp_is_register_page() || bp_is_activation_page() )
			return;
		
	    extract( $args );

		$wcounts = array();
	    
	    $data = (array) maybe_unserialize( get_option( 'bp_community_stats_display') );
		
		if ( in_array( 'members', $data ) )
			$wcounts[] = etivite_bp_community_stats_get_members();

		if ( in_array( 'active', $data ) )
			$wcounts[] = etivite_bp_community_stats_get_active();
			
		if ( in_array( 'status', $data ) )
			$wcounts[] = etivite_bp_community_stats_get_status();
				
		if ( in_array( 'groups', $data ) )
			$wcounts[] = etivite_bp_community_stats_get_groups();	
		
		if( is_multisite() ) {
			if ( in_array( 'blogs', $data ) )
				$wcounts[] = etivite_bp_community_stats_get_blogs();
		}

		if ( in_array( 'posts', $data ) )
			$wcounts[] = etivite_bp_community_stats_get_posts();
				
		if ( in_array( 'comments', $data ) )
			$wcounts[] = etivite_bp_community_stats_get_comments();

		echo '<ul class="wn-community-stats">';
				$i = 0;
				$l = count( $wcounts );
				
				foreach ( (array) $wcounts as $count) {
					$isLastItem = ( $i == ( $l - 1 ) );
					
					echo '<li class="wn-community-item">'. $count .'</li>';
					
					++$i;
				}
		echo '</ul>';

		echo '' . $args['after_widget'];

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * since 2.0
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * since 2.0
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Title', 'deep' );
		?>
		<p>
		<label for="<?php echo '' . $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'deep' ); ?></label> 
		<input class="widefat" id="<?php echo '' . $this->get_field_id( 'title' ); ?>" name="<?php echo '' . $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}	
}