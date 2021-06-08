<?php
/**
 * Hero Content Options
 *
 * @package Signify
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'signify_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'signify' ),
			'panel' => 'signify_theme_options',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'signify_sanitize_select',
			'choices'           => signify_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'signify' ),
			'section'           => 'signify_hero_content_options',
			'type'              => 'select',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'signify_sanitize_post',
			'active_callback'   => 'signify_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'signify' ),
			'section'           => 'signify_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_hero_content_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'signify_sanitize_select',
			'active_callback'   => 'signify_is_hero_content_active',
			'choices'           => signify_content_show(),
			'label'             => esc_html__( 'Display Content', 'signify' ),
			'section'           => 'signify_hero_content_options',
			'type'              => 'select',
		)
	);
}
add_action( 'customize_register', 'signify_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'signify_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since 1.0.0
	*/
	function signify_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'signify_hero_content_visibility' )->value();

		return signify_check_section( $enable );
	}
endif;
