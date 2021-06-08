<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Signify
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_testimonial_options( $wp_customize ) {
    $wp_customize->add_section( 'signify_testimonials', array(
            'panel'    => 'signify_theme_options',
            'title'    => esc_html__( 'Testimonials', 'signify' ),
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_testimonial_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'signify_sanitize_select',
            'choices'           => signify_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'signify' ),
            'section'           => 'signify_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_testimonial_headline',
            'default'           => esc_html__( 'Testimonials', 'signify' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Section Title', 'signify' ),
            'active_callback'   => 'signify_is_testimonial_active',
            'section'           => 'signify_testimonials',
            'type'              => 'text',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_testimonial_description',
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Section Description', 'signify' ),
            'active_callback'   => 'signify_is_testimonial_active',
            'section'           => 'signify_testimonials',
            'type'              => 'textarea',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_testimonial_number',
            'default'           => '5',
            'sanitize_callback' => 'signify_sanitize_number_range',
            'active_callback'   => 'signify_is_testimonial_active',
            'label'             => esc_html__( 'Number of items', 'signify' ),
            'section'           => 'signify_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'signify_testimonial_number', 5 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        signify_register_option( $wp_customize, array(
                'name'              => 'signify_testimonial_page_' . $i,
                'sanitize_callback' => 'signify_sanitize_post',
                'active_callback'   => 'signify_is_testimonial_active',
                'label'             => esc_html__( 'Page', 'signify' ) . ' ' . $i ,
                'section'           => 'signify_testimonials',
                'type'              => 'dropdown-pages',
            )
        );

        signify_register_option( $wp_customize, array(
                'name'              => 'signify_testimonial_position_' . $i,
                'sanitize_callback' => 'sanitize_text_field',
                'active_callback'   => 'signify_is_testimonial_active',
                'label'             => esc_html__( 'Position', 'signify' ),
                'section'           => 'signify_testimonials',
                'type'              => 'text',
            )
        );
    } // End for().
}
add_action( 'customize_register', 'signify_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'signify_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since 1.0.0
    */
    function signify_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'signify_testimonial_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return signify_check_section( $enable );
    }
endif;
