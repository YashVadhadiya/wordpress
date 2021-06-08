<?php
/**
 * Deep Theme.
 *
 * The template for displaying attachment pages
 *
 * @since   1.0.0
 * @author  Webnus
 */

if ( defined( 'DEEPCORE' ) ) {
	get_header();
	do_action( 'attachment_content' );
	get_footer();
}