<?php
// Creating the widget
class deep_LatestReview extends WP_Widget {

	function __construct() {
		$params = array(
				'description'	=> 'Display Latest Review',
				'name'			=> 'Webnus - latest review'
		);
		parent::__construct('deep_LatestReview', '', $params);

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function form( $instance ) {
		extract($instance);?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>">
				<?php esc_html_e('Title:','deep') ?>
			</label>
			<input	type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('title') ) ?>"	name="<?php echo esc_attr( $this->get_field_name('title') ) ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('numberOfPosts') ) ?>">
				<?php esc_html_e('Number of Posts:','deep') ?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('numberOfPosts') ) ?>" name="<?php echo esc_attr( $this->get_field_name('numberOfPosts') ) ?>" value="<?php if( isset($numberOfPosts) )  echo esc_attr($numberOfPosts); ?>" />
		</p>
		<?php
	}

	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		if (!isset( $title ) ) $title = '';
		if (!isset( $numberOfPosts ) ) $numberOfPosts = 5;
		echo'' . $before_widget;
		if (!empty( $title ) )
			echo '' . $before_title.esc_html($title).$after_title;
		?>
		<div class="side-list">
			<ul>
				<?php
				$totall_post = $numberOfPosts;
				$post_count  = 0;
				$wpbp = new WP_Query(array( 'post_type' => 'post', 'paged'=>1, 'posts_per_page'=>-1, 'orderby' => 'comment_count'));
				if ( $wpbp->have_posts() ) : while ( $wpbp->have_posts() ) : $wpbp->the_post();
					if ( $post_count == $numberOfPosts ) {
						break;
					}
					$reviews	 		= rwmb_meta( 'deep_blogpost_review' );
					$total_vots			= 0;
					$total_rates		= 0;
					$stars				= '';
					$item_empty_stars	= '';
					$item_full_stars	= '';

					if ( ! empty( $reviews['0']['0'] ) && ! empty( $reviews['0']['1'] ) ) {
						$stars .= '<ul class="wn-review-section">';
							foreach ( $reviews as $item ) {
								if ( !empty( $item['0'] ) and !empty( $item['1'] ) ) {
									$total_vots = $total_vots + round( $item['1'] );
									$total_rates++;
								}
							}
							if ( $total_vots != 0 && $total_rates != 0 ) {
								$average	= $total_vots / $total_rates;
								$decimals	=  explode( '.', $average );
								$stars .= '<li class="wn-average-stars">';
								$stars .= '<div class="wn-empty-stars">';
								for ( $i = 0; $i < 5; $i++ ) {
									$stars .= '<i class="wn-far wn-fa-star"></i>';
								}
								$stars .= '</div>';
								$stars .= '<div class="wn-stars">';
								for ( $i = 0; $i < $decimals['0']; $i++ ) {
									$stars .= '<i class="wn-fas wn-fa-star full-stars"></i>';
								}
								if ( isset( $decimals['1'] ) ) :
									if ( $decimals['1'] <= 5 ) {
										$stars .= '<i class="wn-fas wn-fa-star-half half-stars"></i>';
									} elseif ( $decimals['1'] > 5 ) {
										$stars .= '<i class="wn-fas wn-fa-star"></i>';
									}
								endif;
								$stars .= '</div>';
								$stars .= '</li>';
							}
							$stars .='</ul>';

						// render
						$thumbnail_url = get_the_post_thumbnail_url();
						$thumbnail_id  = get_post_thumbnail_id();
						if( !empty( $thumbnail_url ) && !empty( $thumbnail_id ) ) {
							if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
								require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
							}
							$image = new Wn_Img_Maniuplate;
							if ( $post_count == 0 ) {
								$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '404' , '235' );
							} else {
								$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '80' , '60' );
							}
						}
						?>
						<li class="post-review-item">
							<?php if ( $thumbnail_url ) { ?>
								<div class="review-figure">
									<img src="<?php echo esc_url( $thumbnail_url ) ?>" alt="<?php the_title(); ?>" >
								</div>
							<?php } ?>
							<div class="review-content">
								<p class="review-date"><?php the_time( get_option( 'date_format' ) ) ?></p>
								<h5 class="review-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h5>
								<?php if( $stars ) { ?>
									<div class="review-star"><?php echo $stars; ?></div>
								<?php } ?>
							</div>
						</li>
						<?php
						$post_count++;
					}
				endwhile; endif;
				wp_reset_postdata();
				?>
        	</ul>
        </div>
		<?php echo $after_widget;
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'deep_latestreview', true) ) {
			wp_enqueue_style( 'deep-post-review-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/post-review.css', false, DEEP_VERSION );
		}
	}

}

add_action( 'widgets_init', 'register_deep_latest_review' );
function register_deep_latest_review() {
	register_widget( 'deep_LatestReview' );
}
