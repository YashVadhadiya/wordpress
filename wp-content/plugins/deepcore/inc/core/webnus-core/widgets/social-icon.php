<?php
function deep_SocialWidget_shortcode( $attributes, $content = null ) {

	extract(shortcode_atts(	array(


	), $attributes));


	$instance = array(

	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'WebnusSocialWidget', $instance, $args );
}

add_shortcode( 'widget-SocialWidget', 'deep_SocialWidget_shortcode' );
