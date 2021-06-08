<?php
/**
 * Deep Theme.
 *
 * The template for displaying sermon series single
 *
 * @since   1.0.0
 * @author  Webnus
 */

if ( defined( 'DEEPCORE' ) ) {
	get_header();
	do_action( 'deepcore_taxonomy_sermon_series' );
	get_footer();
}