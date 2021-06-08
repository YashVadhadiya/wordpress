<?php
function deep_subscribe_shortcode( $attributes, $content = null ) {

	extract(shortcode_atts(	array(
		'display'			=> '',
		'subscribe_service'	=> '',
		'feedburner_txt'	=> '',
		'mailchimp_txt'		=> '',
		'custom_text'		=> '',

	), $attributes));

	$display				= $display ? $display : '';
	$subscribe_service		= $subscribe_service ? $subscribe_service : '';
	$feedburner_txt			= $feedburner_txt ? $feedburner_txt : '';
	$mailchimp_txt			= $mailchimp_txt ? $mailchimp_txt : '';
	$custom_text			= $custom_text ? $custom_text : '';


	$instance = array(
		'display'			=> $display,
		'type'				=> $subscribe_service,
		'id'				=> $feedburner_txt,
		'url'				=> $mailchimp_txt,
		'text'				=> $custom_text,
	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'deep_subscribe_widget', $instance, $args );
}

add_shortcode( 'widget-subscribe', 'deep_subscribe_shortcode' );
