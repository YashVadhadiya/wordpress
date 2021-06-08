<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Signify
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_jetpack_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Signify_Note_Control',
			'label'             => sprintf( esc_html__( 'For Portfolio Options for this theme, go %1$shere%2$s', 'signify' ),
				 '<a href="javascript:wp.customize.section( \'signify_portfolio\' ).focus();">',
				 '</a>'
			),
			'section'           => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'signify_portfolio', array(
			'panel'    => 'signify_theme_options',
			'title'    => esc_html__( 'Portfolio', 'signify' ),
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'signify_sanitize_select',
			'choices'           => signify_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'signify' ),
			'section'           => 'signify_portfolio',
			'type'              => 'select',
		)
	);

	signify_register_option( $wp_customize, array(
	        'name'              => 'signify_portfolio_title',
	        'sanitize_callback' => 'wp_kses_post',
	        'label'             => esc_html__( 'Section Title', 'signify' ),
	        'active_callback'   => 'signify_is_portfolio_active',
	        'section'           => 'signify_portfolio',
	        'type'              => 'text',
	    )
	);

	signify_register_option( $wp_customize, array(
	        'name'              => 'signify_portfolio_description',
	        'sanitize_callback' => 'wp_kses_post',
	        'label'             => esc_html__( 'Section Description', 'signify' ),
	        'active_callback'   => 'signify_is_portfolio_active',
	        'section'           => 'signify_portfolio',
	        'type'              => 'textarea',
	    )
	);


	signify_register_option( $wp_customize, array(
			'name'              => 'signify_portfolio_number',
			'default'           => 6,
			'sanitize_callback' => 'signify_sanitize_number_range',
			'active_callback'   => 'signify_is_portfolio_active',
			'label'             => esc_html__( 'Number of items to show', 'signify' ),
			'section'           => 'signify_portfolio',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	$number = get_theme_mod( 'signify_portfolio_number', 6 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		//for CPT
		        signify_register_option( $wp_customize, array(
                'name'              => 'signify_portfolio_page_' . $i,
                'sanitize_callback' => 'signify_sanitize_post',
                'active_callback'   => 'signify_is_portfolio_active',
                'label'             => esc_html__( 'Page', 'signify' ) . ' ' . $i ,
                'section'           => 'signify_portfolio',
                'type'              => 'dropdown-pages',
            )
        );
	} // End for().
}
add_action( 'customize_register', 'signify_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'signify_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since 1.0.0
	*/
	function signify_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'signify_portfolio_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( signify_check_section( $enable ) );
	}
endif;
