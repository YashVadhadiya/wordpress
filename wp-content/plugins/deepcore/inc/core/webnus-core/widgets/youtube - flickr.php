<?php
function deep_flickr_shortcode( $attributes, $content = null ) {

	extract(shortcode_atts(	array(

		'flickr_script'			=> '',

	), $attributes));

	$flickr_script				= $flickr_script? $flickr_script : '';


	$instance = array(
		'flickr'								=> $flickr_script,
	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'YFlickr', $instance, $args );
}

add_shortcode( 'widget-flickr', 'deep_flickr_shortcode' );
