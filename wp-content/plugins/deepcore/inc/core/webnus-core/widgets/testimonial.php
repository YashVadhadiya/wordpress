<?php
function deep_testimonial_shortcode( $attributes, $content = null ) {
	extract( shortcode_atts( array(
		'img_testimonial'		=> '',
		'name_testimonial'		=> '',
		'subtitle_testimonial'		=> '',
		'textarea_testimonial'	=> '',
	), $attributes )) ;

	$img_testimonial		= is_numeric( $img_testimonial ) ? wp_get_attachment_url( $img_testimonial ) : '';
	$name_testimonial		= $name_testimonial? $name_testimonial : '';
	$textarea_testimonial	= $textarea_testimonial? $textarea_testimonial : '';

	$instance = array(
		'image'		=> $img_testimonial,
		'name'		=> $name_testimonial,
		'subtitle'	=> $subtitle_testimonial,
		'text'		=> $textarea_testimonial,
	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'WebnusTestimonialWidget', $instance, $args );
}

add_shortcode( 'widget-testimonial', 'deep_testimonial_shortcode' );
