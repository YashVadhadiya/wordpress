<?php
function deep_latest_review_shortcode( $attributes, $content = null ) {

	extract(shortcode_atts(	array(

		'number_review'			=> '',

	), $attributes));

	$number_review				= $number_review? $number_review : '';


	$instance = array(
		'numberOfPosts'			=> $number_review,
	);

	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'deep_LatestReview', $instance, $args );
}

add_shortcode( 'widget-latest-review', 'deep_latest_review_shortcode' );
