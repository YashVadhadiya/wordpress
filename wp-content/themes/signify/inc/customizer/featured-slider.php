<?php
/**
 * Featured Slider Options
 *
 * @package Signify
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'signify_featured_slider', array(
			'panel' => 'signify_theme_options',
			'title' => esc_html__( 'Featured Slider', 'signify' ),
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'signify_sanitize_select',
			'choices'           => signify_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'signify' ),
			'section'           => 'signify_featured_slider',
			'type'              => 'select',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_slider_number',
			'default'           => 2,
			'sanitize_callback' => 'signify_sanitize_number_range',

			'active_callback'   => 'signify_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'signify' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'signify' ),
			'section'           => 'signify_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'signify_slider_number', 2 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {

		// Page Sliders
		signify_register_option( $wp_customize, array(
				'name'              => 'signify_slider_page_' . $i,
				'sanitize_callback' => 'signify_sanitize_post',
				'active_callback'   => 'signify_is_slider_active',
				'label'             => esc_html__( 'Page', 'signify' ) . ' # ' . $i,
				'section'           => 'signify_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);

	} // End for().
}
add_action( 'customize_register', 'signify_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'signify_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since 1.0.0
	*/
	function signify_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'signify_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return signify_check_section( $enable );
	}
endif;
