<?php
function deep_youtube_shortcode( $attributes, $content = null ) {
	extract( shortcode_atts( array(
		'youtube_txt'			=> 'UCmQ-VeVK7nLR3bGpAkSYB1Q',
	), $attributes)) ;
	
	$youtube_txt	= $youtube_txt ? $youtube_txt : '';
	$instance		= array( 'id' => $youtube_txt, );
	$args			= array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);
	return get_the_widget( 'deep_youtube_widget', $instance, $args );
}
add_shortcode( 'widget-youtube', 'deep_youtube_shortcode' );
