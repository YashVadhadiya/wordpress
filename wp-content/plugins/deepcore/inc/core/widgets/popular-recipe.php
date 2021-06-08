<?php

if ( ! defined('RECIPES_DIR') )
	return;

class deep_PopularRecipe extends WP_Widget {
	function __construct() {
		$params = array(
			'description'	=> 'Display Popular Recipe',
			'name'			=> 'Webnus-Popular Recipe',
		);
		parent::__construct( 'deep_PopularRecipe', '', $params );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function form( $instance ) {
		extract( $instance ); ?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>"><?php esc_html_e('Title:','deep') ?></label><input	type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('title') ) ?>"	name="<?php echo esc_attr( $this->get_field_name('title') ) ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('numberOfPosts') ) ?>"><?php esc_html_e('Number of Posts:','deep') ?></label><input type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('numberOfPosts') ) ?>"	name="<?php echo esc_attr( $this->get_field_name('numberOfPosts') ) ?>"	value="<?php if( isset($numberOfPosts) )  echo esc_attr($numberOfPosts); ?>" /></p>
		<?php
	}

	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		if( !isset( $title ) )
			$title = '';

		if( !isset( $numberOfPosts ) )
			$numberOfPosts = 5 ;

		echo '' . $before_widget;

		if( !empty( $title ) )
			echo '' . $before_title . esc_html($title) . $after_title; ?>

		<div class="recipe-list">
		<?php  ?>
			<ul>
				<?php
				$wpbp = new WP_Query(
					array(
						'post_type'			=> 'recipe',
						'paged'				=> 1,
						'posts_per_page'	=> $numberOfPosts,
						'orderby'			=> 'comment_count'
					)
				);

				$temp_out = "";

				if ( $wpbp->have_posts() ) : while ( $wpbp->have_posts() ) : $wpbp->the_post();
					global $post ?>
					<li>
						<?php
						$thumbnail_url = get_the_post_thumbnail_url();
						$thumbnail_id  = get_post_thumbnail_id();
						?>
						<img src="<?php echo '' . $thumbnail_url; ?>" alt="<?php the_title(); ?>">
						<div>
							<p class="date"><?php echo get_the_date(); ?></p>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
					</li>
				<?php endwhile; endif; wp_reset_postdata(); ?>
        	</ul>
        </div>
		<?php
	}

	public function enqueue_scripts() {
		if ( is_active_widget(false, false, 'deep_popularrecipe', true) ) {
			wp_enqueue_style( 'deep-recipe-list-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/recipe-list.css', false, DEEP_VERSION );
		}
	}

}
add_action('widgets_init', 'register_deep_PopularRecipe');
function register_deep_PopularRecipe(){
	register_widget('deep_PopularRecipe');
}
