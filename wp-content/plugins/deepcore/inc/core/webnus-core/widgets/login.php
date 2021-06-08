<?php
function deep_login_widget_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(	array(

	), $attributes));



	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'WebnusLoginWidget', '', $args );
}

add_shortcode( 'widget-login-widget', 'deep_login_widget_shortcode' );
