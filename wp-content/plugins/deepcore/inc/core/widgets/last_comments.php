<?php
if ( ! is_plugin_active( 'buddypress/bp-loader.php' ) ) {
    return;
}
// Register and load the widget
function deep_bp_last_comments_load_widget() {
    register_widget( 'deep_bp_last_comments_widget_plugin' );
}
add_action( 'widgets_init', 'deep_bp_last_comments_load_widget' );


// Get SQL records from DB
function bp_get_recent_comments($number_blogs) {
	global $wpdb;

	$recent_blogs = $wpdb->get_results( "SELECT user_id, content, item_id, id, date_recorded FROM {$wpdb->prefix}bp_activity WHERE TYPE = 'activity_comment' ORDER BY date_recorded DESC LIMIT $number_blogs" );
	return $recent_blogs;
 
 }
 
 // Draw html line for each comment
 function bp_show_recent_comments($number_blogs, $show_date) {
	$recent_blogs = bp_get_recent_comments($number_blogs);
					
	foreach($recent_blogs as $recent_blog):
		$domain = get_option('siteurl');
		$blog_url = $domain."/activity/p/".$recent_blog->item_id ."/#acomment-".$recent_blog->id;
		$blog_content = $recent_blog->content;
		$the_date = mysql2date( get_option( 'date_format' ), $recent_blog->date_recorded);
		mb_internal_encoding("UTF-8");
?>
			<li class="wn-bp-comment">
				<div class="title-wrap">
					<h5 class="wn-bp-comment-title">
						<i class="ti-comments"></i>
						<a href="<?php echo '' . $blog_url;?>"><?php echo stripslashes(mb_substr(esc_attr($blog_content), 0, 60)); ?></a>
					</h5>
				</div>
				<?php if ( $show_date ) : ?>
					<p class="wn-bp-comment-post-date"><?php echo '' . $the_date; ?></p>
				<?php endif; ?>
			</li>
<?php 
	endforeach;
 } 
 
// Creating the widget 
class deep_bp_last_comments_widget_plugin extends WP_Widget { 
	
	// Constructor
	function __construct() {
		parent::__construct(
		 
		// Base ID of your widget
		'deep_bp_last_comments_widget_plugin', 
		 
		// Widget name will appear in UI
		__('(BuddyPress) Last Comments Widget', 'deep'), 
		 
		// Widget description
		array( 'description' => __( 'BP widget based on last activity comments', 'deep' ), ) 
		);
	}
	 
	// Creating Frontend widget	 
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		 
		// before and after widget arguments are defined by themes
		echo '' . $args['before_widget'];
		if ( ! empty( $title ) )
			echo '' . $args['before_title'] . $title . $args['after_title'];
		 
		// This is where you run the code and display the output
		echo '
		<ul class="wn-bp-last-comments">';
			bp_show_recent_comments($instance['count'], $show_date);
		echo '
		</ul>';
		
		echo '' . $args['after_widget'];
	}
			 
	// Widget Backend (admin) widget
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'deep' );
		}
		$count 		= ! empty( $instance['count'] ) ? absint( $instance['count'] ) : '3';
		$show_date 	= isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
	?>
		<p>
			<label for="<?php echo '' . $this->get_field_id( 'title' ); ?>"><?php _e( 'Last Comments Widget Title:', 'deep' ); ?></label> 
			<input class="widefat" type="text" id="<?php echo '' . $this->get_field_id( 'title' ); ?>" name="<?php echo '' . $this->get_field_name( 'title' ); ?>"  value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo '' . $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of comments:', 'deep' ); ?></label>
			<input class="widefat" type="text" id="<?php echo '' . $this->get_field_id( 'count' ); ?>" name="<?php echo '' . $this->get_field_name( 'count' ); ?>" value="<?php echo esc_attr( absint( $count ) ); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo '' . $this->get_field_id( 'show_date' ); ?>" name="<?php echo '' . $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo '' . $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display date?', 'deep' ); ?></label>
		</p>
	<?php 
	}
		 
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = absint($new_instance['count'] ) ;
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}
} // Class bp_last_comments_plugin ends here
 
/* Stop Adding Functions Below this Line */
?>