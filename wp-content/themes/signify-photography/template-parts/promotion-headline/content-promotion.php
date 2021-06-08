<?php
/**
 * The template used for displaying hero content
 *
 * @package Signify_Photography
 */

$signify_enable_section = get_theme_mod( 'signify_promo_head_visibility', 'disabled' );

if ( ! signify_check_section( $signify_enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/promotion-headline/post-type', 'promotion' );
