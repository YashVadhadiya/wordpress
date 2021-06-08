<?php
/**
 * Deep Theme.
 *
 * The template for displaying portfolio category
 *
 * @since   1.0.0
 * @author  Webnus
 */

if ( defined( 'DEEPCORE' ) ) {
	get_header();
	do_action( 'deepcore_taxonomy_portfolio_category' );
	get_footer();
}