<?php
function deep_widget_about( $attributes, $content = null ) {
	
	extract(shortcode_atts(	array(

		'name'			=> '',
		'image'			=> '',
		'description'	=> '',

	), $attributes));

	$name			= $name ? $name : '';
	$image			= is_numeric( $image ) ? wp_get_attachment_url( $image ) : '';
	$description	= $description ? $description : '';

	$instance = array(
		'name'			=> $name,
		'imageurl'		=> $image,
		'description'	=> $description,
	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'WebnusAboutWidget', $instance, $args );
}

add_shortcode( 'widget-about', 'deep_widget_about' );
