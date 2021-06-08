<?php
/**
 * Services options
 *
 * @package Signify Pro
 */

/**
 * Add service content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_service_options( $wp_customize ) {
	
    $wp_customize->add_section( 'signify_service', array(
			'title' => esc_html__( 'Services', 'signify' ),
			'panel' => 'signify_theme_options',
		)
	);

	// Add color scheme setting and control.
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'signify_sanitize_select',
			'choices'           => signify_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'signify' ),
			'section'           => 'signify_service',
			'type'              => 'select',
		)
	);
	signify_register_option( $wp_customize, array(
	        'name'              => 'signify_service_title',
	        'sanitize_callback' => 'wp_kses_post',
	        'active_callback'   => 'signify_is_service_active',
	        'label'             => esc_html__( 'Section Title', 'signify' ),
	        'section'           => 'signify_service',
	        'type'              => 'text',
	    )
	);

	signify_register_option( $wp_customize, array(
	        'name'              => 'signify_service_description',
	        'sanitize_callback' => 'wp_kses_post',
	        'active_callback'   => 'signify_is_service_active',
	        'label'             => esc_html__( 'Section Description', 'signify' ),
	        'section'           => 'signify_service',
	        'type'              => 'textarea',
	    )
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_service_number',
			'default'           => 3,
			'sanitize_callback' => 'signify_sanitize_number_range',
			'active_callback'   => 'signify_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'signify' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'signify' ),
			'section'           => 'signify_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'signify_service_number', 3 );

	//loop for service post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		        signify_register_option( $wp_customize, array(
                'name'              => 'signify_service_page_' . $i,
                'sanitize_callback' => 'signify_sanitize_post',
                'active_callback'   => 'signify_is_service_active',
                'label'             => esc_html__( 'Services Page', 'signify' ) . ' ' . $i ,
                'section'           => 'signify_service',
                'type'              => 'dropdown-pages',
                'allow_addition'    => true,
            )
        );
	} // End for().
}
add_action( 'customize_register', 'signify_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'signify_is_service_active' ) ) :
	/**
	* Return true if service content is active
	*
	* @since 1.0.0
	*/
	function signify_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'signify_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return signify_check_section( $enable );
	}
endif;
