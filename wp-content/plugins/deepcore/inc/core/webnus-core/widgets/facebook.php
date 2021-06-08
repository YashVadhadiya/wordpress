<?php
function deep_facebook_shortcode( $attributes, $content = null ) {

	extract(shortcode_atts(	array(

		'facebook_url'			=> '',

	), $attributes));

	$facebook_url					= $facebook_url? $facebook_url : '';


	$instance = array(
		'url'								=> $facebook_url,
	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'deep_facebook_widget', $instance, $args );
}

add_shortcode( 'widget-facebook', 'deep_facebook_shortcode' );
