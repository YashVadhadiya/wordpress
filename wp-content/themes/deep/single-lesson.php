<?php
/**
 * Deep Theme.
 *
 * The template for displaying lesson single
 *
 * @since   1.0.0
 * @author  Webnus
 */

if ( defined( 'DEEPCORE' ) ) {
	get_header();
	do_action( 'deepcore_single_lesson' );
	get_footer();
}