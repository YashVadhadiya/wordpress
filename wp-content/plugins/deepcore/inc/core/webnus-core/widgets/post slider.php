<?php
function post_slider_shortcode( $attributes, $content = null ) {

	extract(shortcode_atts(	array(

		'posts_count'			=> '',

	), $attributes));

	$posts_count				= $posts_count? $posts_count : '';


	$instance = array(
		'count'						=> $posts_count,
	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'WebnusPostSliderWidget', $instance, $args );
}

add_shortcode( 'widget-post-slider', 'post_slider_shortcode' );
