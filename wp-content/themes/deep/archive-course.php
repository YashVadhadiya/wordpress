<?php
/**
 * Deep Theme.
 *
 * The template for displaying course archive
 *
 * @since   1.0.0
 * @author  Webnus
 */

if ( defined( 'DEEPCORE' ) ) {
	get_header();
	do_action( 'deepcore_archive_course' );
	get_footer();
}