<?php
/**
 * Deep Theme.
 *
 * The template for displaying recipe single
 *
 * @since   1.0.0
 * @author  Webnus
 */

if ( defined( 'DEEPCORE' ) ) {
	get_header();
	do_action( 'deepcore_single_recipe' );
	get_footer();
}