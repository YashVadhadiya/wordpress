<?php
class deep_daily_post extends WP_Widget {

	function __construct() {

		$params = array(
			'name'			=> esc_html__( 'Webnus Daily Post', 'deep' ),
			'description'	=> esc_html__( 'If you select multi post it will change to carousel', 'deep' ),
		);

		parent::__construct( 'deep_daily_post', '', $params );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}


	public function form( $instance ) {

		extract($instance);	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>"><?php esc_html_e('Title:','deep') ?></label>
			<input
				type="text"
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id('title') ) ?>"
				name="<?php echo esc_attr( $this->get_field_name('title') ) ?>"
				value="<?php if( isset($title) )  echo esc_attr($title); ?>"
			>
		</p>
		<?php

		if( $instance )
			$select = $instance['select'];
		else
			$select = array( '0' => '1' );

		$get_posts = get_posts( array(
			'offset'			=> 1,
			'orderby'			=> 'date',
			'order'				=> 'DESC',
			'posts_per_page'	=> -1,
			'post_status'		=> 'publish'
		)); ?>

		<?php
		if( ! empty( $get_posts  ) ) {

				echo '<label for="%s">' . esc_html__('Posts:','deep') . '</label>';
				printf(
					'<select multiple="" name="%s[]" id="%s" class="widefat" size="15">',
					$this->get_field_name('select'),
					$this->get_field_id('select')
				);

				foreach( $get_posts as $post ) {

						printf(
							'<option value="%s" class="hot-topic" %s>%s</option>',
							$post->ID,
							in_array( $post->ID, $select) ? 'selected="selected"' : '',
							$post->post_title
						);
				}

			echo '</select><p style="margin-top: 0; margin-bottom: 20px;">' . esc_html__( 'If you select multi post it will change to carousel', 'deep' ) . '</p>';
		} else {
			echo esc_html__( 'No posts found', 'deep' );
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance			= $old_instance;
		$instance['title']	= ! empty( $new_instance['title'] ) ? $new_instance['title'] : '' ;
		$instance['select'] = ! empty( $new_instance['select'] ) ? esc_sql( $new_instance['select'] ) : '' ;

		return $instance;
	}

	public function widget( $args, $instance ) {
		wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21' . '.css' );

		extract( $args );
		extract( $instance );
		$title	= $title ? $before_title . esc_html($title) . $after_title : '';

		if ( ! empty( $select ) ) {

			$dailypost_arg = array(
				'order'				=> 'date',
				'posts_per_page'	=> -1,
				'post__in'			=> $select,
			);

			echo '' . $before_widget;

					echo '' . $title;

					// The Query
					$daily_post = new WP_Query( $dailypost_arg );
					$uniqid 	= uniqid();

					// The Loop
					if ( $daily_post->have_posts() ) {

						echo '<div class="wn-daily-post-wrap">';
							if ( $daily_post->post_count > 1 ) {
								echo '<div class="wn-daily-post-carousel owl-carousel owl-theme">';
							}
						while ( $daily_post->have_posts() ) {

							$daily_post->the_post();

							$thumbnail_id = get_post_thumbnail_id();
							$thumbnail_url = get_the_post_thumbnail_url();
							?>

							<article class="latest-b21 wn-daily-post">
								<figure class="latest-b21-img">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo '' . $thumbnail_url ?>" alt="<?php the_title(); ?>" >
									</a>
								</figure>
								<div class="latest-b21-cont">
									<div class="latest-b21-category" style="background: <?php echo deep_category_color(); ?>;">
										<span class="latest-b21-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category(', '); ?></span>
									</div>
									<div class="latest-b21-date">
										<i class="pe-7s-clock"></i><?php echo get_the_date();?>
									</div>
									<h3 class="latest-b21-title"><a href="<?php the_permalink(); ?>" class="hcolorf"><?php the_title(); ?></a></h3>
									<div class="latest-author">
										<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
										<span><?php the_author_posts_link(); ?></span>
									</div>
								</div>
							</article><?php

						}
						if ( $daily_post->post_count > 1 ) {
							echo '</div>';
						}
						echo '</div>';

						/* Restore original Post Data */
						wp_reset_postdata();
					} else {
						echo '<p>' . esc_html__( 'No post found', 'deep' ) . '</p>';
					}

			echo '' . $after_widget;
		}
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'deep_daily_post', true) ) {
			wp_enqueue_style( 'deep-owl-carousel', DEEP_ASSETS_URL . 'css/frontend/plugins/owl-carousel.css', false, DEEP_VERSION );
			wp_enqueue_script( 'deep-owl-carousel', DEEP_ASSETS_URL . 'js/frontend/plugins/owl.js', array( 'jquery' ), DEEP_VERSION, true );
			wp_enqueue_script( 'deep-daily-post', DEEP_ASSETS_URL . 'js/frontend/wp-widgets/daily-post.js', array( 'jquery' ), DEEP_VERSION, true );
			wp_enqueue_style( 'deep-daily-post-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/daily-post.css', false, DEEP_VERSION );
		}
	}

}

add_action( 'widgets_init', 'deep_daily_post' );
function deep_daily_post() {
	register_widget( 'deep_daily_post' );
}
