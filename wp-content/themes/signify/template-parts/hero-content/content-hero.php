<?php
/**
 * The template used for displaying hero content
 *
 * @package Signify
 */

$enable_section = get_theme_mod( 'signify_hero_content_visibility', 'disabled' );

if ( ! signify_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type-hero' );
