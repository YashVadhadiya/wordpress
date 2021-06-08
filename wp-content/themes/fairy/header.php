<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fairy
 */
global $fairy_theme_options;
$fairy_theme_options = fairy_get_options_value();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
//wp_body_open hook from WordPress 5.2
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}else { 
    do_action( 'wp_body_open' ); 
}
?><div id="page" class="site">
<?php

/**
 * fairy_before_header hook.
 *
 * @since 1.0.0
 *
 * @hooked fairy_do_skip_to_content_link - 10
 *
 */
do_action('fairy_before_header');

/**
 * fairy_header hook.
 *
 * @since 1.0.0
 *
 * @hooked fairy_header_search_modal - 10
 * @hooked fairy_construct_header - 20
 */
do_action('fairy_header');
?>
<div id="content" class="site-content">