<?php
/**
 * Theme Customizer
 *
 * @package Signify
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport              = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'header_video' )->transport          = 'refresh';
	$wp_customize->get_setting( 'external_header_video' )->transport = 'refresh';
	$wp_customize->get_setting( 'header_image' )->transport 		 = 'refresh';
	$wp_customize->register_section_type( 'Signify_Customize_Section_Upsell' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'signify_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'signify_customize_partial_blogdescription',
		) );
	}

	// Reset all settings to default.
	$wp_customize->add_section( 'signify_reset_all', array(
		'description'   => esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'signify' ),
		'title'         => esc_html__( 'Reset all settings', 'signify' ),
		'priority'      => 998,
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_reset_all_settings',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'label'             => esc_html__( 'Check to reset all settings to default', 'signify' ),
			'section'           => 'signify_reset_all',
			'transport'         => 'postMessage',
			'type'              => 'checkbox',
		)
	);

	// Important Links.
	$wp_customize->add_section( 'signify_important_links', array(
		'priority'      => 999,
		'title'         => esc_html__( 'Important Links', 'signify' ),
	) );

	// Has dummy Sanitizaition function as it contains no value to be sanitized.
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_important_links',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Signify_Important_Links_Control',
			'label'             => esc_html__( 'Important Links', 'signify' ),
			'section'           => 'signify_important_links',
			'type'              => 'signify_important_links',
		)
	);
	// Important Links End.

	// Register sections.
	$wp_customize->add_section(
		new Signify_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Signify Pro', 'signify' ),
				'pro_text' => esc_html__( 'Buy Pro', 'signify' ),
				'pro_url'  => 'https://themepalace.com/downloads/signify-pro/',
				'priority'  => 1,
			)
		)
	);
}
add_action( 'customize_register', 'signify_customize_register', 999 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function signify_customize_preview_js() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'signify-customize-preview', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/js/customize-preview' . $min . '.js', array( 'customize-preview' ), '2020', true );
}
add_action( 'customize_preview_init', 'signify_customize_preview_js' );

/**
 * Register customizer controls scripts.
 *
 * @since 0.1
 */
function signify_customize_controls_register_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	
	wp_enqueue_script( 'signify-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'jquery', 'customize-controls', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0.0', true );
	
	wp_enqueue_style( 'signify-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css', array(), '1.0.0' );
}

add_action( 'customize_controls_enqueue_scripts', 'signify_customize_controls_register_scripts', 0 );

/**
 * Include Custom Controls
 */
require get_parent_theme_file_path( 'inc/customizer/custom-controls.php' );

/**
 * Include Header Media Options
 */
require get_parent_theme_file_path( 'inc/customizer/header-media.php' );

/**
 * Include Theme Options
 */
require get_parent_theme_file_path( 'inc/customizer/theme-options.php' );

/**
 * Include Hero Content
 */
require get_parent_theme_file_path( 'inc/customizer/hero-content.php' );

/**
 * Include Featured Slider
 */
require get_parent_theme_file_path( 'inc/customizer/featured-slider.php' );

/**
 * Include Featured Content
 */
require get_parent_theme_file_path( 'inc/customizer/featured-content.php' );

/**
 * Include Testimonial
 */
require get_parent_theme_file_path( 'inc/customizer/testimonial.php' );

/**
 * Include Portfolio
 */
require get_parent_theme_file_path( 'inc/customizer/portfolio.php' );

/**
 * Include Customizer Helper Functions
 */
require get_parent_theme_file_path( 'inc/customizer/helpers.php' );

/**
 * Include Sanitization functions
 */
require get_parent_theme_file_path( 'inc/customizer/sanitize-functions.php' );

/**
 * Include Service
 */
require get_parent_theme_file_path( 'inc/customizer/service.php' );
