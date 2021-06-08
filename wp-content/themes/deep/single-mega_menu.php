<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package deep
 */

get_header();

/**
 * The function is located in the following path
 * deep/src/class-deep-theme.php
 */
do_action( 'deep_theme_page' );

get_sidebar();
get_footer();
