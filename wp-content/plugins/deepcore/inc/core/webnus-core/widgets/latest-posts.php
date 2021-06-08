<?php
function deep_LatestPosts_shortcode( $attributes, $content = null ) {

	extract(shortcode_atts(	array(

		'post_number'			=> '',

	), $attributes));

		 $post_number				= $post_number? $post_number : '';


			$instance = array(
				'numberOfPosts'							=> $post_number,
			);

		$args = array(
			'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
			'after_title'	=> '</h4></div>'
		);

	return get_the_widget( 'deep_LatestPosts', $instance, $args );
}

add_shortcode( 'widget-LatestPosts', 'deep_LatestPosts_shortcode' );
