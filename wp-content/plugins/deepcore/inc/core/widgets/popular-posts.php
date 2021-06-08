<?php
class deep_PopularPosts extends WP_Widget {

	public $sidebar_type;

	function __construct(){
		$params = array('description'=> 'Display Popular Posts','name'=> 'Webnus-Popular Posts');
		parent::__construct('deep_PopularPosts', '', $params);

		$this->sidebar_type = deep_options()['deep_sidebar_blog_options'];

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
		echo $before_widget;
		if(!empty($title))
			echo $before_title . esc_html($title) . $after_title; ?>
		<div class="side-list">
			<ul class="wn-popularposts">
				<?php
				$deep_options = deep_options();
				$deep_sidebar_blog_options	= $deep_options['deep_sidebar_blog_options'] = isset($deep_options['deep_sidebar_blog_options']) ? $deep_options['deep_sidebar_blog_options'] : '' ;
				$deep_no_image_src			= $deep_options['deep_no_image_src'] = isset($deep_options['deep_no_image_src']['url']) ? $deep_options['deep_no_image_src']['url'] : '' ;				$wpbp = new WP_Query(
					array(
						'post_type'			=> 'post',
						'paged'				=> -1,
						'posts_per_page'	=> $numberOfPosts,
						'orderby'			=> 'comment_count'
					)
					);

				$temp_out = "";
				if ( $wpbp->have_posts() ) :
					while ($wpbp->have_posts()) :
						$wpbp->the_post();

						$thumbnail_url = get_the_post_thumbnail_url();
						$thumbnail_id  = get_post_thumbnail_id();
						if ( $deep_sidebar_blog_options == 'personal-sidebar' ) { ?>
							<li>
								<?php
								if ( $thumbnail_url ) { ?>
									<img src="<?php echo esc_attr( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" > <?php
								} ?>
								<div class="personal">
									<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<p class="date"><?php the_time(get_option( 'date_format' )); ?> | <?php comments_number(); ?></p>
								</div>
							</li>
						<?php } elseif ( $deep_sidebar_blog_options == 'magazine-sidebar' ) { ?>
							<li>
								<a href="<?php the_permalink(); ?>">
									<?php
									if( !empty( $thumbnail_url ) && !empty( $thumbnail_id ) ) {
										if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
											require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
										}
										$image = new Wn_Img_Maniuplate;
										$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '120' , '89' );
									}
									if ( $thumbnail_url ) { ?>
										<img src="<?php echo esc_attr( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" > <?php
									} else { ?>
										<img src="<?php echo $deep_no_image_src; ?>" alt="<?php the_title(); ?>">
									<?php } ?>
								</a>
								<div class="latest-post-right-sec">
									<p class="date"><?php the_time(get_option( 'date_format' )); ?></p>
									<h5>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h5>
								</div>
								<p><?php comments_number(); ?></p>
							</li>
						<?php } else { ?>
							<li>
								<?php
								if ( $thumbnail_url ) { ?>
									<img src="<?php echo esc_attr( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" > <?php
								} else { ?>
									<img src="<?php echo $deep_no_image_src; ?>" alt="<?php the_title(); ?>">
								<?php } ?>
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							</li>
						<?php }
			endwhile;
		endif;

		wp_reset_postdata();
		?>
		</ul>
	</div>
		<?php

		echo $after_widget;
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'deep_popularposts', true) ) {
			if ( $this->sidebar_type == 'default' ) {
				wp_enqueue_style( 'deep-popular-posts-default-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/popular-posts.css', false, DEEP_VERSION );
			} elseif ( $this->sidebar_type == 'personal-sidebar' ) {
				wp_enqueue_style( 'deep-popular-posts-personal-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/popular-posts-personal.css', false, DEEP_VERSION );
			} elseif ( $this->sidebar_type == 'magazine-sidebar' ) {
				wp_enqueue_style( 'deep-popular-posts-magazine-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/popular-posts-magazine.css', false, DEEP_VERSION );
			}
		}
	}
}

add_action('widgets_init', 'register_deep_PopularPosts');
function register_deep_PopularPosts(){
	register_widget('deep_PopularPosts');
}
