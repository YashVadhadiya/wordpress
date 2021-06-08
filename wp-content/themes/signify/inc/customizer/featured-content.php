<?php
/**
 * Featured Content options
 *
 * @package Signify
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_featured_content_options( $wp_customize ) {

    $wp_customize->add_section( 'signify_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'signify' ),
			'panel' => 'signify_theme_options',
		)
	);

	// Add color scheme setting and control.
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_featured_content_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'signify_sanitize_select',
			'choices'           => signify_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'signify' ),
			'section'           => 'signify_featured_content',
			'type'              => 'select',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_featured_content_title',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'signify_is_featured_content_active',
			'label'             => esc_html__( 'Section Title', 'signify' ),
			'section'           => 'signify_featured_content',
			'type'              => 'text',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_featured_content_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'signify_is_featured_content_active',
			'label'             => esc_html__( 'Section Description', 'signify' ),
			'section'           => 'signify_featured_content',
			'type'              => 'textarea',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'signify_sanitize_number_range',
			'active_callback'   => 'signify_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'signify' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Featured Content', 'signify' ),
			'section'           => 'signify_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'signify_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		signify_register_option( $wp_customize, array(
				'name'              => 'signify_featured_content_page_' . $i,
				'sanitize_callback' => 'signify_sanitize_post',
				'active_callback'   => 'signify_is_featured_content_active',
				'label'             => esc_html__( 'Featured Page', 'signify' ) . ' ' . $i ,
				'section'           => 'signify_featured_content',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'signify_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'signify_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since 1.0.0
	*/
	function signify_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'signify_featured_content_option' )->value();

		return signify_check_section( $enable );
	}
endif;
