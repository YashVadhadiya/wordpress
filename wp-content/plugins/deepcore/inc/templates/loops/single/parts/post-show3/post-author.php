<?php
/**
 * Deep Theme.
 *
 * Single Post Magazine template
 *
 * @since   3.2.3
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$deep_options			= deep_options();
$enable_date_meta		= deep_get_option( $deep_options, 'deep_blog_meta_date_enable', '1' );
$enable_category_meta	= deep_get_option( $deep_options, 'deep_blog_meta_category_enable', '1' );
$enable_gravatar_meta	= deep_get_option( $deep_options, 'deep_blog_meta_gravatar_enable', '1' );
$enable_author_meta		= deep_get_option( $deep_options, 'deep_blog_meta_author_enable', '0' );
$post_excerpt			= rwmb_meta( 'deep_post_excerpt' );
