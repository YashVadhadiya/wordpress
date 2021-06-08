<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package deep
 */

get_header();

/**
 * The function is located in the following path
 * deep/src/class-deep-theme.php
 */
do_action( 'deep_theme_search' );

get_footer();