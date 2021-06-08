<?php
class deep_recnet_post extends WP_Widget {
	function __construct(){
		$params = array('description'=> 'Display recent posts','name'=> 'Webnus-recent posts');
		parent::__construct('deep_recnet_post', '', $params);

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function form($instance) {
		extract($instance);	?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>"><?php esc_html_e('Title:','deep') ?></label><input	type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('title') ) ?>"	name="<?php echo esc_attr( $this->get_field_name('title') ) ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('numberOfPosts') ) ?>"><?php esc_html_e('Number of Posts:','deep') ?></label><input type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('numberOfPosts') ) ?>"	name="<?php echo esc_attr( $this->get_field_name('numberOfPosts') ) ?>"	value="<?php if( isset($numberOfPosts) )  echo esc_attr($numberOfPosts); ?>" /></p>
		<?php
	}

	public function widget($args, $instance) {
		extract($args);
		extract($instance);
		if(!isset($title)) $title='';
		if(!isset($numberOfPosts)) $numberOfPosts=5;
		echo '' . $before_widget;
		if(!empty($title))
			echo '' . $before_title.esc_html($title).$after_title; ?>
			<ul class="wn-recnet_post">
				<?php
				$deep_options = deep_options();
				$deep_sidebar_blog_options	= $deep_options['deep_sidebar_blog_options'] = isset($deep_options['deep_sidebar_blog_options']) ? $deep_options['deep_sidebar_blog_options'] : '' ;
				$deep_no_image_src			= $deep_options['deep_no_image_src'] = isset($deep_options['deep_no_image_src']) ? $deep_options['deep_no_image_src'] : '' ;				$wpbp = new WP_Query(
						array(
							'post_type'			=> 'post',
							'paged'				=> -1,
							'posts_per_page'	=> $numberOfPosts,
							'orderby'			=> 'comment_count'
						)
					);

				if ( $wpbp->have_posts() ) :

					while ($wpbp->have_posts()) :

						$wpbp->the_post(); ?>

						<li class="wn-post post-<?php the_ID(); ?>">
							<h5>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h5>
							<p class="post-date"><?php echo get_the_date(); ?></p>
						</li>
						<?php
					endwhile;
				endif;

		wp_reset_postdata();
		?>
		</ul>
		<?php

		echo '' . $after_widget;
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'deep_recnet_post', true) ) {
			wp_enqueue_style( 'deep-recnet-post-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/recnet-post.css', false, DEEP_VERSION );
		}
	}
}

add_action('widgets_init', 'register_deep_recnet_post');
function register_deep_recnet_post(){
	register_widget('deep_recnet_post');
}
