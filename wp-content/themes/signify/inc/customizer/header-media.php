<?php
/**
 * Header Media Options
 *
 * @package Signify
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'signify' );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'signify_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'signify' ),
				'entire-site'            => esc_html__( 'Entire Site', 'signify' ),
				'disable'                => esc_html__( 'Disabled', 'signify' ),
			),
			'label'             => esc_html__( 'Enable on', 'signify' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);
	
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'signify' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Site Header Text', 'signify' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_media_url',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'signify' ),
			'section'           => 'header_image',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'signify' ),
			'section'           => 'header_image',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_url_target',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'signify' ),
			'section'           => 'header_image',
			'type'   	 		=> 'checkbox',
		)
	);
}
add_action( 'customize_register', 'signify_header_media_options' );
