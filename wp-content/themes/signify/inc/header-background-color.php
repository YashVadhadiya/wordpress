<?php
/**
 * Customizer functionality
 *
 * @package Signify
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since 1.0.0
 *
 * @see signify_header_style()
 */
function signify_custom_header_and_background() {
	/**
	 * Filter the arguments used when adding 'custom-background' support in Signify.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'signify_custom_background_args', array(
		'default-color' => '#ffffff',
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Signify.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'signify_custom_header_args', array(
		'default-image'      	=> get_parent_theme_file_uri( '/images/header-image.jpg' ),
		'default-text-color'    => '#000000',
		'width'                 => 1920,
		'height'                => 1080,
		'flex-height'           => true,
		'flex-width'            => true,
		'wp-head-callback'      => 'signify_header_style',
		'video'                 => true,
	) ) );
}
add_action( 'after_setup_theme', 'signify_custom_header_and_background' );

/**
 * Customize video play/pause button in the custom header.
 *
 * @param array $settings header video settings.
 */
function signify_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'signify' ) . '</span>';
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'signify' ) . '</span>';
	return $settings;
}
add_filter( 'header_video_settings', 'signify_video_controls' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 * @see signify_customize_register()
 *
 * @return void
 */
function signify_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.0.0
 * @see signify_customize_register()
 *
 * @return void
 */
function signify_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
