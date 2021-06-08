<?php
function deep_widget_popular_posts( $attributes, $content = null ) {
	extract(shortcode_atts(	array(
	
		'widget_title'	=> '',
		'post_count'	=> '',
	
	), $attributes));
	
	$widget_title	= $widget_title ? $widget_title : '';
	$post_count		= $post_count ? $post_count : '10';

	$instance = array(
		'title'			=> $widget_title,
		'numberOfPosts'	=> $post_count
	);
	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'deep_PopularPosts', $instance, $args );
}

add_shortcode( 'widget-popular-posts', 'deep_widget_popular_posts' );
