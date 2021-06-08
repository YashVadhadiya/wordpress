<?php
/**
 * TGM implementation.
 *
 * @package Signify
 */

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'signify_register_recommended_plugins' );

/**
 * Register recommended plugins.
 *
 * @since 1.0.0
 */
function signify_register_recommended_plugins() {

	// Plugins.
	$plugins = array(
		array(
			'name' => esc_html__( 'Contact Form 7', 'signify' ),
			'slug' => 'contact-form-7',
		),
		array(
			'name' => esc_html__( 'WEN Featured Image', 'signify' ),
			'slug' => 'wen-featured-image',
		),
		array(
			'name' => esc_html__( 'Essential Content Types', 'signify' ),
			'slug' => 'essential-content-types',
		),
		array(
			'name' => esc_html__( 'Catch Themes Demo Import', 'signify' ),
			'slug' => 'catch-themes-demo-import',
		),
	);

	// TGM configurations.
	$config = array(
	);

	// Register now.
	tgmpa( $plugins, $config );

}

